<?php error_reporting(0);?>
<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class auction extends CI_Model {

        //11.12.2014 - for use with new functions
 	      protected $auctions_table = "auctions";
        protected $assets_table = "asset";

        function create_auction () {
            
          $ass_id = $_POST['ass_id'];
          $user = $this->session->userdata('user_id');
          $title = $_POST['ass_name'];
          $from_date = $_POST['from_date'];
    //      $to_date = $_POST['to_date'];
          $duration = $_POST['duration'];
          $price = $_POST['price'];
          $buy_now = $_POST['buy_now'];
          $increment = $_POST['increment'];
        
          $this->db->query(
                 "INSERT INTO `auctions` (`ass_id`,`use_id`,`title`,`subtitle`,`starts`,`duration`,`minimum_bid`,`buy_now`,`auction_type`,`increment`) 
                 VALUES ('$ass_id','$user','$title','$title','$from_date','$duration','$price','$buy_now','1','$increment')"
                 );
          //Get the auction id for event logging
          $auct_id = $this->db->insert_id();
          // $this->db->insert('assssssetsi', $data);
        
          //TODO:Also insert into system events log type 1 event
          $event_object_type = 1; //Auction
          $this->events->log_event($user, $auct_id, date('Y-m-d H:j:s'), "Auction for Asset id:$ass_id created", $event_object_type);

	} 
        
         function approve_auction () {
        $ass_id = $_POST['ass_id'];
        if (!isset($ass_id)){
             $ass_id = $_REQUEST['asst_id'];
            
        }
        
        
            if (isset($_POST['approve'])) {
             $this->db->query("Update `auctions` set status = '1' where id ='$ass_id'" );
             $action = 'approved';    //for event log
            }
            if (isset($_POST['decline'])) {
             $this->db->query("Update `auctions` set status = '9' where id ='$ass_id'" );
             $action = 'declined';    //for event log
            }
            
            //TODO:Also insert into system events log type 1 event
            $event_object_type = 1; //Auction
            $this->events->log_event($user, $auct_id, date('Y-m-d H:j:s'), "Auction for Asset id:$ass_id $action", $event_object_type);
             
            // $this->db->insert('assssssetsi', $data); 

	} 
         function add_all_auction () {
               
             $user = $this->session->userdata('user_id');    //for event log
             $this->db->query("Update `auctions` set status = '1' where status='0'" );

             $total = $this->db->affected_rows();            //for event log
             //TODO:Maybe Also insert into system events log type 1 event
            $event_object_type = 1; //Auction
            $this->events->log_event($user, 0, date('Y-m-d H:j:s'), "$total Auctions added by User id:$user", $event_object_type);
            
	}
        
        function remove_all_auction () {
               
             $user = $this->session->userdata('user_id');    //for event log
             $this->db->query("Update `auctions` set status = '9' where status='0'" );

             $total = $this->db->affected_rows();             //for event log
             //TODO:Maybe Also insert into system events log type 1 event
             $event_object_type = 1; //Auction
             $this->events->log_event($user, 0, date('Y-m-d H:j:s'), "$total Auctions removed by User id:$user", $event_object_type);
             
	} 
        function create_bid() {
          $amount = 0;
          if(isset($_GET) && !empty($_GET)){   //Added empty check coz in CI get wll almost always be present but could be any epmty array
            //Array (  )
              $amount = $_GET['bid'];
              $ass_id = $_GET['ass_id'];
              $id = $_GET['auct_id'];
              $auct_id = $_POST['auct_id'];
              //print_r( $this->input->get() );
          }else{
            //Array ( [auct_id] => 1 [ass_id] => 1 [email] => 5.00 )
              $amount = $_POST['email'];
              $amount = $this->input->post('email');
              $ass_id = $_POST['ass_id'];
              $id = $_POST['auct_id'];
              $auct_id = $_POST['auct_id'];
              //print_r( $this->input->post() );
          }
          ///$user = 5;// $this->session->userdata('user_id');
          $user_id = $this->session->userdata('user_id');
          
          $this->db->query(
                       "INSERT INTO `bids` (`auction`,`bidder`,`bid`,`bidwhen`,`quantity`,`winner`)
                       VALUES ('$auct_id','$user_id','$amount',now(),'1',0)"
                       );
          //update current bid
          $this->db->query(
                       "Update `auctions` set current_bid = '$amount' where id =
                       '$id'"
                       );
          //Maybe Also insert into system events log type 2 event
          $event_object_type = 2; //Bid
          $this->events->log_event($user_id, $auct_id, date('Y-m-d H:j:s'), "$amount Bid placed", $event_object_type);

          //TODO: Maybe notify user who has just been outbid
        }
        
        
        function buy_now() {
        $amount = $_POST['email']; 
        $ass_id = $_POST['ass_id'];
        $id = $_POST['auct_id'];
        $user = $this->session->userdata('user_id');

        
        echo 'to payment gateway';exit;
        
        //Maybe Also insert into system events log type 1 event
        $event_object_type = 1; //Auction
        $this->events->log_event($user, $id, date('Y-m-d H:j:s'), "Asset id:$ass_id sold for $amount", $event_object_type);
        
        }
        
        function add_watch() {
        $id = $_POST['auct_id'];
        $ass_id = $_REQUEST['ass_id'];
        $user = $this->session->userdata('user_id');
        $id = $_REQUEST['auct_id'];   print_r($_POST);
         $this->db->query(
                     "INSERT INTO `watch_list` (`ass_id`,`use_id`,`auction`,`start_date`,`status`) 
                     VALUES ('$ass_id','$user','$id',now(),'1')"
                     );
        
         //Also insert into system events log type 6 event
         if($id > 0){
          //valid auction id
          $event_object_type = 1;

         } else {
          //assume asset id
          $event_object_type = 6;
          $id = $ass_id;
         }

         $this->events->log_event($user, $id, date('Y-m-d H:j:s'), "Asset id:$ass_id added to user:$user's watchlist", $event_object_type);
         
        }
        
          function remove_watch() {
          //$id = $_POST['auct_id'];
          $ass_id = $_REQUEST['ass_id'];
          $user = $this->session->userdata('user_id');    //changed all instances of use_id to user_id
          //$id = $_REQUEST['auct_id'];
          $this->db->query(
                     "update `watch_list` set `status` = '0' where ass_id='$ass_id' and use_id='$user'"
                     );
          //Maybe Also insert into system events log type 6 event
          $event_object_type = 6;
          $this->events->log_event($user, $ass_id, date('Y-m-d H:j:s'), "Asset id:$ass_id removed from user:$user's watchlist", $event_object_type);
         
          }
        
        
                         
        function getAsset () {
                if (isset($_REQUEST['ass_id'])){
                
                $this->db->where('ass_id', $_REQUEST['ass_id']);
                
	       
                }
             
		$select_query = $this->db->get('asset');
			
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
        
  /********************************************************************************
   * 11.12.2014                                 *
   * NEW FUNCTIONS FOR NEW LAYOUTS/DESIGN                     *
   *                                        *
   *******************************************************************************/        
  /*
  Get this user's messages
  @param    user_id   int
  @param    isread   int (0 = all unread messages, 1 - all read messages)
  @returns  recordset - list of emails
  */
  public function getCityAreaAuctionCounts($user_id=0) {       

    //Setup user condition if any
    $condition = '';
    if($user_id>0){
      $condition = " AND (au.use_id = '$user_id') ";
    }    
    $query = $this->db->query("
      SELECT au.id, `as`.ass_city, Count(`as`.ass_city) AS area_count, `as`.ass_province 
      FROM auctions AS au 
        INNER JOIN asset AS `as` ON au.ass_id = `as`.ass_id
      WHERE 1
        $condition
      GROUP BY `as`.ass_city, `as`.ass_province");

    //echo $this->db->last_query(); 

    if(empty($query)) {
      return null;
    }
    return $query->result();
  }       
    

}