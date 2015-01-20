<?php
               

                $this->db->where("auctions.status", '0');
                $this->db->select('*');
		$this->db->from('auctions');
                $select_in = $this->db->get();

                $this->db->where("watch_list.status", '1');
                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query1 = $this->db->get(); 

                
                $this->db->where("bids.status", '1');
                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get();  
                
                        $this->db->order_by("bidwhen", "desc");
                        $this->db->limit(1);
                        $this->db->select('*');
		        $this->db->from('bids');
                        $this->db->join('auctions','bids.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = auctions.ass_id');
                        $this->db->join('media_category','media_category.mec_id = asset.mec_id', 'left outer');
                        $this->db->join('images','images.ass_id = asset.ass_id', 'left outer');
                        $select_query2 = $this->db->get();
                        
                        
                        $this->db->order_by("bidwhen", "desc");
                        $this->db->limit(1);
                        $this->db->select('*');
		        $this->db->from('bids');
                        $this->db->join('auctions','bids.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = auctions.ass_id');
                        $this->db->join('media_category','media_category.mec_id = asset.mec_id', 'left outer');
                        $this->db->join('images','images.ass_id = asset.ass_id', 'left outer');
                        $select_query3 = $this->db->get();
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
              <div class="panel-heading">User Management<a href="../load_stock/active_bids" class="label label-default pull-right">User Management Home</a></div>
               <ul class="list-group">
                  <li class="list-group-item"><a href="<?php echo site_url("user?st=new") ?>"><span class="glyphicon glyphicon-plus"></span>New Applicants [ <?php echo $select_query->num_rows;?> ]</a></li>
                 <li class="list-group-item"><a href="<?php echo site_url("user?list=med") ?>"><span class="glyphicon glyphicon-plus"></span>Media Owners List</a></li>
                <li class="list-group-item"><a href="<?php echo site_url("user?list=adv") ?>"><span class="glyphicon glyphicon-plus"></span>Advertisers List</a></li>
              </ul>
            </div>
          </div>

                  <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Auctions<a href="../load_stock/lost_bids" class="label label-default pull-right">Auction Home</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><a href="../navigate/applicants"><span class="glyphicon glyphicon-plus"></span>Create / Close Auction [ <?php echo $select_query3->num_rows;?> ]</a></li>
                  <li class="list-group-item"><a href="../my_stock/op_index"><span class="glyphicon glyphicon-plus"></span>Incoming Auction Items For Approval [ <?php echo $select_in->num_rows;?> ]</a></li>
                  <li class="list-group-item"><a href="../load_stock/all_active_bids"><span class="glyphicon glyphicon-plus"></span>Active Bids [ 200 ]</a></li>
                 <li class="list-group-item"><a href="../load_stock/all_watch_list"><span class="glyphicon glyphicon-plus"></span>Assets On Watch List [ 300 ]</a> </li>
                <li class="list-group-item"></a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">System Settings<a href="../load_stock/won_bids" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Incoming RFPs [ <?php echo $select_query2->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>


          

          <div class="clear"></div>

          
          <br>

          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Invoice Management<a href="../navigate/invoice_list" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                 <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query1->num_rows;?> ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>

                  <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">News Feeds<a href="../load_stock/active_bids" class="label label-default pull-right">Feeds Home</a></div>
              <div class="panel-body">
                   <li class="list-group-item"><a href="<?php echo site_url("newsfeed") ?>"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ <?php echo $select_query1->num_rows;?> ]</a></li>
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
          
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Request For Proposals</div>
             <ul class="list-group">
                 <li class="list-group-item"><a href="../new_campaign/campaigns"><span class="glyphicon glyphicon-plus"></span>Incoming Proposals [ 8 ]</a></li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>


          

          <div class="clear"></div>
          
          
        </div>

  <?php //include("footer.php"); ?>