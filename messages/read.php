<?php include_once('lib/common.php'); ?>
<?php include('tpl/header_top.php'); ?>
<title>Read Message</title>
<?php include('tpl/header_bot.php'); ?>

<?php
if (!isset($_GET['message_id']) || empty($_GET['message_id']))
  die ('unknown message id');
$message_id = intval($_GET['message_id']);
$msg = $hmsg->getMessage($message_id);

?>
     <a href="forward.php?message_id=<?php echo $msg->message_id?>">Forward</a>
     <a href="reply.php?message_id=<?php echo $msg->message_id?>">Reply</a>


  <table class="unstriped" border="1" width="400px">
  <tr>
    <th>To</th>
    <td><?php echo $msg->to; ?></td>
  </tr>
  <tr>
    <th>From</th>
    <td><?php echo $msg->from; ?></td>
  </tr>
  <tr>
    <th>About</th>
    <td><?php echo $msg->about; ?></td>
  </tr>
  <tr>
    <th colspan="2">Content</th>
  </tr>
  <tr>
    <td colspan=2><?php echo $msg->message; ?></td>
  </tr>
</table>
<h2>History</h2>


<?php
  $mailbag = $hmsg->getHistory($message_id);
if ($mailbag) {
?>

<table class="striped" border=1>
  <tr>
    <th>To</th>
    <th>From</th>
    <th>About</th>
    <th>Type</th>
    <th>Purpose</th>
    <th>Message</th>
  </tr>

<?php
   
   foreach ($mailbag as $msg) {
     $msg->consent = (empty($msg->consent)) ? 'N/A' : $msg->consent;

     echo "<tr>";
     echo "<td>" . $msg->to . "</td>";
     echo "<td>" . $msg->from . "</td>";
     echo "<td>" . $msg->about . "</td>";
     echo "<td>" . $msg->type . "</td>";
     echo "<td>" . $msg->purpose . "</td>";
     echo "<td>" . $msg->message . "</td>";
     echo "</tr>";
  }
  echo "</table>";
 }
?>

<?php include('tpl/footer.php'); ?>