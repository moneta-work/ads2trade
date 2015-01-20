<!DOCTYPE html>
<html>
  <head>
      <title>Ads to Trade</title>
      <link rel="stylesheet" type="text/css" media="all" href="http://localhost/ads2trade_UI/new/assets/css/bootstrap.css" />
      <link rel="stylesheet" type="text/css" media="all" href="http://localhost/ads2trade_UI/new/assets/styles.css" />
      <link rel="stylesheet" type="text/css" media="all" href="http://localhost/ads2trade_UI/new/assets/css/dataTables.bootstrap.css" />
      <link rel="stylesheet" type="text/css" media="all" href="http://localhost/ads2trade_UI/new/assets/css/bootstrap-checkbox.css" />
      
      <script src="http://localhost/ads2trade_UI/new/assets/js/jquery.min.js" type="text/javascript"></script>
      <script src="http://localhost/ads2trade_UI/new/assets/js/bootstrap-checkbox.js" type="text/javascript"></script>

      <script src="http://localhost/ads2trade_UI/new/assets/scripts.js" type="text/javascript"></script>
      
      <script src="http://localhost/ads2trade_UI/new/assets/js/amcharts/amcharts.js" type="text/javascript"></script>
      <script src="http://localhost/ads2trade_UI/new/assets/js/amcharts/serial.js" type="text/javascript"></script>

      <link rel="stylesheet" href="http://localhost/ads2trade_UI/new/assets/css/chosen.css">
      <script src="http://localhost/ads2trade_UI/new/assets/js/chosen.jquery.js" type="text/javascript"></script>

      

      <meta name="viewport" content="width=1024" />
  </head>
  <body>

    <div class="modal fade" id="placeBid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Ontdekkers A0/349/A</h4>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-xs-6">
              <a class="thumbnail" href="auctions_details.php">
                <img src="assets/add1.jpg">
              </a>
            </div>
            <div class="col-xs-6">
              <table class="tables">
                <tr>
                  <td width="100">Current Bid <h3 style="margin:0px; margin-bottom:10px;">R2500</h3></td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-flag"></span> Randburg</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-tag"></span> Billboard</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-time"></span> 3 Days 8 Hrs Remaining</td>
                </tr>
              </table>

              <br>

              <div class="form-group">
                <div class="input-group">
                  <input class="form-control" type="email" placeholder="R0.00">
                  <a href="#" class="input-group-addon btn btn-primary">Place Bid</a>
                </div>
              </div>

            </div>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="buyNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Ontdekkers A0/349/A</h4>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-xs-6">
              <a class="thumbnail" href="auctions_details.php">
                <img src="assets/add1.jpg">
              </a>
            </div>
            <div class="col-xs-6">
              <table class="tables">
                <tr>
                  <td width="100">Current Bid <h3 style="margin:0px; margin-bottom:10px;">R2500</h3></td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-flag"></span> Randburg</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-tag"></span> Billboard</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-time"></span> 3 Days 8 Hrs Remaining</td>
                </tr>
              </table>

              <br>

              <a href="#" class="btn btn-primary btn-block">Buy Now</a>

            </div>
           </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="watchList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h4 class="text-center">The listing has been added to you watch list</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>

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
        <div class="user_profile">
          <div class="info">
            <p>Logged in as</p>
            <h3>Leroy <strong>Gwirize</strong></h3>
          </div>
        </div>
        <div class="slogo">
          <a href="#"><img src="assets/logo.png"></a>
        </div>
        <ul>
          <li><a href="index.php" class="active"><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>
          <li>
            <a href="auctions.php"><span class="glyphicon glyphicon-list-alt"></span>Auctions</a>
          </li>
          <li>
            <a href="campaigns.php"><span class="glyphicon glyphicon-globe"></span>Campaigns</a>
          </li>
          <li>
            <a href="invoices.php"><span class="glyphicon glyphicon-file"></span>Invoices</a>
          </li>
          
          <li>
            <a href="rpf.php"><span class="glyphicon glyphicon-file"></span>RPF</a>
          </li>
          
          <li><a href="forms.php"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
          
        </ul>
      </div>

      <div class="main_content">