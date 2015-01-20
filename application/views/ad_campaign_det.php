<?php error_reporting(0);?>
<?php 

               
function getaddress($lat,$lng)
                            {
                            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
                            $json = @file_get_contents($url);
                            
                            $data1=json_decode($json);
                            $status = $data1->status;
                            if($status=="OK")
                            return $data1->results[0]->formatted_address;
                            else
                            return false;
                            }
                    $ids = $_GET['id'];
                    $this->db->where('cam_id',  $ids);
                    $this->db->from('tmp_prop');
                    $this->db->select('*');
                    $select = $this->db->get();
                    $allassets =  0; 
                    if ($select->num_rows > 0){ // records found
                    
                     $allassets =  1; 
                   }
?>
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
		
		top: 0;
                left: 0;
		width: 75%;
                background-color: #FFF;position:fixed;
overflow-x:auto;
		overflow-y:scroll;bottom:0;left:0;right:0;top:10;
z-index:9999;
		
		display: none;
		padding: 5px;
		border: 3px double #CCC;
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-box-shadow: 3px 3px 6px #666;
		-webkit-box-shadow: 3px 3px 6px #666;
	}

	#modalmsg2 {
		text-align: center;
		/* Add more style to your message */
	}

</style>

<style>
	.modal.large {
		width: 80%;
	}
</style>
<script>
function test(){
alert('The RFP has successfully been submitted to the Media Owner(s) ');
}
</script>
<div style="height:0px; width: 0px;">
	<?php 
        echo $map1['js'];
	echo $map1['html'];
	?>

</div>
<body onload="clears()">
<div class="breadcrumbs">
	<h1><span class="glyphicon glyphicon-list-alt"></span>RFP : : Process RFP</h1>
</div>
<div class="main col-xs-12">
<form method="post">
	<ul class="nav navbar-nav section-menu">
			<li ><a href="../new_campaign/ad_campaigns">My Outstanding Proposals</a></li>
			<li class="active"><a href="../new_campaign/ad_proposals">Incoming Proposals<span class="badge"><?php echo $select_query->num_rows; ?></span></a></li>
			<li><a href="../load_stock/watch_list">Sold Items<span	class="badge"><?php echo $select_query1->num_rows; ?></span></a></li>
			
		</ul>


	<div class="clear"></div>

	<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-info-sign"></span>
		Please Choose Desired Locations For Your Campaign
	</div>

	<br>
</form>
<?php
//$dataw = array();
//$dataw['angu'] = $cats;

  // $attributes = array('id' => 'campaigns');
        $data = array('onsubmit' => "test()");
        echo form_open('new_campaign/campaigns', $data);
?>
<div>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Campaign Title</th>
			<th>Campaign Budget</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Respond By Date</th>
			<th>Partial Availability</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>

               <?php 
               //start of loop
               foreach ($rfps as $amai) {
               ?>
		<tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<td><?php echo $amai->cam_title; ?><input type="hidden" name="camp_title" id="camp_title"
		                                       value="<?php echo $amai->cam_title; ?>"/></td>
		<td><strong><?php echo "R", number_format($amai->cam_budget, 2, ',', ' '); ?><input type='hidden'
		                                                                                  name='camp_budget'
		                                                                                  id="camp_budget"
		                                                                                  value="<?php echo $amai->cam_budget;; ?>"/></strong>
		</td>
	
		<td><?php echo $amai->cam_requested_start_date; ?><input type="hidden" name="start_date" id="start_date"
		                                            value="<?php echo $amai->cam_requested_start_date; ?>"/></td>
		<td><?php echo $amai->cam_requested_end_date; ?><input type="hidden" name="end_date" id="end_date"
		                                          value="<?php echo $amai->cam_requested_end_date; ?>"/></td>
		<td><?php echo $amai->cam_requested_response_date; ?><input type="hidden" name="respond_date" id="respond_by"
		                                            value="<?php echo $amai->cam_requested_response_date; ?>"/></td>
		<td><?php
			if ($amai->partial_availability = "") {
				echo $amai->cam_partial_availability_status;
			} else {
				echo 'NO';
			}
			?><input type="hidden" name="partial_availability"
		                                              id="partial_availability"
		                                              value="<?php echo $amai->cam_partial_availability_status; ?>"/></td>
		<td><?php echo $amai->cam_description; ?><input type="hidden" name="campaign_desc" id="campaign_desc"
		                                               value="<?php echo $amai->cam_description; ?>"/></td>
		</tr>
                
                
                
               <?php 
               }
               //end of loop
               ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</tbody>
	</table>
