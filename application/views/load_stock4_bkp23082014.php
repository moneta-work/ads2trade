<?php //var_dump($region); exit   ?>
<style>
    html, body, #map-canvas {
        height: 500px;
        margin: 0px;
        padding: 0px
    }

    .tabs_wrap{ border:solid 1px #e1e1e1; }
    .tabs_wrap a.active{ background-color: #cbc9c9; }
    .dn{ display:none;}
    .Faces{ border-bottom: solid 1px #e1e1e1; padding-bottom: 10px; height: 30px; margin-bottom: 10px; }
    .dbfl{float:left; display:inline-block;}
    .tab_content{display:none; height: 215px; overflow: auto;}
    .tab_content.active{display:block;}
    #dialog_content .buttons_wrap a{ margin-right: 10px;}
    #dialog_content{ float:left; width:100%;}
    #dialog_content label{ display: block; margin: 0px;}
    #dialog_content .form-control{ outline: none!important; border-shadow:none; margin: 0px;outline: none; border: solid 2px #e1e1e1; width: 250px; padding: 6px; margin-bottom: 10px;}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<div id="popup_content" style="display:none">
    <div id="dialog_content"><form>
            
            <div class="Faces">
                <div class="col-xs-4">
                    <input type="radio" name="face" checked="checked" id="fa" class="dbfl">
                    <label for="fa" class="dbfl">Face A</label>
                </div>
                <div class="col-xs-6">
                    <input type="radio" name="face" id="fb" class="dbfl">
                    <label  for="fb" class="dbfl">Face B</label>
                </div>
            </div>
            
            <div class="face_a_content">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Upload Photo</label>
                    <input type="file" name="file_fa" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content
                </div>
                <div class="tab_content" id="rate">
                    Rate Content
                </div>
            </div>
            
            <div class="face_b_content dn">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content Face B
                </div>
                <div class="tab_content" id="rate">
                    Rate Content Face B
                </div>
            </div>

            <div class="buttons_wrap">
                <input type="hidden" class="form-control latlong" name="position"  value="" >
                <a href="#" class="save_new_asset btn btn-primary">Save Asset</a>
                <a href="#" class="delete_new_asset btn btn-primary">Delete Asset</a>
            </div><br>
        </form></div>
    <div class="clear"></div>
</div>
<script type="text/javascript">

    var centerposition = new google.maps.LatLng(-26.063214,27.943271);
    var marker;
    var markers = [];
    var map;
    var ajax_file = "<?php echo site_url('our_ajax'); ?>";
    var openInfoWindow;
    var image = 'http://localhost/maps/images/blue_icon.png';

    function populate_table(){
        var mediaowner_id = $("#mediaowner_id").val();
        $.ajax({type: "POST",url: ajax_file,
            data: { action:'table_data', mediaowner_id:mediaowner_id},
            success:function(html){
                openInfoWindow.close();
                $(".table_div").html(html);
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
        });
    }
    function setup_marker(marker){
        

        var mLatLang = marker.getPosition().toUrlValue();
        google.maps.event.addListener(marker, 'click', function() {
            if (openInfoWindow) {
                openInfoWindow.close();
            }

            var infowindow = new google.maps.InfoWindow({
                content: ''
            });
            $.post( ajax_file, { action: "get_asset_details", position: mLatLang},function( data ) {
            
                var contentString = $('<div>'+data+'</div>');    

                infowindow.setContent(contentString[0]);
                infowindow.open(map,marker);
                openInfoWindow = infowindow;

                //Find remove button in infoWindow
                var removeBtn = contentString.find('.delete_asset')[0];
                var saveBtn = contentString.find('.save_asset')[0];

                //add click listner to remove marker button
                google.maps.event.addDomListener(removeBtn, "click", function(event) {
                    //call remove_marker function to remove the marker from the map
                    remove_marker(marker);
                });

                //add click listner to save marker button
                google.maps.event.addDomListener(saveBtn, "click", function(event) {
                    //call remove_marker function to remove the marker from the map
                    save_current_asset(marker,infowindow);
                });
            });
          
        });
    }

    function remove_marker(Marker){
        //Remove saved marker from DB and map using jQuery Ajax
        var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
        
        var myData = {action : 'delete_asset', latlang : mLatLang}; //post variables
        $.ajax({
            type: "POST",
            url: ajax_file,
            data: myData,
            success:function(data){
                Marker.setMap(null); 
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
        });
      
    }

    function save_current_asset(Marker,infowindow){
        
        var myData = $(infowindow.content).find('form').serialize();
        $.ajax({
            type: "POST",
            url: ajax_file,
            data: myData,
            success:function(data){
                openInfoWindow.close();
                populate_table();
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
        });
      
    }

    function save_new_asset(Marker,infowindow){
        var myData = $(infowindow.content).find('form').serialize();
        $.ajax({type: "POST",url: ajax_file,
            data: myData,
            success:function(data){
                openInfoWindow.close();
                populate_table();
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
        });
    }

    function addMarker(location) {
        if (openInfoWindow) {
            openInfoWindow.close();
        }

      
        var marker = new google.maps.Marker({
            position: location,
            draggable:true,
            icon:image,
            map: map
        });

        markers.push(marker);

        var mLatLang = marker.getPosition().toUrlValue();
        var popupcontent = $("#popup_content").html();
        
        var contentString = $('<div>'+popupcontent+'</div>');    
        contentString.find('.latlong').val(mLatLang);

        var infowindow = new google.maps.InfoWindow({
            content: '',maxWidth: 360 ,Height: 600 
        });
        infowindow.setContent(contentString[0]);
        openInfoWindow = infowindow;
        infowindow.open(map,marker);

        //Find remove button in infoWindow
        var removeBtn = contentString.find('.delete_new_asset')[0];
        var saveBtn = contentString.find('.save_new_asset')[0];

        //add click listner to remove marker button
        google.maps.event.addDomListener(removeBtn, "click", function(event) {
            marker.setMap(null); 
        });

        //add click listner to save marker button
        google.maps.event.addDomListener(saveBtn, "click", function(event) {
            save_new_asset(marker,openInfoWindow);
        });

        setup_marker(marker);
      

    }


    function initialize() {
        var mapOptions = {zoom: 13, center: centerposition};
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        
        google.maps.event.addListener(map, 'click', function(event) {
            addMarker(event.latLng);
        });

<?php 
if($mmm){
foreach ($mmm as $key) { ?>
                   var myLatlng = new google.maps.LatLng(<?= $key->position; ?>);
                   var marker = new google.maps.Marker({
                       position: myLatlng,
                       icon:image,
                       map: map,
               
                       title: 'Your Asset Title!'
                   });
            
           
                   setup_marker(marker);

<?php }} ?>

        
            }

            google.maps.event.addDomListener(window, 'load', initialize);

      
</script>

<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Load Stock</h1>
</div>


<div class="main col-xs-12">

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
                <select name="ast_id" id="ast_id" class="form-control">
                    <option value="0">Billboard</option>
                    <option value="3">Media Type 2</option>
                    <option value="1">Media Type 3</option>
                    <option value="2">Media Type 4</option>
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

            <div class="map_wrap">
                <div id="map-canvas"></div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <h3>Asset Details</h3>
    <div class="table_div">
    <table class="table table-bordered headed " cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Pic</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Time Remaining</th>
                <th>Type</th>
                <th>Status</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td width="50">
                    <a class="thumbnail" href="auctions_details.php">
                        <img src="assets/add1.jpg">
                    </a>
                </td>
                <td><a href="auctions_details.php">Ontdekkers A0/349/A</a></td>
                <td>01 June</td>
                <td>21 June</td>
                <td>5 Day 3 Hours</td>
                <td>Billboard</td>
                <td>Out Bid</td>
                <td width="240">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#placeBid">Bid</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#buyNow">Buy Now</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#watchList">Watch List</a>
                </td>
            </tr>

            <tr>
                <td width="50">
                    <a class="thumbnail" href="auctions_details.php">
                        <img src="assets/add2.jpg">
                    </a>
                </td>
                <td><a href="auctions_details.php">Ontdekkers A0/349/A</a></td>
                <td>01 June</td>
                <td>21 June</td>
                <td>5 Day 3 Hours</td>
                <td>Billboard</td>
                <td>Out Bid</td>
                <td width="240">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#placeBid">Bid</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#buyNow">Buy Now</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#watchList">Watch List</a>
                </td>
            </tr>

            <tr>
                <td width="50">
                    <a class="thumbnail" href="auctions_details.php">
                        <img src="assets/add1.jpg">
                    </a>
                </td>
                <td><a href="auctions_details.php">Ontdekkers A0/349/A</a></td>
                <td>01 June</td>
                <td>21 June</td>
                <td>5 Day 3 Hours</td>
                <td>Billboard</td>
                <td>Out Bid</td>
                <td width="240">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#placeBid">Bid</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#buyNow">Buy Now</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#watchList">Watch List</a>
                </td>
            </tr>

            <tr>
                <td width="50">
                    <a class="thumbnail" href="auctions_details.php">
                        <img src="assets/add1.jpg">
                    </a>
                </td>
                <td><a href="auctions_details.php">Ontdekkers A0/349/A</a></td>
                <td>01 June</td>
                <td>21 June</td>
                <td>5 Day 3 Hours</td>
                <td>Billboard</td>
                <td>Out Bid</td>
                <td width="240">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#placeBid">Bid</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#buyNow">Buy Now</a>
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#watchList">Watch List</a>
                </td>
            </tr>





        </tbody>
    </table>
    </div>





</div><!--Main -->

<?php
//include("footer.php"); ?>