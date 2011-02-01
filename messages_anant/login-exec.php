<?php	
	//Include database connection details
	require_once "resources/inc/header.php";
	
	//Start session
	session_start();
		
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login_']);
	$password = clean($_POST['password_']);

	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login missing.';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing.';
		$errflag = true;
	}
	
	//If there are input validation error, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}
	$_SESSION['LOGIN'] = $login;
	header("location: index.php");
	session_write_close();
?>