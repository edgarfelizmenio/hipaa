<?php

$json_values = shell_exec("cd lib/scripts/; cat allpossibles | perl msg_possibles.pl");
$options = json_decode($json_values);


$recipients = $options->Msg_from->items;

foreach($recipients as $recipient) {
  $value = $recipient->name;

  echo "<option value='$value'> $value </option>\n";

}

?>