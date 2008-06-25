<?php
include_once('lib/common.php');

$hmsg = new Message();

$hmsg->addMessage($_POST['msg_to'],$_POST['msg_from'],$_POST['msg_about'],$_POST['type'],$_POST['msg_purpose'],$_POST['consent'],$_POST['belief'],$_POST['message'],$_POST['consent_required']);
  echo '<a href="viewmsg.php">view messages</a>';



?>