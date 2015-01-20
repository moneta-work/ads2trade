<?php //var_dump($angu_macats);  

//foreach ($angu_macats as $data) {
	//$cats[] = $this->media_category->getIDs($data);
//}


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
		position: fixed;
		top: 0;
                overflow-y:hidden;
                overflow-x:hidden;
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
<body>
<div class="breadcrumbs">
	<h1><span class="glyphicon glyphicon-list-alt"></span>RFP : : Process RFP</h1>
</div>
<div class="main col-xs-12">
<form method="post">
	<ul class="nav navbar-nav section-menu">
		<li><a href="#">User Management</a></li>
		<li><a href="#">Auctions</a></li>
		<li><a href="#">Settings</a></li>
                <li><a href="#">Invoice Management</a></li>
                <li><a href="#">News Feeds</a></li>
                <li class="active"><a href="#">Request For Proposals</a></li>
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
			<th>Media Type Required</th>
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
		<td><?php echo $amai->title; ?><input type="hidden" name="camp_title" id="camp_title"
		                                       value="<?php echo $amai->title; ?>"/></td>
		<td><strong><?php echo "R", number_format($amai->budget, 2, ',', ' '); ?><input type='hidden'
		                                                                                  name='camp_budget'
		                                                                                  id="camp_budget"
		                                                                                  value="<?php echo $amai->budget;; ?>"/></strong>
		</td>
		<td>
                    <input type="hidden" name="media_types" id="media_types"
		           value="<?php //echo htmlentities(serialize($angu_macats)); ?>"/><?php
			$this->db->where_in("mec_id", explode(',',$amai->ast_id));
                        $this->db->from('media_category');
                        $select_query = $this->db->get();
                        if ($select_query->num_rows > 0){ 
                        $count = $select_query->num_rows;
                        $i = 0;
                        foreach ($select_query->result() as $rows){
                            $i = $i + 1;
                            if ($count == $i ){
                             $comma = '';   
                            }else{
                              $comma = ', ';  
                            }
				echo strtoupper($rows->mec_description), $comma;
                                
			}
                        
                        }
			?>
                
                </td>
		<td><?php echo $amai->start_date; ?><input type="hidden" name="start_date" id="start_date"
		                                            value="<?php echo $amai->start_date; ?>"/></td>
		<td><?php echo $amai->end_date; ?><input type="hidden" name="end_date" id="end_date"
		                                          value="<?php echo $amai->end_date; ?>"/></td>
		<td><?php echo $amai->respond_date; ?><input type="hidden" name="respond_date" id="respond_by"
		                                            value="<?php echo $amai->respond_date; ?>"/></td>
		<td><?php
			if ($amai->partial_availability = "") {
				echo $amai->partial_availability;
			} else {
				echo 'NO';
			}
			?><input type="hidden" name="partial_availability"
		                                              id="partial_availability"
		                                              value="<?php echo $amai->partial_availability; ?>"/></td>
		<td><?php echo $amai->camp_descriptor; ?><input type="hidden" name="campaign_desc" id="campaign_desc"
		                                               value="<?php echo $amai->camp_descriptor; ?>"/></td>
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
			<th>View Map</th>
			<th>GPS Coordinates</th>
			<th>Address</th>
			<th>Proximity</th>
                        <th>Select Media Owner</th>
                        <th>Added Assets</th>


		</tr>
		</thead>
		<tbody>


		<?php if (!empty($rfp_det)) {
				
                           foreach ($rfp_det as $data) {
                       ?>
                    <tr>
                        <td><?php echo $data->mec_description;?></td>
                        <td><button type="button" class="js-fire-modal btn btn-info" data-toggle="modal" data-target="#mapModal" data-latLng="-25.746111,28.18805599999996">View Map</button></td>
                        <td><?php echo strtoupper($data->position);?><input type="hidden" id="media_category" name="media_category" value="<?php echo $data->position;?>"></input></td>
                        <td><?php echo $data->address;?></td>
                        <td><?php echo "5km";?></td>
                      
                        <td> <select name="cat_id[]" id="<?php echo $data->mec_id;?>"  data-placeholder="Select Media Owner" style="width:200px;" multiple class=" chosen-select" tabindex="8">
                    
                    <?php
                        $this->db->where("mec_id", $data->mec_id);
                        $this->db->select('use_username,user.use_id');
                        $this->db->join('user','user.use_id = asset.use_id');
                        $this->db->from('asset');
                        $select_query = $this->db->get();
                        foreach ($select_query->result() as $row1){
                        echo "<option value=\"$row1->use_id\"  >$row1->use_username</option>";
                        }
                    ?>
                </select></td>
                <td> <?php 
                    $assets = '';
                    $coun = 0;
                        $this->db->where_in("ass_id", explode(',',$amai->p_assets));
                        $this->db->where_in("mec_id", $data->mec_id);
                        $this->db->from('asset');
                        $this->db->select('*');                        
                        $select1_query = $this->db->get();
                        foreach ($select1_query->result() as $ro1){
                         $coun = $coun + 1;
                         if ($coun > 1 ){
                         $assets = $assets .','.$ro1->ass_name;    
                         
                         }else{
                         $assets = $ro1->ass_name; 
                         }  
                        }
                
                echo $assets;?> </td>
                
                 <td><button type="button" class="js-fire-modal btn btn-info" onclick="modalshow('<?php echo $_GET['id']?>','<?php echo $data->mec_id;?>')" >Add Assets</button></td>
                      
                      
                        
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
			<td>
                            <button type="submit" <?php if ($dis == 1){?> disabled <?php }?>class="btn btn-success">Submit Proposals To Media Owners</button>
			</td>


		</tr>
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
<script>
	function modalshow(a,b) {
		var varb, width, height, padding, top, left, modalbak, modalwin;
		width = 900;
		height = 500;
		padding = 64;
		top = (window.innerHeight - height - padding) / 2;
		left = (window.innerWidth - width - padding) / 2;
               var fld = document.getElementById(b);
               varb = 0;
                for (var i = 0; i < fld.options.length; i++) {
                if (fld.options[i].selected) {
                    varb = varb + ',' + fld.options[i].value;
                }
                }
               
		$("#modalwin").load("addstock?b=" + b+"&c=" + a +"&p="+varb);

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
<div id='modalbak'></div>
<div id='modalwin'>


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
                $('#stage').html(data);
             }

          );
        });
        

</script> 
        
        
        
   </script>