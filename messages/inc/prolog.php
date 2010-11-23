<?php
define('STARTMARK', '--START--');
define('ENDMARK', '--END--');

/**
 * Defines an interface for PHP scripts to execute prolog commands and
 * retrieve results from prolog calls.  XSB prolog is executed through the
 * command line through shell_exec().  Retrieving results is aided by a
 * STARTMARK and an ENDMARK defined as constants which are placed as
 * trivial goals in a prolog query.
 */
class Prolog {
  private $systemPath; // path to HIPAA rules
  private $xsb; // path to XSB binary
  private $ruleSet; // specific company rule file

  private $pStartMark; // prolog trivial goal used to delineate the 
  private $pEndMark;   // start and end of output we're interested in

  /**
   * Initializes variables necessary to execute XSB Prolog
   * 
   * @param systemPath the path to the system rules (such as HIPAA)
   * @param XsbPath path to XSB binary
   * @param ruleSet policy file to be loaded when XSB is called
   */
  function  __construct($systemPath=HIPAA_PATH,$xsbBinary=XSB_BIN,$ruleSet=POLICY_FILE) {
    if(!is_dir($systemPath))
      die('Error in system path');
    if(!is_file($xsbBinary))
      die('Error in XSB binary');
    if(!is_file($systemPath . '/' . $ruleSet))
      die('Error in rule set file');
    
    $this->systemPath = $systemPath;
    $this->xsb = $xsbBinary;
    $this->ruleSet = $ruleSet;
    $this->pStartMark =  "StartMark = '" . STARTMARK . "'";
    $this->pEndMark ="EndMark = '" . ENDMARK . "'";
  }
  
  
  /**
   * Directly queries the prolog engine with HIPAA ruleset loaded in
   *
   * @param query prolog query
   * @returns results of the prolog query
   */
  public function ask($query) {
    $command = "";
    $command .= "cd $this->systemPath;";
    $command .= "echo \"$query.\" | $this->xsb -e \"['$this->ruleSet'].\" 2>&1";

    return shell_exec($command);
  }

  /**
   * Queries HIPAA rules to determine if a message is allowed
   *
   * @param query a prolog query asking if a specific message in the form
   *              pbh(a(...)) is allowed under HIPAA
   * @returns string response indicating yes/no and the relevant HIPAA
   *                 clauses satisfied (if yes)
   */
  public function askHIPAA($query) {
    $query = str_replace("\n", "", $query); 
    
    $response = $this->ask($query);

    $passed = '';
    $endLoc = strrpos($response, '|') - 1;
    $offset = $endLoc - strlen($response) -1;
    $startLoc = strrpos($response, "\n",$offset) + 1;
    $passed = substr($response, $startLoc, $endLoc-$startLoc);

    switch($passed) {
    case 'no':
	$result = 'HIPAA says no';
	break;
    case 'yes':
	$start = 0;
	$marker = 'HIPAA rule ';

	while(($startLoc = strpos($response, $marker, $start)) !== false) {
	    $endLoc = strpos($response, ';', $startLoc);
	    $startLoc += strlen($marker);
	    $rules[] = substr($response, $startLoc, $endLoc - $startLoc);
	    $start = $startLoc + 1;
	}

	$result = 'HIPAA says yes <br />';
	if ($rules) {
	    foreach($rules as $rule) {
		$result .=  'Rule: ' . $rule . '<br />';
	    }
	}
	
	break;

    default:
	die('Error in parsing answer or in the query given');
    }


    return $result;
  }

  /**
   * Calculates all possible values for each of the variables specified
   * and returns the results in a JSON string
   *
   * @param vars array of variables that need to be evaluated
   * @param query the existing prolog query
   * @param filterFn the filter function to run the results through
   * @returns json string of possible values for each of the $vars
   */
  public function getPossibleVals($vars, $query, $filterFn) {
    // construct the query 
    $queries = $this->getPossibleQueries($vars, $query, array(), 0);
    
    $filterQueries = array();
    foreach($vars as $var) {
      $filterQueries[] = "$filterFn({$var}List,{$var}CleanList)";
    }  

    // add in start and end markers
    $queries[] = $this->pStartMark;
    $filterQueries[] = $this->pEndMark;

    // construct the full query
    $prologQuery = implode(    array_merge($queries, $filterQueries), ',');
    $response = $this->ask($prologQuery);

    // extract the answer out
    $startIndex = strrpos($response, STARTMARK) + strlen(STARTMARK) + 1;
    $endMark = $this->pEndMark;
    $endMark = str_replace("'", '', $endMark); 
    $endIndex = strrpos($response, $endMark) - 1;
    $results = substr($response, $startIndex , $endIndex - strlen($response));
    
    return $this->prologToJson($results);
  }
  
  /**
   * Converts the prolog output
   *   Msg_toCleanList = [carla,chief_of_medicine,dad] 
   *   Msg_purposeCleanList = [obtaining_authorization,payment,treatment] 
   *   Msg_aboutCleanList = [carla,dad,dead]
   * Into JSON formatted string
   *   {"Msg_to":["carla","chief_of_medicine","dad"],
   *    "Msg_purpose":["obtaining_authorization","payment","treatment"],
   *    "Msg_about":["carla","dad","dead"]}
   * @returns json string
   */
  private function prologToJson($prolog) {

      $prolog = str_replace('CleanList', '', $prolog);
      $prolog = str_replace('[', '["', $prolog);
      $prolog = str_replace(']', '"]', $prolog);
      $prolog = str_replace(',', '","', $prolog);
      $prolog = str_replace(' = ', '":', $prolog);
      $prolog = str_replace("\n", ',"', $prolog);

      $json = '{"' . $prolog . '}';
      return $json;
  } 

  /**
   * Generates a series of queries to find all the possible values for
   * each variable in $vars
   * Eg. Given the variables (Color, Shape, Size) and the query
   *     'object(Color,Shape,Size)', this function will return the
   *     following queries:
   *       setof(Color,Shape^Size^object(Color,Shape,Size),ColorList)
   *       setof(Shape,Color^Size^object(Color,Shape,Size),ShapeList)
   *       setof(Size,Color^Shape^object(Color,Shape,Size),SizeList)
   *     In this example, all the possible values of Color, Shape, and
   *     Size will be found by the query
   * @returns array of prolog queries 
   */
  private function getPossibleQueries($vars, $query, $queries, $i) {
    if (count($vars) == $i) return $queries; // reached the end of the array
    $queries = $this->getPossibleQueries($vars, $query, $queries, $i+1);

    $curValue = $vars[$i];
    array_splice($vars, $i, 1); // splice out that value
    $vars[] = $query;
    $existsVars = implode('^', $vars);
    
    $queries[] = "setof($curValue, $existsVars, {$curValue}List)";
    return $queries;
  }



}

?>
