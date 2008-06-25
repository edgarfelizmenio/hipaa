<html>

<head>
<title>Display file</title>
</head>


<form name=fileform method=GET action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
 <FRAMESET cols="50%,50%">
   <?php 
      $fp = $_GET['fname'];
     echo "<FRAME src=\"getLaw.php?fname=./Law/"  ; echo $fp; echo ".txt\" frameborder=\"0\">";
     echo "<FRAME src=\"getPL.php?fname=./HIPAA/"; echo $fp; echo ".pl\" frameborder=\"0\">";
   ?>
 </FRAMESET>
</html>
