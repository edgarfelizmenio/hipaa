<?php
$shutOffLinks = 1;
require_once "resources/inc/header.php";
session_start();
unset($_SESSION['LOGIN']);
?>

<div id="wrap"> 
<?php
$sql = "SELECT * FROM users";
$results = @mysql_query($sql);
if(!$results){
	DIE ('Failed to load API list');
}

?>
<table style="width:100%">
<tr>
<td style="width:50%; border-right-style:solid; border-right-width:thin; border-right-color:#6D6D6D; padding:30px; vertical-align:top;">
<div style="background-color:#F9F9F9; width:400px; padding:20px; text-align:justify; float:right;">
<p style="font-weight:bold;">
Welcome to the HIPAA Compliant Mail System Demo.
</p>
<p>
The demo shows how the HIPAA Compliance checker can be integrated into existing email systems to enforce policies.
For this demo, we have considered a simple hospital message flow that follows HIPAA guidelines. 
The system enforces that messages are not allowed if they violate HIPAA in some way. 
</p>
<p>
The demo also shows certain situations in which the system should allow some actions. 
</p>
</div>
</td>

<td style="width:50%; border-left-style:solid; border-left-width:thin; border-left-color:#6D6D6D; padding:30px; vertical-align:top;">
<div style="width:250px; text-align:left;">
<label style="font-weight:bold; font-size:larger; color:#6D6D6D;">HIPAA Login</label>
<hr />
<?php 
	if(isset($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR'])>0) {
		print '<p style="color:#FF0000; font-weight:bold; border-style:solid; border-width:thin; padding:10px; background-color:#FFFFD9">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			print $msg;
			print '<br />';
		}
		print '</p>';
		unset($_SESSION['ERRMSG_ARR']);
	} 
?>
<form method="post" action="login-exec.php">
<table style="padding-top:15px;">
<tr>
<td>
<label style="font-weight:bold; color:#00006A">Login: </label>
</td>
</tr>
<tr>
<td>
<select name= "login_" id="login_" style="width:236px; height: 23px;" onchange="autoFill(this.value);">
<option value= "" selected="selected">Select Login</option>
<?php
while($name = mysql_fetch_array($results)){
print "<option value=\"$name[last_name]\"> $name[initials] $name[last_name] </option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>
<label style="font-weight:bold; color:#00006A">Password: </label>
</td>
</tr>
<tr>
<td>
<input type="password" id="password_" name= "password_" value="" style="width:230px;"/>
</td>
</tr>
<tr>
<td>
<br />
<input type="submit" value="Login" style="width:100px;"/>
</td>
</tr>

</table>
</form>
</div>
</td>
</tr>
</table>
<br />
<br />
</div>

<script type="text/javascript">
//<![CDATA[
function autoFill(str){
	if(str!=""){
		document.getElementById("password_").value="xxxx";
	}else{
		document.getElementById("password_").value="";
	}
}
//]]>
</script>
<?php
session_write_close();
require_once "resources/inc/footer.php";
?>

