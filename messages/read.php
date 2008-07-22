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
    <th>Reply-to</th>
  </tr>

<?php
   
   foreach ($mailbag as $history) {
     $history->consent = (empty($history->consent)) ? 'N/A' : $history->consent;

     echo "<tr>";
     echo "<td>" . $history->to . "</td>";
     echo "<td>" . $history->from . "</td>";
     echo "<td>" . $history->about . "</td>";
     echo "<td>" . $history->type . "</td>";
     echo "<td>" . $history->purpose . "</td>";
     echo "<td>" . $history->message . "</td>";
     echo "<td><a href='reply.php?message_id=" . $msg->message_id
     . "&replyto_id=" . $history->message_id . "'>Reply</a></td>";
     echo "</tr>";
  }
  echo "</table>";
 }
?>

<?php include('tpl/footer.php'); ?>