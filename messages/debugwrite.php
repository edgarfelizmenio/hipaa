<?php include_once('common.php');?>
<?php include(TPL_PATH . 'header_top.php'); ?>
<title>Compose Message</title>
<?php include(TPL_PATH . 'header_bot.php'); ?>

<div id="notice"></div>
<h2>Write Message</h2>


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

  <div>
    <label>From:</label>
    <select id="msg_from"
	    name="msg_from"
	    onChange="fieldChanged();"
            onClick="fieldChanged('msg_from');"
	    autocomplete="false">
      <option value="null"> -- From -- </option>
      <?php include (TPL_PATH . 'from.php'); ?>
    </select>    
  </div>
  
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

<hr />
<button id="consent_query" onclick=" 
rebootFields(true);
$('#msg_to').val('dr_cox');
$('#msg_from').val('carla');
$('#msg_about').val('patient');
$('#msg_purpose').val('null');
$('#consent_required').removeAttr('checked');
$('#msg_belief').removeAttr('checked');
$('#errors').hide();
$('div.warning').hide();
prepareForm();
$('form div').css('background-color', 'transparent');
$('#notice').html('<p>When sending messages, only certain purposes are allowed.  Check what options are available under <em>Purpose</em></p>'); 

fieldChanged(null);
">Sample Query</button>


<button id="consent_query" onclick=" 
rebootFields(true);
$('#msg_to').val('sacred_heart_hospital');
$('#msg_from').val('carla');
$('#msg_about').val('patient');
$('#msg_purpose').val('null');
$('#consent_required').removeAttr('checked');
$('#msg_belief').removeAttr('checked');
$('form div').css('background-color', 'transparent');
$('#errors').hide();
$('div.warning').hide();
prepareForm();

$('#notice').html('<p>Notice how in the <em>Purpose</em> option field that healthcare operations is highlighted red.' +  
'<ul><li>' + 
'Click the <em>Requires Consent</em> checkbox.  Notice how healthCare_operations is now allowed in <em>Purpose</em>.' +
'</li><li>' + 
'Select healthCare_operations.  Notice how the <em>Consented by</em> option only allows the option patient now' + 
'</li></ul></p>'); 

fieldChanged(null);
">Sample Consent Query</button>


<button id="belief_query" onclick=" 
rebootFields(true);
$('#msg_to').val('pha');
$('#msg_from').val('dr_kelso');
$('#msg_about').val('kid');
$('#msg_purpose').val('null');
$('#consent_required').removeAttr('checked');
$('#msg_belief').removeAttr('checked');
$('form div').css('background-color', 'transparent');
$('#errors').hide();
$('div.warning').hide();
prepareForm();

$('#notice').html('<p>Notice how in the <em>Purpose</em> option field investigate is now allowed' +  
'<ul><li>' + 
'Click the <em>Belief</em> checkbox.  Notice how investigate is now allowed in <em>Purpose</em>.' +
'</li><li>' + 
'Select investigate.  Notice how the <em>belief fields</em> show the only possible <em>belief fields</em> that are allowed' + 
'</li></ul></p>'); 

fieldChanged(null);
">Sample Belief Query</button>



<br />
<button id="showinfo" onclick="$('.info').toggle();   $('#prologquery').empty();
  $('#prologanswer').empty();
">What's going on here?</button>


</td>
<td width="50%">
<div id="prolog">
  <h3>Prolog calls</h3>
  <div id="prologquery"></div>  
  <div id="prologanswer"></div>
</div>

</td>
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
