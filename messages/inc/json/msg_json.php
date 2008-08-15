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
    $mConsent = "(${_GET['msg_consent']},consented)";
  } else {
    $mConsent = '(Msg_consent,consented)';
    $evalVars[] = 'Msg_consent';    
  }
} else {
  $mConsent = 'null';  
}


if (isset($_GET['msg_belief']) && $_GET['msg_belief'] == 'true') {
  if (isset($_GET['belief_about']) && $_GET['belief_about'] != 'null') {
    $belief_about = $_GET['belief_about']; 
  } else {
    $belief_about = 'Belief_about';
    $evalVars[] = $belief_about;    
  }

  if (isset($_GET['belief_what']) && $_GET['belief_what'] != 'null') {
    $belief_what = $_GET['belief_what']; 
  } else {
    $belief_what = 'Belief_what';
    $evalVars[] = $belief_what;    
  }

  if (isset($_GET['belief_by']) && $_GET['belief_by'] != 'null') {
    $belief_by = $_GET['belief_by']; 
  } else {
    $belief_by = 'Belief_by';
    $evalVars[] = $belief_by;    
  }

  $mBelief = "b($belief_about,$belief_what,$belief_by)";

} else {
  $mBelief = 'null';  
}



$toEvaluate = implode(',',$evalVars);

$query = "pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,$mConsent,$mBelief))";
echo $prolog->getPossibleVals($evalVars, $query, 'filter_var_any');


?>