<?php error_reporting(0);?>
<?php echo $map_1['js'];echo $map_3['js'];echo $map_5['js'];echo $map_7['js'];echo $map_9['js']; ?>
<?php echo $map_2['js'];echo $map_4['js'];echo $map_6['js'];echo $map_8['js'];echo $map_10['js'];
$count = 0;
foreach ($mmm as $row) {
    
    $count = $count + 1;
}

?>        
<script type="text/javascript">
function approve(){
  if (confirm("Are you sure you want to approve all")) {
    location.href='add_all?all=1';
  }
  return false;
}
function decline(){
  if (confirm("Are you sure you want to decline all")) {
    location.href='remove_all?all=1';
  }
  return false;
}
</script>

<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Incoming Auction Items For Approval</h1>
</div>

   
    <div class="table_div">
        
        <div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="container">
							<div class="sbInRow ">
								<form novalidate="novalidate" class="form-inline">
																		
									<div class="form-group pull-right">
										<span class="help-block">Found <?php echo $count;?> Assets</span>
									</div>
                                                                    <div class="form-group pull-right">
                                                                        <span class="help-block">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</div>
                                                                    
								</form>

							</div>
						</div>
					</div>
				</div>
                                                                        <div class="form-group pull-right">
                                                                            <span class="help-block"><input name="approve" onclick="approve()" type="button" class="btn btn-primary" value="Approve All">&nbsp;&nbsp;<input name="approve" onclick="decline()" type="button" class="btn btn-primary" value="Decline All"></span>
									</div>
            <br>
            <br>
            
				<div class="panel-body">
	<div class="list-group" data-bind="foreach: pagedRows">
						
    
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
                
                
                          
                
                
                   $this->db->where('ass_id', $row->ass_id);
                  
               //   $this->db->where('use_id', $user);
		$this->db->select('*');
		$this->db->from('auctions');  
                
		$this->db->join('durations', 'durations.days = auctions.duration');
               $select_query = $this->db->get();
                  
                  
                 	//$this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
                            $found = 1;                        
				$towns=$rows->minimum_bid;
                                $from = $rows->starts;
                                $ends = $rows->ends;
                                $duration = $rows->description;
                                $minimum_bid = $rows->minimum_bid;
                                $buy_now = $rows->buy_now;
                                $increment = $rows->increment;
                                $reference = $rows->id;
                                }
		}else{
                                $towns='';
                                $from = '';
                                $ends = '';
                                $duration = '';
                                $minimum_bid = '';
                                $buy_now = '0.00';
                                $increment = '0.00'; 
                                $reference = 'N/A';
                                
                    
                }
			  
			  
			  
            ?>
