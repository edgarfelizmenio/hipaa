<?php
include_once('lib/common.php');
if (!isset($_GET['msg_id']) || empty($_GET['msg_id']))
  die ('unknown message id');
$msg_id = intval($_GET['msg_id']);
$hmsg->setConsent($msg_id);
$msg = $hmsg->getMessage($msg_id);

?>
<html>
  <head>
    <?php include('tpl/header.php'); ?>
  </head>
  <body>
    <?php include('tpl/msg_menu.php'); ?>


<h2>Message consented</h2>

</body>

</html>