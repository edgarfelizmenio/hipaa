<?php include_once('common.php'); ?>
<?php include(TPL_PATH . 'header_top.php'); ?>
<title>Reply To Message</title>
<?php include(TPL_PATH . 'header_bot.php'); ?>

<?php
$action = $_POST['action'];

if($action == 'process') {  
  if ($hmsg->addMessage($_POST['message_id'])) {
    echo "<p>Reply successfully sent</p>";
    include(TPL_PATH . 'footer.php');
    exit;
  } 
  echo '<div class="warning"><p>The query was not allowed</p></div>';

 }
if (!isset($_GET['message_id']) || empty($_GET['message_id']))
  die ('unknown message id');
$message_id = intval($_GET['message_id']);
$replyto_id = intval($_GET['replyto_id']);
$msg = $hmsg->getMessage($message_id);

// to set default values
if(empty($_POST['msg_about'])) {
  $_POST['msg_about'] = htmlspecialchars($msg->about);
  }
if(empty($_POST['msg_purpose'])) {
  $_POST['msg_purpose'] = htmlspecialchars($msg->purpose);
  }

?>

<table>
<tr>
<td width="50%">

<form method="post" action="">
  <div>

    <input type="hidden"
	   name="msg_from"
	   id="msg_from"
	   value="<?php echo htmlspecialchars($_SESSION['username']); ?>" />

  <div>
    <label>To:</label>
    <input type="text" name="msg_to" id="msg_to" readonly="readonly" value="<?php echo htmlspecialchars($msg->from); ?>" />
  </div>

  <div>
    <label>About:</label>
    <select name="msg_about" id="msg_about" onChange="fieldChanged(this)";>
      <option value="null"> -- About -- </option>
    <?php
      include (TPL_PATH . 'about.php');
    ?>
    </select>

  </div>
  
  <div>
    <label>Type:</label>
    <input type="text" name="msg_type" id="msg_type" value="<?php echo htmlspecialchars($msg->type) ?>"
    readonly="readonly" />
  </div>

  <div>
    <label>Purpose:</label>
   <select name="msg_purpose" id="msg_purpose" onChange="fieldChanged(this)";>
      <option value="null"> -- Purpose -- </option>
    <?php
      include (TPL_PATH . 'purpose.php');
    ?>
    </select>


  </div>

<!--  <div>
    <label>Reply-to:</label>
    <input type="text" name="replyto" id="replyto">
-->
<?php
   include (TPL_PATH . 'msg_footer.php');
?>


  <div>
    <input type="hidden" name="msg_reply" value="1" />
    <input type="hidden" name="action" value="process" />
    <input type="hidden" name="replyto_id" value="<?php echo htmlspecialchars($replyto_id);?>"/>
  <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message_id); ?>"/>
    <input type="submit"  value="Send Reply" />
  </div>
   
</form>

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
    <th>Consent</th>
    <th>Consented</th>
    <th>Message</th>
  </tr>

<?php
   
   foreach ($mailbag as $msg) {
     $msg->consent = (empty($msg->consent)) ? 'N/A' : $msg->consent;

     echo "<tr>";
     echo "<td>" . htmlspecialchars($msg->to) . "</td>";
     echo "<td>" . htmlspecialchars($msg->from) . "</td>";
     echo "<td>" . htmlspecialchars($msg->about) . "</td>";
     echo "<td>" . htmlspecialchars($msg->type) . "</td>";
     echo "<td>" . htmlspecialchars($msg->purpose) . "</td>";
     echo "<td>" . htmlspecialchars($msg->consent) . "</td>";
     echo "<td>" . htmlspecialchars($msg->consented) . "</td>";
     echo "<td>" . htmlspecialchars($msg->message) . "</td>";
     echo "</tr>";
  }
  echo "</table>";
 }

?>

</td>
<td>
<div id="prolog">
  <h3>Prolog calls</h3>
    <div id="prologquery"></div>

    <div id="prologanswer"></div>
</div>
</td>
</tr>
</table>



<?php include(TPL_PATH . 'footer.php'); ?>




