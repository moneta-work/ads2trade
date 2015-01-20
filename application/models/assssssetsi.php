<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class assssssetsi extends CI_Model
{


	function addAsset($parentage_data)
	{

		$this->db->query(
			"INSERT INTO `asset` (`position`) VALUES ('$parentage_data')"
		);
		// $this->db->insert('assssssetsi', $data);

	}

	function getAssetDetails()
	{
		if (isset($_POST['filter'])) {
                    if (isset($_POST['mec_id']) && !empty($_POST['mec_id'])) {
			$ass_types = $_POST['mec_id'];
			
				foreach ($ass_types as $ast_id) {
					$this->db->or_where('asset.mec_id', $ast_id);
				}
			}
                        
                        if (isset($_POST['mef_id']) && !empty($_POST['mef_id'])) {
                        $ass_family = $_POST['mef_id'];
			
				foreach ($ass_family as $mef_id) {
					$this->db->or_where('media_family.mef_id', $mef_id);
				}
			}
                        if (isset($_POST['mam_id']) && !empty($_POST['mam_id'])) {
                        $ass_master = $_POST['mam_id'];
			
				foreach ($ass_master as $mam_id) {
					$this->db->or_where('master_medium_type.mam_id', $mam_id);
				}
			}
                       
                        
			if (isset($_POST['duration']) && !empty($_POST['duration'])) {
				$duration = $_POST['duration'];
				foreach ($duration as $dur) {
					$this->db->or_where('auctions.duration', $dur);
				}
			}

		}
		$this->db->where('auctions.status', '1');
		$this->db->select('asset.*,auctions.*');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id', 'left outer');
                $this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
                $this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
                $this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
//			print_r($data); exit();
			//echo $this->db->last_query(); 

			return $data;

		} else {
			return false;
		}

	}
