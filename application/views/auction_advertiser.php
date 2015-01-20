<?php //include("header.php"); ?>
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-home"></span>Auctions Dashboard</h1>
        </div>
        <div class="main">

          <div class="alert alert-info text-center" role="alert">
            <h2>Welcome <?php echo $this->session->userdata('username'); ?></h2>
            <p>You current don't have any active campaigns. To start a campaign you have to buy or bid for advertising space.</p>
            <br><a href="../load_stock/asset_details3" class="btn btn-primary">Go To  Current Auctions</a>
          </div>
          <br>
          <br>

         
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Action Required</div>
              <div class="panel-body">
                <div class="feed-activity-list">

                  <div class="feed-element">
                    <div class="media-body ">
                      <a href="notifications.php">Art work is due within 7 days. Please Upload</a><br>
                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                    </div>
                  </div>

                  <div class="feed-element">
                    <div class="media-body ">
                      <a href="notifications.php">Payment deposit due. Please click here to settle and upload prove of payment</a><br>
                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                    </div>
                  </div>

                  <div class="feed-element">
                    <div class="media-body ">
                      <a href="notifications.php">Art work is due within 7 days. Please Upload</a><br>
                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

                  <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">My Stock <a href="../load_stock/view_my_assets" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ 18 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>My Bid Value [ R 30,000.00 ]</li>
                <li class="list-group-item"></a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Recent Bids<a href="../load_stock/won_bids" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ 8 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>


          

          <div class="clear"></div>

          
          <br>

          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Incoming RFP Proposals<a href="../load_stock/watch_list" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                 <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ 8 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>

                  <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">My Submitted RFPs<a href="../load_stock/active_bids" class="label label-default pull-right">View All</a></div>
              <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ 8 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="panel panel-default">
              <div class="panel-heading">Assets On Special<a href="../load_stock/active_bids" class="label label-default pull-right">View All</a></div>
             <ul class="list-group">
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Number Of Items [ 8 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Total Value [ R 200,000.00 ]</li>
                  <li class="list-group-item"><span class="glyphicon glyphicon-plus"></span>Current Bid Value [R 230,000.00 ]</li>
                 <li class="list-group-item"></li>
                <li class="list-group-item"></li>
              </ul>
            </div>
          </div>
          
          

          <div class="clear"></div>
          
          
        </div>

  <?php //include("footer.php"); ?>