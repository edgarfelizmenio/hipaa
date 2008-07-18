<?php include_once('lib/common.php');?>
<?php include('tpl/header_top.php'); ?>
<title>Inbox</title>
<?php include('tpl/header_bot.php'); ?>

<h2>Inbox</h2>
    <label>Check which person's mail</label>
    <form method="get" action="">
      <select name="recipient">
	<?php
	   $recipients = $hmsg->getRecipients();

	   echo '<option> -- select mailbox -- </option>';
	   foreach ($recipients as $recipient) {
	     echo '<option value="' . $recipient->name . '">' . $recipient->name . '</option>';
	   }
	?>
      </select>
      <input type="submit" value="Read Mail" />
    </form>

<?php
   $recipient = htmlspecialchars($_GET['recipient']);
   echo "<h1>" . $recipient . " mailbox</h1>";
   $mailbag = $hmsg->getRecipientMail($recipient);

if ($mailbag) {
?>

<table class="striped">
  <tr>
    <th>Read</th>
    <th>To</th>
    <th>From</th>
    <th>About</th>
    <th>Type</th>
    <th>Purpose</th>
    <th>Consent</th>
    <th>Consented</th>
    <th>Message</th>
    <th>Forward</th>
    <th>Reply</th>
  </tr>

<?php
   
   foreach ($mailbag as $msg) {
     $msg->consent = (empty($msg->consent)) ? 'N/A' : $msg->consent;

     echo "<tr>";
     echo '<td><a href="read.php?message_id=' . $msg->message_id . '">Read</a></td>';
     echo "<td>" . $msg->to . "</td>";
     echo "<td>" . $msg->from . "</td>";
     echo "<td>" . $msg->about . "</td>";
     echo "<td>" . $msg->type . "</td>";
     echo "<td>" . $msg->purpose . "</td>";
     echo "<td>" . $msg->consent . "</td>";
     echo "<td>" . $msg->consented . "</td>";
     echo "<td>" . $msg->message . "</td>";
     echo '<td><a href="forward.php?message_id=' . $msg->message_id . '">Forward</a></td>';
     echo '<td><a href="reply.php?message_id=' . $msg->message_id . '">Reply</a></td>';
     echo "</tr>";
  }
  echo "</table>";
} else {
  echo 'Sorry, no individual mailbox selected';
}

?> 
<?php include('tpl/footer.php'); ?>