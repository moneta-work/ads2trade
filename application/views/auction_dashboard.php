<?php
               
                $this->db->where("watch_list.status", '1');
                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query1 = $this->db->get();
                
                $this->db->where("watch_list.status", '1');
                $this->db->select('*');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query5 = $this->db->get();
                
                $bb = 0;
                $cc = 0;
                 foreach ($select_query5->result() as $row1){
				$bb=$row1->buy_now + $bb;
                                $cc=$row1->current_bid + $cc;
                               
		}
                

                
                $this->db->where("bids.status", '1');
                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get(); 
                
                $this->db->where("bids.status", '1');
                $this->db->select('*');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query4 = $this->db->get(); 
                
                $open_bids = 0;
                $curr_bids = 0;
                foreach ($select_query4->result() as $row2){
				$open_bids=$row2->buy_now + $open_bids;
                                $curr_bids=$row2->bid + $curr_bids;
                               
		}
                
                
                      //  $this->db->where("winner", '5');  
                      //  $this->db->order_by("bidwhen", "desc");
                        $this->db->limit(1);
                        $this->db->select('*');
		        $this->db->from('bids');
                        $this->db->join('auctions','bids.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = auctions.ass_id');
                        $this->db->join('media_category','media_category.mec_id = asset.mec_id', 'left outer');
                        $this->db->join('images','images.ass_id = asset.ass_id', 'left outer');
                        $select_query2 = $this->db->get();
                        $won_bids = 0;
                        $cwon_bids = 0;
                         foreach ($select_query2->result() as $row3){
				$won_bids=$row3->buy_now + $won_bids;
                                $cwon_bids=$row3->current_bid + $cwon_bids;
                               
		}
                        
                        
                        
                     //   $this->db->where("winner !=", '5');   
                     //   $this->db->where("winner !=", '0'); 
                        $this->db->order_by("bidwhen", "desc");
                        $this->db->limit(1);
                        $this->db->select('*');
		        $this->db->from('bids');
                        $this->db->join('auctions','bids.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = auctions.ass_id');
                        $this->db->join('media_category','media_category.mec_id = asset.mec_id', 'left outer');
                        $this->db->join('images','images.ass_id = asset.ass_id', 'left outer');
                        $select_query3 = $this->db->get();
                        $out_bids = 0;
                        $cout_bids = 0;
                         foreach ($select_query3->result() as $row4){
				$out_bids=$row4->buy_now + $out_bids;
                                $cout_bids=$row4->current_bid + $cout_bids;
                               
		}
                        
                        
?>
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-home"></span>Auctions Dashboard</h1>
        </div>
        <div class="main">

          <div class="alert alert-info text-center" role="alert">
            <h2>Welcome <?php echo $this->session->userdata('username'); ?></h2>
            <p>You current don't have any active campaigns. To start a campaign you have to buy or bid for advertising space.</p>
            <br><a href="../load_stock/asset_details3" class="btn btn-primary">Go To  Current Auctions</a>
          </div>
          <br>
          <br>

          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Bids (Open)<a href="../load_stock/active_bids" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R <?php echo $open_bids; ?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R <?php echo $curr_bids;?> ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>

                  <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Bids (Outbid)<a href="../load_stock/lost_bids" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query3->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R <?php echo $cout_bids;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R <?php echo $out_bids;?> ]</li>
                 <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>My Bid Value [ R <?php echo $cout_bids;?> ]</li>
                <li class="list-group-item"></a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Bids (Won)<a href="../load_stock/won_bids" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query2->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R <?php echo $won_bids;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R <?php echo $cwon_bids;?> ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>


          

          <div class="clear"></div>

          
          <br>

          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Watch List<a href="../load_stock/watch_list" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                 <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query1->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R <?php echo $bb; ?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R <?php echo $cc;?> ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>

                  <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">My Shopping Basket<a href="../load_stock/active_bids" class="label label-default pull-right">Display</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>
          <?php 
          $tot = $select_query->num_rows + $select_query2->num_rows; 
          $tot1 = $open_bids + $won_bids;
          $tot2 = $curr_bids + $cwon_bids;
          
          ?>
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Estimated Spent</div>
             <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $tot;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ <?php echo $tot1;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R <?php echo $tot2;?>  ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>


          

          <div class="clear"></div>
          
          
        </div>

  <?php //include("footer.php"); ?>