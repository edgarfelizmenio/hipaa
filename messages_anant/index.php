<?php
require_once "resources/inc/header.php";
session_start();
if(!isset($_SESSION['LOGIN'])){
	header("location: login.php");
}else {
	print '<div id="headlink">';
	print "Welcome ".$_SESSION['LOGIN']. "  | <a href=\"logout.php\">Logout</a>";
	print '</div>';
}

?>


<div id="wrap"> 
<?php
if(isset($_GET["tab"])){
	$activetab = $_GET["tab"];
	if($activetab == 'mail'){
		require_once "mail.php";		
	}else if($activetab == 'tour'){
		require_once "tour.php";
	}else if($activetab == 'guide'){
		require_once "hipaa-guide.php";
	}else if($activetab == 'preferences'){
		require_once "preferences.php";
	}else {
		require_once "mail.php";
	}
}else{
	require_once "mail.php";
}
?>
</div>

<?php
require_once "resources/inc/footer.php";
?>

