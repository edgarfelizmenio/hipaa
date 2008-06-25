<?php
   include_once('lib/common.php');
?>
<html>
  <head>
    <?php include('tpl/header.php'); ?>
  </head>
  <body>
    <?php include('tpl/msg_menu.php'); ?>

<h2>View All Messages</h2>
<?php


$hmsg->getAllMessages();

?>