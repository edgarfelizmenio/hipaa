<?php include_once('common.php');?>
<html>
<head>
</head>

<body>
<?php
 /**
  * Using the prolog method setof, this script generates all the possible
  * values that can be used in our standard HIPAA call.  It takes the
  * ouput of the prolog call, sends it to a perl script to be parsed and
  * saves the ouput into two formats: JSON and serialized PHP.  
  *
  * The serialized PHP is for other PHP scripts to be able to access the
  * possible values in a native format.
  */
$action = $_GET['action'];
switch ($action) {
 case 'refresh':
   // remove the file that currently holds old possible values
   shell_exec("rm -rf " . CACHE_PATH . CACHE_FILE); // PHP serialized file

   // get the leaf nodes of Msg_(to,from,about)
   $evalVars = array('Msg_to','Msg_from','Msg_about');
   $query = "Msg_purpose^Belief_about^Belief_what^Belief_by^pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,b(Belief_about,Belief_what,Belief_by)))";
   $poss_json1 = $prolog->getPossibleVals($evalVars, $query, 'filter_inner_role_nodes');

   // get the rest of the possible values
   $query = "Msg_to^Msg_from^Msg_about^pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,b(Belief_about,Belief_what,Belief_by)))";
   $evalVars = array('Msg_purpose','Belief_about','Belief_what','Belief_by');
   $poss_json2 = $prolog->getPossibleVals($evalVars, $query, 'filter_vars');




   $poss_php1 = json_decode($poss_json1);
   $poss_php2 = json_decode($poss_json2);


   // construct Msg_consent set (set join of Msg_to, Msg_from, and Msg_about)
   $msg_consent = array();
   foreach($poss_php1 as $key => $arr) {
     for($i = 0; $i < count($arr); $i++) {
	 $value = $arr[$i];
	 $msg_consent[$value] = 1;
     }
   }
   $msg_consent = array_keys($msg_consent);

   // combine the two and add Msg_consent (set join of Msg_to, Msg_from, and Msg_about)
   foreach($poss_php2 as $key => $value) {
     $poss_php1->{$key} = $value;
   }
   $poss_php1->Msg_consent = $msg_consent;

   // save a PHP serialized version
   $fh = fopen(CACHE_PATH . CACHE_FILE, 'w+');
   fwrite($fh, serialize($poss_php1));
   fclose($fh);

   break;

 default:
   break;
 }

?>

<form action="" method="GET">
<button name="action" value="refresh">Refresh Possibilities</button>

</form>
<?php
   echo "<pre>";
$fh = fopen(CACHE_PATH . CACHE_FILE, 'r');
$contents = fread($fh, filesize(CACHE_PATH . CACHE_FILE));
print_r(unserialize($contents));
   echo "</pre>";


?>

</body>
</html>
