<?php
error_reporting(0);
echo $map_1['js'];echo $map_3['js'];echo $map_5['js'];echo $map_7['js'];echo $map_9['js']; 
echo $map_2['js'];echo $map_4['js'];echo $map_6['js'];echo $map_8['js'];echo $map_10['js']; 
 ?>        


		<div class="breadcrumbs">
		    <h1><span class="glyphicon glyphicon-list-alt"></span><a href="#">Auctions</a> / <?php echo $this->input->get('area');?></h1>
		</div>
		
		<?php
		               
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

		?>

        <div class="main col-xs-12">

          <ul class="nav navbar-nav section-menu">
            <li class="active"><a href="../load_stock/asset_details3">Search</a></li>
            <li ><a href="../load_stock/active_bids">Your Active Bids<span class="badge"><?php echo $select_query->num_rows;?></span></a></li>
            <li><a href="../load_stock/watch_list">Watch List<span class="badge"><?php echo $select_query1->num_rows;?></span></a></li>
            <li><a href="../load_stock/won_bids">Won Bids</a></li>
            <li><a href="../load_stock/lost_bids">Lost Bids</a></li>
          </ul>

    	<h3>Filter Results</h3>


        <form method="post" class="main col-xs-12">



          <div class="clear"></div>

              

              <div class="row">
                <div class="col-sm-9">

                   <?php
					$a = 0;
					foreach ($mmm as $row) {
						$a = $a + 1;
						$b = 'map_'.$a; 
						$c = 'map_canvas'.$a; 

						$this->db->where('tow_id', $row->loc_id);
						$select_query = $this->db->get('town');

						if ($select_query->num_rows > 0){
							foreach ($select_query->result() as $rows){
								$town=$rows->tow_description;                      
							}
						}
			                
			                
			            $this->db->where('auction', $row->id);
			            $this->db->where('bidder', $this->session->userdata('use_id'));
			            $select_query = $this->db->get('bids');

						if ($select_query->num_rows > 0){
							foreach ($select_query->result() as $rows){
								$yobid=$rows->bid;                               
							}
						}

			            ?>

                  <div class="assets_box">
                    <a href="asset?auction_id=<?php echo $auction_id;?>&ass_id=<?php echo $row->ass_id;?>" class="pic"></a>
                    <div class="info">
                      <table>
                        <tbody>
                          <tr>
                            <td width="150px;">Asset Name/Number:</td>
                            <td><?php echo $row->ass_name;?></td>
                          </tr>
                          <tr>
                            <td>Current Status:</td>
                            <td><?php echo $row->status;?></td>
                          </tr>
                          <tr>
                            <td>Current Bid:</td>
                            <td>R<?php foreach($current_bid as $bid_data){echo number_format($bid_data->currentBid,2);} ?></td>
                          </tr>
                          <tr>
                            <td>Your Bid:</td>
                            <td>R<?php foreach($last_bid as $my_bid){echo number_format($my_bid->myCurrentBid,2);}?></td>
                          </tr>
                        </tbody>
                      </table>
                      <p class="description">
                      <?php echo 'Description: ',$row->ass_description; ?><br>
                      <?php echo 'Location: ', $row->ass_street_address, ', ',$row->ass_city; ?><br>	
                      </p>
                      <div class="btn-group">
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#placeBid"><span class="glyphicon glyphicon-record"></span> Bid</a>
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#buyNow"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a>
                      </div>
                      <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#watchList"><span class="glyphicon glyphicon-eye-open"></span> Add to watchlist</a>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <?php } ?>

                </div>

                <div class="col-sm-3">
                  <div class="side_info_box">
                    <h3>Room Details</h3> 
                    <table>
                        <tbody>
                        	<? $num_assets = count($mmm); foreach ($mmm as $key) {	?>
                          <tr>
                            <td width="150px;">Auction Name:</td>
                            <td><?=$key->ass_city;?></td>
                          </tr>
                          <tr>
                            <td>Auction Address:</td>
                            <td><?=$key->ass_street_address;?></td>
                          </tr>
                          <tr>
                            <td>Number Of Assets:</td>
                            <td><?=$num_assets;?></td>
                          </tr>
                          <tr>
                            <td>Auction Status:</td>
                            <td><?php if($key->status == 1){echo 'ACTIVE';}else{echo 'INACTIVE';}?></td>
                          </tr>
                        </tbody>
                        <?php }?>
                      </table>
                  </div>
                

                  <div class="side_info_box">
                    <h3>Filter Assets</h3> 
                    
                    <label>Location</label>
                    <input type="text" class="form-control">

                    <label>Bid Range</label>
                    <select class="form-control">
                      <option>R0 - R999</option>
                      <option>R1000 - R3000</option>
                    </select>

                    <div class="text-center">
                      <input type="submit" value="Filter" class="btn btn-primary">
                    </div>

                  </div>
                </div>

                

                

                
              </div>
              

              

            

        </form><!--Main --> 




    <div class="table_div">
     
     <!--   
        <table class="table table-bordered headed " cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Auction Room</th>
					<th>Duration</th>
					<th>Artwork Required By</th>
					<th>Auction Start</th>
					<th>No Of Assets</th>
					<th>Campaign To Start</th>
					<th>End Date</th>
					<th>Media Type</th>
					<th>Time Remaining</th>
				</tr>
				</thead>

				<tbody>
        <?php
              
        $this->db->where('asset.mec_id', $_REQUEST['aset']);   
        $this->db->where('auctions.duration', $_REQUEST['duration']);
              $this->db->group_by('mec_id');
              $this->db->group_by('duration');
		//$this->db->select('count(*)as counts,`loc_id`,`ast_id`');
		$this->db->select('count(*) as counts, auctions.duration as loc_id,asset.mec_id');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id');
		$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				
			
						$count = $count + 1;
						$this->db->where('mec_id', $row->mec_id);
						$select_query = $this->db->get('media_category');
						if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

							foreach ($select_query->result() as $rows) {
								$dat = $rows->mec_description;
							}


						}
                                                
                                                
                                                
                                                $this->db->where('days', $row->loc_id);
						$select_query = $this->db->get('durations');
						if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

							foreach ($select_query->result() as $rows) {
								$duration = $rows->description;
							}


						}
						?>
						<tr>
							<td><?php echo $count; ?>
							</td>
							<td>
								<?php echo $duration; ?>
							</td>
							<td>01.08.2014</td>
							<td>01.08.2014</td>
							<td>
								<?php echo $row->counts; ?>
							</td>
							<td><?php $row->mec_id; ?>
							</td>
							<td>08.08.2014</td>
							<td><?php echo $dat; ?></td>
							<td>2 Days</td>
						</tr>
					<?php
					}}?> </tbody>
			</table>
        
        
  

  <table class="table table-bordered headed " width="100%" border="1" cellpadding="1"  cellspacing="1" bordercolor="#CCCCCC">
    <thead>
      <tr> 
        <th>Pic</th>
        <th><div align="center">Location</div></th>
        <th><div align="center">Asset Description</div></th>
        <th><div align="center">Details</div></th>
  <th><div align="center">Action</div></th>
      </tr>
    </thead>
    
      <?php
		$a = 0;
		print_r($mmm);

		foreach ($mmm as $row) {
			$a = $a + 1;
			$b = 'map_'.$a; 
			$c = 'map_canvas'.$a; 

			$this->db->where('tow_id', $row->loc_id);
			$select_query = $this->db->get('town');

			if ($select_query->num_rows > 0){
				foreach ($select_query->result() as $rows){
					$town=$rows->tow_description;                      
				}
			}
                
                
            $this->db->where('auction', $row->id);
            $this->db->where('bidder', $this->session->userdata('use_id'));
            $select_query = $this->db->get('bids');

			if ($select_query->num_rows > 0){
				foreach ($select_query->result() as $rows){
					$yobid=$rows->bid;                               
				}
			}

            ?>
      	<tr> 
        <td width="80" height="70"> <div align="left"><a  href="asset?ass_id=<?php echo $row->ass_id;?>"> <img src="../../assets/add1.jpg" width="95%" height="216%" align="left"> 
            </a> </div>
        </td>
        <td width="324" align="center" > <div><?php echo $row->ass_address;?></div></td>
        <td width="284"> <p>Description :<?php echo $row->ass_description;?></p></td>
          
         
        <td width="321"><p>Current Status :<?php ?></p>
          <p>Current Bid &nbsp;&nbsp;&nbsp; :<?php echo $row->current_bid;?></p>
          <p>Your Bid &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $yobid; ?></p>
         </td> 
         <td align="center"> <a href="#" onclick="modalshow('<?php echo $row->ass_id; ?>','1')" class="btn btn-default"  >Options</a>
                                   </td>                      
      </tr>
      <?php 
  		}
      ?>
 
  </table>

  -->

    </div>

    </form>



