        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span><a href="#">Auctions</a> / <?php echo $this->input->get('area');?></h1>

          <?php
                         
                          $this->db->where("watch_list.status", '1');
                          $this->db->select('distinct(auction) as auction');
              $this->db->from('auctions');
                          $this->db->join('watch_list','watch_list.auction = auctions.id');
                          $select_query1 = $this->db->get(); 

                          
                          $this->db->where("bids.status", '1');
                          $this->db->select('distinct(auction) as auction');
              $this->db->from('auctions');
                          $this->db->join('bids','bids.auction = auctions.id');
                          $select_query = $this->db->get();  
          ?>
        <br>
        <div class="main col-xs-12">

          <ul class="nav navbar-nav section-menu">
            <li class="active"><a href="../load_stock/asset_details3">Search</a></li>
            <li ><a href="../load_stock/active_bids">Your Active Bids<span class="badge"><?php echo $select_query->num_rows;?></span></a></li>
            <li><a href="../load_stock/watch_list">Watch List<span class="badge"><?php echo $select_query1->num_rows;?></span></a></li>
            <li><a href="../load_stock/won_bids">Won Bids</a></li>
            <li><a href="../load_stock/lost_bids">Lost Bids</a></li>
          </ul>
          </div>          

          <h2>Assets Found</h2>

        </div>


        <form method="post" class="main col-xs-12">



          <div class="clear"></div>

              

              <div class="row">
                <div class="col-sm-9">

                  <?php $i=0; while($i<=5){ $i++;?>
                  <div class="assets_box">
                    <a href="asset.php" class="pic"></a>
                    <div class="info">
                      <table>
                        <tbody>
                          <tr>
                            <td width="150px;">Asset Number:</td>
                            <td>R301.00</td>
                          </tr>
                          <tr>
                            <td>Current Status:</td>
                            <td>R301.00</td>
                          </tr>
                          <tr>
                            <td>Current Bid:</td>
                            <td>R301.00</td>
                          </tr>
                          <tr>
                            <td>Your Bid:</td>
                            <td>R301.00</td>
                          </tr>
                        </tbody>
                      </table>
                      <p class="description">Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus suscipit tortor eget felis porttitor volutpat...</p>
                      <div class="btn-group">
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#placeBid"><span class="glyphicon glyphicon-record"></span> Bid</a>
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#buyNow"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a>
                      </div>
                      <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#watchList"><span class="glyphicon glyphicon-eye-open"></span> Add to watchlist</a>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <?php } ?>


                  


                  
                </div>

                <div class="col-sm-3">
                  <div class="side_info_box">
                    <h3>Room Details</h3> 
                    <table>
                        <tbody>
                          <tr>
                            <td width="150px;">Asset Number:</td>
                            <td>R301.00</td>
                          </tr>
                          <tr>
                            <td>Current Status:</td>
                            <td>R301.00</td>
                          </tr>
                          <tr>
                            <td>Current Bid:</td>
                            <td>R301.00</td>
                          </tr>
                          <tr>
                            <td>Your Bid:</td>
                            <td>R301.00</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                

                  <div class="side_info_box">
                    <h3>Filter Assets</h3> 
                    
                    <label>Location</label>
                    <input type="text" class="form-control">

                    <label>Bid Range</label>
                    <select class="form-control">
                      <option>R0 - R999</option>
                      <option>R1000 - R3000</option>
                    </select>

                    <div class="text-center">
                      <input type="submit" value="Filter" class="btn btn-primary">
                    </div>

                  </div>
                </div>

                

                

                
              </div>
              

              

            

        </form><!--Main --> 