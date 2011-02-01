<?php

$hostname='127.0.0.1:3306';
$username='root';
$password='Anant$04';
$dbname='hipaa';

//Connect To Database
//$hostname='hipaa.db.7039406.hostedresource.com';
//$username='hipaa';
//$password='P@ssw0rd';
//$dbname='hipaa';
@mysql_connect($hostname,$username, $password) or die ('Unable to connect to database! Please try again later.');
@mysql_select_db($dbname) or die('Failed to load Database');

?> 