</div><!--Main -->

 <script>
  function modalshow(a,b){ 

  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
  
 $("#modalwin").load("loadajax?c="+a+"&type="+b+"&p=auction_details");
  //$("#modalwin").load("bid_pop?ass_id="+a+"&type="+b);
  modalbak = document.getElementById("modalbak");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";
}
function modalhide(){
  document.getElementById("modalbak").style.display = "none";
  document.getElementById("modalwin").style.display = "none";
}

  </script>
  
   <style>
	#modalbak {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #333333;
		display: none;
		opacity: 0.40;
		z-index: 9;
	}

	#modalwin {
		position: fixed;
		top: 0;
		left: 0;
		width: 900px;
		height: 600px;
		background: #FFF;
		display: none;
		padding: 5px;
		border: 3px double #CCC;
		z-index: 10;
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-box-shadow: 3px 3px 6px #666;
		-webkit-box-shadow: 3px 3px 6px #666;
	}

	#modalmsg {
		text-align: center;
		/* Add more style to your message */
	}

</style>

<div id='modalbak'></div>
<div id='modalwin' >
  
           
 </div> 
<?php

function getaddress($lat, $lng)
{
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
	$json = @file_get_contents($url);
	$data=json_decode($json);
	$status = $data->status;
	if($status=="OK")
		return $data->results[0]->formatted_address;
	else
		return false;
}

function getaddress2($coordinates)
{
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($coordinates).'&sensor=false';
	$json = @file_get_contents($url);
	$data=json_decode($json);
	$status = $data->status;
	if($status=="OK")
		return $data->results[0]->formatted_address;
	else
		return false;
}

?>