<?php
session_start();
session_destroy();

$redirect = $_GET['redirect'];
/* Redirect to a different page in the current directory that was
 requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: http://$host$uri/$redirect");
exit;


?>