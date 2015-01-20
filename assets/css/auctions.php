<?php include("header.php"); ?>
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
                      <option value="0">Billboard</option>
                      <option value="3">Media Type 2</option>
                      <option value="1">Media Type 3</option>
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

              

            

        </form><!--Main -->


  <?php include("footer.php"); ?>