</div>


<div class="row">
	<div class="col-xs-4">
		<p>
			<label for="first_name">Locations Required</label>

		</p>
	</div>
</div>
<div>
	<table class="table table-striped" id="rfp_locations">
		<thead>
		<tr>
			<th>Media Type</th>			
			
			<th>Asset Sizes</th>
			<th>Address</th>
			<th>Proximity</th>
                        <th>Added Assets</th>
                        <th></th>


		</tr>
		</thead>
		<tbody>


		<?php if (!empty($rfp_det)) {
				
                           foreach ($rfp_det as $data) {
                            $this->db->where('campaign_transaction.cam_latitude', $data->cam_latitude);
                            $this->db->where('campaign_transaction.cam_longitude', $data->cam_longitude);
                            $this->db->where('campaign_transaction.mec_id', $data->mec_id);
                            $this->db->where('campaign_transaction.cam_id', $data->cam_id);        
                            $this->db->select('asi_description,campaign_transaction.asi_id');
                            $this->db->distinct();
                            $this->db->from('campaign_transaction');
                            $this->db->join('asset_size', 'asset_size.asi_id = campaign_transaction.asi_id');
                            $select_query4 = $this->db->get();
                            $ass_size = '';
                            foreach ($select_query4->result() as $dat){
                                
                                $ass_size = $ass_size . ',' .$dat->asi_description;  
                            } 
                       ?>
                    <tr>
                        <td><?php echo $data->mec_description;?></td>
                         <td><?php echo $ass_size;?><input type="hidden" id="media_category" name="media_category" value="<?php echo $data->cam_latitude.','.$data->cam_longitude ;?>"></input></td>
                        <td><?php
                       
                            $lat= $data->cam_latitude;// 26.754347; //latitude
                            $lng= $data->cam_longitude; //81.001640; //longitude
                            $address= getaddress($lat,$lng);
                            if($address)
                            {
                            echo $address;
                            }
                            else
                            {
                            echo "Not found";
                            }
                       // echo $data->address;?>
                        
                        </td>
                        <td><?php echo "5km";?></td>
                  <?php
                  $ids = $_GET['id'];
                    $this->db->where('cam_id',  $ids);
                    $this->db->where('mec_id',  $data->mec_id);
                    $this->db->from('tmp_prop');
                    $this->db->select('*');
                    $selectd = $this->db->get();
                    
                  
                  ?>   
                       
                <td> <span class="badge"><?php echo $selectd->num_rows;?></span></td>
                 
                  
                 <!--td><button type="button" class="js-fire-modal btn btn-info" onclick="modals('<?php //echo $_GET['id']?>','<?php //echo $data->mec_id;?>','<?php //echo $data->cam_latitude;?>','<?php //echo $data->cam_longitude;?>')" >Add Assets</button></td !-->
                          
                      
                        
                      </tr>
                    <?php }$dis = '';}else{
                        $dis = '1';
                        ?>
                          <tr>
                              <td align="center" colspan="6"><font color="red"><strong>No Line Items Found</strong></font></td>
                          </tr>
                        
                    <?php }?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>


		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>
				<button type="button" onclick="javascript:window.history.back();" class="btn btn-default">Back</button>
			</td>
			<td><input name="allasset" id="allasset" type="hidden" value="<?php echo $allassets;?>">
                            <button type="button" onclick="submits(<?php echo $_GET['id'];?>)" class="btn btn-success">Accept Proposals</button>
			    <button type="button" onclick="submits(<?php echo $_GET['id'];?>)" class="btn btn-success">View this Proposal</button>
			
                        </td>


		</tr>
		</tbody>
	</table>
