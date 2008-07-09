<?php include_once('lib/common.php'); ?>
<?php include('tpl/header_top.php'); ?>
<title>Messaging Demo</title>
<?php include('tpl/header_bot.php'); ?>

<h2>View All Messages</h2>


<?php


$hmsg->getAllMessages();

?>

<?php include('tpl/footer.php'); ?>
