<?php
session_start();
if(isset($_SESSION['username']))
  unset($_SESSION['username']); 

$username = $_POST['username'];
$redirect = $_POST['redirect'];

if (empty($username))
  die('invalid username');

$_SESSION['username'] = htmlspecialchars($username);

/* Redirect to a different page in the current directory that was
 requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: http://$host$uri/$redirect");
exit;

?>