<?php include('messages/common.php'); 
?>

<html>

<head>
<title>HIPAA Compliance Checker</title>
</head>

<h2 align=center style='text-align:center'>Personal Health Information Messaging<span
style='color:black'><o:p></o:p></span></h2>

<body bgcolor="#d0e0ff" lang=EN-US link=blue vlink=purple style='tab-interval:
.5in' TEXT="#453E8F" LINK="#453E8F" VLINK="#453E8F" >

<div class=Section1>

<p class=MsoNormal><span style='color:black'><o:p></o:p></span></p>

</div>

<div id="frm" class="centerpiece">
<form name=msgform method=POST action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">

<table>
<tr>
<td><b>To:</b></td>
<td><select NAME="msg_to"  ALIGN=right>
          <option VALUE="dr_cox"<?php if ($_POST['msg_to'] == "dr_cox") echo " selected"; ?>>Dr Cox (Doctor)
          <option VALUE="carla"<?php if ($_POST['msg_to'] == "carla") echo " selected"; ?>>Carla (nurse)
          <option VALUE="dr_kelso"<?php if ($_POST['msg_to'] == "dr_kelso") echo " selected"; ?>>Dr Kelso (Chief of Medicine)
          <option VALUE="dr_turk"<?php if ($_POST['msg_to'] == "dr_turk") echo " selected"; ?>>Dr Turk (Surgeon)
          <option VALUE="dr_jd"<?php if ($_POST['msg_to'] == "dr_jd") echo " selected"; ?>>Dr JD (Intern)
          <option VALUE="dr_elliot"<?php if ($_POST['msg_to'] == "dr_elliot") echo " selected"; ?>>Dr Elliot (Intern)
          <option VALUE="ted"<?php if ($_POST['msg_to'] == "ted") echo " selected"; ?>>Ted (Lawyer)
          <option VALUE="j"<?php if ($_POST['msg_to'] == "j") echo " selected"; ?>>Janitor
          <option VALUE="lavern"<?php if ($_POST['msg_to'] == "lavern") echo " selected"; ?>>Lavern (secretary)
          <option VALUE="jordon"<?php if ($_POST['msg_to'] == "jordon") echo " selected"; ?>>Jordon (Board Member)
          <option VALUE="seattle_grace_hospital"<?php if ($_POST['msg_to'] == "seattle_grace_hospital") echo " selected"; ?>>Seattle grace Hospital (Business Associate)
          <option VALUE="sacred_heart_hospital"<?php if ($_POST['msg_to'] == "sacred_heart_hospital") echo " selected"; ?>>Sacred Heart Hospital (Covered Entity)
          <option VALUE="patient"<?php if ($_POST['msg_to'] == "patient") echo " selected"; ?>>(patient)
          <option VALUE="thief"<?php if ($_POST['msg_to'] == "thief") echo " selected"; ?>>(thief)
          <option VALUE="cop"<?php if ($_POST['msg_to'] == "cop") echo " selected"; ?>>(cop)
          <option VALUE="teen"<?php if ($_POST['msg_to'] == "teen") echo " selected"; ?>>(teenager)
          <option VALUE="kid"<?php if ($_POST['msg_to'] == "kid") echo " selected"; ?>>(kid)
          <option VALUE="mom"<?php if ($_POST['msg_to'] == "mom") echo " selected"; ?>>(mom)
          <option VALUE="dad"<?php if ($_POST['msg_to'] == "dad") echo " selected"; ?>>(dad)
          <option VALUE="dead"<?php if ($_POST['msg_to'] == "dead") echo " selected"; ?>>(dead person)
   </select></td>
