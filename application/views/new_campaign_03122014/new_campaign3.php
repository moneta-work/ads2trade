<?php error_reporting(0); ?>
<script>
function test(){
alert('Thank you for generating the Request For Proposal (RFP). The RFP has been submitted to the Operator who will be in touch with you shortly');
}
</script>
<style>
      #modalbak1{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:black; 
  display:none; 
  opacity:0.60; 
  z-index:9;
}
#mapModal{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:700px; 
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

<div style="height:0px; width: 0px;">
   

</div>
<body onload="load()">
    <div class="breadcrumbs">
        <h1><span class="glyphicon glyphicon-list-alt"></span>RFP : : Create A New Campaign</h1>
    </div>
    <div class="main col-xs-12">
        <form method="post">
            <ul class="nav navbar-nav section-menu">
                <li class="active"><a href="#">Search</a></li>
                <li><a href="#">Your Active Bids<span class="badge"><?php echo '0'; ?></span></a></li>
                <li><a href="#">Watch List<span class="badge"><?php echo '2'; ?></span></a></li>
                <li><a href="#">Won Bids</a></li>
                <li><a href="#">Lost Bids</a></li>
            </ul>


            <div class="clear"></div>

            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-info-sign"></span>
                Please Make Budget Allocations and Choose Sizes for your Media Types </div>

            <br>
        </form>
           <?php
        $attributes = array('id' => 'newCampaign1');
        $data = array('onsubmit' => "test()");
        echo form_open('new_campaign', $data);
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
                <td><?php echo $camp_title ?><input type="hidden" name ="camp_title" id="camp_title" value="<?php echo $camp_title ?>" /></td>
                <td><strong><?php echo $camp_budget; ?><input type='hidden' name='camp_budget' id="camp_budget" value="<?php echo $camp_budget; ?>" /></strong></td>
                <td><input type="hidden" name="media_types" id="media_types" value="<?php print_r($makaipa);?>"/><?php
 
                foreach($makaipa as $data){
                    echo $data;
                }
               
    
    ?></td>
                <td><?php echo $start_date; ?><input type="hidden" name="start_date" id="start_date" value="<?php echo $start_date; ?>"/></td>
                <td><?php echo $end_date; ?><input type="hidden" name="end_date" id="end_date" value="<?php echo $end_date; ?>"/></td>
                <td><?php echo $respond_by; ?><input type="hidden" name="respond_by" id="respond_by" value="<?php echo $respond_by; ?>"/></td>
                <td><?php
                    if (isset($partial_availability)) {
                        echo 'YES';
                    } else {
                        echo 'NO';
                    }
    ?><?php echo $partial_availability; ?><input type="hidden" name="partial_availability" id="partial_availability" value="<?php echo $partial_availability; ?>"/></td>
                <td><?php echo $campaign_desc ?><input type="hidden" name="campaign_desc" id="campaign_desc" value="<?php echo $campaign_desc; ?>"/></td>
                </tr>
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


   <div>
       
         <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-info-sign"></span>
                Campaign Details </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Media Type</th>
                        <th>Area</th>
                        <th>Size Options</th>
                        <th>Rate Options</th>
                       
                    </tr>
                </thead>
                <tbody>

                    <tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                          
                        
                    </tr>
                    <?php for ($i = 0; $i < count($maPosition); $i++) {
                           foreach ($makaipa as $data) {
                       ?>
                    <tr>
                        <td><?php echo strtoupper($data);?><input type="hidden" id="media_category" name="media_category" value="<?php echo $data;?>"></input></td>
                        <td><?php echo $street_addresses[$i];?></td>
                        <td><?php echo "<a class='js-fire-modal btn btn-info' type='submit' data-toggle='modal' href='#' name='size_button'  onClick='sizeModal()'>>>></a>";?></td>
                        <td><?php echo "<a href='change_budget'>auto</a>";?></td>
                      </tr>
                    <?php }}?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="btn btn-default">Back</button></td>
                    <td><button type="submit" class="btn btn-success" >Submit RFP</button></td>
                   
                    
                </tr>
                </tbody>
            </table>
        </div>     
       
<?php echo form_close(); ?>

        <!--Main -->
        <div id="modalbak1" ></div>
        <div  id="mapModal">
          
        </div>
<script>
	function sizeModal(a) {
                //alert(a);
		var width, height, padding, top, left, modalbak, modalwin;
		width = 900;
		height = 500;
		padding = 64;
		top = (window.innerHeight - height - padding) / 2;
		left = (window.innerWidth - width - padding) / 2;


		$("#mapModal").load("city_cell?c="+a);

		modalbak = document.getElementById("modalbak1");
		modalbak.style.display = "block";

		modalwin = document.getElementById("mapModal");
		modalwin.style.top = top + "px";
		modalwin.style.left = left + "px";
		modalwin.style.display = "block";
	}
	function modalhide() {
		document.getElementById("modalbak1").style.display = "none";
		document.getElementById("mapModal").style.display = "none";
	}

</script>
