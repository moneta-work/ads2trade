<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class city extends CI_Model {

 	      
        function getCities () {

		$select_query = $this->db->get('city');
			
		if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $row){
				$data[]=$row;
			}
			
			return $data;

		}
		else{
		return false;
		}

	}  
        
          

}