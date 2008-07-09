<?php include_once('lib/common.php'); ?>
<?php include('tpl/header_top.php'); ?>
<title>Reply To Message</title>
<?php include('tpl/header_bot.php'); ?>

<?php
$action = $_POST['action'];

if($action == 'process') {  
  include('process/writereply.php');

 } else {

if (!isset($_GET['msg_id']) || empty($_GET['msg_id']))
  die ('unknown message id');
$msg_id = intval($_GET['msg_id']);
$msg = $hmsg->getMessage($msg_id);

?>
<div id="prolog">
  <h3>Prolog calls</h3>
    <div id="prologquery"></div>

    <div id="prologanswer"></div>
</div>

<form method="post" action="">
  <div>
  <label>From:</label>
    <input type="text" name="msg_from" id="msg_from" readonly="readonly" value="<?php echo $msg->msg_to ?>" />
</select>
  </div>

  <div>
    <label>To:</label>
    <input type="text" name="msg_to" id="msg_to" readonly="readonly" value="<?php echo $msg->msg_from ?>" />
  </div>

  <div>
    <label>About:</label>
    <select name="msg_about" id="msg_about">
    <?php
      include ('tpl/about.php');
    ?>
    </select>

  </div>
  
  <div>
    <label>Type:</label>
    <input type="text" name="msg_type" id="msg_type" value="<?php echo $msg->type ?>"
    readonly="readonly" />
  </div>

  <div>
    <label>Purpose:</label>
   <select name="msg_purpose" id="msg_purpose">
    <?php
      include ('tpl/purpose.php');
    ?>
    </select>


  </div>

<!--  <div>
    <label>Reply-to:</label>
    <input type="text" name="replyto" id="replyto">
-->
<?php
   include ('tpl/msg_footer.php');
?>


  <div>
    <input type="hidden" name="action" value="process" />
    <input type="hidden" name="msg_id" value="<?php echo $msg_id; ?>"/>
    <input type="submit"  value="Send Reply" />
  </div>
   
</form>


<h2>History</h2>

<?php
  $mailbag = $hmsg->getHistory($msg_id);
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
 }
?>


<?php include('tpl/footer.php'); ?>




