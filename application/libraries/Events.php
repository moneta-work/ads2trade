<?php
//TODO: Maybe rename this to Common
/*
Handles:
- events 
- messaging
- any other header displays calculations
*/
class Events
{
	// hold CI instance
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		
		//Load the sysevents model
		$this->CI->load->model('sysevents_model', 'sysevents');	
		//Load the messages model
		$this->CI->load->model('messages_model', 'messages');
		//Get this user's inbox count
	}

  public function log_event($user, $object_id, $event_date, $event_datails, $event_type=5)
  {
      //Event Types:
      /*
      1 - Auction related events
      2 - Bids related events
      3 - Campaign related events
      4 - News related events
      5 - User related events (Default)
      */
      //Create event object
		  $event = new stdClass;
  		$event->event_type = $event_type;
	   	$event->event_user = $user;
	 	  $event->event_object_id = $object_id;
	   	$event->event_date = $event_date;
		  $event->event_details = $event_datails;

      //Save event
      $this->CI->sysevents->save($event);
  }
  
  /*Begin Messages related functions*/
  
  public function getCountUnreadMessages($user_id){
	 $isread = 0;
	 return $this->CI->messages->countAll($user_id, $isread);
  }
 
  public function getReadMessages($user_id){
	$isread = 1;
	 return $this->CI->messages->getAll($user_id, $isread);
  }

  public function getUnreadMessages($user_id){
	$isread = 0;
	 return $this->CI->messages->getAll($user_id, $isread);
  }

  public function getCountReadMessages($user_id){
	$isread = 1;
	 return $this->CI->messages->countAll($user_id, $isread);
  }
  
  public function getSentMessages($user_id){
	 return $this->CI->messages->getAllSent($user_id);
  }

  public function getCountSentMessages($user_id){
	 return $this->CI->messages->countAllSent($user_id);
  }
  
  /*End Messages related functions*/
  
  public function getEstimatedSpend($user_id){
	$estimatedSpend = 0;
	//Calc estimated spend & return result
	 return $estimatedSpend;
  } 
  
  public function sendMessage($message, $temp_message, $reply_of){
    return $this->CI->messages->send($message, $temp_message, $reply_of);
  }

  public function getById($message_id){
    return $this->CI->messages->getById($message_id);
  }

  public function markMessageAsRead($message_id, $read){
    return $this->CI->messages->markRead($message_id, $read);
  }

}
/* End of file Events.php */