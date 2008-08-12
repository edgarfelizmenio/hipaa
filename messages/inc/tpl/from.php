<?php
$filename = CACHE_PATH . 'allpossiblesserialized.php';
$fh = fopen($filename, 'r');
$string = fread($fh, filesize($filename));
$options = unserialize($string);


$recipients = $options->Msg_from->items;

foreach($recipients as $recipient) {
  $value = $recipient->name;
  $selected = ($_POST['msg_from'] == $value) ? 'selected="selected"' : '';
  echo "<option value='$value' $selected> $value </option>\n";

}

?>