<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class asset_size extends CI_Model {

    function getMediaSizes() {

        $this->db->select("asi.*, `ag.asg_min_price`, `ag.asg_max_price`, `ag.asg_id`, `ag.asg_description`");
        $this->db->from("asset_size asi");
        $this->db->join("asset_group ag","asi.asi_id = ag.asi_id","left");
        $select_query = $this->db->get();  

        //$select_query = $this->db->get('asset_size');

        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
    }
function getMediaSizesById($_id){

        $this->db->where("asi.asi_id", $_id);
        $this->db->select("asi.*, `ag.asg_min_price`, `ag.asg_max_price`, `ag.asg_id`, `ag.asg_description`");
        $this->db->from("asset_size asi");
        $this->db->join("asset_group ag","asi.asi_id = ag.asi_id","left");
        $select_query = $this->db->get();      
        
        //$select_query = $this->db->get_where('asset_size', array('asi_id' => $_id));
        
        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
        
    }
    
}