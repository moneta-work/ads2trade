<?php $this->load->helper("form"); ?>

<style>
    .form-button-group {
        padding: 10px 0px;
    }
    
    .form-control-group {
        margin-top: 5px;
        margin-bottom: 0px;
        margin-left:   0px;
        margin-right:  0px;
    }
    
</style>

<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Users</h1>
</div>

<div class="main col-xs-12" >

<h3>Editing User :: <?php echo $user->use_username ?></h3>

<div class="table_div">
<?php echo form_open_multipart("user/edit?id=".$user->use_id) ?>
    <?php echo form_hidden("id", $user->use_id) ?>
    
    <div class="row">
        <div class="col-sm-4">
            <div class="form-control-group">
                <label for="first_name">First Name</label>
                <?php echo form_input('use_first_name', $user->use_first_name, 'class="form-control"' ); ?>
            </div>
            
            <div class="form-control-group">
                <label for="first_name">User Type</label>                         
                <?php echo form_dropdown('user_type', $user_type_options, set_value('user_type',$user->ust_id), ' class="form-control"' ); ?>
            </div>
            
            <div class="form-control-group">
                <label for="first_name">Country</label>                         
                <?php echo form_dropdown('use_country', $country_options, $user->use_country, ' class="form-control"' ); ?>
            </div>
            
            <div class="form-control-group">
                <label for="first_name">Company</label>                         
                <?php echo form_input('use_company_name', $user->use_company_name, ' class="form-control"' ); ?>
            </div>
            
        </div>
    
        <div class="col-sm-4">
            <div class="form-control-group">
                <label for="first_name">Last Name</label>
                <?php echo form_input('use_last_name', $user->use_last_name, 'class="form-control"' ); ?>
            </div>
            
            <div class="form-control-group">
                <label for="first_name">Status</label>
                <?php echo form_dropdown('use_status', $user_status_options, $user->use_status, ' class="form-control"' ); ?>
            </div>

            <div class="form-control-group">
                <label for="first_name">City</label>
                <?php echo form_input('use_city', $user->use_city, ' class="form-control"' ); ?>
            </div>
                        
        </div>
    
        <div class="col-sm-4">
            <div class="form-control-group">
                <label for="first_name">Email</label>
                <?php echo form_input('use_email', $user->use_email, 'class="form-control"'); ?>
            </div>

            <div class="form-control-group">
                <label for="use_mobile_number">Mobile Number</label>
                <?php echo form_input('use_mobile_number', $user->use_mobile_number, 'class="form-control"'); ?>
            </div>
            
            <div class="form-control-group">
                <label for="use_street_number">Street Number</label>
                <?php echo form_input('use_street_number', $user->use_street_number, ' class="form-control"' ); ?>
            </div>
        </div>
    
    </div>

    <hr />
    <!-- Other things -->
    <div class="row">
        <div class="col-sm-4">
            <div class="form-control-group">
                <label for="use_auction_limit">Auction Limit</label>
                <?php echo form_input('use_auction_limit', $user->use_auction_limit , 'class="form-control"' ); ?>
            </div>
            
        </div>
    
        <div class="col-sm-4">
            <div class="form-control-group">
                <label for="use_increase_limit">Increase Limit</label>
                <?php echo form_input('use_increase_limit', $user->use_increase_limit, ' class="form-control"' ); ?>
            </div>
        </div>
    
    </div>
    
    <div class="row" >
        <div class="col-sm-12">
            <div class="form-button-group">
            <?php echo form_submit('update-user', 'Update User', 'class="btn btn-primary"' );?>
            </div>
        </div>
    </div>
<?php echo form_close() ?>
</div>

</div>

<?php
    //End offile list.php