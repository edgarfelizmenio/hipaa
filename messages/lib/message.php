<?php
include_once ('db.php');
include_once ('functions.php');
require_once ('xsbprolog.php');

class Message {

  private $db;
  function __construct() {
    $this->db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME, DB_HOST);
    $this->prolog = new Xsbprolog();
  }

  /**
   * Retrieves ones mail
   * @param recipient string name of recipient
   */
  function getRecipientMail($recipient) {
    $recipient = addslashes($recipient);

    $query = "SELECT * FROM `hipaa_msg`
              WHERE msg_to='" . $recipient . "'
              AND consented='1'
             ";

    return $this->db->get_results($query);
  }

  /**
   * Retrieves the consents that the consenter needs to consent
   */
  function getConsents($consenter) {
    if(empty($consenter))
      return null;
    $consenter = addslashes($consenter);

    $query = "SELECT * FROM `hipaa_msg`
              WHERE consent='" . $consenter . "'
             ";
    return $this->db->get_results($query);
  }
  

  /**
   * Sets the consented value for a message
   */
  function setConsent($msg_id, $consented='1') {
    $msg_id = intval($msg_id);
    $consented = addslashes($consented);

    $query = "UPDATE `hipaa_msg`
              SET consented='" . $consented . "'
              WHERE msg_id='" . $msg_id . "'
             ";

    $this->db->query($query);
  }

  /**
   * Retrieve all recipients of mail
   */
  function getRecipients() {
    $query = "SELECT DISTINCT msg_to AS name from hipaa_msg";
    return $this->db->get_results($query);
  }

  /**
   * Retrieves all people who need to consent
   */
  function getConsenters() {
    $query = "SELECT DISTINCT consent AS name from hipaa_msg WHERE consented='0'";
    return $this->db->get_results($query);
  }


  function getMessage($msg_id) {
    $msg_id = intval($msg_id);
    $query = "SELECT * FROM `hipaa_msg`
              WHERE msg_id='" . $msg_id . "'
             ";
    $results = $this->db->get_row($query);
    return $results;
  }

  function getAllMessages() {
    $query = "SELECT *
              FROM `hipaa_msg`";
    
    $this->db->query($query);
    
    $this->db->debug();

  }


  /**
   * Retrieves the history of a message
   */
  function getHistory($msg_id) {
    $msg_id = intval($msg_id);
    $ancestors = $this->getAncestors($msg_id);

    $ids = implode(',', $ancestors);

    $query = "SELECT * FROM hipaa_msg WHERE msg_id IN(" . $ids . ")";
    return $this->db->get_results($query);
  }

  /**
   * Retrieves all ancestors of this message
   */
  function getAncestors($msg_id) {
    $msg_id = intval($msg_id);
    $idtree = array();
    $idtree[] = $msg_id;
    while (true) {
      $query = "SELECT parent_id 
              FROM hipaa_msg
              WHERE msg_id='" . $msg_id . "'
              ";
      $parent_id = $this->db->get_var($query);
      if ($parent_id != -1) {
	$idtree[] = $parent_id;
	$msg_id = $parent_id;
      } else {
	break;
      }
    }
    return $idtree;
  }

  function addMessage($consent_required, $parent_id=-1) {
    global $_POST;

    // make variables local and check for missing fields
    $msg_vars = $this->getMsgVars();
    foreach($msg_vars as $msg_var => $required) {
      $$msg_var = htmlspecialchars(addslashes($_POST[$msg_var]));
      if ($required && ($$msg_var == 'null' || empty($$msg_var))) {
	$errors[] = $msg_var;
      }
    }

    // if they believe something, make sure they fill out all belief fields
    if ($msg_belief == '1') {
      $b_about = $_POST['b_about'];
      $b_belief = $_POST['b_belief'];
      $b_from = $_POST['b_from'];
      if (empty ($b_about) || empty($b_belief) || empty($b_from))
	$errors[] = 'Please fill out all belief fields';
      $mBelief = "b($b_about,$b_belief,$b_from)";
    }
    
    // exit out if required fields not filled in
    if (!empty($errors)) {
      echo "<h4>Please fill in the following:</h4>\n";
      echo '<ul id="errors">' . "\n";
      foreach ($errors as $error) {
	echo "<li>$error</li>\n";
      }
      echo '</ul>' . "\n";
      return;
    }

    $consented = '1'; // by default a message is consented/allowed
    if ($consent_required == 'true') // unless consent is required
      $consented = '0';

    $parent_id = intval($_POST['parent_id']);

    /* Variables to be passed to prolog */
    $mTo = $msg_to;
    $mFrom = $msg_from;
    $mAbout = $msg_about;
    $mPurpose = $msg_purpose;
    /* not implemented yet */
    $mReplyto = 'null';
    $mConsent = 'null';
    $mBelief = 'null';

    $query="pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,$mReplyto,$mConsent,$mBelief)).";

    // reply to, consented, belief
    //    $STR="\"pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,null,null)).\"";
    // b(ce,unlawful,Carla) # Carla believes that the covered entity is unlawful
    //$STR="\"pbh(a(patient, ce, patient, phi, null, null, null,null)).\"";
    // b(ce, unlawful, Carla)
    // where is consented by?
    $response = $this->prolog->askHIPAA($query);

    echo $response;
    if (strpos($response, "yes") === false)
      return false;
  
  if (empty($parent_id) || $parent_id==0)
    $parent_id = -1;
  $query = "INSERT INTO `hipaa_msg` 
                ( `msg_to` 
                , `msg_from`
                , `about` 
                , `type` 
                , `purpose` 
                , `consent`
                , `consented`
                , `belief` 
                , `message`
                , `parent_id` 
                )
              VALUES 
                ( '" . $msg_to . "'
                , '" . $msg_from . "'
                , '" . $msg_about . "'
                , '" . $msg_type . "'
                , '" . $msg_purpose . "'
                , '" . $msg_consent . "'
                , '" . $consented . "'
                , '" . $msg_belief . "'
                , '" . $msg_message . "'
                , '" . $parent_id . "'
                )";

  if(!$this->db->query($query)) {
    echo "Error in query";
  }

  return true;

  }

/**
 * Returns an associative array with variable name as the key and a
 * boolean telling whether the variable is required for a message or not
 */
private function getMsgVars() {
  $msg_vars = array();
  $msg_vars['msg_to'] = true;
  $msg_vars['msg_from'] = true;
  $msg_vars['msg_about'] = true;
  $msg_vars['msg_type'] = true;
  $msg_vars['msg_purpose'] = true;
  $msg_vars['msg_belief'] = false;
  $msg_vars['msg_message'] = true;
  $msg_vars['msg_consent'] = false;        
  return $msg_vars;
}
}
?>
