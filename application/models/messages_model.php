<?php

//following class accesses the messages table
class Messages_model extends CI_Model {
	protected $messages_table = "messages";
	protected $messages_cc_table = "messages_cc";
	protected $user_table = "user";

	/*
	Get this user's messages
	@param 		user_id 	int
	@param 		isread   int (0 = all unread messages, 1 - all read messages)
	@returns 	recordset - list of emails
	*/
	public function getAll($user_id, $isread=0) {
		//Get this user's messages
		$this->db->where("m.isread", $isread);
		$this->db->where("m.sentto", $user_id);
		
		$this->db->select("m.*,uf.use_first_name,uf.use_last_name,uf.use_email,ut.use_first_name,ut.use_last_name,ut.use_email");
		$this->db->from($this->messages_table." m");
		$this->db->join($this->user_table.' uf', 'm.sentfrom = uf.use_id');
		$this->db->join($this->user_table.' ut', 'm.sentto = ut.use_id');

		$query = $this->db->get();          

		//echo $this->db->last_query(); 

		if(empty($query)) {
			return null;
		}
		return $query->result();
	}

	/*
	Count this user's messages
	@param 		user_id 	int
	@param 		isread   int (0 = all unread messages, 1 - all read messages)
	@returns 	recordset - list of emails
	*/
	public function countAll($user_id, $isread=0) {
		//Count this users messages
		$this->db->where("m.isread", $isread);
		$this->db->where("m.sentto", $user_id);

		$this->db->select("m.*");
		$this->db->from($this->messages_table." m");

		$query = $this->db->get();   
		
		return $query->num_rows();
	}

	/*
	Get this user's messages
	@param 		user_id 	int
	@returns 	recordset - list of emails
	*/
	public function getAllSent($user_id) {
		//Get this user's sent messages
		$this->db->where("m.sentfrom", $user_id);
		
		$this->db->select("m.*,uf.use_first_name,uf.use_last_name,uf.use_email,ut.use_first_name,ut.use_last_name,ut.use_email");
		$this->db->from($this->messages_table." m");
		$this->db->join($this->user_table.' uf', 'm.sentfrom = uf.use_id');
		$this->db->join($this->user_table.' ut', 'm.sentto = ut.use_id');

		$query = $this->db->get();          
		if(empty($query)) {
			return null;
		}
		return $query->result();
	}

	/*
	Count this user's sent messages
	@param 		user_id 	int
	@returns 	recordset - list of emails
	*/
	public function countAllSent($user_id, $isread=0) {
		//Count this users messages
		$this->db->where("m.sentfrom", $user_id);
		
		$this->db->select("m.*");
		$this->db->from($this->messages_table." m");

		$query = $this->db->get();   
		
		return $query->num_rows();
	}
	
    public function send($message = null, $temp_message = null) {
		$message_id = 0;
		$temp_message = new stdClass;

    	if(is_array($message->sentto)){
    		$first_time = 1;
    		foreach($message->sentto as $key=>$sentto){
    			if($first_time == 1){

    				$first_time = 0;

    				$temp_message->sentfrom = $message->sentfrom;
    				$temp_message->sentto = $sentto;
    				$temp_message->subject = $message->subject;
    				$temp_message->message = $message->message;
    				$temp_message->datetime = $message->datetime;
    				$temp_message->public = $message->public;
    				$temp_message->fromemail = '.';
    				$temp_message->sentat = $message->datetime;

    				//create new message record
    				$this->db->insert($this->messages_table, $temp_message);

    				//Save message id for use with CCs
    				$message_id = $this->db->insert_id();

    			} else {

    				//This is a CC
    				$cc_message = new stdClass;
    				$cc_message->message_id = $message_id;
    				$cc_message->sentto_id = $sentto;

          			$this->db->insert($this->messages_cc_table, $cc_message);  

    			}
    		}
    	} else {

			$temp_message->sentfrom = $message->sentfrom;
			$temp_message->sentto = $message->sentto;
			$temp_message->subject = $message->subject;
			$temp_message->message = $message->message;
			$temp_message->datetime = $message->datetime;
			$temp_message->public = $message->public;
			$temp_message->fromemail = '.';
			$temp_message->sentat = $message->datetime;

			//create new message record
			$this->db->insert($this->messages_table, $temp_message);

			//Save message id for use with CCs
			$message_id = $this->db->insert_id();

    	}

    	return $message_id;
            
    }

    public function getById($id, $pagination = null) {
        $this->db->select("e.*");
        $this->db->from($this->events_table." e");

        //Conditions
        $this->db->where("e.id", $id);
        $query = $this->db->get();     
        $row =  $query->row();       
        if(empty($row)) {
            return null;
        }
        return $row;
    }

    public function getEventTypes($active=1) {
        
        $this->db->select("et.*");
        $this->db->from($this->events_types_table." et");
		
		$this->db->where("et.active", $active);
        $query = $this->db->get();     
        ///$row =  $query->row();       
        if(empty($row)) {
            return null;
        }
        return $query->result();
    }

	public function delete($event = null) {
	
		if( isset($event->id) and ($event->id != null or !empty($event->id)) ) {
			$event->deleted = 1;
			$this->db->where("id", $event->id);
            $this->db->update($this->events_table, $event);
		}
	}
   
}