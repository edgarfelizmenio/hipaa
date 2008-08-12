<?php include_once('common.php'); ?>
<?php include(TPL_PATH . 'header_top.php'); ?>
<title>Read Message</title>
<?php include(TPL_PATH . 'header_bot.php'); ?>

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

<div id="history">
<button onclick="$('table.msg').show();"> Show all</button>
<button onclick="$('table.msg').hide();"> Hide all</button>

<?php
   


   foreach ($mailbag as $history) {
     $history->consent = (empty($history->consent)) ? 'N/A' : $history->consent;

     echo "<dl onclick=\"\$('#msg$history->message_id').toggle()\"> <dt>Date: " . date("D, M j, g:i A", strtotime($history->date)) . "</dt><dd>From "
     . $history->from . " to " . $history->to . ' <span>'
     . substr($history->message,0,20) . "...<a href='#'>show/hide</a></span></dd></dl>";

     echo "<table style='display:none' class='unstriped msg' id='msg" .$history->message_id . "'>";
     echo "<tr>";
     echo "<th>To</th>";
     echo "<td>" . $history->to . "</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<th>From</th>";
     echo "<td>" . $history->from . "</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<th>About</th>";
     echo "<td>" . $history->about . "</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<th>Type</th>";
     echo "<td>" . $history->type . "</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<th>Purpose</th>";
     echo "<td>" . $history->purpose . "</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td colspan='2'>" . $history->message . "</td>";
     echo "</tr>";

echo "<td colspan='2'><a href='reply.php?message_id=" . $msg->message_id
 . "&replyto_id=" . $history->message_id . "'>Reply</a></td>";

     echo "</table>";
  }
  echo "</table>";
 }
?>
</div>
<?php include(TPL_PATH . 'footer.php'); ?>