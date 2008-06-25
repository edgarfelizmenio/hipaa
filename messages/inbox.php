<?php
   include_once('lib/common.php');
   ?>
<html>
  <head>
    <?php include('tpl/header.php'); ?>
  </head>
  <body>
    <?php include('tpl/msg_menu.php'); ?>

    <label>Check which person's mail</label>
    <form method="get">
      <select name="recipient">
	<?php
	   $recipients = $hmsg->getRecipients();
	   print_r($recipients);
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

<table border=1>
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
     echo '<td><a href="read.php?msg_id=' . $msg->msg_id . '">Read</a>';
     echo "<td>" . $msg->msg_to . "</td>";
     echo "<td>" . $msg->msg_from . "</td>";
     echo "<td>" . $msg->about . "</td>";
     echo "<td>" . $msg->type . "</td>";
     echo "<td>" . $msg->purpose . "</td>";
     echo "<td>" . $msg->consent . "</td>";
     echo "<td>" . $msg->consented . "</td>";
     echo "<td>" . $msg->message . "</td>";
     echo '<td><a href="forward.php?msg_id=' . $msg->msg_id . '">Forward</a>';
     echo '<td><a href="reply.php?msg_id=' . $msg->msg_id . '">Reply</a>';
     echo "</tr>";
  }
  echo "</table>";
} else {
  echo 'Sorry, no individual mailbox selected';
}

?> 
</body>

</html>
