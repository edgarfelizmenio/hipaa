<h2>Replying to Message</h2>
<?php

print_r($_POST);
if ($hmsg->addMessage($_POST['consent_required'], $_POST['msg_id'])) {
  echo "<p>Messaged added successfully</p>";
 } else {
  echo "<p>Not allowed</p>";
  echo '<a href="Javascript:history.go(-1);">Go Back</a>';
 } 



?>
