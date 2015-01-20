<?php //var_dump($angu_macats);  

//foreach ($angu_macats as $data) {
//	$cats[] = $this->media_category->getIDs($data);
//}
?>
<style>
	.modal.large {
		width: 80%;
	}
</style>
<div style="height:0px; width: 0px;">
	<?php //echo $map1['js'];
	//echo $map1['html'];
	?>

</div>
<body>
<div class="breadcrumbs">
	<h1><span class="glyphicon glyphicon-list-alt"></span>RFP :: Incoming Request For Proposals</h1>
</div>
<div class="main col-xs-12">
<form method="post">
	<ul class="nav navbar-nav section-menu">
		<li class="active"><a href="#">Incoming Quotations</a></li>
		<li><a href="#">Accepted Proposals</a></li>
                <li><a href="../new_campaign/campaigns">New Request For Proposals</a></li>
	</ul>


	<div class="clear"></div>

	<div class="alert alert-info" role="alert">
		
	</div>

	<br>
</form>
<?php
//$dataw = array();
//$dataw['angu'] = $cats;

echo form_open('new_campaign/campaignSummary');
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
                        <th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
                    <?php
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
			if ($amai->cam_partial_availability_status = "") {
				echo $amai->cam_partial_availability_status;
			} else {
				echo 'NO';
			}
			?><input type="hidden" name="partial_availability"
		                                              id="partial_availability"
		                                              value="<?php echo $amai->cam_partial_availability_status; ?>"/></td>
		<td>
                 <?php
                    //$this->db->where('cam_id',  $a);
                 $processed = '0';
                    $this->db->where('pro_status_id',  $amai->cam_status);
                    $this->db->from('proposal_status');
                    $this->db->select('*');
                    $select4 = $this->db->get();
                    if ($select4->num_rows > 0){ // records found
                    foreach ($select4->result() as $ro){
                     echo $status =  $ro->prs_description; 
                     $processed = '1';
                   } }else{
                     echo 'Submited To Operator';
                     
                      }?>
                
                </td>
                <td><a href="../new_campaign/campaigns2?id=<?php echo $amai->cam_id; ?>" class="btn btn-default"  >Process Quotations</a></td>
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




		</tbody>
	</table>
</div>
<?php echo form_close(); ?>

<!--Main -->

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog" style="width: 75%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel">View Location Map</h4>
			</div>
			<div class="modal-body">
				<div id="campaign_map_canvas" style="width: 100%; height: 500px"></div>
				<div id="campaign_images" style="width: 100%; height: 800px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
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



	var base_url = '<?php echo base_url();?>';
	var adsMap = false;
	function adsMapInit() {




		$('#mapModal').on('shown.bs.modal', function (e) {
			var tmp_id = $(e.relatedTarget).attr('data-latLng');

			var parts = tmp_id.split(',');
			var position = new google.maps.LatLng(parts[0], parts[1]);

			var mapOptions = {
				center: position,
				zoom: 10
			};
			var campaign_map = new google.maps.Map(document.getElementById("campaign_map_canvas"), mapOptions);


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
				$('#mapModal').modal('hide');
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
                //$('#stage').html(data);
             }

          );
        });
   </script>