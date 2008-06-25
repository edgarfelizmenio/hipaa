<?php
include_once('lib/db.php');
include('tpl/msg_menu.php'); 
?>
<h2>View All Messages</h2>
<?php
$query = "SELECT *
          FROM `hipaa_msg`";

$db->query($query);

$db->debug();

?>