<?php
include_once('lib/common.php');
$isAllowed = true;

if ($isAllowed) {
  $hmsg->addMessage($_POST['msg_to'],$_POST['msg_from'],$_POST['msg_about'],$_POST['type'],$_POST['msg_purpose'],$_POST['consent'],$_POST['belief'],$_POST['message'],
  $_POST['consent_required'], $_POST['msg_id']);
  echo '<a href="viewmsg.php">view messages</a>';
 } else {
  die('that actions is not allowed');
 }

?>
