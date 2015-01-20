<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class duration extends CI_Model {

 	
        function getDudarion () {
		$select_query = $this->db->get('durations');
			
		if ($select_query->num_rows > 0){

			foreach ($select_query->result() as $row){
				$data[]=$row;
			}
			//print_r($data); exit();
			return $data;

		}
		else{
		return false;
		}

	}  
    

}