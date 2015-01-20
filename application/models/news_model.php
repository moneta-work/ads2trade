<?php

//following class accesses the lms_user tuple
class News_model extends CI_Model {

    public function saveNews($news = null) {
        
        if( isset($news->id) and ($news->id != null or !empty($news->id)) ) {

            $this->db->where("id", $news->id);
            $this->db->update("news", $news);
            
        } else { //we are inserting
            $this->db->insert("news", $news);
        }
    }

    public function getById($id, $pagination = null) {
        $this->db->select("u.*");
        $this->db->from("news u");

        //Conditions
        $this->db->where("u.id", $id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getStatusOptions() {
        
        $options = array(
            '' => '',
            0 => 'Active',
            1 => 'Suspended'
        );
        
        return $options;
    }

    public function getStatus($status_id) {
        
        $statuses = $this->getStatusOptions();
        
        if(array_key_exists($status_id, $statuses)) {
            return $statuses[$status_id];
        }
        
        return null;
    }

    public function getFilterNews($conditions = null) {

        $this->db->select("u.*");
        $this->db->from("news u");
        
        //Now we handle the filters
        if($this->input->get_post('suspended')) {
            $this->db->where('u.suspended', $this->input->get_post('suspended'));
        }
        if($this->input->get_post('title')) {
            $this->db->like('u.title', $this->input->get_post('title'), 'after');
        }
        if($this->input->get_post('content')) {
            $this->db->like('u.content', $this->input->get_post('content'), 'after');
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function delete($id) {
        
        $this->db->where('id', $id);
        $this->db->delete('news');
        
        
        //place holder, please do more error checking here.
        return true;
        
    }
}