<html>
    <head>

</head>
<?php 
if ($_GET['p'] != '' ){
$p = $_GET['p'];
}
if ($p = ''){
 $p = '../my_stock/index';       
}
?>
  <body  >
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span>Auctions</h1>
        </div>


        <form method="post" class="main col-xs-12">

          <ul class="nav navbar-nav section-menu">
            <li class="active"><a href="auctions.php">Search</a></li>
            <li><a href="active_bids.php">Your Active Bids<span class="badge">6</span></a></li>
            <li><a href="active_bids.php">Watch List<span class="badge">6</span></a></li>
            <li><a href="active_bids.php">Won Bids</a></li>
            <li><a href="active_bids.php">Lost Bids</a></li>
          </ul>


          <div class="clear"></div>

            <div class="alert alert-info" role="alert">
              <span class="glyphicon glyphicon-info-sign"></span>
              Select the media type and use the map to point the locations that you prefer</div>
          
              <br>
              <div class="row">
                <div class="col-xs-4">
                  <p>
                    <label for="first_name">Media Type Required</label>                         
                    <select data-placeholder="Type Media Type" style="width:100%;" multiple class=" chosen-select" tabindex="8">
                      <option value="0">Billboards</option>
                      <option value="3">Media Type 2</option>
                      Media Type Required<option value="1">Media Type 3</option>
                      <option  value="2">Media Type 4</option>
                      <option value="4">Media Type 5</option>
                      <option value="5">Media Type 6</option>
                    </select>
                  </p>

                  <p>
                    <label for="first_name">Location</label>                         
                    <select name="ast_id" id="ast_id" class="form-control">
                      <option value="0">Ranburg</option>
                      <option value="3">Area 2</option>
                      <option value="3">Area 3</option>
                      <option value="3">Area 4</option>
                      <option value="3">Area 5</option>
                      <option value="3">Area 6</option>
                    </select>
                  </p>

                  <p>
                    <label for="first_name">Duration</label>                         
                    <select name="ast_id" id="ast_id" class="form-control">
                      <option value="0">1 Month</option>
                      <option value="0">1 Day</option>
                      <option value="0">1 Year</option>
                    </select>
                  </p>

                  <div class="row">
                    <p class="col-xs-6">
                      <label for="first_name">From Date</label>                           
                      <input type="text" vname="first_name" id="first_name" class="form-control">
                    </p>
                    <p class="col-xs-6">
                      <label for="first_name">To Date</label>                           
                      <input type="text" vname="first_name" id="first_name" class="form-control">
                    </p>
                  </div>

                  <p>
                    <label for="first_name">Proximity Filter</label>                         
                    <ul class="list-unstyled list-group">
                      <li class="list-group-item">
                        <input type="checkbox" checked="checked" name="">
                        12.94383E 21.245S Bryanston
                        <span class="pull-right small"><a href="#">Remove</a></span>
                      </li>
                      <li class="list-group-item"><input type="checkbox" checked="checked" name=""> 12.94383E 21.245S Bryanston</li>
                      <li class="list-group-item"><input type="checkbox" name=""> 12.94383E 21.245S Bryanston</li>
                    </ul>
                  </p>

                  
                  <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Apply Filter">
                  </div>
                </div>

                <div class="col-xs-8">
                  <script>
                    var map;
                    function initialize() {
                      var mapOptions = {
                        zoom: 8,
                        center: new google.maps.LatLng(-34.397, 150.644)
                      };
                      map = new google.maps.Map(document.getElementById('map-canvas'),
                          mapOptions);
                    }

                    google.maps.event.addDomListener(window, 'load', initialize);

                  </script>
                  <div class="map_wrap">
                    <div id="map-canvas"></div>
                  </div>
                </div>
              </div>
              
              <br>
              <br>
            

            

        </form><!--Main -->

 <style>
      #modalbak{
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
#modalwin{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:250px; 
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
<div id='modalbak'></div>
<div id='modalwin' >
    <div class="modal-header">
            <label></label><h4 class="modal-title" id="myModalLabel"><label id="ass_name">Record Captured Successfully</label></h4>
          </div>
    <div class="modal-body">
        <div>Transaction successful </div>
        <br>
        <br>
           <div  class="col-xs-8">
        
              <div class="form-group">
                <div class="input-group">
                    <a href="<?php echo $p;?>"  class="input-group-addon btn btn-primary">Create Another Transaction</a>&nbsp;
                 <a href="../navigate/index"  class="input-group-addon btn btn-primary">Exit Transaction</a>
                </div>
              </div>

            </div>
    </div>
           
 </div>      
 
 </div>
</body>
</html>
<script>
  function modalshow(){

  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
  
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
  <?php 
echo "modalshow();";

?>
  </script>