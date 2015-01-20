<?php

//following class accesses the system_events table
class Sysevents_model extends CI_Model {
	protected $events_table = "system_events";
	protected $events_types_table = "system_events_type";

	public function getAll() {
		
		$this->db->select("e.*");
		$this->db->from($this->events_table." e");

		$query = $this->db->get();          
		if(empty($row)) {
			return null;
		}
		return $query->result();
	}
		
    public function save($event = null) {
	
        if( isset($event->id) and ($event->id != null or !empty($event->id)) ) {
			/*
			$event->event_type = $event->event_type;
			$event->event_user = date("Y-m-d h:i:s");
			$event->event_object_id = date("Y-m-d h:i:s");
            $event->event_details = date("Y-m-d h:i:s");
			*/
			if(is_null($event->event_date) || $event->event_date == '')
				$event->event_date = date("Y-m-d h:i:s");
			if($event->event_date <= date()){
				$event->event_past = 1;
			}else {
				$event->event_past = 0;
			}
			
			$event->created_date = date("Y-m-d h:i:s");
			
            $this->db->where("id", $event->id);
            $this->db->update($this->events_table, $event);
            
        } else { 
			//we are inserting
            $this->db->insert($this->events_table, $event);
			
        }
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