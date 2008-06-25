<?php
include_once "lib/ez_sql_core.php";
include_once "lib/ez_sql_mysql.php";

/* DB defines here */

$db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME, DB_HOST);
?>
