<?php ob_start();?>
<?php

//following class accesses the lms_guardianship tuple
class lms_guardianship extends CI_Model{
	

//function to insert record into guardianship table
function register_relationship($parentage_data)
	{
		$this->db->insert('asset', $parentage_data);
	}	

}