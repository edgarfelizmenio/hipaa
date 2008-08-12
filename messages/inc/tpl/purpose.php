<!--          <option VALUE="healthCare_operations"<?php if ($_POST['msg_purpose'] == "healthCare_operations") echo " selected"; ?>>Health care operations</option>
          <option VALUE="payment"<?php if ($_POST['msg_purpose'] == "payment") echo " selected"; ?>>Payment</option>
          <option VALUE="treatment"<?php if ($_POST['msg_purpose'] == "treatment") echo " selected"; ?>>Treatment</option>
          <option VALUE="create_deidentified_info"<?php if ($_POST['msg_purpose'] == "create_deidentified_info") echo " selected"; ?>>Create De-identified Information</option>
          <option VALUE="create_protected_health_info"<?php if ($_POST['msg_purpose'] == "create_protected_health_info") echo " selected"; ?>>Create protected health information</option>
          <option VALUE="receive_deidentified_info"<?php if ($_POST['msg_purpose'] == "receive_deidentified_info") echo " selected"; ?>>Receive De-identified information</option>
          <option VALUE="requested_by_Individual"<?php if ($_POST['msg_purpose'] == "requested_by_Individual") echo " selected"; ?>>Request by individual</option>
          <option VALUE="investigate"<?php if ($_POST['msg_purpose'] == "investigate") echo " selected"; ?>>Investigation</option>
          <option VALUE="definition_healthCare_operations"<?php if ($_POST['msg_purpose'] == "definition_healthCare_operations") echo " selected"; ?>>Define health care operations</option>
          <option VALUE="compliance"<?php if ($_POST['msg_purpose'] == "compliance") echo " selected"; ?>>Compliance</option>
          <option VALUE="incident_to_use"<?php if ($_POST['msg_purpose'] == "incident_to_use") echo " selected"; ?>>Incident to use</option>
          <option VALUE="healthCare_fraud_abuse_detection"<?php if ($_POST['msg_purpose'] == "healthCare_fraud_abuse_detection") echo " selected"; ?>>Detect health care fraud abuse</option>
          <option VALUE="determining_legal_options"<?php if ($_POST['msg_purpose'] == "determining_legal_options") echo " selected"; ?>>Determine legal options</option>
          <option VALUE="standards_faliure_misconduct"<?php if ($_POST['msg_purpose'] == "standards_failure_misconduct") echo " selected"; ?>>Standards failure and misconduct</option>
-->
<?php

$filename = CACHE_PATH . 'allpossiblesserialized.php';
$fh = fopen($filename, 'r');
$string = fread($fh, filesize($filename));
$options = unserialize($string);



$recipients = $options->Msg_purpose->items;

foreach($recipients as $recipient) {
  $value = $recipient->name;
  $selected = ($_POST['msg_purpose'] == $value) ? 'selected="selected"' : '';
  echo "<option value='$value' $selected> $value </option>\n";

}

$value = 'requested_by_Individual';
$selected = ($_POST['msg_purpose'] == $value) ? 'selected="selected"' : '';
echo "<option value='$value' $selected> $value </option>\n";


?>