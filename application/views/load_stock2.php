<?php //include("header.php"); ?>
<script type="text/javascript">
		function getMarkerPosition(newLat, newLng)
		{//alert('we are here now' + newLng + ' and ' + newLng);
		//alert (window.location.href);
		
			 //call the controller and pass the coordinates to it
			//var old_url = window.location.href;
			//var re = new RegExp(old_url, 'simple_marker/');
			//var str = str.replace(re,'');
			window.location.href= 'http://localhost/ads2trade/index.php/save_location_details/?lat=' + newLat + '&lng=' + newLng;
			
			//end call to controller
			
		}
                
	</script>
<?php echo $map['js']; ?>



        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span>Media Owner : : Load Stock</h1>
        </div>


        <div class="main col-xs-12">


          <div class="clear"></div>

            <div class="alert alert-info" role="alert">
              <span class="glyphicon glyphicon-info-sign"></span>
              Select the media type and use the map to point the locations that you prefer</div>
          
              <br>
              <div class="row">
                <div class="col-xs-4">
                  <p>
                    <label for="first_name">Region</label>                         
                    <p><?php echo $_POST['region'];?> </p> 
                  </p>

                  <p>
                    <label for="first_name">Location</label>                         
                    <p><?php echo $_POST['location'];?> </p>
                  </p>

                  <p>
                    <label for="first_name">Location Reference</label>                         
                    <p><?php echo $_POST['loc_ref'];?> </p>
                  </p>

                 

                  
                  <div class="text-center">
                    
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
                   <?php echo $map['html']; ?>
                  </div>
                </div>
              </div>
              
              <br>
              <br>
              <h3>Search Results</h3>
              <table class="table table-bordered headed" cellspacing="0" width="100%">
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

              

            

        </div><!--Main -->


  <?php //include("footer.php"); ?>