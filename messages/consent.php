<?php include('lib/common.php'); ?>
<html>
 <head>
   <?php include('tpl/header.php'); ?>
 </head>
 <body>
   <?php include('tpl/msg_menu.php'); ?>
    <label>Check which person's consents?</label>
    <form method="get">
      <select name="consenter">
	<?php
	   $consenters = $hmsg->getConsenters();
	   print_r($consenters);
	   echo '<option> -- select mailbox -- </option>';
	   foreach ($consenters as $consenter) {
	     echo '<option value="' . $consenter->name . '">' . $consenter->name . '</option>';
	   }
	?>
      </select>
      <input type="submit" value="View consents" />
    </form>



<?php
   $consenter = htmlspecialchars($_GET['consenter']);
   echo "<h1>" . $consenter . " consents</h1>";
   $mailbag = $hmsg->getConsents($consenter);

if ($mailbag) {

?>
<table border=1>
  <tr>
    <th>To</th>
    <th>From</th>
    <th>About</th>
    <th>Type</th>
    <th>Purpose</th>
    <th>Message</th>
    <th>Allow message?</th>
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
     echo "<td>" . $msg->message . "</td>";
     echo '<td><a href="allowconsent.php?msg_id=' . $msg->msg_id . '">Consent to
     this message?</a>';
     echo "</tr>";
  }
  echo "</table>";

} else {
  echo 'Sorry, no consenters selected';
}

?> 



</body>
</html>