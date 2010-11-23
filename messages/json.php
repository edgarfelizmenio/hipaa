<?php
include_once('common.php');
$action = ($_POST['action']) ? $_POST['action'] : $_GET['action'];
switch ($action) {
 case 'msg_json.php':
   include (JSON_PATH . $action);



 }

?>
