<?php
/**
 * Given the values for a number of variables, returns the possible
 * values for the other variables in JSON format
 * Eg. If the sender is a policeman, he can only have law purposes
 */

// get variables passed in, otherwise, place as variable for prolog to
// fill in

$evalVars = array();
if (isset($_GET['msg_to'])) {
  $mTo = $_GET['msg_to'];
 } else {
  $mTo = 'Mto';
  $evalVars[] = $mTo;
 }
if (isset($_GET['msg_from'])) {
  $mFrom = $_GET['msg_from'];
 } else {
  $mFrom = 'Mfrom';
  $evalVars[] = $mFrom;
 }
if (isset($_GET['msg_purpose'])) {
  $mPurpose = $_GET['msg_purpose'];
 } else {
  $mPurpose = 'Mpurpose';
  $evalVars[] = $mPurpose;
 }
if (isset($_GET['msg_about'])) {
  $mAbout = $_GET['msg_about'];
 } else {
  $mAbout = 'Mabout';
  $evalVars[] = $mAbout;
 }

$toEvaluate = implode(',',$evalVars);


$prologCall = "\"setof(t($toEvaluate), pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,null,null)),L).\"";
echo $prologCall;
// results will return properly formatted return value for use

#$results = shell_exec("pwd");
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