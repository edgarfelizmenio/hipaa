
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
   $filepath = 'lib/scripts/';
   $filename = 'allpossibles';

   // remove the file that currently holds old possible values
   shell_exec("rm -rf $filename"); // JSON
   shell_exec("rm -rf $filename.php"); // PHP serialized

   $query = "pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,b(Belief_about,Belief_what,Belief_by)))";
   $evalVars = array('Msg_to','Msg_from','Msg_about','Msg_purpose','Belief_about','Belief_what','Belief_by');
   echo $prolog->getPossibleVals($evalVars, $query, true);
   exit;

   // generate a new one
   $prologCall = "setof(t(Msg_to,Msg_from,Msg_about,Msg_purpose,Belief_about,Belief_what,Belief_by),pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,b(Belief_about,Belief_what,Belief_by))),L).";        
   //$prologCall = "setof(t(Msg_to,Msg_from,Msg_about,Msg_purpose), pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,null)),L).";        
   // perl processes into JSON
   shell_exec("cd lib/scripts/; ./xsbexec '" . $prologCall . "' | perl  msg_possibles.pl > " . $filename);

   $fh = fopen($filepath . $filename, 'r');
   $string = fread($fh, filesize($filepath . $filename));
   fclose($fh);
   
   // save a PHP serialized version
   $fh = fopen($filepath . $filename . 'serialized.php', 'w');
   
   fwrite($fh, serialize(json_decode($string)));
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
   echo shell_exec("cd lib/scripts; cat allpossibles");
   echo "</pre>";


?>

</body>
</html>