</div>
<?php echo form_close(); ?>

<!--Main -->
<?php if (!empty($rfp_det)) {
	foreach ($rfp_det as $data) {
            ?>
<div class="modal fade" id="<?php echo $data->mec_id;?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" >
 <div class="modal-dialog" id="mo" style="width: 75%">           
     <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title" id="myModalLabel"><h3>Asset List</h3></h4>
                    </div>
                       <div class="row">
    <div class="col-sm-6"> 
        
        
        <label for="first_name">Select Media Owner</label>   
        <select name="mef_id[]" id="mef_id" data-placeholder="Type Media Family" style="width:80%;" tabindex="1">
        <?php
               $this->db->where('ust_id', '2');        
                $this->db->select('use_id, use_username');
                $this->db->from('user');
                $select_query = $this->db->get();
                $arry1 = array();
               if (isset($_GET['mef_id'])){
                $arry1 = $_POST['mef_id'];
               } 
            foreach ($select_query->result() as $row) {?>
              <option <?php for($i=0;$i<count($arry1);$i++){
                                 if ($arry1[$i] == $row->use_id){ echo 'Selected';}
                              } ?> value="<?php echo $row->use_id;?>"  ><?php echo $row->use_username;?></option>
			<?php }
			?>
         </select>
            <br>
            <br>
            <br>
            <div class="wrapper">
            <div class="modal-body">
                        <div id="campaign_map_canvas" style="width: 100%; height: 350px"></div>
                        <div id="imgs" style="width: 150px; height: 150px">
                            <div><h4>Uploaded Images</h4></div>
                            <div class="row">
                            <div width="50">
                              <a class="thumbnail" href="#">
                                <img src="<?php echo base_url();?>assets/map.jpg">
                              </a>
                            </div>
                         </div>
                        </div>
                        <br>
                        <div id="campaign_images" style="width: 100%; height: 800px;"></div>
                    </div>
                </div>
             </div>
    <div>

    <p class="col-xs-6"> 
    <h3>Add Assets to RFP List </h3>

    </p>
    <table  id="rfp_locations">
    <thead>
    <tr>
    <th>Asset Name</th>
    <th>Media Owner</th>
    <th>Rate</th>
    <th>Add/Remove Asset</th>
            </tr>
    </thead>
    <tbody>


    <?php 
    
                $this->db->where('asset.mec_id', $data->mec_id);
               $this->db->from('asset');
                $this->db->join('media_category','media_category.mec_id = asset.mec_id');
                $this->db->join('user','user.use_id = asset.use_id');
                $select_query2 = $this->db->get();
                if ($select_query2->num_rows > 0){
                 // //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();
                        $i = 0;
			foreach ($select_query2->result() as $row){
    ?>
    <tr>
        <tr><td colspan="4">&nbsp;</td></tr>
    <td><?php echo $row->ass_name;?></td>
    <td><?php echo $row->use_username;?></td>
    <td> <?php echo $row->ass_production_price_SCY;?></td>
    <td align="center"><div style="display: true;" id="add<?php echo $row->ass_name;?>" name="add<?php echo $row->ass_name;?>"><img width="30px" onclick="adds('<?php echo $row->ass_production_price_SCY;?>','<?php echo $row->ass_name;?>','<?php echo $row->ass_id;?>')" height="20px" src="<?php echo base_url();?>assets/images/btnp.png"></div>
    <div style="display:none;" id="remove<?php echo $row->ass_name;?>" name="remove<?php echo $row->ass_name;?>"><img width="30px" onclick="adds1('<?php echo $row->ass_production_price_SCY;?>','<?php echo $row->ass_name;?>','<?php echo $row->ass_id;?>')" height="20px" src="<?php echo base_url();?>assets/images/btnm.png"></div></td>
    </tr>
    <tr><td colspan="4">&nbsp;</td></tr>
    <?php }$dis = '';}else{
    $dis = '1';
    ?>
    <tr>
    <td align="center" colspan="6"><font color="red"><strong>No Line Items Found</strong></font></td>
    </tr>

    <?php }?>
    <tr>
        <td colspan="4">&nbsp;</td>
   </tr>
   <tr>
    <td colspan="4">&nbsp;</td>
   </tr>

    <tr>
    <td><input name="tot" id="tot" type="hidden"></td>
    <td>Total :</td>
    <td><label id="totals">R 0.00</label></td>
      </tr>
      <tr>
    <td colspan="4">&nbsp;</td>
   </tr>
    <input name="asses" id="asses" type="hidden" >
     <tr>
    <td></td>
    <td><input type="button" name="sds" onclick="selects('<?php echo $data->cam_longitude;?>','<?php echo $data->cam_latitude;?>','<?php echo $data->mec_id;?>','<?php echo $_GET['id'];?>')" value="Add Selected Assets to RFP"></td>
    <td></td>
    </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
   </tr>
    <tr>
    <td><input name="tot" id="tot" type="hidden"></td>
    <td>Budget Remaining :</td>
    <td><label id="totals1">R <?php echo $amai->cam_budget;?></label><input name="tot1" value="<?php echo $amai->cam_budget;?>" id="tot1" type="hidden" ></td>
      </tr>
    </tbody>
    </table>                 

    </div>
         </div>
                          </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
    <?php
    
               
                $this->db->where('asset.mec_id', $data->mec_id);
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->join('auctions', 'asset.ass_id = auctions.ass_id', 'left outer');
                $this->db->join('media_category', 'asset.mec_id = media_category.mec_id');
                $this->db->join('master_medium_type', 'media_category.mam_id = master_medium_type.mam_id');
                $this->db->join('media_family', 'master_medium_type.mef_id = media_family.mef_id');
		$select_query = $this->db->get();

		if ($select_query->num_rows > 0) { //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $row) {
				$mmm[] = $row;
			}
//			print_r($data); exit();
//			return $data;

		}
    
    ?>                  
    
     </div>
            </div>
                <script>
                 var raw_markers = <?php echo json_encode($mmm);?>;
	var base_url = '<?php echo base_url();?>';
	var adsMap = false;
	function adsMapInit() {




		$('#<?php echo $data->mec_id;?>').on('shown.bs.modal', function (e) {
			var tmp_id = $(e.relatedTarget).attr('data-latLng');

			var parts = tmp_id.split(',');
			var position = new google.maps.LatLng(parts[0], parts[1]);

			var mapOptions = {
				center: position,
				zoom: 10
			};
			var campaign_map = new google.maps.Map(document.getElementById("campaign_map_canvas"), mapOptions);

                var dont_show_info = false;
		var markers = [];
		for (var i in raw_markers) {
			(function (i) {
				var marker_details = raw_markers[i]
				console.log('Ugly hack to fix missing mec_id field');
				if (!marker_details.hasOwnProperty('mec_id')) {
					marker_details.mec_id = marker_details.med_id;
				}
				var parts = marker_details.position.split(',');

				var latLng = new google.maps.LatLng(parts[0], parts[1]);
				var marker = new google.maps.Marker({
					position: latLng,
					map: campaign_map,
					type: parseInt(marker_details.mec_id),
					asset_id: marker_details.ass_id
				});
				markers.push(marker);

//				google.maps.event.addListener(marker, 'click', function () {
//
//					modalshow(marker_details.ass_id);
//				});
			})(i);

		}






			var selected_marker = new google.maps.Marker({
				position: position,
				map: campaign_map,
				icon: base_url + 'assets/mapping/images/user_marker.png'
			});
			var optOptions = {
				urlBase: base_url,
				markers: [selected_marker],
				showRadii: true,
				currentFilterCriteria: {},
				showSearchPOIButton: true,
				showFilterButton: true
			};
			var clusterOptions = {};
			var spiderOptions = {};
			var html2canvasOptions = {
				logging: true
			};
			adsMap = new AdsMap(campaign_map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);
			google.maps.event.trigger(campaign_map,'resize');

			var campaign = new AdsMap.Campaign(adsMap, {url: base_url + 'index.php/new_campaign/upload_campaign', onsuccess: function() {
				$('#<?php echo $data->mec_id;?>').modal('hide');
				alert('Succesfully posted images');
			}}, {id: tmp_id});
			$('#campaign_images').html(campaign.edit());
		});

	}
	google.maps.event.addDomListener(window, 'load', adsMapInit);



</script>
 <script type="text/javascript" language="javascript">
  $(document).ready(function() {
     
          $.post( 
             base_url + '/index.php/new_campaign/saveCampaign',
             { name: $('#campaign_desc').val(),
               budget: $('#camp_budget').val()},
             function(data) {
                $('#stage').html(data);
             }

          );
        });
        



                
                            </script>>
                <?php }} ?>
        </div>
