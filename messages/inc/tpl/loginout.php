<?php
if (isLoggedIn()) {
  include ('logother_form.php');
 } else {
  include ('login_form.php');
 }

?>