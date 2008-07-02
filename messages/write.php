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

	<select id="msg_from"
		name="msg_from"
		onChange="fieldChanged(this);"
		autocomplete="false">
<?php	     include ('tpl/recipients.php');	     ?>
	</select>

      </div>

      <div>
	<label>To:</label>
	<select name="msg_to"
		id="msg_to"
	onChange="fieldChanged(this);"
	    name="First Name">
	  <?php	     include ('tpl/recipients.php');	     ?>
	</select>

      </div>

      <div>
	<label>About:</label>
	<select name="msg_about"
		id="msg_about"
	onChange="fieldChanged(this);">
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
	<select id="msg_purpose"
		name="msg_purpose"
	onChange="fieldChanged(this);"   >
	     <?php include ('tpl/purpose.php');
	     ?>
	</select>
      </div>

      <!--  <div>
	    <label>Reply-to:</label>
	    <input type="text" name="replyto" />
	    </div>
	-->
<?php
   include ('tpl/msg_footer.php');
?>


      <div>
	<input type="submit"  value="Send message" />
      </div>
      
      

    </form>
  </body>

</html>
