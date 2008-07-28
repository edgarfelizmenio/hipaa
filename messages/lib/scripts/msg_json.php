<?php
/**
 * Given the values for a number of variables, returns the possible
 * values for the other variables in JSON format
 * Eg. If the sender is a policeman, he can only have law purposes
 */

// get variables passed in, otherwise, place as variable for prolog to
// fill in

$evalVars = array();
if (isset($_GET['msg_to']) && $_GET['msg_to'] != 'null') {
  $mTo = $_GET['msg_to'];
 } else {
  $mTo = 'Msg_to';
  $evalVars[] = $mTo;
 }
if (isset($_GET['msg_from']) && $_GET['msg_from'] != 'null') {
  $mFrom = $_GET['msg_from'];
 } else {
  $mFrom = 'Msg_from';
  $evalVars[] = $mFrom;
 }
if (isset($_GET['msg_purpose']) && $_GET['msg_purpose'] != 'null') {
  $mPurpose = $_GET['msg_purpose'];
 } else {
  $mPurpose = 'Msg_purpose';
  $evalVars[] = $mPurpose;
 }
if (isset($_GET['msg_about']) && $_GET['msg_about'] != 'null') {
  $mAbout = $_GET['msg_about'];
 } else {
  $mAbout = 'Msg_about';
  $evalVars[] = $mAbout;
 }
if (isset($_GET['consent_required']) && $_GET['consent_required'] == 'true') {
if (isset($_GET['msg_consent']) && $_GET['msg_consent'] != 'null') {
  $mConsent = '(Msg_consent,consented)';
  $evalVars[] = 'Msg_consent';
}

} else {
$mConsent = 'null';
}

$toEvaluate = implode(',',$evalVars);


$prologCall = "\"setof(t($toEvaluate), pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,$mConsent,null)),L).\"";
// results will return properly formatted return value for use

$results = shell_exec("sh ./getJSON $prologCall");

// give the JSON values back to caller
echo $results;


/*
Sample JSON results if they had provided a value for msg_to
Thus they will get results for Mfrom and Mpurpose

{Mfrom: {identifier: "name",
	    items: [{name: "doctor"},
		    {name: "nurse"},
		    {name: "police"}]
	 },
 Mpurpose: {identifier: "name",
	     items: [{name: "create_deidentified_info"},
		     {name: "healthCare_operations"},
		     {name: "determine_legal_options"}]
            }
}


*/

?>