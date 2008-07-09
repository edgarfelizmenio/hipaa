<h2>Sending Message</h2>
<?php

if ($hmsg->addMessage($_POST['consent_required'])) {
  echo "<p>Messaged added successfully</p>";
  echo '<a href="viewmsg.php">View messages</a>';
 } else {
  echo "<p>Not allowed</p>";
  echo '<a href="Javascript:history.go(-1);">Go Back</a>';
 }





?>