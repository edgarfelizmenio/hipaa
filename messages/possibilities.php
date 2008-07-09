<html>
<head>
</head>

<body>
<?php
$action = $_GET['action'];
switch ($action) {
 case 'refresh':
   // remove the file
   $filename = 'lib/scripts/allpossibles';
   shell_exec("rm -rf $filename");
   shell_exec("rm -rf $filename.php");
   // generate a new one

   $prologCall = "setof(t(Msg_to,Msg_from,Msg_about,Msg_purpose), pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,null)),L).";        
   shell_exec("cd lib/scripts/; ./xsbexec '" . $prologCall . "' | perl msg_possibles.pl > allpossibles");

   $fh = fopen($filename, 'r');
   $string = fread($fh, filesize($filename));
   fclose($fh);
   
   $fh = fopen($filename . 'serialized.php', 'w');
   
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
