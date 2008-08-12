<?php include_once('common.php');?>
<?php include(TPL_PATH . 'header_top.php'); ?>
<title>Compose Message</title>
<?php include(TPL_PATH . 'header_bot.php'); ?>

<?php requireLogin(true); ?>

<div id="notice"></div>
<h2>Compose Message</h2>

<table>
<tr>
<td width="50%">
<form method="post" action="#">
  
  <div>
    <label>To:</label>
    <select name="msg_to"
	    id="msg_to"
	    onChange="fieldChanged();"
            onClick="fieldChanged('msg_to');"
	    name="First Name">
      <option value="null"> -- To -- </option>
      <?php include (TPL_PATH . 'to.php'); ?>
    </select>
  </div>


    <input type="hidden"
	   name="msg_from"
	   id="msg_from"
	   value="<?php echo $_SESSION['username']; ?>" />
    
  <div>
    <label>About:</label>
    <select name="msg_about"
	    id="msg_about"
	    onChange="fieldChanged();"
            onClick="fieldChanged('msg_about');">
      <option value="null"> -- About -- </option>
      <?php include (TPL_PATH . 'about.php'); ?>
    </select>
  </div>
  
  <div>
    <label>Type:</label>
    <input type="text" 
	   name="msg_type" 
	   value="phi" 
	   readonly="readonly" />
  </div>

  <div>
    <label>Purpose:</label>
    <select id="msg_purpose"
	    name="msg_purpose"
	    onChange="fieldChanged();"   
            onClick="fieldChanged('msg_purpose');">
      <option value="null"> -- Purpose -- </option>
      <?php include (TPL_PATH . 'purpose.php');
	    ?>
    </select>
  </div>

  <?php include (TPL_PATH . 'msg_footer.php');  ?>

  <div>
    <input type="hidden" name="action" value="process" />
    <input type="submit"  value="Send message" />
<!--    <input type="reset" value="Reset" onclick="rebootFields(true);" />-->
<a href="write.php">
Reset
</a>

  </div>

</form>


<button id="showinfo" onclick="$('.info').toggle();   $('#prologquery').empty();
  $('#prologanswer').empty();
">What's going on here?</button>


</td>
</tr>
</table>

<?php
$action = $_POST['action'];

if($action == 'process') {  
    if ($hmsg->addMessage($_POST['consent_required'])) {
	echo "<p>Message added successfully</p>";
	echo '<a href="viewmsg.php">View messages</a>';
    } else {
      echo '<div class="warning"><p>The query was not allowed.  Prolog could not find a matching rule</p></div>';
    }
} 
?>

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
      $query = generatePrologQuery();
      $response = $prolog->askHIPAA($query);

      if(allowed($response)) 
        // add to database
      else
        // report failure

    </xmp>
  </div>

</div>


<?php include(TPL_PATH . 'footer.php'); ?>
