<?php //include("header.php"); ?>
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-home"></span> Dashboard</h1>
        </div>
        <div class="main">

          <div class="alert alert-info text-center" role="alert">
            <h2>Welcome <?php echo $this->session->userdata('username'); ?></h2>
            <p>You current don't have any active campaigns. To start a campaign you have to buy or bid for advertising space.</p>
            <br><a href="auctions.php" class="btn btn-primary">Click here to start</a>
          </div>
          <br>
          <br>

          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Quick Links</div>
              <ul class="list-group">
                  <li class="list-group-item"><a href="<?php echo site_url();?>load_stock/index"><span class="glyphicon glyphicon-plus"></span>Load Stock </a></li>
                <li class="list-group-item"><a href="new_campaign.php"><span class="glyphicon glyphicon-plus"></span> Build a Campaign</a></li>
                <li class="list-group-item"><a href="invoices.php"><span class="glyphicon glyphicon-file"></span> Invoice/ Statements</a></li>
                <li class="list-group-item"><a href="#"><span class="glyphicon glyphicon-plus"></span> Historical Purchases</a></li>
                <li class="list-group-item"><a href="<?php echo site_url();?>my_stock/index"><span class="glyphicon glyphicon-plus"></span> View Current Stock </a></li>
              </ul>
            </div>
          </div>

          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Current Bids<a href="../load_stock/active_bids" class="label label-default pull-right">View All</a></div>
              <div class="panel-body">
                <div class="feed-activity-list">
            <?php
                
                     
                $this->db->limit(5);
                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get();         
                 if ($select_query->num_rows > 0){       
                 foreach ($select_query->result() as $rows){       
                        
                        
               // SELECT * FROM bids inner join auctions on auctions.id = bids.auction inner join asset on asset.ass_id = auctions.ass_id WHERE auction = '1' order by bidwhen desc limit 1
                        
                        $this->db->where("auction", $rows->auction);
                        $this->db->order_by("bidwhen", "desc");
                        $this->db->limit(1);
                        $this->db->select('*');
		        $this->db->from('bids');
                        $this->db->join('auctions','bids.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = auctions.ass_id');
                        $select_query = $this->db->get();
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $row){
				$desc=$row->title . ' - ' .$row->ass_name ;
                        
                        //SELECT floor(HOUR(TIMEDIFF(now(), bidwhen)) / 24) as days, MOD(HOUR(TIMEDIFF(now(), bidwhen)), 24) as hours, MINUTE(TIMEDIFF(now(), bidwhen))as minutes from bids
                                
                       // $this->db->select("floor(HOUR(TIMEDIFF(now(), `bidwhen`)) / 24) as days, MOD(HOUR(TIMEDIFF(now(), `bidwhen`)), 24) as hours, MINUTE(TIMEDIFF(now(), `bidwhen`)) as minutes");
                        //$select_query = $this->db->get('bids');
                        
                        
                       // $query = "SELECT floor(HOUR(TIMEDIFF(now(), bidwhen)) / 24) as days, MOD(HOUR(TIMEDIFF(now(), bidwhen)), 24) as hours, MINUTE(TIMEDIFF(now(), bidwhen))as minutes from bids
//";
                       // $result = $db->query($query);
                                                 
                        $date = date('Y-m-d h:i:s', time());
                        $date1 = $row->bidwhen;//'2013-09-11 10:25:00';
                        
                        $start_date = new DateTime($date);
                        $since_start = $start_date->diff(new DateTime($date1));
                        
                        $a = substr($date1,0,10);
                        $b = substr($date,0,10);
                        
                        if ($a == $b){
                            $today = 'Today ';
                        }else{
                            $today = '';
                        }
                        $elapsed = '';
                            if ($since_start->y > 0){
                            $elapsed = $since_start->y .' Years';    
                            }
                            if ($since_start->m > 0){
                            $elapsed = $elapsed . ' '.$since_start->m .' Months';    
                            }
                            if ($since_start->d > 0){
                            $elapsed = $elapsed . ' '.$since_start->d .' Days';    
                            }
                                                     
                           if ($since_start->h > 0){
                            $elapsed = $elapsed . ' '.$since_start->h .' Hours';    
                            }
                            if ($since_start->i > 0){
                           
                                $elapsed = $elapsed . ' '.$since_start->i .' Mins';    
                            }
                           
                            $elapsed = $elapsed . ' ago';
                        
                         
                                
		?>
                    <div class="feed-element">
                    <div class="media-body ">
                      <small class="pull-right"><?php echo $elapsed;?></small>
                      <a href="../load_stock/asset?ass_id=<?php echo $row->ass_id; ?>"><?php echo $desc;?></a><br>
                      <small class="text-muted"><?php echo $today; echo $row->bidwhen;?></small>
                    </div>
                  </div>
                                
                                
               <?php }
               
               }
               
               }
		

		}else{ ?>
                    <div class="feed-element">
                    <div class="media-body ">
                      <small class="pull-right"></small>
                      <a href="#">No Bids Yet</a><br>
                      <small class="text-muted"></small>
                    </div>
                  </div> 
                    
               <?php }
?>
 

                </div>
              </div>
            </div>
          </div>
          
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Action Required</div>
              <div class="panel-body">
                <div class="feed-activity-list">

                  <div class="feed-element">
                    <div class="media-body ">
                      <a href="notifications.php">Art work is due within 7 days. Please Upload</a><br>
                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                    </div>
                  </div>

                  <div class="feed-element">
                    <div class="media-body ">
                      <a href="notifications.php">Payment deposit due. Please click here to settle and upload prove of payment</a><br>
                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                    </div>
                  </div>

                  <div class="feed-element">
                    <div class="media-body ">
                      <a href="notifications.php">Art work is due within 7 days. Please Upload</a><br>
                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


          

          <div class="clear"></div>

        </div>

  <?php //include("footer.php"); ?>