<script>
	function modalshow(a,b) {
		var varb, width, height, padding, top, left, modalbak, modalwin;
		width = 900;
		height = 500;
		padding = 64;
		top = (window.innerHeight - height - padding) / 2;
		left = (window.innerWidth - width - padding) / 2;
            //   var fld = document.getElementById(b);
           //    varb = 0;
           //     for (var i = 0; i < fld.options.length; i++) {
          //      if (fld.options[i].selected) {
         //           varb = varb + ',' + fld.options[i].value;
         //       }
         //       }
               
		$("#modalwin").load("loadrfp?b=" + b+"&id=" + a );

		modalbak = document.getElementById("modalbak");
		modalbak.style.display = "block";

		modalwin = document.getElementById("modalwin");
		modalwin.style.top = top + "px";
		modalwin.style.left = left + "px";
		modalwin.style.display = "block";
	}
        
        function modals(id,mec_id,cam_latitude,cam_longitude) {
		var width, height, padding, top, left, modalbak, modalwin;
		width = 900;
		height = 500;
		padding = 64;
		top = (window.innerHeight - height - padding) / 2;
		left = 200;// (window.innerWidth - width - padding) / 2;
            //   var fld = document.getElementById(b);
           //    varb = 0;
           //     for (var i = 0; i < fld.options.length; i++) {
          //      if (fld.options[i].selected) {
         //           varb = varb + ',' + fld.options[i].value;
         //       }
         //       }
               
		$("#modalwin").load("loadrfp?cam_longitude=" + cam_longitude+"&cam_latitude=" + cam_latitude+"&id=" + id+"&mec_id=" + mec_id );

		modalbak = document.getElementById("modalbak");
		modalbak.style.display = "block";

		modalwin = document.getElementById("modalwin");
		modalwin.style.top = top + "px";
		modalwin.style.left = left + "px";
		modalwin.style.display = "block";
	}
        
	function modalhide() {
		document.getElementById("modalbak").style.display = "none";
		document.getElementById("modalwin").style.display = "none";
	}

