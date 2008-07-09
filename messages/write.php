<?php include_once('lib/common.php');?>
<?php include('tpl/header_top.php'); ?>
<title>Compose Message</title>
<?php include('tpl/header_bot.php'); ?>
<?php
$action = $_POST['action'];
if($action == 'process') {  
  include('process/writemsg.php');
 } else {
?>

<h2>Write Message</h2>
<div id="prolog">
  <h3>Prolog calls</h3>
    <div id="prologquery"></div>

    <div id="prologanswer"></div>
</div>
<form method="post" action="write.php">


  <div>
    <label>To:</label>
    <select name="msg_to"
	    id="msg_to"
	    onChange="fieldChanged(this);"
	    name="First Name">
      <option value="null"> -- To -- </option>
      <?php	     include ('tpl/to.php');	     ?>
    </select>

  </div>

<div>
    <label>From:</label>
    
    <select id="msg_from"
	    name="msg_from"
	    onChange="fieldChanged(this);"
	    autocomplete="false">
      <option value="null"> -- From -- </option>
      <?php	     include ('tpl/from.php');	     ?>
    </select>

  </div>


  <div>
    <label>About:</label>
    <select name="msg_about"
	    id="msg_about"
	    onChange="fieldChanged(this);">
      <option value="null"> -- About -- </option>
      <?php
	 include ('tpl/about.php');
	 ?>
    </select>
  </div>
  
  <div>
    <label>Type:</label>
    <input type="text" name="msg_type" value="phi" readonly="readonly" />
  </div>

  <div>
    <label>Purpose:</label>
    <select id="msg_purpose"
	    name="msg_purpose"
	    onChange="fieldChanged(this);"   >
      <option value="null"> -- Purpose -- </option>
      <?php include ('tpl/purpose.php');
	    ?>
    </select>
  </div>

  <!--  <div>
	<label>Reply-to:</label>
	<input type="text" name="msg_replyto" />
	</div>
    -->
  <?php
     include ('tpl/msg_footer.php');
     ?>


  <div>
    <input type="hidden" name="action" value="process" />
    <input type="submit"  value="Send message" />
    <input type="reset" value="Reset" onclick="refreshFields()" />
  </div>
  
  

</form>

     <?php } ?>
<?php include('tpl/footer.php'); ?>