<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class rfps extends CI_Model {

    
    function getRfp () {
                
                //$this->db->where('auctions.status', '1');
                $select_query = $this->db->get('rfp');
			
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
        
 	
        function create_rfp () {
            

               $duration = $_POST['duration'];
                if(isset($duration) && !empty($duration)){    
                foreach ($duration as $duration)
                
                {  if (!isset($durations)){
                        
                        $durations =  $duration;
                    }else{
                        $durations = $durations .','. $duration;}
                }}
               $ast_ids = $_POST['ast_id'];
                if(isset($ast_ids) && !empty($ast_ids)){    
                foreach ($ast_ids as $ast_id)
                
                {  
                    if (!isset($ast)){
                        
                        $ast =  $ast_id;
                    }else{
                        $ast = $ast .','. $ast_id;}
                    }
                    
                    
                    
                    }
                
        $budget = $_POST['budget'];
        $user = $this->session->userdata('use_id');
        $title = $_POST['titles'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $respond_date = $_POST['responce'];
        $camp_descriptor = $_POST['campaign'];
        
             $this->db->query(
                     "INSERT INTO `rfp` (`budget`,`rfp_status_id`,`respond_date`,`use_id`,`title`,`camp_descriptor`,`start_date`,`end_date`,`duration`, `ast_id`) 
                     VALUES ('$budget','1','$respond_date','$user','$title','$camp_descriptor','$from_date','$to_date','$durations','$ast')"
                     );
            // $this->db->insert('assssssetsi', $data); 

	} 
    
        
        
    

}