</script>
<div id='modalbak' ></div>
<div id='modalwin' >


</div>



<!-- Mapping Requirements -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/mapping/css/mapping_styles.css">
<!-- Maps already loaded from php -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMapRFC.js"></script>
<script>

	function deleteRow(r) {
		var i = r.parentNode.parentNode.rowIndex;
		document.getElementById("rfp_locations").deleteRow(i);
	}

	function mezmerize(address, lat, lon) {
		var table = document.getElementById("rfp_locations");
		var row = table.insertRow(3);
		var cell1 = row.insertCell(-1);
		var cell2 = row.insertCell(0);
		var cell3 = row.insertCell(1);
		var cell4 = row.insertCell(2);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(3);

		cityCell = '<div id="mineCity"></div>';
		btn = '<input type="button" value="Delete Location" class="btn btn-danger" onclick="deleteRow(this)">';
		proxBtn = '<input type="text"  id="proximity" name="proximity" class="form-control" placeholder="No Proximity Sprcified" readonly />';
		myLat = '<input type="hidden"  id="lat[]" name="lat[]" value="' + lat + "," + lon + '"/>';
		myStreetAdd = '<input type="hidden"  id="streetAdd[]" name="streetAdd[]" value="' + address + '"/>';
		viewMap = '<button type="button" class="js-fire-modal btn btn-info" data-toggle="modal" data-target="#mapModal" data-latLng="' + lat + ',' + lon + '">View Map</button>';
		myDiv = '<div id="hepano"></div>';
		myCountry = address.substr(address.lastIndexOf(",") + 1);
		//myLattitude = '<input type="hidden" value="+lat+" class="btn btn-danger" onclick="deleteRow(this)">';
		cell1.innerHTML = address + myStreetAdd;
		// $("#mineCity").load("city_cell?c=" + "address");
		cell2.innerHTML = myCountry;
		cell3.innerHTML = btn;
		cell5.innerHTML = proxBtn + myLat; //+ myStreetAdd;
		// cell5.innerHTML = myLat;
		cell4.innerHTML = viewMap;
		cell6.innerHTML = " <strong>lat:</strong> " + lat + "\n <strong>lon:</strong> " + lon;
		//$("#hepano").load("dynamic_table?c=" + document.getElementById('cit_id').value);

		//remember to reset the search box after populating the table

	}
