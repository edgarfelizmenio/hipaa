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
  <input type="text" name="belief_about" />
</div>
<div>
  <label>What Belief</label>
  <input type="text" name="belief_what" />
</div>
<div>
  <label>By/From</label>
  <input type="text" name="belief_by" />
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
	 value="1" 
	 type="checkbox"
	 rel="permission"
	 <?php if($_POST['consent_required']=='1') echo 'checked="checked"'; ?>>

      </div>

      <div rel="permission">
	<label>Consented by:</label>
		<select name="msg_consent">
          <option VALUE="">-- Choose consent -- </option>
	  <?php
	     include ('tpl/consents.php');

	     ?>
	</select>

      </div>
