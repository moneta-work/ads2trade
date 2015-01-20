<?php

//following class accesses the lms_user tuple
class User_type_model extends CI_Model {

    public function get_users($conditions = null) {

        $this->db->select("u.*, ut.ust_description");
        $this->db->from("user u");
         $this->db->join("user_type ut", "ut.ust_id=u.ust_id", "left")
       ;
        
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_select_options() {
        $this->db->select("o.ust_id id, ust_description name");
        $this->db->from("user_type o");

        $query = $this->db->get();

        $result =  $query->result();
        
        $options = array( '' => '');
        
        foreach($result as $row) {
            $options[$row->id] = $row->name;
        }
    
        return $options;
    }

    public function getSelectOptions($options = array()) {
    
        $this->db->select("o.ust_id id, ust_description name");
        $this->db->from("user_type o");

        $query = $this->db->get();

        $result =  $query->result();
        
        $selectOptions = $options;
        
        foreach($result as $row) {
            $selectOptions[$row->id] = $row->name;
        }
    
        return $selectOptions;
    }

    
    
}