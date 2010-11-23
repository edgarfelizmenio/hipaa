<?php
if (isLoggedIn()) {
  include (TPL_PATH . 'logother_form.php');
 } else {
  include (TPL_PATH . 'login_form.php');
 }

?>