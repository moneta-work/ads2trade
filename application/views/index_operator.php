<?php
				$user_id = $this->session->userdata('user_id');
					
                        $this->db->where("user_type_id", '1');
                         $this->db->select('*');
                        $this->db->from('news');
                        $this->db->join('news_group_access', 'news_group_access.news_id = news.id');
                        $select = $this->db->get();



                $this->db->where('use_status', '0');
                $select_query_new = $this->db->get('user');

                $select_query_user = $this->db->get('user');
                $advertisers = 0;
                $m_owners = 0;
                 foreach ($select_query_user->result() as $rr){
                   if ($rr->ust_id == '1'){

                      $advertisers = $advertisers + 1;
                   }
                   if ($rr->ust_id == '2'){

                      $m_owners = $m_owners + 1;
                   }
		}




                $this->db->where('cam_status', '0');
                $select_query_cam = $this->db->get('campaign');
                $cam_am = 0;
                 foreach ($select_query_cam->result() as $r){
				$cam_am=$r->cam_budget+ $cam_am;

		}
                $cam_amt = 0;
                $select_query_camt = $this->db->get('campaign');
                foreach ($select_query_camt->result() as $r){
				$cam_amt=$r->cam_budget+ $cam_amt;

		}


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
          <h1><span class="glyphicon glyphicon-home"></span> Dashboard</h1>
        </div>
        <div class="main">

          <br>
          <br>

          <div class="row">
            <div class="col-xs-8">
              <div id="dashboard_stats">
                <div class="row">
                  <div class="col-sm-4">
                    <a href="../user?list=med" class="stat icon1">
                      <h3><?php echo $select_query_new->num_rows;?></h3>
                      <h4>User Management</h4>
                      <hr>
                      <div class="row info">
                        <div class="col-sm-4 text-left">
							<small><span>Advertisers:</span><?php echo $advertisers; ?></small>
                        </div>
                        <div class="col-sm-8 text-right">
							<small><span>Media Owners:</span><?php echo $m_owners;?></small>
                        </div>
                      </div>
                    </a>
                  </div>

                  <div class="col-sm-4">
                     <a href="../new_campaign/campaigns" class="stat icon2">
                      <h3><?php echo $select_query_cam->num_rows;?></h3>
                      <h4>RFPs</h4>
                      <hr>
                      <div class="row info">
                        <div class="col-sm-4 text-left">
                          <small><span>Total:</span>R<?php echo number_format($cam_am, 0, '.', ',');?></small>
                        </div>
                        <div class="col-sm-8 text-right">
                          <small><span>Value:</span>R<?php echo number_format($cam_amt, 0, '.', ',');?></small>
                        </div>
                      </div>
                    </a>
                  </div>

                  <div class="col-sm-4">
                    <a href="../my_stock/op_index" class="stat icon3">
                      <h3><?php echo $select_query2->num_rows;?></h3>
                      <h4>Auctions</h4>
                      <hr>
                      <div class="row info">
                        <div class="col-sm-4 text-left">
                          <small><span>Total:</span>R<?php echo number_format($won_bids, 2, '.', ',');?></small>
                        </div>
                        <div class="col-sm-8 text-right">
                          <small><span>Current Bid Value:</span>R<?php echo number_format($cwon_bids, 2, '.', ',');?></small>
                        </div>
                      </div>
                    </a>
                  </div>


                  <div class="col-sm-4">
                    <a href="../load_stock/all_watch_list" class="stat icon4">
                      <h3><?php echo $select_query1->num_rows;?></h3>
                      <h4>Assets on Watch List</h4>
                      <hr>
                      <div class="row info">
                        <div class="col-sm-4 text-left">
                          <small><span>Total:</span>R<?php echo $bb; ?></small>
                        </div>
                        <div class="col-sm-8 text-right">
                          <small><span>Current Bid Value:</span>R<?php echo $cc;?></small>
                        </div>
                      </div>
                    </a>
                  </div>

                  <div class="col-sm-4">
                    <a href="../newsfeed" class="stat icon5">
                      <h3><?php echo $select->num_rows;?></h3>
                      <h4>News Feeds</h4>
                      <hr>
                      <div class="row info">
                        <div class="col-sm-4 text-left">
                          <small><span>Campaigns:</span>3</small>
                        </div>
                        <div class="col-sm-8 text-right">
                          <small><span>Activities:</span>2</small>
                        </div>
                      </div>
                    </a>
                  </div>

                  <div class="col-sm-4">
                    <a href="<?php echo site_url("messages/inbox");?>" title="My Messages" class="stat icon6">
                      <h3>3</h3>
                      <h4>Emails</h4>
                      <hr>
					  <?php
					  $total_unread = $this->events->getCountUnreadMessages($user_id);
					  $total_read = $this->events->getCountReadMessages($user_id);
					  ?>
                      <div class="row info">
                        <div class="col-sm-4 text-left">
                          <small><span>Total:</span><?php echo number_format(($total_read+$total_unread),0);?></small>
                        </div>
                        <div class="col-sm-8 text-right">
                          <small><span>Unread:</span><?php echo number_format(($total_unread),0);?></small>
                        </div>
                      </div>
                    </a>
                  </div>


                </div>
              </div>
            </div>



            <div class="col-xs-4">
              <div class="panel panel-default">
                <!--<div class="panel-heading">Latest News</div>-->
                <div class="panel-body">

                  <div class="bs-example bs-example-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                      <li class="active"><a href="#newsfeed" role="tab" data-toggle="tab">Newsfeed</a></li>
                      <li><a href="#campaigns" role="tab" data-toggle="tab">Campaigns</a></li>
                      <li><a href="#activities" role="tab" data-toggle="tab">Activities</a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content">

                      <div class="tab-pane fade in active" id="newsfeed">
                        <div class="feed-activity-list">

                         <?php
						
						$this->db->distinct();
                        $select = $this->db->get('news');
                        foreach ($select->result() as $feed){
                      ?>
                    <div class="feed-element">
                      <div class="media-body ">
                        <a href="../navigate/feeds"><?php echo $feed->title;?></a><br>
                        <!-- <small class="text-muted">Today 5:60 pm - 12.06.2014</small> -->
						<small class="text-muted"><?php echo date('D, F d, Y',strtotime($feed->news_date)); ?></small>
                      </div>
                    </div>

                   <?php }?>
                        </div>
                      </div>

                      <div class="tab-pane fade in" id="campaigns">
                      <?php
                        $sql = "SELECT * FROM system_events WHERE event_type in(3)";
                        $select = $this->db->query($sql);
                        if ($select->num_rows() > 0)
                        {
                         foreach ($select->result() as $event){
                      ?>
                      <div class="feed-element">
                        <div class="media-body ">
                          <a href="../navigate/feeds"><?php echo $event->event_details;?></a><br>
                          <small class="text-muted"><?php echo date('D, F d, Y h:j A',strtotime($event->event_date)); ?></small>
                        </div>
                      </div>
                     <?php }
                      } else {?>
                      
                      <div class="feed-element">
                        <div class="media-body ">
                          <span><i>No Campaign Events found </i></span><br>
                          <small class="text-muted"><?php echo date('D, F d, Y h:j A'); ?></small>
                        </div>
                      </div>
                      
                     <?php }?>
                   
                      </div>

                      <div class="tab-pane fade in" id="activities">
                      <?php
                        $sql = "SELECT * FROM system_events WHERE event_type in(1,2,6)";
                        $select = $this->db->query($sql);
						if($select->num_rows() > 0){
                        foreach ($select->result() as $event){
                      ?>
                    <div class="feed-element">
                      <div class="media-body ">
                        <a href="../navigate/feeds"><?php echo $event->event_details;?></a><br>
                        <small class="text-muted"><?php echo date('D, F d, Y h:j A',strtotime($event->event_date)); ?></small>
                      </div>
                    </div>

				    <?php } //end foreach
				      } else { ?>

                      <div class="feed-element">
                        <div class="media-body ">
                          <span><i>No Bids/Auctions Activites found </i></span><br>
                          <small class="text-muted"><?php echo date('D, F d, Y h:j A'); ?></small>
                        </div>
                      </div>
					  
                   <?php }?>
                      </div>

                    </div>
                  </div>


                </div>
              </div>
            </div>

          </div>

        </div>