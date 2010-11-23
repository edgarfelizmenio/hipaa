<div id="loginBox">
  <form id="loginDropdown" method="post"
	action="login.php"
	class="loginbox">
    
    <h5>
      <a onclick="$('#loginForm').toggle().parent().toggleClass('expanded'); return false;" id="loginexpander"  href="#">
      Log in</a>  to your account</h5>
    <div class="loginform" id="loginForm"
	 style="display: none;">
      <div> 
	<label for="username">User Name:</label>
	<select id="username"
		name="username"
		autocomplete="off">
	<?php include (TPL_PATH . 'from.php'); ?>
	</select>
      </div>
      <div>
	<label for="password">Password:</label>
	<input type="password" 
	       autocomplete="off"
	       name="password" 
	       id="password"
	       value="1234"
	       readonly="readonly"/>
	
      </div>
      <div>
	<input type="hidden" 
	       id="redirect" 
	       name="redirect" 
	       value="<?php echo basename($_SERVER['PHP_SELF'])?>" />
	<input type="submit" 
	       class="btn"
	       value="LOG IN" />
      </div>
    </div>
  </form>
</div>
