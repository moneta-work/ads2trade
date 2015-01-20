<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class rfp extends CI_Model {

    
    function getRfp () {
                if (isset($_GET['id'])){
              //  $this->db->where('rfp_id', $_GET['id']);
                    $this->db->where('cam_id', $_GET['id']);
                }
                
               // $select_query = $this->db->get('rfp');
                $this->db->where('cam_status', '0');
		$select_query = $this->db->get('campaign');	
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
        
        
            function getRfp_prop () {
                if (isset($_GET['id'])){
              //  $this->db->where('rfp_id', $_GET['id']);
                    $this->db->where('cam_id', $_GET['id']);
                }
                
               // $select_query = $this->db->get('rfp');
                $this->db->where('cam_status', '1');
		$select_query = $this->db->get('campaign');	
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
        
        
        function mo_getRfp () {
                if (isset($_GET['id'])){
              
                    $this->db->where('cam_id', $_GET['id']);
                }
                $user = $this->session->userdata('user_id');
                $this->db->where('pro_status_id', NULL);
                $this->db->where('med_id', $user);
                $this->db->select('*');
                $this->db->from('proposal');
                $this->db->join('campaign','proposal.cam_id = campaign.cam_id');
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
        
        
        function ad_getRfp () {
                if (isset($_GET['id'])){
              
                    $this->db->where('cam_id', $_GET['id']);
                }
                $user = $this->session->userdata('user_id');
                $this->db->where('pro_status_id', NULL);
                $this->db->where('med_id', $user);
                $this->db->select('*');
                $this->db->from('proposal');
                $this->db->join('campaign','proposal.cam_id = campaign.cam_id');
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
        
        function rfp_add_assets(){
            if (isset($_GET['mec_id'])){
                
                $this->db->where('asset.mec_id', $_GET['mec_id']);
                
                }
                if (isset($_POST['filter'])){
                
                $this->db->where('asset.use_id', $_POST['mef_id']);
                
                }
                
                
                $this->db->from('asset');
                $this->db->join('media_category','media_category.mec_id = asset.mec_id');
                $this->db->join('user','user.use_id = asset.use_id');
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
        
        
        
        
         function getRfpDet () {
                
                if($this->session->userdata('user_type') != 3){
                  $operator = TRUE;
                } else {
                  $operator = FALSE;
                }

                $operator = FALSE;

                if (isset($_GET['id']) && !$operator){
                $this->db->where('campaign_transaction.cam_id', $_GET['id']);
                }
                 
                
         //       $this->db->from('rfp_detail');
         //       $this->db->join('media_category','media_category.mec_id = rfp_detail.mec_id');
                
               $this->db->select('asi_id,cam_id, cam_longitude, cam_latitude, mec_description,campaign_transaction.mec_id');
                $this->db->distinct();
                $this->db->from('campaign_transaction');
                if($this->session->userdata('user_type') == 3){ //operator login
                  $this->db->join('media_category','media_category.mec_id = campaign_transaction.mec_id');
                } else {
                  $this->db->join('media_category','media_category.mec_id = campaign_transaction.mec_id');  
                }
                
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
        function mo_getRfpDet () {
                if (isset($_GET['id'])){
                $this->db->where('proposal.pro_id', $_GET['id']);
                }
                 
               $this->db->select('*');
               $this->db->from('proposal');
               $select_query = $this->db->get();
			
		if ($select_query->num_rows > 0){//echo "tapinda tapinda amai niyasha. musabaika bus service";exit();
                    if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $row){
			$this->db->where_in('ass_id', explode(',',$row->p_assets));
                        $this->db->select('*');
                        $this->db->from('asset');
                        $select_query = $this->db->get();	
                            foreach ($select_query->result() as $rows){
                            
                            $data[]=$rows;
                            
                            }
                            return $data;
                            }
			}
			

		}
		else{
		return false;
		}

	}  
        function pro_getRfp () {
                if (isset($_GET['id'])){
                $this->db->where('proposal.pro_id', $_GET['id']);
                }
                 
                $this->db->select('*');
                $this->db->from('proposal');
                $this->db->join('campaign','campaign.cam_id = proposal.cam_id');
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
    
        function rpfCommit($rfp_data){
          if($rfp_data['title'] != '' && $rfp_data['title'] != '0'){
              $this->db->insert('rfp',$rfp_data); 
            }
        }
                
                
         function getrfps($rfp_data){
           $this->db->insert('rfp',$rfp_data); 
                }
                
                function submit_proposal(){
                    $prop_id = $_GET['id'];
                    $user = $this->session->userdata('user_id');
                    $textboxes = $_POST['allasset'];
                    $len = strlen($textboxes);
                    $textboxes = substr($textboxes, 1, $len-1);
                    $mann =  explode(',',$textboxes );
                    foreach($mann as $row){
                     
                    $as =  str_replace(' ','_',$row);
                    $price = $_POST["$as"];
                     $from = $_POST["week_$as"];
                     $to = $_POST["week1_$as"];
                     $today = date("Ymd");
                      $this->db->query(
                     "INSERT INTO `proposal_details` (`pd_price`,`pd_ass_id`,`pd_available_from`,`pd_available_to`,`pd_prop_id`,`pd_use_id`,`pd_date`) 
                     VALUES ('$price', '$as','$from', '$to' ,'$prop_id','$user','$today')"
                     );    
                    } 
                    
                    
                    $this->db->query(
                     "Update proposal set pro_status_id = '1' where pro_id = '$prop_id' "
                     ); 
                    
                }
                
                
        function create_proposal(){
                    $a = $_GET['id'];//rfp 
                    
                    $this->db->where('cam_id',  $a);
                    $this->db->from('tmp_prop');
                    $this->db->select('use_id, lon, lat');
                    $this->db->distinct();
                    $select = $this->db->get();
                    if ($select->num_rows > 0){ // records found
                    foreach ($select->result() as $rows){
                     $users[] = $rows; 
                     
                    }
                    
                    }
                    
                    foreach ($users as $row){
                    $this->db->where('cam_id',  $a);
                    $this->db->where('use_id',  $row->use_id);
                    $this->db->from('tmp_prop');
                    $this->db->select('*');
                    $select = $this->db->get();
                    $asset = '';
                    if ($select->num_rows > 0){ // records found
                    foreach ($select->result() as $rows){
                     $asset =  $asset .','. $rows->assets; 
                   } $today = date("Ymd");
                    $this->db->query(
                     "INSERT INTO `proposal` (`cam_id`,`p_assets`,`lon`,`lat`,`pro_creation_date`,`med_id`) 
                     VALUES ('$a','$asset','$row->lon','$row->lat','$today','$row->use_id')"
                     );  
                    
                    }
                }
                $this->db->query(
                     "delete from tmp_prop where cam_id = '$a' and lon = '$row->lon' and lat = '$row->lat'"
                     );  
                    
                    $this->db->query(
                     "Update campaign set cam_status = '1' where cam_id = '$a' "
                     );  
        }
                
        
    function add_media_owner() {
              $a = $_GET['id'];//rfp 
              $assets = $_GET['assets'];//selected assets
              $long = $_GET['cam_longitude'];//longitude
              $lat = $_GET['cam_latitude'];//latitude
              $mec_id = $_GET['mec_id'];//latitude
              
              $this->db->where('cam_id',  $a);
              $this->db->where('lon',  $long);
              $this->db->where('lat',  $lat);
              $this->db->where('mec_id',  $mec_id);
              $this->db->from('tmp_prop');
              $this->db->select('*');
              $select = $this->db->get();
               if ($select->num_rows > 0){ // records found
                $this->db->query(
                     "delete from `tmp_prop` where `cam_id`= '$a' and `mec_id` = '$mec_id' and `lon`= '$long' and `lat` = '$lat' ") 
                     ;  
               }
                             
              
              $this->db->where_in('ass_id', explode(',', $assets));
              $this->db->from('asset');
              $this->db->distinct();
              $this->db->select('use_id');
                $select = $this->db->get();
               if ($select->num_rows > 0){
                   foreach ($select->result() as $rows){
                     $users[] = $rows;  
                   }
                   
               }
              foreach ($users as $p){
              $this->db->where('use_id',$p->use_id);
              $this->db->where_in('ass_id', explode(',', $assets));
              $this->db->from('asset');
              $this->db->select('*');
              $select = $this->db->get();
               if ($select->num_rows > 0){ // records found
              foreach ($select->result() as $row){
                      //create temp proposals for each user  
             
                  $this->db->query(
                     "INSERT INTO `tmp_prop` (`cam_id`,`use_id`,`assets`,`mec_id`,`lon`,`lat`) 
                     VALUES ('$a','$row->use_id','$row->ass_id','$row->mec_id','$long','$lat')"
                     );
                  
              }} 
              }
        
    }


        function campaignCommit($campaign_data){
           if($campaign_data['cam_title'] != '' && $campaign_data['cam_title'] != '0'){ 
           $this->db->insert('campaign',$campaign_data); 
           return $this->db->insert_id();  //return new campaign id
          } else {
            return 0;
          }
        }

        function campaignTxnCommit($campaign_txn){
          $this->db->insert('campaign_transaction', $campaign_txn);
          return $this->db->insert_id();  //return new campaign id
        }
                
}