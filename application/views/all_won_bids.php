<?php //include("header.php"); ?>
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span>All Won Bids</h1>
        </div>

<?php
               

                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query1 = $this->db->get(); 


                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get();  
?>
        <div class="main col-xs-12">

          <ul class="nav navbar-nav section-menu">
            <li><a href="../navigate/index">Home</a></li>
            <li><a href="../load_stock/all_active_bids">All Active Bids<span class="badge"><?php echo $select_query->num_rows;?></span></a></li>
            <li><a href="../load_stock/all_watch_list">All Watch List<span class="badge"><?php echo $select_query1->num_rows;?></span></a></li>
            <li class="active"><a href="../load_stock/all_won_bids">All Won Bids</a></li>
          </ul>

           <div class="clear"></div>

                    <table class="table table-bordered headed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Pic</th>
                            <th>Asset Name</th>
                            <th>Winning Bid</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
             
                    <tbody>
                        
                 <?php
                      
                 if ($select_query->num_rows > 0){       
                 foreach ($select_query->result() as $rows){       
                        
                        
               // SELECT * FROM bids inner join auctions on auctions.id = bids.auction inner join asset on asset.ass_id = auctions.ass_id WHERE auction = '1' order by bidwhen desc limit 1
                        
                     $this->db->where("winner", '5');   
                     $this->db->where("auction", $rows->auction);
                        $this->db->order_by("bidwhen", "desc");
                        $this->db->limit(1);
                        $this->db->select('*');
		        $this->db->from('bids');
                        $this->db->join('auctions','bids.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = auctions.ass_id');
                        $this->db->join('media_category','media_category.mec_id = asset.mec_id', 'left outer');
                        $this->db->join('images','images.ass_id = asset.ass_id', 'left outer');
                        $select_query = $this->db->get();
			$ass_name = '';
                        $img = '../../assets/images/add1.jpg';
                        if ($select_query->num_rows > 0){
                        
			foreach ($select_query->result() as $row){
				$desc=$row->title . ' - ' .$row->ass_name ;
                                $ass_name = $row->ass_name;
                                $img = '';
                                if ($row->url == ''){$img = '../../assets/images/add1.jpg';}else{$img = $row->url;}
                          $elapsed = '';                                               
                        $date = $row->ends;//date('Y-m-d h:i:s', time());
                        $date1 = $row->bidwhen;//'2013-09-11 10:25:00';
                        $current_bid= $row->current_bid;
                        
                        $yobid = 0;
                            if (isset($auction_id) && $auction_id <> '0' ){
                            $this->db->where('auction', $auction_id);
                            $this->db->where('bidder', $this->session->userdata('use_id'));
                            $select_query = $this->db->get('bids');
                                    if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$yobid=$rows->bid;
                                
                               
		}
                        }}$stat = 'Won';
                       
                        
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
                            $elapsed = $elapsed. ' ' .$since_start->h .' Hours';    
                            }
                            if ($since_start->i > 0){
                            $elapsed = $elapsed . ' '.$since_start->i .' Mins';    
                            }
                           
                            $elapsed = $elapsed ;
                        
                         
                                
		?>
                        <tr>
                            <td width="50">
                              <a class="thumbnail" href="asset?ass_id=<?php echo $row->ass_id;?>">
                                <img src="<?php echo $img;?>">
                              </a>
                            </td>
                            <td><a href="asset?ass_id=<?php echo $row->ass_id;?>"><?php echo $ass_name ?></a></td>
                            <td><?php echo $current_bid;?></td>
                            <td><?php echo $row->ends;?></td>
                            <td><?php echo $row->mec_description;?></td>
                            <td><?php echo $stat;?></td>
                           
                        </tr>
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
                    </tbody>
                </table>

              

            

        </div><!--Main -->


  <?php //include("footer.php"); ?>