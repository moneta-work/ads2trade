<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class user extends CI_Model {

 	var $username;
	var $password;
        
        function getLoginDetails () {

		
		$this->db->where('use_username', $this->input->post('username'));
		$this->db->where('use_password', $this->input->post('password'));
		$this->db->where('use_status', 1);
		$select_query = $this->db->get('user');
			
		if ($select_query->num_rows > 0){//echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row){
				$data[]=$row;
			}
			print_r($data); exit();
			return $data;

		}
		else{
		return false;
		}

	}  
    

}