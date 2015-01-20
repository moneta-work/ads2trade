<?php

//following class accesses the lms_user tuple
class Newsfeed_model extends CI_Model {

    public function saveNewsfeed($news = null) {
        
        if( isset($news->id) and ($news->id != null or !empty($news->id)) ) {

            $news->update_date = date("Y-m-d h:i:s");
        
            $this->db->where("id", $news->id);
            $this->db->update("news", $news);
            
        } else { //we are inserting
            $news->created_date = date("Y-m-d h:i:s");
            $news->update_date = date("Y-m-d h:i:s");
        
            $this->db->insert("news", $news);
        }
    }

    public function getById($id, $pagination = null) {
        $this->db->select("u.*");
        $this->db->from("news u");

        //Conditions
        $this->db->where("u.id", $id);
        $query = $this->db->get();
        
        $row =  $query->row();
        
        if(empty($row)) {
            return null;
        }
        
        return $row;
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

    public function getFilterNews($suspended = 0) {
		
        $this->db->select("u.*");
        $this->db->from("news u");
        
        //Now we handle the filters
        if($this->input->get_post('suspended')) {
            $this->db->where('u.suspended', $this->input->get_post('suspended'));
        } else {
			$this->db->where('u.suspended', 0);
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
    
    public function getUserTypesAccessByNewsId($id, $return_type='object') {
        
        $this->db->where("nga.news_id", $id);
        
        $this->db->select("ust.ust_id, ust.ust_description");
        $this->db->from("news_group_access nga");
        $this->db->join("user_type ust", "ust.ust_id=nga.user_type_id");

        $query = $this->db->get();
        
        switch($return_type) {
            case 'array':
                return $query->result_array();
            break;
            
            case 'object':
            default:
                return $query->result();
            break;
        }
    }
    
    //Returns an array of user_type_ids
    public function getUserTypeIdbyNewsId($news_id) {
        $user_types = $this->getUserTypesAccessByNewsId($news_id, 'object');
        
        $user_type_ids = array();
        
        foreach($user_types as $user_type) {
            $user_type_ids[] = $user_type->ust_id;
        }
        
        return $user_type_ids;
    }

    //Returns an array of the usertype names
    public function getUserTypeNamesByNewsId($news_id, $return_type) {
        
        $user_types = $this->getUserTypesAccessByNewsId($news_id, 'object');
        
        $names = array();
        
        foreach($user_types as $user_type) {
            $names[] = $user_type->ust_description;
        }
        
        return $names;
    }
    
    public function saveNewsAccess($news_id, $news_group_access ) {
        
        //first delete all the news_id group accesses
        $this->db->where('news_id', $news_id);
        $this->db->delete('news_group_access');
        
        if(count($news_group_access) == 0) {
            //Nothing is happening
            return false;
        }
        
        $batch_insert = array();
        
        foreach($news_group_access as $group_id) {
            $batch_insert[] = array('news_id' => $news_id, 'user_type_id' => $group_id);
        }
         
        //Now we start saving the accesses one by one
        $this->db->insert_batch('news_group_access', $batch_insert);
    }
}