<?php
include_once ('db.php');
include_once ('functions.php');
require_once ('xsbprolog.php');

define('MSG_DB', 'hipaa_message');

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

    $query = "SELECT * FROM " . MSG_DB . "
              WHERE `to`='" . $recipient . "'
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

    $query = "SELECT * FROM " . MSG_DB . "
              WHERE consent='" . $consenter . "'
             ";
    return $this->db->get_results($query);
  }
  

  /**
   * Sets the consented value for a message
   */
  function setConsent($message_id, $consented='1') {
    $message_id = intval($message_id);
    $consented = addslashes($consented);

    $query = "UPDATE " . MSG_DB . "
              SET consented='" . $consented . "'
              WHERE message_id='" . $message_id . "'
             ";

    $this->db->query($query);
  }

  /**
   * Retrieve all recipients of mail
   */
  function getRecipients() {
    $query = "SELECT DISTINCT `to` AS name from " . MSG_DB;
    return $this->db->get_results($query);
  }

  /**
   * Retrieves all people who need to consent
   */
  function getConsenters() {
    $query = "SELECT DISTINCT consent AS name from " . MSG_DB . " WHERE consented='0'";
    return $this->db->get_results($query);
  }


  function getMessage($message_id) {
    $message_id = intval($message_id);
    $query = "SELECT * FROM " . MSG_DB . "
              WHERE message_id='" . $message_id . "'
             ";
    $results = $this->db->get_row($query);
    return $results;
  }

  function getAllMessages() {
    $query = "SELECT *
              FROM " . MSG_DB;
    
    $this->db->query($query);
    
    $this->db->debug();

  }


  /**
   * Retrieves the history of a message
   */
  function getHistory($message_id) {
    $message_id = intval($message_id);
    $ancestors = $this->getAncestors($message_id);

    $ids = implode(',', $ancestors);

    $query = "SELECT * FROM " . MSG_DB . " WHERE message_id IN(" . $ids . ")";
    return $this->db->get_results($query);
  }

  /**
   * Retrieves all ancestors of this message
   * first go up tree by replyto_id and secondary by parent_id
   */
  function getAncestors($message_id) {
    $message_id = intval($message_id);
    
    
    $idtree = array();
    $idtree[] = $message_id;
    while (true) {
      $query = "SELECT parent_id, replyto_id 
              FROM " . MSG_DB . "
              WHERE message_id='" . $message_id . "'
              ";
      $results = $this->db->get_row($query);
      
      $parent_id = $results->parent_id;
      $replyto_id = $results->replyto_id;
      if ($replyto_id != -1) {
	$idtree[] = $replyto_id;
	$message_id = $replyto_id;
      } else if ($parent_id != -1) {
	$idtree[] = $parent_id;
	$message_id = $parent_id;
      } else {
	break;
      }
    }
    return $idtree;
  }

  function addMessage($parent_id=-1) {
    global $_POST;
    // make variables local and check for missing fields
    $msg_vars = $this->getMsgVars();
    foreach($msg_vars as $msg_var => $required) {
      $$msg_var = htmlspecialchars(addslashes($_POST[$msg_var]));
      if ($required && ($$msg_var == 'null' || empty($$msg_var))) {
	$errors[] = $msg_var;
      }
    }

    $mConsent = 'null';
    if ($consent_required == '1') {
      if ($msg_consent == null)
	$errors[] = 'Please fill out consent field';
      $msg_consent = $_POST['msg_consent'];
      $mConsent = "($msg_consent,consented)";
    }

    $mBelief = 'null';
    // if they believe something, make sure they fill out all belief fields
    if ($msg_belief == '1') {
      $b_about = $_POST['belief_about'];
      $b_what = $_POST['belief_what'];
      $b_by = $_POST['belief_by'];
      if (empty ($b_about) || empty($b_about) || empty($b_by))
	$errors[] = 'Please fill out all belief fields';
      $mBelief = "b($b_about,$b_what,$b_by)";
    }

    $mReplyto = 'null';
    if ($msg_reply == '1') {
      $rmsg = $this->getMessage($_POST['message_id']);
      
      $rto = empty($rmsg->to) ? 'null' : $rmsg->to;
      $rfrom = empty($rmsg->from) ? 'null' : $rmsg->from;
      $rabout = empty($rmsg->about) ? 'null' : $rmsg->about;
      $rtype = empty($rmsg->type) ? 'null' : $rmsg->type;
      $rpurpose = empty($rmsg->purpose) ? 'null' : $rmsg->purpose;
      $rreply_to = empty($rmsg->reply_to) ? 'null' : $rmsg->reply_to;
      $rconsent_by = empty($rmsg->consent_by) ? 'null' : $rmsg->consent_by;
      $rbelief = empty($rmsg->belief) ? 'null' : $rmsg->belief;

      $mReplyto = "a($rto,$rfrom,$rabout,$rtype,$rpurpose,$rreply_to,$rconsent_by,$rbelief)";

    }
    
    // exit out if required fields not filled in
    if (!empty($errors)) {
      echo '<div id="errors">';
      echo "<h4>Please fill in the following:</h4>\n";
      echo '<ul>' . "\n";
      foreach ($errors as $error) {
	echo "<li>$error</li>\n";
      }
      echo '</ul>' . "\n";
      echo '</div>';

      echo '<script type="text/javascript">';
      foreach ($errors as $error) {
	echo '$(document).ready(function() {';
	echo '$("#' . $error . '").parent().css("background-color", "rgb(255,255,206)");' . "\n";
	echo '});';
      }
      echo '</script>';


      return false;
    }

    /* Variables to be passed to prolog */
    $mTo = $msg_to;
    $mFrom = $msg_from;
    $mAbout = $msg_about;
    $mPurpose = $msg_purpose;




    $query="pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,$mReplyto,$mConsent,$mBelief)).";
  if (empty($parent_id) || $parent_id==0)
    $parent_id = -1;


  $replyto_field = '';
  $replyto_id = '';
  if (isset($_POST['replyto_id']) && !empty($_POST['replyto_id'])) {
    $replyto_field = ', `replyto_id`';
    $replyto_id = ",'" . intval($_POST['replyto_id']) . "'";
  }

  $sqlquery = "INSERT INTO " . MSG_DB . " 
                ( `to` 
                , `from`
                , `about` 
                , `type` 
                , `purpose` 
                , `consent_by`
                , `consent_type`
                , `belief_about` 
                , `belief_what` 
                , `belief_by` 
                , `message`
                , `parent_id` 
              " . $replyto_field . "
                )
              VALUES 
                ( '" . $msg_to . "'
                , '" . $msg_from . "'
                , '" . $msg_about . "'
                , '" . $msg_type . "'
                , '" . $msg_purpose . "'
                , NULL
                , NULL
                , NULL
                , NULL
                , NULL
                , '" . $msg_message . "'
                , '" . $parent_id . "'
              " . $replyto_id . "
                )";

    // reply to, consented, belief
    //    $STR="\"pbh(a($mTo,$mFrom,$mAbout,phi,$mPurpose,null,null,null)).\"";
    // b(ce,unlawful,Carla) # Carla believes that the covered entity is unlawful
    //$STR="\"pbh(a(patient, ce, patient, phi, null, null, null,null)).\"";
    // b(ce, unlawful, Carla)
    // where is consented by?
    $response = $this->prolog->askHIPAA($query);

    echo '<div class="confirmed"><p>' . $response . '</p><p>Prolog query:
    ' . $query . '</p></div>';
    if (strpos($response, "yes") === false)
      return false;
    
  if(!$this->db->query($sqlquery)) {
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
  $msg_vars['msg_message'] = false;
  $msg_vars['msg_consent'] = false;        
  $msg_vars['consent_required'] = false;        
  $msg_vars['msg_reply'] = false;        
  return $msg_vars;
}

 public function debug() {
   echo MSG_DB;
 }

}
?>
