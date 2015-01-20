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
    <h1><span class="glyphicon glyphicon-list-alt"></span>News Feeds</h1>
</div>

<div class="main col-xs-12" >

<h3>Creating Newsfeed</h3>

<?php $this->load->view("newsfeeds/_nav", array("tab" => "new") ) ?>

    <div class="table_div">
    <?php echo form_open_multipart("newsfeed/create") ?>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">Title</label>
                    <?php echo form_input('title', set_value('title'), 'class="form-control"' ); ?>
                </div>
             </div>
             
             <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">News Date</label> 
                    <?php echo form_input('news_date', set_value('news_date'), ' class="form-control"' ); ?>
                </div>
            </div>

             <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">Status</label> 
                    <?php echo form_dropdown('suspended', $suspended_options, set_value('suspended', 0), ' class="form-control"' ); ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-control-group">
                    <label for="first_name">Content</label>
                    <?php echo form_textarea('content', set_value('content'), 'class="form-control" rows="4"' ); ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">Usertype Access</label>
                    <?php echo form_multiselect('user_type[]', $user_type_options, set_value('user_type[]'), 'class="form-control"' ); ?>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="col-sm-12">
                <div class="form-button-group">
                <?php echo form_submit('create-news', 'Create Feed', 'class="btn btn-primary"' );?>
                </div>
            </div>
        </div>
    <?php echo form_close() ?>
    </div>

</div>

<?php
    //End offile list.php