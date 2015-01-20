<?php 
echo $map['js'];
foreach ($mmm as $row) {
    $asset_id = $row->id;
    $mec_id = $row->mec_id;
    $asset_name = $row->ass_name;
    $ass_ref = $row->ass_ref;
    $ass_description = $row->ass_description;
    $auction_end = $row->ends;
    $ass_street_address = $row->ass_street_address;
    $ass_city = $row->ass_city;
    $ass_province = $row->ass_province;

    $pri_width = $row->ass_printable_width;
    $pri_height = $row->ass_printable_height;
    $this->db->where('tow_id', $row->loc_id);
            $select_query = $this->db->get('town');
    if ($select_query->num_rows > 0){
        foreach ($select_query->result() as $rows){
            $town=$rows->tow_description;
        }
    }
    //categories/media family
    //$this->db->select('mc.mec_id, mc.mec_description, mt.mam_id, mt.met_description, mf.mef_id, mef_description');
    $this->db->where('mc.mec_id', $mec_id);
    $this->db->select('mc.mec_id, mc.mec_description');
    $this->db->from('media_category mc');
    //$this->db->join('master_medium_type mt', 'media_category.mam_id = master_medium_type.mam_id');
    //$this->db->join('media_family mf', 'master_medium_type.mef_id = media_family.mef_id');
    $select_query = $this->db->get(); 
    if($select_query->num_rows > 0)   
        foreach($select_query->result() as $rows){
            $mec_description=$rows->mec_description;
        }
    }

    $yobid = 0;
        if (isset($auction_id) && $auction_id <> '0' ){
          $this->db->where('auction', $auction_id);
          $this->db->where('bidder', $this->session->userdata('use_id'));
          $select_query = $this->db->get('bids');
          if ($select_query->num_rows > 0){
            foreach ($select_query->result() as $rows){
              $yobid=$rows->bid;
            }
          }
        }
    $todayDate = date("Y-m-d H:i:s", mktime(0, 0, 0));  
    if ($todayDate > $auction_end) {
      $stat = 'CLOSED';
    }
    else {
      $stat = 'ACTIVE';
    }

?>
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span><a href="#">Auctions</a></h1>
        </div>

        <form method="post" class="main col-xs-12">

          <div class="clear"></div>

              <div class="row">
              
                <div class="col-sm-8">
                  <div class="pull-right">
                    <br><br>
                    
                  </div>
                  <h3><?php echo ucwords($mec_description),' #',$asset_id; ?></h3>
                  <h4>in <?php echo $ass_city, ', ', $ass_province; ?></h4>
                    <br>
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#placeBid"><span class="glyphicon glyphicon-record"></span> Bid</a>
                      <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#buyNow"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a>
                    </div>
                    <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#watchList"><span class="glyphicon glyphicon-eye-open"></span> Add to watchlist</a>
                    <br><br>

                  <div class="map_view">
                    <H3>Loading ...</H3>
                    <div id="map_canvas" style="height:400px;width:730px;margin:-2;"> <?php echo $map['html'];?></div>
                  </div>

                  <div class="main_picture"><a href="#"><img src="<?php echo base_url();?>assets/billboard_1.jpg"></a></div>
                  <ul class="thumbnails">
                    <li><a href="<?php echo base_url();?>assets/billboard_1.jpg"><img src="<?php echo base_url();?>assets/thumbnail_2.jpg"></a></li>
                    <li><a href="<?php echo base_url();?>assets/billboard_2.jpg"><img src="<?php echo base_url();?>assets/thumbnail_1.jpg"></a></li>
                    <li class="show_map_view"><img src="<?php echo base_url();?>assets/thumbnail_map.jpg"></li>
                  </ul>

                  <h3>Description</h3>
                  <p><?php echo $ass_description; ?></p>


                </div>

                <div class="col-sm-4">
                  <div class="side_info_box">
                    <h3>Asset Details</h3> 
                    <table>
                        <tbody>
                          <tr>
                            <td width="150px;">Asset Number:</td>
                            <td><?php echo $row->ass_id; ?></td>
                          </tr>
                          <tr>
                            <td>Current Status (In Auction):</td>
                            <td><?php echo $stat; ?></td>
                          </tr>
                            <tr>
                            <td>Minimum Bid:</td>
                            <td>R<?php echo number_format($row->minimum_bid,2); ?></td>
                          </tr>
                          <tr>
                            <td>Current Bid:</td>
                            <td>R<?php foreach($current_bid as $bid_data){echo number_format($bid_data->currentBid,2);} ?></td>
                          </tr>
                            <tr>
                            <td>Bid: Increment:</td>
                            <td>R<?php echo number_format($row->increment,2); ?></td>
                          </tr>
                          <tr>
                            <td>Your Bid:</td>
                            <td>R<?php echo number_format($yobid,2); ?></td>
                          </tr>
                          <tr>
                            <td width="150px;">Asset Cost (BCY):</td>
                            <td>R<?php echo number_format($row->ass_production_cost_BCY,2); ?></td>
                          </tr>
                          <tr>
                            <td>Asset Price (ACY):</td>
                            <td>R<?php echo number_format($row->ass_production_price_SCY,2); ?></td>
                          </tr>
                          <tr>
                            <td>Rat Description:</td>
                            <td><?php echo $row->rat_description; ?></td>
                          </tr>
                          <tr>
                            <td>Rat Rate:</td>
                            <td>R<?php echo number_format($row->rat_rate,2); ?></td>
                          </tr>
                          <tr>
                            <td width="150px;">Rat Value (BCY):</td>
                            <td>R<?php echo number_format($row->rat_value_BCY,2); ?></td>
                          </tr>
                          <tr>
                            <td>Auction Starts:</td>
                            <td><?php echo $row->starts; ?></td>
                          </tr>
                          <tr>
                            <td>Auction Ends:</td>
                            <td><?php echo $row->ends; ?></td>
                          </tr>
                          <tr>
                            <td>Minimum Bid:</td>
                            <td>R<?php echo number_format($row->minimum_bid,2); ?></td>
                          </tr>
                          <tr>
                            <td>Buy Now Price:</td>
                            <td>R<?php echo number_format($row->buy_now,2); ?></td>
                          </tr>                          
                        </tbody>
                      </table>
                  </div>

                  <br>
                  <div class="text-center"></div>
                  
                </div>

              </div>

        </form>
        <?php
        //print_r($mmm);
        ?>
        <!--Main -->