<a href="op_asset?ass_id=<?php echo $row->ass_id;?>" class="list-group-item gray-gradiant-background">

							<div class="row">
								<div class="col-md-2 col-md-3 col-sm-3 col-xs-4">
									<div style="display: none;" data-bind="visible : IsSold" class="soldVehicleList">&nbsp;</div>
									<img src="<?php echo $row->url;?>"  alt="<?php echo $row->ass_name;?>" class="img-responsive img-thumbnail">

									<div class="hidden-xs">
										<span class="text-blue-bold">VIEW DETAILS  </span>
									</div>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
									<div>
										<div class="row">
											<div class="col-sm-12">
												<div class="pull-left">
													
													<h4 class="media-heading pull-left" data-bind="text: Title"><?php echo $row->ass_name;?></h4>
													<small>&nbsp;</small>
												</div>

												<span class="pull-right yes360" style="display: inline-block; height:28px; width:100px;" data-bind="css:{yes360 : HasThreeSixty, div360 : !HasThreeSixty}"></span>
											</div>
										</div>

										<hr style="margin-top:5px;">
										<div class="row">

											<div class="col-xs-12 col-sm-6">
												<div>
													<div>
														<span class="detailField">Reference :</span>
														<span data-bind="text: PublicReference == null ? '' : PublicReference " class="detailFieldDetail"><?php echo $reference;?></span>
													</div>
													<div>
														<span class="detailField">Increment :</span><!--"detailField"-->
														<span data-original-title="Code" title="" data-bind="attr:{title: VehicleCode == 0 ? 'To be confirmed' : 'Code'}, text: VehicleCode == 0 ? 'TBC' : VehicleCode" class="detailFieldDetail"><?php echo $increment;?></span>
													</div>

													<span class="detailField">Asset Category :</span><!--"detailField"-->
													<span class="detailFieldDetail" data-bind="text:VehicleCategory"><?php echo $row->mec_description;?></span>
													<!--"detailFieldDetail"-->

													<div data-bind="visible: !IsComingSoon">
														<span class="detailField">Duration:</span><!--"detailField"-->
														<span class="detailFieldDetail" data-bind="text: HasReserve ? 'Yes':'No'"><?php echo $duration;?></span>
														<!--"detailFieldDetail"-->
													</div>
												</div>
											</div>
											<div class="col-sm-6">

												<div class="pull-right" style="display: inline-block; padding-left: 15px;" data-bind="visible: IsTimedBid">
													<span class="sales-type" data-bind="visible: IsTimedBid">Bids:  <span data-original-title="Total number of successfull bids made" title="" data-bind="text: TotalBidsMade">2</span> </span>
													<div>
														<span data-bind="visible: HighestTimedBidAmount >=  ReservePrice" class="text-success detailfield">Minimum Bid : <?php echo $minimum_bid; ?></span>
														<span style="display: none;" data-bind="visible: HighestTimedBidAmount < ReservePrice" class="text-danger detailField">STC : Yes</span>
													</div>

													<span data-bind="visible: !IsTimeBidExpired">Auction Expires: </span><span data-bind="visible: !IsTimeBidExpired, text: TimeBidEndDate"><?php echo $ends;?></span> <span style="display: none;" class="sales-type" data-bind="visible: IsTimeBidExpired">Expired</span>
												</div>
												
												<div class="pull-right" style="display: none; width: 180px; padding-left: 15px;" data-bind="visible: IsAuctionItem">
													<span class="sales-type" style="margin-bottom: 3px; display: none;" data-bind="visible: IsAuctionItem">On Auction</span>
													<span class="sales-type" style="margin-bottom:3px;">
														<b>	Current Bid: <span data-original-title=" highest successfull bid made" title="" data-bind="text: HighestTimedBidAmount != null ? HighestTimedBidAmountString : 'No Bids'">R 18&nbsp;500</span></b>
													</span>
													
													<div style="display: none;" class="placeTimedBid" data-bind="visible: ShowPreBidButton">
														<div>PRE-BID</div> 
													</div>
												</div>

												<div class="pull-right" style="padding-left: 15px; display: inline-block">
													<span style="display: none;" class="sales-type" data-bind="visible: IsSold">Sold</span>
													<span style="display: none;" class="sales-type" data-bind="visible: IsComingSoon">Coming Soon</span>
													<span class="sales-type text-blue" data-bind="visible: IsBuyNow, text: 'Buy Now ' + BuyNowSalesAmountString">Buy Now R <?php echo $buy_now ;?></span>
													<span style="display: none;" class="sales-type" data-bind="visible: IsMakeAnOffer &amp;&amp; IsBuyNow">or best offer</span>
													<span style="display: none;" class="sales-type" data-bind="visible: IsMakeAnOffer &amp;&amp; !IsBuyNow">Make an offer</span>
												</div>
											</div>
										</div>
                                                                                <form name="<?php echo $reference;?>" method="post" action="../my_stock/approve?p=op_index&asst_id=<?php echo $reference;?>">
										<div class="row">
											<div class="col-sm-12">
												<span data-bind="visible: !IsComingSoon"><span class="label label-primary" data-bind="text:SiteName">New</span></span>
												<span><span><input name="approve" type="submit" class="btn btn-primary" value="Approve This"></span></span>
												<span id="ca7cc8de-1801-e411-9409-00155d42d62c" data-bind="attr:{id:Id}, visible: IsTimedBid || IsAuctionItem" data-original-title="Bidders">
													<span>&nbsp;&nbsp;<input name="decline" type="submit" class="btn btn-primary" value="Decline This"></span>
												</span>

											</div>
										</div>
                                                                                    </form>
									</div>
								</div>
							</div>

						</a>
      <?php }?>


    </div>
				</div>
				<div class="panel-footer">
					<div class="smd-pagination">
						<div id="pager" class="smd-pager light-theme"><span class="current"></span></a><span class="ellipse"></span></div>
					</div>
				</div>
			</div>



</div><!--Main -->

<?php
//include("footer.php"); ?>
