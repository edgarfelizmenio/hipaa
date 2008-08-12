 </head>
 <body>
   <?php include(TPL_PATH . 'msg_mast.php'); ?>
   <?php include(TPL_PATH . 'loginout.php'); ?>

<?php 
   if (isLoggedIn()) {
     echo '<p>Welcome ' . $_SESSION['username'] . '. Not '
   . $_SESSION['username'] . 
   '? <a href="logout.php?redirect=' . basename($_SERVER['PHP_SELF']) . '">Logout</a></p>';
   }
   
?>
      
   <div id="content">
