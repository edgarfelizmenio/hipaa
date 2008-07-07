<html>
<head>
</head>

<body>
<?php
$action = $_GET['action'];
switch ($action) {
 case 'refresh':
   // remove the file
   shell_exec("rm -rf lib/scripts/allpossibles");
   // generate a new one

   $prologCall = "setof(t(Msg_to,Msg_from,Msg_about,Msg_purpose), pbh(a(Msg_to,Msg_from,Msg_about,phi,Msg_purpose,null,null,null)),L).";        
   shell_exec("cd lib/scripts/; ./xsbexec '" . $prologCall . "' > allpossibles");

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
   echo shell_exec("cd lib/scripts; cat allpossibles | perl msg_possibles.pl");
   echo "</pre>";


?>

</body>
</html>