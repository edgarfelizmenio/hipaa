<?php
include_once ('db.php');
include_once ('functions.php');

class Message {

  private $db;
  function __construct() {
      $this->db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME, DB_HOST);
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
    $consenter = addslahes($consenter);

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

  function addMessage($msg_to, $msg_from, $msg_about, $type, $purpose,
		      $consent, $belief, $message, $consent_required, $parent_id=-1) {

    if ($consent_required == 'true')
      $consented = '0';
    else $consented = '1';
    $msg_to = addslahses($msg_to);
    $msg_from = addslashes($msg_from);
    $msg_about = addslashes($msg_about);
    $type = addslashes($type);
    $purpose = addslashes($purpose);
    $consent = addslashes($consent);
    $belief = addslashes($belief);
    $message = addslashes($message);
    $parent_id = addslashes($parent_id);


    /* Below is code mostly lifted from existing 'message_checker.php'
     script */
    $mTo = htmlspecialchars($msg_to);
    $mFrom = htmlspecialchars($msg_from);
    $mAbout = htmlspecialchars($msg_about);
    $mPurpose = htmlspecialchars($purpose);
   
    if (true) { // using prolog?
      if(!$mTo || empty($mTo)) {
	die("You must supply the recipients name");
      } else if(!$mFrom || empty($mFrom)) {
	die("You must supply the senders name");
      } else if(!$mAbout || empty($mAbout)) {
	die("You must supply the subjects name");
      } else if(!$mPurpose || empty($mPurpose))
	die("You must supply the purpose");
    
    $STR="\"pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,null,null)).\"";
    //$STR="\"pbh(a(patient, ce, patient, phi, null, null, null,null)).\"";
    $crap = shell_exec("sh ../prolog $STR");
    echo $crap;
    if (strpos($crap, "yes") === false)
      die('not allowed');
    }
    if (empty($parent_id))
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
                ( '" . $mTo . "'
                , '" . $mFrom . "'
                , '" . $mAbout . "'
                , '" . $type . "'
                , '" . $mPurpose . "'
                , '" . $consent . "'
                , '" . $consented . "'
                , '" . $belief . "'
                , '" . $message . "'
                , '" . $parent_id . "'
                )";

    $this->db->query($query);

  }

}
?>