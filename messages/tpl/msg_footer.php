      <div>
	<label>Belief:</label>
	<input type="checkbox" rel="belief_present" name="msg_belief" value="1" />
      </div>

<div rel="belief_present">
<div>
  <label>About</label>
  <input type="text" name="b_about" />
</div>
<div>
  <label>Belief</label>
  <input type="text" name="b_belief" />
</div>
<div>
  <label>From</label>
  <input type="text" name="b_from" />
</div>
</div>


      <div>
	<label>Message:</label>
	<textarea name="msg_message"></textarea>
      </div>

      <div>
	<label>Requires Consent?</label>
	<input name="consent_required" value="true" type="checkbox" rel="permission">

      </div>

      <div rel="permission">
	<label>Consented by:</label>
		<select name="msg_consent">
          <option VALUE="">-- Choose consent -- </option>
	  <?php
	     include ('tpl/recipients.php');

	     ?>
	</select>

      </div>
