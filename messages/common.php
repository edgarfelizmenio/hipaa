<?php
define('ROOTPATH', dirname(__FILE__) . '/');
define('INC_PATH', ROOTPATH . 'inc/');
define('EZSQL_PATH', INC_PATH . 'ezsql/');
define('TPL_PATH' , INC_PATH . 'tpl/');
define('CACHE_PATH', INC_PATH . 'cache/');


define('SITE_PATH', dirname($_SERVER['SCRIPT_NAME']) . '/');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] .  SITE_PATH);
define('JS_URL' ,  SITE_PATH . 'inc/js/');
define('CSS_URL' , SITE_PATH . 'inc/tpl/');
//define('JSON_URL', SITE_PATH . 'json/');
define('JSON_PATH', INC_PATH . 'json/');

define('DB_USER', 'gAASAmain');
define('DB_PASS', 'hieshoon' );
define('DB_NAME', 'g_AASA_main' );
define('DB_HOST', 'mysql-user.stanford.edu');

define('MSG_DB', 'hipaa_message');


include_once(EZSQL_PATH . "ez_sql_core.php");
include_once(EZSQL_PATH . "ez_sql_mysql.php");
include_once(INC_PATH . 'message.php');
include_once(INC_PATH . 'prolog.php');
include_once(INC_PATH . 'functions.php');
$hmsg = new Message();

/* Constants defined in config.php */
$db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME, DB_HOST);
//$prolog = new Prolog("/var/www/HIPAA", "/var/www/XSB/bin/xsb", "shh.pl");
$prolog = new Prolog("/afs/ir.stanford.edu/users/s/t/stevetan/cgi-bin/hipaa/HIPAA/", "/afs/ir.stanford.edu/users/s/t/stevetan/cgi-bin/hipaa/XSB/bin/xsb", "shh.pl");
?>