
<!DOCTYPE html>
<html>
<head>
 <?php  

$a = $_GET['id']; 
$p = $_GET['b'];
$current_bid = 0;
$buy_now = 0;
$yobid = 0;
$ast_id = 0;
$minimum_bid = 0;
$increment = 0;
$current_bid = 0;
$auction_id = 0;
$ass_type = '';


if (isset($_GET['c'])){
                $ass_id =  $_GET['c'];
                $this->db->where('auctions.ass_id', $ass_id);
                $this->db->select('auctions.minimum_bid,auctions.current_bid,asset.mec_id,asset.ass_name,auctions.id,media_category.mec_description,auctions.buy_now,auctions.increment,buy_now');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id');
                $this->db->join('media_category','asset.mec_id = media_category.mec_id', 'left outer');
                $select_query = $this->db->get();
               
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$current_bid= $rows->current_bid;
                                $ass_name = $rows->ass_name;
                                $ass_type = $rows->mec_description;
                                $buy_now = $rows->buy_now;
                                $increment = $rows->increment;
                                $auction_id = $rows->id;
                              
                                if ($current_bid>0){
                                $minimum_bid = $current_bid + $increment;}else{
                                  $minimum_bid =   $rows->minimum_bid;
                                }
                                
		}
                
                }
                if (isset($auction_id) && $auction_id <> '0' ){
                $this->db->where('auction', $auction_id);
                $this->db->where('bidder', $this->session->userdata('use_id'));
                $select_query = $this->db->get('bids');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$yobid=$rows->bid;
                               
		}
                        }}
            

}
//$asset['asset'] = $this->ajax_asset->getAsset();



?>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
 <script>
function initialize() {
  var fenway = new google.maps.LatLng(-26.067732,27.935486);
  var mapOptions = {
    center: fenway,
    zoom: 14
  };
  var map = new google.maps.Map(
      document.getElementById('map-canvas'), mapOptions);
  var panoramaOptions = {
    position: fenway,
    pov: {
      heading: 34,
      pitch: 10
    }
  };
  var panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'), panoramaOptions);
  map.setStreetView(panorama);
}
<?php echo "initialize();";?>

    </script>
    
    
    <script>
    function bid_now(id){
        
   bid =  document.getElementById('bid').value * 1;
   min =  document.getElementById('minimum').value * 1;
   auct_id =  document.getElementById('auct_id').value;
   if (bid < min ){ 
   
   alert("Please Enter An Amount Greater of Equal to Minimum Bid Amount "+ min);
   return;
   }else{
       
       location.href="bid?bid="+bid+"&ass_id="+id+"&auct_id="+auct_id;
   }
    }
    
    </script>
    
    
 
</head>

<body onload="initialize()" >
<div class="modal-dialog" style="width: 100%;overflow-y:auto;overflow-x:auto;">
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
                        <div id="campaign_map_canvas" style="width: 100%; height: 500px"></div>
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
            <th>Add Asset</th>
            <th>Remove Asset</th>
                    </tr>
            </thead>
            <tbody>


            <?php if (!empty($rfp_det)) {

            foreach ($rfp_det as $data) {
            ?>
            <tr>
            <td><?php echo $data->mec_description;?></td>
            <td><?php echo $data->mec_description;?></td>
            <td><?php echo $data->mec_description;?></td>
            <td><img src="<?php echo base_url();?>assets/images/btnp.png"></td>
            <td>|<img src="<?php echo base_url();?>assets/images/btnm.png"></td>


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
            </tbody>
            </table>                 

            </div>
         </div>
                          </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                      
                </div>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    </body>
</html>

<style>
      #modalbak1{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:#333333; 
  display:none; 
  opacity:0.40; 
  z-index:9;
}
#modalwin1{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:300px; 
  background:#FFF; 
  display:none; 
  padding:5px; 
  border:3px double #CCC; 
  z-index:10;
  -moz-border-radius:6px;
  -webkit-border-radius:6px; 
  -moz-box-shadow:3px 3px 6px #666;
  -webkit-box-shadow:3px 3px 6px #666; 
}
#modalmsg{ 
  text-align:center; 
  /* Add more style to your message */
}
      
  </style>
<div id='modalbak1'></div>
<div id='modalwin1' >
    <div class="modal-header">
            <button type="button" onclick="modalhide()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <label></label><h4 class="modal-title" id="myModalLabel"><label id="ass_name">Payment Transfered to the Payment Gateway</label></h4>
          </div>
    <div class="modal-body">
        <div>Please Note You Have 2 Hours to Make the Payment, Otherwise the Asset Will be Put Back On Auction</div>
        <br>
        <br>
           <div  class="col-xs-8">
        
              <div class="form-group">
                <div class="input-group">
                 <a href="#"  class="input-group-addon btn btn-primary">Continue Buying</a>&nbsp;
                 <a href="#"  class="input-group-addon btn btn-primary">Go To My Shopping Basket</a>&nbsp;
                 <a href="#"  class="input-group-addon btn btn-primary">Exit Auctions</a>
                </div>
              </div>

            </div>
    </div>
           
 </div>      
 
 </div>
</body>
</html>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/mapping/css/mapping_styles.css">
<!-- Maps already loaded from php -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMapRFC.js"></script>
<script>
  function modalshow1(){

  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
  
  modalbak = document.getElementById("modalbak1");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin1");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";
}
function modalhide(){
  document.getElementById("modalbak1").style.display = "none";
  document.getElementById("modalwin1").style.display = "none";
}

function modalhide1(){
  document.getElementById("modalbak").style.display = "none";
  document.getElementById("modalwin").style.display = "none";
}

  </script>
  
  <script>
  function modalshow3(a,b){
  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
  $("#modalwin3").load("bid_pop?ass_id="+a+"&type="+b);
  modalbak = document.getElementById("modalbak3");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin3");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";
}
function modalhide(){
  document.getElementById("modalbak3").style.display = "none";
  document.getElementById("modalwin3").style.display = "none";
}

  </script>
  
  <div id='modalbak3'></div>
<div id='modalwin3' >
  
           
 </div> 
  
  <style>
      #modalbak3{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:#333333; 
  display:none; 
  opacity:0.40; 
  z-index:9;
}
#modalwin3{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:300px; 
  background:transparent; 
  display:none; 
  padding:5px;  
  z-index:10;
  -moz-border-radius:6px;
  -webkit-border-radius:6px; 
  -moz-box-shadow:3px 3px 6px #666;
  -webkit-box-shadow:3px 3px 6px #666; 
}

      
  </style>