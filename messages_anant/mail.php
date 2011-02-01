<?php
if(isset($_GET["target"])){
	$target = $_GET["target"];
	if($target == 'inbox'){
		require_once "mail/inbox.php";	
	}else if($target == 'sent'){
		require_once "mail/sent.php";
	}else if($target == 'draft'){
		require_once "mail/draft.php";
	}else if($target == 'thrash'){
		require_once "mail/thrash.php";
	}else if($target == 'compose'){
		require_once "mail/compose.php";
	}else {
		require_once "mail/inbox.php";
	}
}else{
	require_once "mail/inbox.php";
}
?>
