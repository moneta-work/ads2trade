<!DOCTYPE html>
<html>
  <head>
      <title>Ads to Trade - Login</title>
      <link rel="stylesheet" type="text/css" media="all" href="assets/css/bootstrap.css" />
      <link rel="stylesheet" type="text/css" media="all" href="assets/login.css" />
      <link rel="stylesheet" type="text/css" media="all" href="assets/css/dataTables.bootstrap.css" />
      <link rel="stylesheet" type="text/css" media="all" href="assets/css/bootstrap-checkbox.css" />
      
      <script src="assets/js/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/bootstrap-checkbox.js" type="text/javascript"></script>

      <script src="assets/scripts.js" type="text/javascript"></script>

      <meta name="viewport" content="width=device-width" />
  </head>
  <body>
        
      <form class="login_form" action="<?=site_url();?>login/validate_credentials" method="post">
          <div class="logo">
            <img src="<?=base_url();?>assets/login_logo.png">
          </div>

          <div class="fbkg">
            <label>Username</label>
            <input type="text" class="form-control" name="username" id="username">

            <label><span class="pull-right"><a href="#">Forgot?</a></span> Password </label>
            <input type="password" class="form-control" name="password" id="password">

            <input type="submit" value="Login" class="btn btn-primary">

            <div class="text-center message">
              <a href="create_an_account.php">Create an account</a>
            </div>
          </div>

        </form>

  		<div class="clear"></div>
      </div>
    </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>  
    <script src="assets/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/js/jquery.dataTables.js" type="text/javascript"></script>

    
  </body>
</html>
      