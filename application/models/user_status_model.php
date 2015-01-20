<?php

//following class accesses the lms_user tuple
class User_status_model extends CI_Model {

    public function getSelectOptions($empty = array()) {
        $this->db->select("o.user_status_id id, user_status_name name");
        $this->db->from("user_status o");

        $query = $this->db->get();

        $result =  $query->result();
        
        $options = $empty;
        
        foreach($result as $row) {
            $options[$row->id] = $row->name;
        }
    
        return $options;
    }

    public function getStatus($status_id) {
        $statuses = $this->getSelectOptions();
        
        if(array_key_exists($status_id, $statuses)) {
            return $statuses[$status_id];
        }
        
        return null;
    }

}