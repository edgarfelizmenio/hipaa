<?php
include_once('lib/common.php');
if (!isset($_GET['msg_id']) || empty($_GET['msg_id']))
  die ('unknown message id');
$msg_id = intval($_GET['msg_id']);
$msg = $hmsg->getMessage($msg_id);

?>
<html>
  <head>
    <?php include('tpl/header.php'); ?>
  </head>
  <body>
    <?php include('tpl/msg_menu.php'); ?>

     <a href="forward.php?msg_id=<?php echo $msg->msg_id?>">Forward</a>
     <a href="reply.php?msg_id=<?php echo $msg->msg_id?>">Reply</a>


<table border=1>
  <tr>
    <th>To</th>
    <td><?php echo $msg->msg_to; ?></td>
  </tr>
  <tr>
    <th>From</th>
    <td><?php echo $msg->msg_from; ?></td>
  </tr>
  <tr>
    <th>About</th>
    <td><?php echo $msg->msg_about; ?></td>
  </tr>
  <tr>
    <th>Content</th>
  </tr>
  <tr>
    <td colspan=2><?php echo $msg->message; ?></td>
  </tr>
</table>
<h2>History</h2>


<?php
  $mailbag = $hmsg->getHistory($msg_id);
if ($mailbag) {
?>

<table border=1>
  <tr>
    <th>To</th>
    <th>From</th>
    <th>About</th>
    <th>Type</th>
    <th>Purpose</th>
    <th>Consent</th>
    <th>Consented</th>
    <th>Message</th>
  </tr>

<?php
   
   foreach ($mailbag as $msg) {
     $msg->consent = (empty($msg->consent)) ? 'N/A' : $msg->consent;

     echo "<tr>";
     echo "<td>" . $msg->msg_to . "</td>";
     echo "<td>" . $msg->msg_from . "</td>";
     echo "<td>" . $msg->about . "</td>";
     echo "<td>" . $msg->type . "</td>";
     echo "<td>" . $msg->purpose . "</td>";
     echo "<td>" . $msg->consent . "</td>";
     echo "<td>" . $msg->consented . "</td>";
     echo "<td>" . $msg->message . "</td>";
     echo "</tr>";
  }
  echo "</table>";
 }
?>


</body>
</html>