<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class media_family extends CI_Model {

    function getMediaFamilies() {

        $select_query = $this->db->get('media_family');

        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
    }

    function getNameOfMediaCategory($id) {

        return $this->db->get_where('media_family', array('media_family_id =' => '$id'));
    }

}