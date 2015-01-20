<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class Auction_model extends CI_Model {

    public function getById($id) {
        
        if(empty($id)) {
            return $id;
        }
        
        $this->db->select("a.*");
        $this->db->from('auction a')
        $this->db->where('a.au_id', $id);
        
        return $this->db->get()->result();
    }

}

//End of file auction_model.php