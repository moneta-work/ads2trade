<?php

//following class accesses the lms_user tuple
class Country_model extends CI_Model {

    public function get_select_options() {
        $this->db->select("o.cou_id id, cou_name name");
        $this->db->from("country o");

        $query = $this->db->get();

        $result =  $query->result();
        
        $options = array( '' => '');
        
        foreach($result as $row) {
            $options[$row->id] = $row->name;
        }
    
        return $options;
    }

}