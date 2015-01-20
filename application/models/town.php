<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class town extends CI_Model {

 	
        function getTowns () {

		$select_query = $this->db->get('town');
			
		if ($select_query->num_rows > 0){//echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

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