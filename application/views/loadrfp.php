<style>
    html, body, #map-canvas {
        height: 500px;
        margin: 0px;
        padding: 0px
    }

    </style>

<?php              
 if (isset($_GET['mec_id'])){
                
                $this->db->where('asset.mec_id', $_GET['mec_id']);
                
                }            
if (isset($_POST['filter'])){
                
                $this->db->where('asset.use_id', $_POST['mef_id']);
                
                }
                
                $this->db->select('position, asset.mec_id,asset.ass_id ');
                $this->db->from('asset');
                $this->db->join('media_category','media_category.mec_id = asset.mec_id');
                $this->db->join('user','user.use_id = asset.use_id');
                $select_query2 = $this->db->get();
                if ($select_query2->num_rows > 0){
                 // //echo "tapinda tapinda amai niyasha. musabaika bus service";exit();
                        $i = 0;
			foreach ($select_query2->result() as $row){
				$mmm[$i]=$row;
                                $i = $i + 1;
			}
                        
                        }


                if (isset($_GET['mec_id'])){
                
                $this->db->where('asset.mec_id', $_GET['mec_id']);
                
                }
                if (isset($_POST['filter'])){
                
                $this->db->where('asset.use_id', $_POST['mef_id']);
                
                }
                
                
                $this->db->from('asset');
                $this->db->join('media_category','media_category.mec_id = asset.mec_id');
                $this->db->join('user','user.use_id = asset.use_id');
                $select_query2 = $this->db->get();
                
