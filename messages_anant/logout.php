<?php
$shutOffLinks = 1;
require_once "resources/inc/header.php";
session_start();
unset($_SESSION['LOGIN']);
?>

<div id="wrap" style="width:560px; height:250px; text-align:center;"> 

<div style="border-style:solid; border-width:thin; padding:10px; background-color:#FFFFD9; width:500px; text-align:center; margin:30px;">
	<p style="text-align:justify;">
	Than you for using HIPAA mailbox. You have successfully logged out. <br />
	Click <a href="login.php">here</a> to login again.
    </p>
</div>

</div>

<?php
session_write_close();
require_once "resources/inc/footer.php";
?>

