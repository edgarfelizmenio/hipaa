<?php
define('STARTMARK', '--START--');
define('ENDMARK', '--END--');

class Prolog {

  /**
   * Constructs XSB Prolog class
   * 
   * @param systemPath the path to the system rules
   * @param XsbPath path to XSB binary
   */

  private $systemPath; // path to HIPAA rules
  private $xsb; // path to XSB binary
  private $ruleSet; // specific company rule file


  private $pStartMark;
  private $pEndMark;

  function  __construct($systemPath="/afs/ir.stanford.edu/users/s/t/stevetan/cgi-bin/hipaa/HIPAA",$xsbBinary="/afs/ir.stanford.edu/users/s/t/stevetan/cgi-bin/hipaa/XSB/bin/xsb",$ruleSet="shh.pl") {
    //  function  __construct($systemPath="/var/www/HIPAA",$xsbBinary="/var/www/XSB/bin/xsb",$ruleSet="shh.pl") {
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


  
  public function ask($query) {
    $command = "";
    $command .= "cd $this->systemPath;";
    $command .= "echo \"$query\" | $this->xsb -e \"['$this->ruleSet'].\" 2>&1";
    return shell_exec($command);
  }
  
  public function askHIPAA($query) {
    $query = str_replace("\n", "", $query);
    $cmd = 'cd ' . $this->systemPath . '; ../prolog "' . $query . '"';
    return shell_exec($cmd);
  }
  /**
   *
   * @param vars array of variables that need to be evaluated
   * @param query the existing prolog query
   */
  public function getPossibleVals($vars, $query) {
    $queries = $this->getPossibleQueries($vars, $query, array(), 0);
    
    $filterQueries = array();
    foreach($vars as $var) {
      $filterQueries[] =  "filter_list({$var}List,{$var}CleanList)";
    }
    
    $queries[] = $this->pStartMark;
    $filterQueries[] = $this->pEndMark;
    $prologQuery = implode(    array_merge($queries, $filterQueries), ',');
    $results = $this->ask($prologQuery);
    $startIndex = strrpos($results, STARTMARK);
    echo substr($results, $startIndex);

  }

  private function getPossibleQueries($vars, $query, $queries, $i) {
    if (count($vars) == $i) return $queries; // reached the end of the array
    $queries = $this->getPossibleQueries($vars, $query, $queries, $i+1);

    $curValue = $vars[$i];
    array_splice($vars, $i, 1); // splice out that value
    $existsVars = implode('^', $vars);
    
    $queries[] = "setof($curValue, $existsVars^$query, {$curValue}List)";
    return $queries;
  }



}

?>