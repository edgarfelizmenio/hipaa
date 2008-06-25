<?php
include_once ('db.php');

class Message {

  private $db;
  function __construct() {
      $this->db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME, DB_HOST);
  }

  /**
   * Retrieves ones mail
   */
  function getRecipientMail($recipient) {
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
    $query = "SELECT * FROM `hipaa_msg`
              WHERE consent='" . $consenter . "'
             ";
    return $this->db->get_results($query);
  }
  

  /**
   * Sets the consented value for a message
   */
  function setConsent($msg_id, $consented='1') {
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
    $query = "SELECT * FROM `hipaa_msg`
              WHERE msg_id='" . $msg_id . "'
             ";
    $results = $this->db->get_row($query);
    return $results;
  }


  /**
   * Retrieves the history of a message
   */
  function getHistory($msg_id) {
    $ancestors = $this->getAncestors($msg_id);

    $ids = implode(',', $ancestors);

    $query = "SELECT * FROM hipaa_msg WHERE msg_id IN(" . $ids . ")";
    return $this->db->get_results($query);
  }

  /**
   * Retrieves all ancestors of this message
   */
  function getAncestors($msg_id) {
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