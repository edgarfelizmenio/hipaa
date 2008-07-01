<html>
  <head>
    <?php include('tpl/header.php'); ?>
  </head>
  <body id="body" class="tundra">
    <?php include('tpl/msg_menu.php'); ?>
    <h2>Write Message</h2>
    <form method="post" action="writemsg.php">
      <div>
	<label>From:</label>

	<select id="msg_from"
		name="msg_from"
		dojoType="dijit.form.FilteringSelect"
		onChange="fieldChanged('msg_from');"
		autocomplete="false">
<?php	     include ('tpl/recipients.php');	     ?>
	</select>

      </div>

      <div>
	<label>To:</label>
	<select name="msg_to"
		id="msg_to"
		dojoType="dijit.form.FilteringSelect"
		autocomplete="false"
		onChange="fieldChanged('msg_to');"
	    name="First Name">
	  <?php	     include ('tpl/recipients.php');	     ?>
	</select>

      </div>

      <div>
	<label>About:</label>
	<select name="msg_about"
		id="msg_about"
		dojoType="dijit.form.FilteringSelect"
		autocomplete="false"
		onChange="fieldChanged('msg_about');">
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
		dojoType="dijit.form.FilteringSelect"
		autocomplete="false"
		onChange="fieldChanged('msg_purpose');">
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
<?php
   include ('tpl/msg_footer.php');
?>


      <div>
	<input type="submit"  value="Send message" />
      </div>
      
      

    </form>
  </body>

</html>
