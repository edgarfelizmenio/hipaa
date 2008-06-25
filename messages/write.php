<html>
  <head>
    <?php include('tpl/header.php'); ?>
  </head>
  <body>
    <?php include('tpl/msg_menu.php'); ?>
    <h2>Write Message</h2>
    <form method="post" action="writemsg.php">
      <div>
	<label>From:</label>
	<select name="msg_from">
          <option VALUE="">-- Select whom you are -- </option>
	  <?php
	     include ('tpl/recipients.php');

	     ?>
	</select>

      </div>

      <div>
	<label>To:</label>
	<select name="msg_to">
          <option VALUE="">-- Select the recipient -- </option>
	  <?php
	     include ('tpl/recipients.php');

	     ?>
	</select>

      </div>

      <div>
	<label>About:</label>
	<select name="msg_about">
	  <?php
	     include ('tpl/about.php');
	     ?>
	</select>
      </div>
      
      <div>
	<label>Type:</label>
	<input type="text" name="type" value="phi" readonly="readonly" />
      </div>

      <div>
	<label>Purpose:</label>
	<select name="msg_purpose">
	  <?php
	     include ('tpl/purpose.php');
	     ?>
	</select>
      </div>

      <!--  <div>
	    <label>Reply-to:</label>
	    <input type="text" name="replyto" />
	    </div>
	-->
      <div>
	<label>Belief:</label>
	<input type="checkbox" name="belief" value="1" />
      </div>


      <div>
	<label>Message:</label>
	<textarea name="message"></textarea>
      </div>

      <div>
	<label>Requires Consent?</label>
	<input name="consent_required" value="true" type="checkbox" rel="permission">

      </div>

      <div rel="permission">
	<label>Consented by:</label>
		<select name="consent">
          <option VALUE="">-- Choose consent -- </option>
	  <?php
	     include ('tpl/recipients.php');

	     ?>
	</select>

      </div>



      <div>
	<input type="submit"  value="Send message" />
      </div>
      
      

    </form>
  </body>

</html>
