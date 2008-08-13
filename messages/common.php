<?php
define('ROOTPATH', dirname(__FILE__) . '/'); // /var/www/messages/
define('INC_PATH', ROOTPATH . 'inc/'); // /var/www/messages/inc/
define('EZSQL_PATH', INC_PATH . 'ezsql/'); // /var/www/messages/inc/ezsql/
define('TPL_PATH' , INC_PATH . 'tpl/'); // /var/www/messages/inc/tpl/
define('CACHE_PATH', INC_PATH . 'cache/'); // /var/www/messages/inc/cache
define('JSON_PATH', INC_PATH . 'json/'); // /var/www/messages/inc/json/
define('HIPAA_PATH', '/var/www/HIPAA/');
define('XSB_PATH', '/var/www/XSB/bin/xsb');

define('SITE_PATH', dirname($_SERVER['SCRIPT_NAME']) . '/'); // /messages/
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] .  SITE_PATH); // http://crypto.stanford.edu/messages/
define('JS_URL' ,  SITE_PATH . 'inc/js/'); // /messages/inc/js/
define('CSS_URL' , SITE_PATH . 'inc/tpl/'); // /messages/inc/tpl/

define('DB_USER', 'gAASAmain');
define('DB_PASS', 'hieshoon' );
define('DB_NAME', 'g_AASA_main' );
define('DB_HOST', 'mysql-user.stanford.edu');

define('POLICY_FILE', 'shh.pl');
define('CACHE_FILE', 'allposscache.php');

define('MSG_DB', 'hipaa_message');

include_once(EZSQL_PATH . "ez_sql_core.php");
include_once(EZSQL_PATH . "ez_sql_mysql.php");
include_once(INC_PATH . 'message.php');
include_once(INC_PATH . 'prolog.php');
include_once(INC_PATH . 'functions.php');

$hmsg = new Message();
$db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME, DB_HOST);
$prolog = new Prolog(HIPAA_PATH, XSB_PATH, POLICY_FILE);
//$prolog = new Prolog("/afs/ir.stanford.edu/users/s/t/stevetan/cgi-bin/hipaa/HIPAA/", "/afs/ir.stanford.edu/users/s/t/stevetan/cgi-bin/hipaa/XSB/bin/xsb", "shh.pl");
?>