function adds(a,b,c){
  var tot;
  var tot1;

tot = ( document.getElementById("tot").value * 1 ) + ( a * 1);  
tot1 = ( document.getElementById("tot1").value * 1 ) - ( a * 1); 
document.getElementById("tot").value = tot;
document.getElementById("tot1").value = tot1;
document.getElementById("totals").innerHTML = tot;
document.getElementById("totals1").innerHTML = tot1;
var str = document.getElementById("asses").value + ','+c;
document.getElementById("asses").value = str;
document.getElementById('remove'+b).style.display = "block";
document.getElementById('add'+b).style.display = "none";
   
}

function adds1(a,b,c){
 var tot;
 var tot1;

 tot = ( document.getElementById("tot").value * 1 ) - ( a * 1); 
 tot1 = ( document.getElementById("tot1").value * 1 ) + ( a * 1); 
 
document.getElementById("tot").value = tot;
document.getElementById("tot1").value = tot1;
document.getElementById("totals").innerHTML = tot;
document.getElementById("totals1").innerHTML = tot1;
var str = document.getElementById("asses").value;
var res = str.replace(','+c, ""); 
document.getElementById("asses").value = res;
document.getElementById('remove'+b).style.display = "none";
document.getElementById('add'+b).style.display = "block";   
  
}   

function selects(a,b,c,d){
    values = document.getElementById("asses").value;
    if (values != ''){
    location.href="../new_campaign/add_assets?assets="+values+"&cam_longitude="+a+"&cam_latitude="+b+"&mec_id="+c+"&id="+d;
    }else{
        
        alert("Please Select Assets");
        
    }
    
}

function submits(a){
    allvalues = document.getElementById("allasset").value;
    if (allvalues != '0'){
    location.href="../new_campaign/submit_assets?p=campaigns&id="+a;
    }else{
        
        alert("Please Select Assets");
        
    }
    
}

function clears(){
    
 document.getElementById("asses").value = '';   
    
}
</script>