</tr>
<tr>
<td><b>From:</b></td>
<td><select NAME="msg_from"  ALIGN=right>
          <option VALUE="carla"<?php if ($_POST['msg_from'] == "carla") echo " selected"; ?>>Carla (nurse)
          <option VALUE="dr_cox"<?php if ($_POST['msg_from'] == "dr_cox") echo " selected"; ?>>Dr Cox (Doctor)
          <option VALUE="dr_kelso"<?php if ($_POST['msg_from'] == "dr_kelso") echo " selected"; ?>>Dr Kelso (Chief of Medicine)
          <option VALUE="dr_turk"<?php if ($_POST['msg_from'] == "dr_turk") echo " selected"; ?>>Dr Turk (Surgeon)
          <option VALUE="dr_jd"<?php if ($_POST['msg_from'] == "dr_jd") echo " selected"; ?>>Dr JD (Intern)
          <option VALUE="dr_elliot"<?php if ($_POST['msg_from'] == "dr_elliot") echo " selected"; ?>>Dr Elliot (Intern)
          <option VALUE="ted"<?php if ($_POST['msg_from'] == "ted") echo " selected"; ?>>Ted (Lawyer)
          <option VALUE="j"<?php if ($_POST['msg_from'] == "j") echo " selected"; ?>>Janitor
          <option VALUE="lavern"<?php if ($_POST['msg_from'] == "lavern") echo " selected"; ?>>Lavern (secretary)
          <option VALUE="jordon"<?php if ($_POST['msg_from'] == "jordon") echo " selected"; ?>>Jordon (Board Member)
          <option VALUE="seattle_grace_hospital"<?php if ($_POST['msg_from'] == "seattle_grace_hospital") echo " selected"; ?>>Seattle grace Hospital (Business Associate)
          <option VALUE="sacred_heart_hospital"<?php if ($_POST['msg_from'] == "sacred_heart_hospital") echo " selected"; ?>>Sacred Heart Hospital (Covered Entity)
          <option VALUE="patient"<?php if ($_POST['msg_from'] == "patient") echo " selected"; ?>>(patient)
          <option VALUE="thief"<?php if ($_POST['msg_from'] == "thief") echo " selected"; ?>>(thief)
          <option VALUE="cop"<?php if ($_POST['msg_from'] == "cop") echo " selected"; ?>>(cop)
          <option VALUE="teen"<?php if ($_POST['msg_from'] == "teen") echo " selected"; ?>>(teenager)
          <option VALUE="kid"<?php if ($_POST['msg_from'] == "kid") echo " selected"; ?>>(kid)
          <option VALUE="mom"<?php if ($_POST['msg_from'] == "mom") echo " selected"; ?>>(mom)
          <option VALUE="dad"<?php if ($_POST['msg_from'] == "dad") echo " selected"; ?>>(dad)
          <option VALUE="dead"<?php if ($_POST['msg_from'] == "dead") echo " selected"; ?>>(dead person)
   </select></td>
</tr>
<tr>
<td><b>About:</b></td>
<td><select NAME="msg_about"  ALIGN=right>
         <!-- <option VALUE="seattle_grace_hospital"<?php if ($_POST['msg_about'] == "seattle_grace_hospital") echo " selected"; ?>>Seattle grace Hospital (Business Associate)
          <option VALUE="sacred_heart_hospital"<?php if ($_POST['msg_about'] == "sacred_heart_hospital") echo " selected"; ?>>Sacred Heart Hospital (Covered Entity)
          <option VALUE="dr_cox"<?php if ($_POST['msg_about'] == "dr_cox") echo " selected"; ?>>Dr Cox (Doctor)
          <option VALUE="dr_kelso"<?php if ($_POST['msg_about'] == "dr_kelso") echo " selected"; ?>>Dr Kelso (Chief of Medicine)
          <option VALUE="dr_turk"<?php if ($_POST['msg_about'] == "dr_turk") echo " selected"; ?>>Dr Turk (Surgeon)
          <option VALUE="dr_jd"<?php if ($_POST['msg_about'] == "dr_jd") echo " selected"; ?>>Dr JD (Intern)
          <option VALUE="dr_elliot"<?php if ($_POST['msg_about'] == "dr_elliot") echo " selected"; ?>>Dr Elliot (Intern)
          <option VALUE="carla"<?php if ($_POST['msg_about'] == "carla") echo " selected"; ?>>Carla (nurse)
          <option VALUE="ted"<?php if ($_POST['msg_about'] == "ted") echo " selected"; ?>>Ted (Lawyer)
          <option VALUE="j"<?php if ($_POST['msg_about'] == "j") echo " selected"; ?>>Janitor
          <option VALUE="lavern"<?php if ($_POST['msg_about'] == "lavern") echo " selected"; ?>>Lavern (secretary)
          <option VALUE="jordon"<?php if ($_POST['msg_about'] == "jordon") echo " selected"; ?>>Jordon (Board Member) -->
          <option VALUE="patient"<?php if ($_POST['msg_about'] == "patient") echo " selected"; ?>>(patient)
          <option VALUE="thief"<?php if ($_POST['msg_about'] == "thief") echo " selected"; ?>>(thief)
          <option VALUE="cop"<?php if ($_POST['msg_about'] == "cop") echo " selected"; ?>>(cop)
          <option VALUE="teen"<?php if ($_POST['msg_about'] == "teen") echo " selected"; ?>>(teenager)
          <option VALUE="kid"<?php if ($_POST['msg_about'] == "kid") echo " selected"; ?>>(kid)
          <option VALUE="mom"<?php if ($_POST['msg_about'] == "mom") echo " selected"; ?>>(mom)
          <option VALUE="dad"<?php if ($_POST['msg_about'] == "dad") echo " selected"; ?>>(dad)
          <option VALUE="dead"<?php if ($_POST['msg_about'] == "dead") echo " selected"; ?>>(dead person)
   </select></td>
