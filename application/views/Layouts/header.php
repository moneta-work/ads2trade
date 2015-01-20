<!DOCTYPE html>
    <html>
<meta charset="UTF-8">
<?php
//echo $this->layouts->print_includes();

//Check if user still has a valid session
if(!$this->session->userdata('user_id')){
  //redirect('login', 'refresh');
  //exit;
  redirect(base_url());exit;
} else {
  $user_id = $this->session->userdata('user_id');
}
?>
 <head>
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/css/bootstrap.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/styles.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/css/bootstrap-checkbox.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>/css/jquery-ui.min.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>/css/jquery-ui.theme.min.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/css/select2.min.css" />
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/css/select2.css" />


        <script src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
<!--     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>-->
     <script src="<? echo base_url(); ?>assets/js/google.maps.search.josh.js"></script>

        <!-- jquery validator plugin -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
        <!-- jquery validator plugin -->
        
        <script src="<?php echo base_url();?>assets/js/bootstrap-checkbox.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/scripts.js" type="text/javascript"></script>


        <script src="<?php echo base_url();?>assets/js/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/amcharts/serial.js" type="text/javascript"></script>

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.css">
        <script src="<?php echo base_url();?>assets/js/chosen.jquery.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tmpl.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.elastislide.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/gallery.js"></script>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/elastislide.css" />


<script type="text/javascript">
    function deleteRow2(a){
            console.log(a);
            $(a).parent().remove();
    }
        
    function sizeModal2(id, b, lat, ln, medType) {
                
        //alert('Loading Sizes....');

        var width = 900 , height = 500, padding = 0, top  = (window.innerHeight - height - padding) / 5, left = (window.innerWidth - width - padding) / 2, modalbak, modalwin, a = id;

        //try other means now
        var myParams = {latitude:lat, longitude:ln, b:b, medType:medType};
        var newQueryString = jQuery.param(myParams);
        //alert(newQueryString); exit;
        //end other 
        //console.log("city_cell?"+newQueryString);

        $("#mapModal2").load("city_cell?"+newQueryString);
        modalbak = document.getElementById("modalbak1");
        modalbak.style.display = "block";

        modalwin = document.getElementById("mapModal2");
        modalwin.style.top = top + "px";
        modalwin.style.left = left + "px";
        modalwin.style.display = "block";

        //alert(modalwin.style.display);

    }

    function modalhide() {

        //alert('Closing popup');

        var mapModal2 =  document.getElementById('mapModal2');
        var mapModal =  document.getElementById('mapModal');
        var modalbak1 =  document.getElementById('modalbak1');

        if (typeof(modalbak1) != 'undefined' && modalbak1 != null)
        {
          // exists.
          document.getElementById("modalbak1").style.display = "none";
        }   
        if (typeof(mapModal) != 'undefined' && mapModal != null)
        {
          // exists.
          document.getElementById("mapModal").style.display = "none";
        }   
        if (typeof(mapModal2) != 'undefined' && mapModal2 != null)
        {
          // exists.
          document.getElementById("mapModal2").style.display = "none";
        }     

        //just in case the 'modal effect' is still in place
        //$(".modal").modal("hide");       
        
    }

    /*
    Get the latitude and longitude of a given address via google maps api
    Return: latitude and longitude in either string or array form
    */
    function getLatLongFromAddress(address, returnType){
      //returnType
      //  1 - string (default), 2 = array
      returnType = returnType || 0; //returnType to a default of 1 if not supplied

      var lattitude = "0";
      var longitude = "0";

      $.ajax({
        url:"https://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
        type: "POST",
        success:function(res){
           lattitude = res.results[0].geometry.location.lat;
           longitude = res.results[0].geometry.location.lng;
           console.log(lattitude);
           console.log(longitude);
        }
      });
      if(returnType == 1)
        return lattitude+','+longitude;
      else
        return array(lattitude, longitude);
    }

