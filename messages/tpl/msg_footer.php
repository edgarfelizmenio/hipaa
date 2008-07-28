      <div>
	<label>Belief:</label>
	<input 
	   type="checkbox" 
	   rel="belief_present" 
	   name="msg_belief" 
	   value="1" 
	   <?php if($_POST['msg_belief']=='1') echo 'checked="checked"'; ?> />
      </div>

<div rel="belief_present">
<div>
  <label>About</label>
  <select name="belief_about" id="belief_about" onChange="fieldChanged(this);">
          <option VALUE="null">-- Choose about whom -- </option>
	  <?php include ('tpl/belief_about.php'); ?>
  </select>

</div>
<div>
  <label>What Belief</label>
  <select name="belief_what" id="belief_what" onChange="fieldChanged(this);">
            <option VALUE="null">-- Choose belief -- </option>
	  <?php include ('tpl/belief_what.php'); ?>
  </select>
</div>
<div>
  <label>By/From</label>
  <select name="belief_by" id="belief_by" onChange="fieldChanged(this);">
          <option VALUE="null">-- Choose whose belief -- </option>
	  <?php include ('tpl/belief_by.php'); ?>
  </select>
</div>
</div>


      <div>
	<label>Message:</label>
	<textarea name="msg_message"></textarea>
      </div>

      <div>
	<label>Requires Consent?</label>
	<input 
	 name="consent_required" 
	 id="consent_required"
	 value="1" 
	 type="checkbox"
	 rel="permission"
	 onChange="fieldChanged(this);"
	 <?php if($_POST['consent_required']=='1') echo 'checked="checked"'; ?>>

      </div>

      <div rel="permission">
	<label>Consented by:</label>
		<select name="msg_consent" id="msg_consent"
	    onChange="fieldChanged(this);">
          <option VALUE="null">-- Choose consent -- </option>
	  <?php include ('tpl/consents.php'); ?>
	</select>

      </div>
