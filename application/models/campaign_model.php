<?php

//following class accesses the lms_user tuple
class Campaign_model extends CI_Model {
    
    public function get_campaigns($conditions = null) {
        
        $this->db->select("c.*, u.use_username");
        $this->db->from("campaign c");
        $this->db->join("user u", "u.use_id=c.adv_id");
        
        //TODO: Implements the conditions here.
        
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_user_campaigns($user_id, $conditions = null) {
        
        $this->db->select("c.*, u.use_username");
        $this->db->from("campaign c");
        $this->db->join("user u", "u.use_id=c.adv_id");
        $this->db->where('c.adv_id', $user_id);
        
        
        //TODO: Implements the conditions here.
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