function getAssetDetailsm()
	{
		if (isset($_POST['filter'])) {
                    if (isset($_POST['mec_id']) && !empty($_POST['mec_id'])) {
			$ass_types = $_POST['mec_id'];
			
				foreach ($ass_types as $ast_id) {
					$this->db->or_where('asset.mec_id', $ast_id);
				}
			}
                        
                        if (isset($_POST['mef_id']) && !empty($_POST['mef_id'])) {
                        $ass_family = $_POST['mef_id'];
			
				foreach ($ass_family as $mef_id) {
					$this->db->or_where('media_family.mef_id', $mef_id);
				}
			}
                        if (isset($_POST['mam_id']) && !empty($_POST['mam_id'])) {
                        $ass_master = $_POST['mam_id'];
			
				foreach ($ass_master as $mam_id) {
					$this->db->or_where('master_medium_type.mam_id', $mam_id);
				}
			}
                       
                        
			if (isset($_POST['duration']) && !empty($_POST['duration'])) {
				$duration = $_POST['duration'];
				foreach ($duration as $dur) {
					$this->db->or_where('auctions.duration', $dur);
				}
			}

		}
                $this->db->where('asset.use_id', '5');
		$this->db->where('auctions.status', '1');
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id', 'left outer');
                $this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
                $this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
                $this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
//			print_r($data); exit();
			return $data;

		} else {
			return false;
		}

	}
	function getAssetSpiderfy()
	{
		if (isset($_POST['filter'])) {

			$this->db->where('asset.ast_id', $this->input->post('ast_id'));

			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}
		//$this->db->where('auctions.status', '1');
		$this->db->select('auctions.id, asset.position,asset.loc_id,asset.ast_id, asset.ass_id, asset.ass_name, asset.ass_description');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id');
		$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}

	}

        function getAssetDetailm()
	{
             
		if (isset($_POST['filter'])) {

                    if (isset($_POST['mec_id']) && !empty($_POST['mec_id'])) {
			$ass_types = $_POST['mec_id'];
			foreach ($ass_types as $ast_id) {
					$this->db->or_where('asset.mec_id', $ast_id);
				}
			}
                        if (isset($_POST['mef_id']) && !empty($_POST['mef_id'])) {
                        $ass_family = $_POST['mef_id'];
			
				foreach ($ass_family as $mef_id) {
					$this->db->or_where('media_family.mef_id', $mef_id);
				}
			}
                        if (isset($_POST['mam_id']) && !empty($_POST['mam_id'])) {
                        $ass_master = $_POST['mam_id'];
			
				foreach ($ass_master as $mam_id) {
					$this->db->or_where('master_medium_type.mam_id', $mam_id);
				}
			}
                        
                      
                        
			if (isset($_POST['duration']) && !empty($_POST['duration'])) {
				$duration = $_POST['duration'];
				foreach ($duration as $dur) {
					$this->db->or_where('auctions.duration', $dur);
				}
			}

		}
		$this->db->where('asset.use_id', '5');
		$this->db->group_by('mec_id');
                $this->db->group_by('duration');
                $this->db->order_by('duration', 'desc');
		//$this->db->select('count(*)as counts,`loc_id`,`ast_id`'); 
		$this->db->select('auctions.id, count(*) as counts, auctions.duration as loc_id,asset.mec_id');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id');
                
                $this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
                $this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
                $this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();
   
		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}
	}
	
	function getAssetDetail()
	{
             
		if (isset($_POST['filter'])) {

                    if (isset($_POST['mec_id']) && !empty($_POST['mec_id'])) {
			$ass_types = $_POST['mec_id'];
			foreach ($ass_types as $ast_id) {
					$this->db->or_where('asset.mec_id', $ast_id);
				}
			}
                        if (isset($_POST['mef_id']) && !empty($_POST['mef_id'])) {
                        $ass_family = $_POST['mef_id'];
			
				foreach ($ass_family as $mef_id) {
					$this->db->or_where('media_family.mef_id', $mef_id);
				}
			}
                        if (isset($_POST['mam_id']) && !empty($_POST['mam_id'])) {
                        $ass_master = $_POST['mam_id'];
			
				foreach ($ass_master as $mam_id) {
					$this->db->or_where('master_medium_type.mam_id', $mam_id);
				}
			}
                        
                      
                        
			if (isset($_POST['duration']) && !empty($_POST['duration'])) {
				$duration = $_POST['duration'];
				foreach ($duration as $dur) {
					$this->db->or_where('auctions.duration', $dur);
				}
			}

		}
		//$this->db->where('auctions.status', '1');
		$this->db->group_by('mec_id');
                $this->db->group_by('duration');
                $this->db->order_by('duration', 'desc');
		//$this->db->select('count(*)as counts,`loc_id`,`ast_id`');
		$this->db->select('auctions.id, count(*) as counts, auctions.duration as loc_id,asset.mec_id, auctions.starts,auctions.ends,auctions.status, auctions.closed, auctions.suspended, media_category.mec_description, master_medium_type.met_description, asset.ass_city, asset.ass_street_address');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id');
                
                $this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
                $this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
                $this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();
   
		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}
	}
	function getAssetDetails1m()
	{
            
		if (isset($_REQUEST['aset'])) {

			$this->db->or_where('asset.mec_id', $_REQUEST['aset']);

			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}
                if (isset($_GET['duration'])) {

			$this->db->or_where('auctions.duration', $_GET['duration']);

			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}
                
                
                if (isset($_POST['filter'])) {

                    if (isset($_POST['mec_id']) && !empty($_POST['mec_id'])) {
			$ass_types = $_POST['mec_id'];
			foreach ($ass_types as $ast_id) {
					$this->db->or_where('asset.mec_id', $ast_id);
				}
			}
                        if (isset($_POST['mef_id']) && !empty($_POST['mef_id'])) {
                        $ass_family = $_POST['mef_id'];
			
				foreach ($ass_family as $mef_id) {
					$this->db->or_where('media_family.mef_id', $mef_id);
				}
			}
                        if (isset($_POST['mam_id']) && !empty($_POST['mam_id'])) {
                        $ass_master = $_POST['mam_id'];
			
				foreach ($ass_master as $mam_id) {
					$this->db->or_where('master_medium_type.mam_id', $mam_id);
				}
			}
                        
                        
                        
			if (isset($_POST['duration']) && !empty($_POST['duration'])) {
				$duration = $_POST['duration'];
				foreach ($duration as $dur) {
					$this->db->or_where('auctions.duration', $dur);
				}
			}

		}

		//$user = $this->session->userdata('use_id');
		// $this->db->where('auctions.status', '1');
		 $this->db->where('asset.use_id', '5');
		$this->db->select('auctions.id,auctions.current_bid,asset.ass_address,asset.ass_description,asset.ass_id, asset.mec_id, asset.position, asset.ass_name');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id', 'left outer');
                $this->db->join('images', 'asset.img_id = images.img_id', 'left outer');
                
//for pintos            
                
                 $this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
               $this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
                $this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}

	}
	function getAssetDetails1($area='')
	{
		//setup conditions
		$where_condition = '1 ';
		$no_area = true;

		//area filter if any is specified
		if($area !='' && !is_null($area)){
			$this->db->where('asset.ass_city', $area);	
			$where_condition .= "AND (asset.ass_city ='$area') ";
			$no_area = false;
		}

            
		if (isset($_REQUEST['aset']) && $no_area) {

			$this->db->or_where('asset.mec_id', $_REQUEST['aset']);
			$where_condition .=  " OR (asset.mec_id = '".$_REQUEST['aset']."')";
			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}
        
        if (isset($_GET['duration']) && $no_area) {

			$this->db->or_where('auctions.duration', $_GET['duration']);
			$where_condition .=  " OR (auctions.duration = '".$_REQUEST['duration']."')";
			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}
                
                
        if (isset($_POST['filter']) && $no_area) {

            if (isset($_POST['mec_id']) && !empty($_POST['mec_id'])) {
				$ass_types = $_POST['mec_id'];
				foreach ($ass_types as $ast_id) {
					$this->db->or_where('asset.mec_id', $ast_id);
					$where_condition .=  " OR (asset.mec_id = '".$ast_id."')";
				}
			}
            
            if (isset($_POST['mef_id']) && !empty($_POST['mef_id']) && $no_area) {
                $ass_family = $_POST['mef_id'];
	
				foreach ($ass_family as $mef_id) {
					$this->db->or_where('media_family.mef_id', $mef_id);
					$where_condition .=  " OR (media_family.mef_id = '".$mef_id."')";
				}
			}
            
            if (isset($_POST['mam_id']) && !empty($_POST['mam_id']) && $no_area) {
                $ass_master = $_POST['mam_id'];
	
				foreach ($ass_master as $mam_id) {
					$this->db->or_where('master_medium_type.mam_id', $mam_id);
					$where_condition .=  " OR (master_medium_type.mam_id = '".$mam_id."')";
				}
			}
                
			if (isset($_POST['duration']) && !empty($_POST['duration']) && $no_area) {
				$duration = $_POST['duration'];
				foreach ($duration as $dur) {
					$this->db->or_where('auctions.duration', $dur);
					$where_condition .=  " OR (auctions.duration = '".$dur."')";
				}
			}
		}

		//$user = $this->session->userdata('use_id');
		// $this->db->where('auctions.status', '1');
		// $this->db->where('asset.use_id', '$user');
		$this->db->select('auctions.id,auctions.status,auctions.current_bid,asset.ass_address,asset.ass_description,asset.ass_id, asset.mec_id, asset.position, asset.ass_name,asset.ass_street_address, asset.ass_city, asset.ass_province');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id', 'left outer');
        $this->db->join('images', 'asset.img_id = images.img_id', 'left outer');
                
		//for pintos            
                
		$this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
		$this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
		$this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();

		//echo $this->db->last_query();
		//echo "<hr>"; 
		//echo $where_condition;
		//exit;

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();
				foreach ($select_query->result() as $row) {
					$data[] = $row;
				}
				//print_r($data); exit();
				return $data;
			} else {
				return false;
		}

	}


	function getMyAsset()
	{
		if (isset($_REQUEST['aset'])) {

			$this->db->where('asset.ast_id', $_REQUEST['aset']);

			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}


		$user = '5'; //$this->session->userdata('use_id');

		$this->db->where('use_id', $user);
		$this->db->select('asset.loc_id,asset.position,asset.ass_name,asset.ass_id,media_category.mec_description, asset.ass_description, images.url,asset.ass_address');
		$this->db->from('asset');                
                $this->db->join('images', 'asset.img_id = images.img_id', 'left outer');
		$this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
		
                $select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}

	}

        function getMyAsset_op()
	{
		if (isset($_REQUEST['aset'])) {

			$this->db->where('asset.ast_id', $_REQUEST['aset']);

			//$this->db->where('position', $this->input->post('location'));
			//$this->db->where('use_status', 1);

		}


		$user = '5'; //$this->session->userdata('use_id');
                $this->db->where('status', '0');
		$this->db->where('auctions.use_id', $user);
		$this->db->select('auctions.id, asset.loc_id,asset.position,asset.ass_name,asset.ass_id,media_category.mec_description, asset.ass_description, images.url,asset.ass_address');
		$this->db->from('asset');                
                $this->db->join('images', 'asset.img_id = images.img_id', 'left outer');
                $this->db->join('auctions', 'auctions.ass_id = asset.ass_id');
		$this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
		
                $select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}

	}

	function getAsset()
	{

if (isset($_REQUEST['ass_id'])){
                
                $this->db->where('asset.ass_id', $_REQUEST['ass_id']);
                
	       
                }
           $this->db->select('*');
           $this->db->from('asset');
           $select_query =  $this->db->join('rate_card', 'asset.ass_id = rate_card.ass_id', 'left outer');
           $select_query =  $this->db->join('measurement_unit', 'measurement_unit.meu_id = rate_card.meu_id', 'left outer');
           $select_query =  $this->db->join('auctions', 'auctions.ass_id = asset.ass_id', 'left outer');
		
//var_dump($select_query);exit;

$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$data[] = $row;
			}
			//print_r($data); exit();
			return $data;

		} else {
			return false;
		}

	}


}