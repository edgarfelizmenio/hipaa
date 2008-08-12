<?php include_once('common.php'); ?>
<?php include(TPL_PATH . 'header_top.php'); ?>
<title>Messaging Demo</title>
<?php include(TPL_PATH . 'header_bot.php'); ?>

<h2>View All Messages</h2>


<?php


$hmsg->getAllMessages();

?>

<?php include(TPL_PATH . 'footer.php'); ?>
