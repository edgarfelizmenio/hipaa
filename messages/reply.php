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


<form method="post" action="writereply.php">
  <div>
  <label>From:</label>
    <input type="text" name="from" readonly="readonly" value="<?php echo $msg->msg_to ?>" />
</select>
  </div>

  <div>
    <label>To:</label>
    <input type="text" name="to" readonly="readonly" value="<?php echo $msg->msg_from ?>" />
  </div>

  <div>
    <label>About:</label>
    <select name="msg_about">
    <?php
      include ('tpl/about.php');
    ?>
    </select>

  </div>
  
  <div>
    <label>Type:</label>
    <input type="text" name="type" value="<?php echo $msg->type ?>"
    readonly="readonly" />
  </div>

  <div>
    <label>Purpose:</label>
   <select name="msg_purpose">
    <?php
      include ('tpl/purpose.php');
    ?>
    </select>


  </div>

<!--  <div>
    <label>Reply-to:</label>
    <input type="text" name="replyto">
-->
  <div>
    <label>Belief:</label>
    <input type="checkbox" name="belief" value="1" />
  </div>


  <div>
    <label>Message:</label>
    <textarea name="message"></textarea>
  </div>

      <div>
	<label>Requires Consent?</label>
	<input name="consent_required" value="true" type="checkbox" rel="permission">

      </div>

      <div rel="permission">
	<label>Consented by:</label>
		<select name="consent">
          <option VALUE="">-- Choose consent -- </option>
	  <?php
	     include ('tpl/recipients.php');

	     ?>
	</select>

      </div>

  

  <div>
    <input type="hidden" name="msg_id" value="<?php echo $msg_id; ?>"/>
    <input type="submit"  value="Send Reply" />
  </div>
   
</form>


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




