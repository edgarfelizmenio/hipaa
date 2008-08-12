      <div>
	<label>Belief:</label>
	<input 
	   type="checkbox" 
	   rel="beliefs" 
	   name="msg_belief" 
	   id="msg_belief"
	   value="1" 
	   onChange="fieldChanged(this);"
	   <?php if($_POST['msg_belief']=='1') echo 'checked="checked"'; ?> />
      </div>

<div id="beliefs" rel="beliefs">
  <div>
    <label>About</label>
    <select 
       name="belief_about" 
       id="belief_about" 
       onChange="fieldChanged(this);"
       onClick="fieldChanged('belief_about');">
      <option VALUE="null">-- Choose about whom -- </option>
      <?php include ('tpl/belief_about.php'); ?>
    </select>
  </div>

  <div>
    <label>What Belief</label>
    <select 
       name="belief_what" 
       id="belief_what" 
       onChange="fieldChanged(this);"
       onClick="fieldChanged('belief_what');">
      <option VALUE="null">-- Choose belief -- </option>
      <?php include ('tpl/belief_what.php'); ?>
    </select>
  </div>

  <div>
    <label>By/From</label>
    <select 
       name="belief_by" 
       id="belief_by" 
       onChange="fieldChanged(this);"
       onClick="fieldChanged('belief_by');">
      <option VALUE="null">-- Choose whose belief -- </option>
      <?php include ('tpl/belief_by.php'); ?>
    </select>
  </div>
</div>


      <div>
	<label>Message:</label>
	<textarea cols="50" rows="10" name="msg_message"></textarea>
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

      <div id="permission" rel="permission">
	<label>Consented by:</label>
		<select name="msg_consent" 
			id="msg_consent"
			onChange="fieldChanged(this);"
			onClick="fieldChanged('msg_consent');">
          <option VALUE="null">-- Choose consent -- </option>
	  <?php include ('tpl/consents.php'); ?>
	</select>

      </div>