?>
<!DOCTYPE html>
<html>
<head>
<body  >
<div class="modal-header">
            <button type="button" onclick="modalhide1()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><label id="ass_name">Asset Details</label></h4>
          </div>
        <div class="row">
    <div class="col-sm-6"> 
        
        
        <label for="first_name">Select Media Owner</label>   
        <select name="mef_id" id="mef_id" data-placeholder="Type Media Family" style="width:80%;" tabindex="1">
        <?php
               $this->db->where('ust_id', '2');        
                $this->db->select('use_id, use_username');
                $this->db->from('user');
                $select_query = $this->db->get();
                $arry1 = array();
                $this->db->distinct();
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
                        <div id="map-canvas" style="width: 100%; height: 500px"></div>
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
    <form >
    <table  id="rfp_locations">
    <thead>
    <tr>
    <th>Asset Name</th>
    <th>Media Owner</th>
    <th>Rate</th>
    <th>Add</th>
    <th>Remove Asset</th>
            </tr>
    </thead>
    <tbody>


    <?php
     if ($select_query2->num_rows > 0) {

    foreach ($select_query2->result() as $data) {
    ?>
    <tr>
    <td><?php echo $data->ass_name;?></td>
    <td><?php echo $data->use_username;?></td>
    <td> <?php echo $data->ass_production_price_SCY;?></td>
    <td><img width="30px" onclick="adds('<?php echo $data->ass_production_price_SCY;?>','<?php echo $data->ass_name;?>','<?php echo $data->ass_id;?>')" height="20px" src="<?php echo base_url();?>assets/images/btnp.png"></td>
    <td>|<img width="30px" onclick="adds1('<?php echo $data->ass_production_price_SCY;?>','<?php echo $data->ass_name;?>','<?php echo $data->ass_id;?>')" height="20px" src="<?php echo base_url();?>assets/images/btnm.png"></td>
<td>|<input type="checkbox" disabled id="<?php echo $data->ass_name;?>"></td>

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


    </tr>
        <tr>
    <td></td>
    <td></td>
    <td></td>


    </tr>
        <tr>
    <td></td>
    <td></td>
    <td></td>


    </tr>
    <tr>
    <td><input name="tot" id="tot" type="hidden"><input name="asses" id="asses" type="hidden"></td>
    <td>Total :</td>
    <td><label id="totals">R 0.00</label></td>
    



    </tr>
    
     <tr>
    <td></td>
    <td><input type="button" name="sds" onclick="selects('<?php echo $_GET['cam_longitude'];?>','<?php echo $_GET['cam_latitude'];?>','<?php echo $_GET['mec_id'];?>','<?php echo $_GET['mec_id'];?>','<?php echo $_GET['id'];?>')" value="Add Selected Assets to RFP"></td>
    <td></td>
    



    </tr>
    </tbody>
    </table>                 
    </form>
    </div>
         </div>
         
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    </body>
</html>
<script>

function modalhide1(){
  document.getElementById("modalbak").style.display = "none";
  document.getElementById("modalwin").style.display = "none";
}

function adds(a,b,c){
  var tot;
if (document.getElementById(b).checked == true){
    
}else{
tot = ( document.getElementById("tot").value * 1 ) + ( a * 1);  
document.getElementById("tot").value = tot;
document.getElementById("totals").innerHTML = tot;
var str = document.getElementById("asses").value + ','+c;
document.getElementById("asses").value = str;
document.getElementById(b).checked = true;
}   
}

function adds1(a,b,c){
 var tot;
if (document.getElementById(b).checked == true){
 tot = ( document.getElementById("tot").value * 1 ) - ( a * 1);  
document.getElementById("tot").value = tot;
document.getElementById("totals").innerHTML = tot;
var str = document.getElementById("asses").value;
var res = str.replace(c, ""); 
document.getElementById("asses").value = res;
document.getElementById(b).checked = false;   
}else{

}   
}   
    


  </script>

  <!-- Mapping Requirements -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mapping/css/mapping_styles.css">
<!-- Maps already loaded from php -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMapRFC.js"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA5bJNyTu51BbOwopYMiV93RkuPO1yoSqA&sensor=false"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMap.js"></script>
<script type="text/javascript">
	var raw_markers = <?php echo json_encode($mmm);?>;
	var base_url = '<?php echo base_url();?>';
	var adsMap = false;
	function initialize() {
		console.log('Initializing AdsMap');
		var mapOptions = {
			center: new google.maps.LatLng(-26.2044, 28.0456),
			zoom: 6
		};
		var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

		//Load markers
		var dont_show_info = false;
		var markers = [];
		for (var i in raw_markers) {
			(function (i) {
				var marker_details = raw_markers[i]
				console.log('Ugly hack to fix missing mec_id field');
				if (!marker_details.hasOwnProperty('mec_id')) {
					marker_details.mec_id = marker_details.med_id;
				}
				var position_parts = marker_details.position.split(',');

				var latLng = new google.maps.LatLng(position_parts[0], position_parts[1]);
				var marker = new google.maps.Marker({
					position: latLng,
					map: map,
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
			var optOptions = {
			urlBase: base_url,
			markers: markers,
			showRadii: false,
			showSearchPOIButton: function() {
				disableListener = true;
				adsMap.add_message('Please click on the map.', 10);
				adsMap.search_poi(false, function() {
					disableListener = false;
				});
				return false;
			},
			showFilterButton: function() {
				disableListener = true;
				adsMap.add_message('Please click on the map.', 10);
				adsMap.filter_markers_in_radius(false, function() {
					disableListener = false;
				});
				return false;
			}
		};
		var clusterOptions = {};
		var spiderOptions = {
			keepSpiderfied: true
		};
		var html2canvasOptions = {
			logging: true
		};
		adsMap = new AdsMap(map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);
		//Now add the click events to the markers
		document.addEventListener('AdsMaploaded', function(e) {
			adsMap.spider.addListener('click', function(clicked_marker) {
				modalshow(clicked_marker.asset_id);
			});
		}, false);


		/** Autocomplete Places */
		var input = document.getElementById('myPlaceTextBox');
		var image = base_url + 'assets/mapping/images/user_marker.png';
		var marker_location = new google.maps.Marker({
			map: map,
			draggable: true,
			icon: image,
			animation: google.maps.Animation.DROP,
			visible: false
		});
		var autoCompleteOnChange = function () {
			var geocoder = new google.maps.Geocoder();
			var address = document.getElementById("myPlaceTextBox").value;

			geocoder.geocode({ "address": address }, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {

					$("#location").parent().removeClass("has-error");
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					$("#latitude").val(latitude);
					$("#longitude").val(longitude);
					marker_location.setVisible(true);
					marker_location.setPosition(results[0].geometry.location);
					console.log(results[0].geometry.location);
					map.setCenter(new google.maps.LatLng(latitude, longitude), 9);
					map.setZoom(9);
					google.maps.event.addListener(marker_location, "dragend", function (event) {
						latitude = this.getPosition().lat();
						longitude = this.getPosition().lng();
						$("#latitude").val(latitude);
						$("#longitude").val(longitude);
					});
				} else {
					alert("Request failed.")
					$("#location").parent().addClass("has-error");
				}
			});

		}
                
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);
		google.maps.event.addListener(autocomplete, 'place_changed', autoCompleteOnChange);
	}
	google.maps.event.addDomListener(window, 'load', initialize);

	function search_poi() {
		adsMap.add_message('Please click on the area where you would like to search.', 10);
		adsMap.search_poi();
	}
        
        function selects(a,b,c,d,e){
     values = document.getElementById("asses").value;
     
    if (values != ''){
    location.href="campaigns1?cam_longitude="+a+"&cam_latitude="+b+"&mec_id="+c+"&mec_id="+d+"&id="+e;
    }else{
        
        alert("Please Select Assets");
    }
    
}

</script>
<script>
<?php echo "initialize();";?>

</script>

<script>
	function modalshow(a) {
		var width, height, padding, top, left, modalbak, modalwin;
		width = 900;
		height = 500;
		padding = 64;
		top = (window.innerHeight - height - padding) / 2;
		left = (window.innerWidth - width - padding) / 2;


		$("#modalwin").load("loadajax?c=" + a +"&p=asset_details3");

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