</script>
      <meta name="viewport" content="width=1024" />

  </head>
  <body>
    <div id="top_bar">
      <a href="#"><span class="glyphicon glyphicon-dashboard"></span> R<?php echo number_format($this->events->getCountUnreadMessages($user_id),2)?> (Estimate spent)</a>
      <?php echo anchor('messages/inbox', "<span class=\"badge\">".$this->events->getCountUnreadMessages($user_id)."</span> Inbox", 'title="My Messages"');?>
      <a href="#"><span class="glyphicon glyphicon-user"></span> Settings</a>
    </div>
<?php
$loc_id='';   $ast_id=''; $id="";
if (isset($_REQUEST['ass_id'])){
                $ass_id =  $_REQUEST['ass_id'];
                $this->db->where('asset.ass_id', $_REQUEST['ass_id']);
                $this->db->select('*');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id', 'left outer');
                $select_query = $this->db->get();
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$current_bid=$rows->current_bid;
                                $loc_id = $rows->loc_id;
                                $ast_id = $rows->ast_id;
                                $ass_name = $rows->ass_name;
                                $id = $rows->id;
                                $buy_now = $rows->buy_now;

		}

                }

                $this->db->where('tow_id', $loc_id);
                $select_query = $this->db->get('town');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$location=$rows->tow_description;
                        }

                }
                $this->db->where('ast_id', $ast_id);
                $select_query = $this->db->get('asset_type');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$asset_type=$rows->ast_description;
                        }

                }
}

             ?>
      <form name="form1" method="post" action="bid">
    <div class="modal fade" id="placeBid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo isset($ass_name)?$ass_name:'';?></h4>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-xs-6">
              <a class="thumbnail" href="auctions_details.php">
                <img src="<?php echo base_url();?>assets/add1.jpg">
              </a>
            </div>


            <div class="col-xs-6">
              <table class="tables">
                <tr>
                  <td width="100">Current Bid <h3 style="margin:0px; margin-bottom:10px;"><?php echo isset($current_bid)?$current_bid:'';?></h3></td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-flag"></span> <?php echo isset($location)?$location:'';?> </td>
                </tr>
                <tr>
                  <td><input type="hidden" value="<?php echo $id;?>" name="auct_id" id="bid_auct_id"><span class="glyphicon glyphicon-tag"></span><?php echo isset($asset_type)?$asset_type:'';?></td>
                </tr>
                <tr>
                  <td><input type="hidden" value="<?php echo $ass_id;?>" name="ass_id"><span class="glyphicon glyphicon-time"></span> 3 Days 8 Hrs Remaining</td>
                </tr>
              </table>

              <br>

              <div class="form-group">
                <div class="input-group">
                  <input class="form-control" name="email" id="email" type="text" placeholder="R0.00">
                  <a href="#" onclick="document.form1.submit();return false;" class="input-group-addon btn btn-primary">Place Bid</a>
                </div>
              </div>

            </div>
           </div>
          </div>
        </div>
      </div>
    </div></form>

      <form name="form2" method="post" action="buynow">
    <div class="modal fade" id="buyNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo isset($ass_name)?$ass_name:'';?></h4>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-xs-6">
              <a class="thumbnail" href="auctions_details.php">
                <img src="<?php echo base_url();?>assets/add1.jpg">
              </a>
            </div>
            <div class="col-xs-6">
              <table class="tables">
                <tr>
                  <td width="100">Buy Now Price <h3 style="margin:0px; margin-bottom:10px;"><?php echo isset($buy_now)?$buy_now:'';?></h3></td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-flag"></span><?php echo isset($location)?$location:'';?></td>
                </tr>
                <tr>
                  <td><input type="hidden" value="<?php echo $id;?>" name="auct_id" id="buy_auct_id"><span class="glyphicon glyphicon-tag"></span> <?php echo isset($asset_type)?$asset_type:'';?></td>
                </tr>
                <tr>
                  <td><input type="hidden" value="<?php echo $_REQUEST['ass_id'];?>" name="ass_id"><span class="glyphicon glyphicon-time"></span> 3 Days 8 Hrs Remaining</td>
                </tr>
              </table>

              <br>

              <a href="#" onclick="document.form2.submit();return false;" class="btn btn-primary btn-block">Buy Now</a>

            </div>
           </div>
          </div>
        </div>
      </div>
    </div></form>


      <form name="form3" method="post" action="addwatch"><div class="modal fade" id="watchList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
          <input type="hidden" value="<?php echo $_REQUEST['ass_id'];?>" name="ass_id" id="watch_auct_id">
                                         <input type="hidden" value="<?php echo $id;?>" name="auct_id">
            <h4 class="text-center">This Item will be added to you watch list</h4>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="document.form3.submit();return false;" class="btn btn-primary" data-dismiss="modal">Add To My Watch List</button>
          </div>
        </div>
      </div>
    </div></form>

    <div class="container">
    <div class="page_wrap">
      <div class="top_bar">

        <button type="button" class="mobi-menu-toggle hidden-sm hidden-md hidden-lg" data-toggle="collapse" data-target=".side_bar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="side_bar">

        <div class="slogo">
          <a href="#"><img src="<?php echo base_url();?>assets/logo.png"></a>
        </div>
        <ul>
         <?php if($this->session->userdata('user_type') == 1){?>
          <li><a href="../navigate/index" class="active"><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>
          <li>
            <a href="../load_stock/asset_details3" ><span class="glyphicon glyphicon-list-alt"></span>Auctions</a>
          </li>
          <li>
            <a href="#"><span class="glyphicon glyphicon-globe"></span>Campaigns</a>
          </li>
          <li>
            <a href="#"><span class="glyphicon glyphicon-file"></span>Invoices</a>
          </li>

          <li>
            <a href="<?=site_url();?>new_campaign/headerInfo"><span class="glyphicon glyphicon-file"></span>RFP</a>
          </li>

          <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
          <li><a href="<?php echo base_url();?>index.php/login/logout"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
          <?php } else
          if($this->session->userdata('user_type') == 2){  ?>
          <li><a href="../navigate/index" class="active"><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>
          <li>
            <a href="../load_stock/asset_details3" ><span class="glyphicon glyphicon-list-alt"></span>Auctions</a>
          </li>
          <li>
            <a href="#"><span class="glyphicon glyphicon-globe"></span>Campaigns</a>
          </li>
          <li>
            <a href="#"><span class="glyphicon glyphicon-file"></span>Invoices</a>
          </li>

          <li>
            <a href="../rfp/rfp_list"><span class="glyphicon glyphicon-file"></span>RFP</a>
          </li>

          <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
          <li><a href="<?php echo base_url();?>index.php/login/logout"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
           <?php } elseif($this->session->userdata('user_type') == 3){  ?>

          <li>
            <a href="<?php echo site_url("navigate/index")?>" class="active"><span class="glyphicon glyphicon-home"></span>Dashboard</a>
          </li>
          <li>
            <a href="<?php echo site_url("my_stock/op_index")?>" ><span class="glyphicon glyphicon-list-alt"></span>Auctions</a>
          </li>
          <li>
            <a href="<?php echo site_url("campaign")?>"><span class="glyphicon glyphicon-globe"></span>Campaigns</a>
          </li>
          <li>
            <a href="<?php echo site_url("invoice") ?>"><span class="glyphicon glyphicon-file"></span>Invoices</a>
          </li>

          <li>
            <a href="<?php echo site_url("rfp/rfp_list") ?>"><span class="glyphicon glyphicon-file"></span>RFP</a>
          </li>

          <li><a href="<?php echo site_url("settings") ?>"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
          <li><a href="<?php echo site_url("login/logout") ?>"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
          <?php } ?>



        </ul>
      </div>
      <div class="main_content">
      <div id="img-wrapper-tmpl" style="display:none;"><!-- to prevent TypeError: $(...).tmpl(...).appendTo is not a function gallery.js:142 --></div>