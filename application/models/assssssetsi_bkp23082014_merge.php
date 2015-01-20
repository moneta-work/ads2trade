<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class assssssetsi extends CI_Model {

 	
        function addAsset ($parentage_data) {
           
             $this->db->query(
                     "INSERT INTO `asset` (`position`) VALUES ('$parentage_data')"
                     );
            // $this->db->insert('assssssetsi', $data); 

	}  
               function getAssetDetails () {
                if (isset($_POST['filter'])  ){                    
                $ass_types = $_POST['ast_id'];
                if(isset($ass_types) && !empty($ass_types)){    
                foreach ($ass_types as $ast_id)
                
                {  $this->db->where('asset.ast_id', $ast_id);}
                }
                 if(isset($duration) && !empty($duration)){
                $duration = $_POST['duration'];
                foreach ($duration as $duration)
                {
                     $this->db->where('auctions.duration', $ast_id);
                }
                }
                                     
                }
                $this->db->where('auctions.status', '1');
                $this->db->select('asset.position,asset.loc_id,asset.ast_id, asset.ass_id, asset.ass_name, asset.ass_description');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id');
                $select_query = $this->db->get();
			
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
       function getAssetSpiderfy () {
                if (isset($_POST['filter'])  ){
                
                $this->db->where('asset.ast_id', $this->input->post('ast_id'));
                
		//$this->db->where('position', $this->input->post('location'));
		//$this->db->where('use_status', 1);
       
                }
                //$this->db->where('auctions.status', '1');
                $this->db->select('asset.position,asset.loc_id,asset.ast_id, asset.ass_id, asset.ass_name, asset.ass_description');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id');
                $select_query = $this->db->get();
			
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
        
        
        
               function getAssetDetail () {
                if (isset($_POST['filter'])){
                    
                    
                $ass_types = $_POST['ast_id'];
                if(isset($ass_types) && !empty($ass_types)){    
               // foreach ($ass_types as $ast_id)
                
                  $this->db->where_in('asset.ast_id', $ass_types);
                }
                 if(isset($duration) && !empty($duration)){
                $duration = $_POST['duration'];
                foreach ($duration as $duration)
                {
                     $this->db->where('auctions.duration', $ast_id);
                }
                }
       
                }
                $this->db->where('auctions.status', '1');
                $this->db->group_by('ast_id');
                //$this->db->select('count(*)as counts,`loc_id`,`ast_id`');
                $this->db->select('count(*) as counts, asset.loc_id,asset.ast_id');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id');
                $select_query = $this->db->get();
			
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
               function getAssetDetails1 () {
                if (isset($_REQUEST['aset'])){
                
                $this->db->where('asset.ast_id', $_REQUEST['aset']);
                
		//$this->db->where('position', $this->input->post('location'));
		//$this->db->where('use_status', 1);
       
                }
                
  
                
                
                //$user = $this->session->userdata('use_id');
               // $this->db->where('auctions.status', '1');
               // $this->db->where('asset.use_id', '$user');
                $this->db->select('*');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id');
                $select_query = $this->db->get();
			
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
        
        
        function getMyAsset () {
                if (isset($_REQUEST['aset'])){
                
                $this->db->where('asset.ast_id', $_REQUEST['aset']);
                
		//$this->db->where('position', $this->input->post('location'));
		//$this->db->where('use_status', 1);
       
                }
                
  
                
                
                $user = '5';//$this->session->userdata('use_id');
              
                $this->db->where('use_id', $user);
                $this->db->select('*');
		$this->db->from('asset');
                $select_query = $this->db->get();
			
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
        
        
        function getAsset () {
            
                if (isset($_REQUEST['ass_id'])){
                
                $this->db->where('asset.ass_id', $_REQUEST['ass_id']);
                
	       
                }
           $this->db->select('*');
           $this->db->from('asset');
           $select_query =  $this->db->join('rate_card', 'asset.ass_id = rate_card.ass_id', 'left outer');
           $select_query =  $this->db->join('measurement_unit', 'measurement_unit.meu_id = rate_card.meu_id', 'left outer');
	//var_dump($select_query);exit;

$select_query = $this->db->get();
			
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