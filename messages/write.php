<?php include_once('lib/common.php');?>
<?php include('tpl/header_top.php'); ?>
<title>Compose Message</title>
<?php include('tpl/header_bot.php'); ?>

<?php
$action = $_POST['action'];

if($action == 'process') {  
    if ($hmsg->addMessage($_POST['consent_required'])) {
	echo "<p>Message added successfully</p>";
	echo '<a href="viewmsg.php">View messages</a>';
	include('tpl/footer.php');
	exit;
    }
    echo '<div class="warning"><p>The query was not allowed.  Prolog could not find a matching rule</p></div>';
} else {
// Begin Notice
    ?>
<button id="showinfo" onclick="$('.info').toggle(); ">Show/Hide Info</button>
<div class="info" style="display:none;">
  <p>
    Each time a selection is chosen in the form, a query is sent to prolog
    to determine the allowable values for each unselected item.  The items
    that aren't allowed are then highlighted red to indicate that choosing
    them would violate HIPAA in some way.
  </p>

  <p>
    When the form is submitted, instead of adding the message directly to
    the database, a query is made to prolog to check if it is allowed.
    The following code (similar, but not actual!) shows the process
  </p>

  <div class="code">
    <xmp>
      // construct query from parameters
      $query="pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,$mReplyto,$mConsent,$mBelief)).";
      $response = $this->prolog->askHIPAA($query);
      if(allowed($response)) 
        // add to database
      else
        // report failure

    </xmp>
  </div>
</div>
<?php
}
// End Notice
?>

<h2>Write Message</h2>

<div id="prolog">
  <h3>Prolog calls</h3>
    <div id="prologquery"></div>

    <div id="prologanswer"></div>
</div>

<form method="post" action="#">
  
  <div>
    <label>To:</label>
    <select name="msg_to"
	    id="msg_to"
	    onChange="fieldChanged(this);"
	    name="First Name">
      <option value="null"> -- To -- </option>
      <?php include ('tpl/to.php'); ?>
    </select>
  </div>

  <div>
    <label>From:</label>
    <select id="msg_from"
	    name="msg_from"
	    onChange="fieldChanged(this);"
	    autocomplete="false">
      <option value="null"> -- From -- </option>
      <?php include ('tpl/from.php'); ?>
    </select>    
  </div>
  

  <div>
    <label>About:</label>
    <select name="msg_about"
	    id="msg_about"
	    onChange="fieldChanged(this);">
      <option value="null"> -- About -- </option>
      <?php include ('tpl/about.php'); ?>
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

  <?php include ('tpl/msg_footer.php');  ?>

  <div>
    <input type="hidden" name="action" value="process" />
    <input type="submit"  value="Send message" />
    <input type="reset" value="Reset" onclick="rebootFields(true)" />
  </div>

</form>
     
<?php include('tpl/footer.php'); ?>
