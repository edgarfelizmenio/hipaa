 </head>
 <body>
   <?php include('tpl/msg_mast.php'); ?>
   <?php include('tpl/loginout.php'); ?>

<?php 
   if (isLoggedIn()) {
     echo '<p>Welcome ' . $_SESSION['username'] . '. Not '
   . $_SESSION['username'] . 
   '? <a href="logout.php?redirect=' . basename($_SERVER['PHP_SELF']) . '">Logout</a></p>';
   }
   
?>
      
   <div id="content">
