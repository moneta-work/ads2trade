<!DOCTYPE html>
<html>
<head>
    
<?php
$a = $_GET['c']; 
$p = $_GET['p'];
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
$asset['asset'] = $this->ajax_asset->getAsset();

if(!empty($asset['asset'])=='1'){
foreach ($asset['asset'] as $row) {

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
  var fenway = new google.maps.LatLng(<?php echo $row->position;?>);
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
<div class="modal-header">
            <button type="button" onclick="modalhide1()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><label id="ass_name">Asset Details</label></h4>
          </div>
         

    <div class="modal-body">
  <div class="row"> 
            <div  class="col-xs-3">
              <a class="thumbnail" href="auctions_details.php">
                <img src="<?php echo base_url();?>assets/add1.jpg">
              </a>
            </div>
            <div id="map-canvas" style="width: 300px; height: 190px"></div>
            <div id="pano" style="position:absolute; left:540px; top: 20px; width: 300px; height: 190px;"></div>
  </div>
  
            <div class="col-xs-12" class="row"> 
          <div >
        <table style="" class="table table-striped">  
        
        <tbody>  
                       <tr>  
            <td colspan="8"><div class="form-group">
                <div class="input-group">
                   <a href="#" onclick="modalshow3('<?php echo $row->ass_id; ?>','2')"  class="input-group-addon btn btn-primary">Watch Lists</a>&nbsp;
                  <a href="../load_stock/won_bids"  class="input-group-addon btn btn-primary">Go To My Shopping Basket</a>&nbsp;
                 <a href="spec_sheet?ass_id=<?php echo $row->ass_id;?>"  class="input-group-addon btn btn-primary">View Spec Sheet</a>
                </div>
              </div> </td>
           
          </tr>
          <tr>  
              <td><strong>Asset Name:</strong></td>  
            <td><?php echo $row->ass_name;?> </td>  
            <td><strong>Buy Now Price</strong></td>  
            <td>R <?php echo $buy_now;?></td> 
            <td><strong>Minimum Bid:</strong> </td>  
            <td>R <?php echo $minimum_bid;?></td> 
            <td><strong>Current Bid:</strong></td>
            <td>R <?php echo $current_bid;?></td>
          </tr>  
          <tr>  
            <td><strong>Ass Descrption</strong></td>  
            <td><?php echo $row->ass_description;?></td>  
            <td><strong></strong></td>  
            <td></td>  
            <td colspan="2">  
            <input  name="bid" id="bid" type="text" placeholder="Enter Bid Amount R0.00">
            <input  name="minimum" id="minimum" type="hidden" value="<?php echo $minimum_bid;?>">
            <input  name="auct_id" id="auct_id" type="hidden" value="<?php echo $auction_id;?>">
                   </td>
            <td><strong>Your Last Bid</strong></td>
            <td>R <?php echo $yobid;?></td>
          </tr>  
          <tr>  
            <td><strong>Asset Type:</strong></td>  
            <td align="left"><?php echo $ass_type;?></td>  
            <td><a href="buynow?p=<?php echo $p; ?>"  class="input-group-addon btn btn-primary" >Buy Now</a></td>  
            <td></td><td colspan="2"> <a href="#" onclick="bid_now(<?php echo $row->ass_id;?>)" class="input-group-addon btn btn-primary">Place Bid</a>
                
            </td>
            <td><strong>Increment:</strong></td>
            <td>R<?php echo $increment; ?></td>
          </tr>
                    <tr>  
            <td><strong>Asset Address:</strong></td>  
            <td colspan="2"><?php echo $row->ass_address;?></td>  
              
            <td></td><td colspan="2"> </td>
            <td><strong>Traffic Count:</strong></td>
            <td>500</td>
          </tr>
                    

         
        </tbody>  
      </table> 

                    </div>
                
               </div>
                
      
   <div  class="col-xs-8">
        
              

            </div>
             
           </div>
    </div>
 <?php }}?> 
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