</tr>
<tr>
<td><b>Purpose:</b></td>
<td><select NAME="msg_purpose" ALIGN=right>
          <option VALUE="healthCare_operations"<?php if ($_POST['msg_purpose'] == "healthCare_operations") echo " selected"; ?>>Health care operations
          <option VALUE="payment"<?php if ($_POST['msg_purpose'] == "payment") echo " selected"; ?>>Payment
          <option VALUE="treatment"<?php if ($_POST['msg_purpose'] == "treatment") echo " selected"; ?>>Treatment
          <option VALUE="create_deidentified_info"<?php if ($_POST['msg_purpose'] == "create_deidentified_info") echo " selected"; ?>>Create De-identified Information
          <option VALUE="create_protected_health_info"<?php if ($_POST['msg_purpose'] == "create_protected_health_info") echo " selected"; ?>>Create protected health information
          <option VALUE="receive_deidentified_info"<?php if ($_POST['msg_purpose'] == "receive_deidentified_info") echo " selected"; ?>>Receive De-identified information
          <option VALUE="requested_by_Individual"<?php if ($_POST['msg_purpose'] == "requested_by_Individual") echo " selected"; ?>>Request by individual
          <option VALUE="investigate"<?php if ($_POST['msg_purpose'] == "investigate") echo " selected"; ?>>Investigation
          <option VALUE="definition_healthCare_operations"<?php if ($_POST['msg_purpose'] == "definition_healthCare_operations") echo " selected"; ?>>Define health care operations
          <option VALUE="compliance"<?php if ($_POST['msg_purpose'] == "compliance") echo " selected"; ?>>Compliance
          <option VALUE="incident_to_use"<?php if ($_POST['msg_purpose'] == "incident_to_use") echo " selected"; ?>>Incident to use
          <option VALUE="healthCare_fraud_abuse_detection"<?php if ($_POST['msg_purpose'] == "healthCare_fraud_abuse_detection") echo " selected"; ?>>Detect health care fraud abuse
          <option VALUE="determining_legal_options"<?php if ($_POST['msg_purpose'] == "determining_legal_options") echo " selected"; ?>>Determine legal options
          <option VALUE="standards_faliure_misconduct"<?php if ($_POST['msg_purpose'] == "standards_failure_misconduct") echo " selected"; ?>>Standards failure and misconduct
   </select></td>
</tr>
</table>

<p align=center> <input type=submit name=submit_pbh value="Permitted by HIPAA?"> </p>

</form>
</div>

<?php

function validate_ip() {
  global $login_error, $prolog;
  $mTo = htmlspecialchars($_REQUEST['msg_to']);
  $mFrom = htmlspecialchars($_REQUEST['msg_from']);
  $mAbout = htmlspecialchars($_REQUEST['msg_about']);
  $mPurpose = htmlspecialchars($_REQUEST['msg_purpose']);
  if(!$mTo)
    $login_error = "You must supply the recipients name";
  else if(!$mFrom)
    $login_error = "You must supply the senders name";
  else if(!$mAbout)
    $login_error = "You must supply the subjects name";
  else if(!$mPurpose)
    $login_error = "You must supply the purpose";
  else
  {
    $query="pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,null,null))";

    $result = $prolog->askHIPAA($query);
    echo $result;
    $myFile = "./log/log.txt";
    $fh = fopen($myFile, 'a') or die("cant open file");
    fwrite($fh, $query.$result."\n");
    fclose($fh);
    
  }
}

// Return true if the user is valid, otherwise return false
  if(isset($_REQUEST['submit_pbh']))
  {
    validate_ip();
  }

?>


<div class="footer warning">
<?php global $login_error; echo $login_error; ?>
</div>
<script>document.msgform.msg_to.focus();</script>

</body>

</html>
