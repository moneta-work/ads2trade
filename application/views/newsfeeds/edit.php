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
    <h1><span class="glyphicon glyphicon-list-alt"></span>Newsfeeds</h1>
</div>

<div class="main col-xs-12" >

<h3>Editing Newsfeed :: <?php echo $newsfeed->title ?></h3>

<?php $this->load->view("newsfeeds/_nav", array("tab" => "edit") ) ?>

    <div class="table_div">
    <?php echo form_open_multipart("newsfeed/edit/".$newsfeed->id) ?>
        <?php echo form_hidden("id", $newsfeed->id) ?>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">Title</label>
                    <?php echo form_input('title', $newsfeed->title, 'class="form-control"' ); ?>
                </div>
            </div>
           
             <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">News Date</label> 
                    <?php echo form_input('news_date', set_value('news_date', $newsfeed->news_date), ' class="form-control"' ); ?>
                </div>
            </div>
           
            <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">Suspended</label>                         
                    <?php echo form_dropdown('suspended', $suspended_options, set_value('suspended',$newsfeed->suspended), ' class="form-control"' ); ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-control-group">
                    <label for="first_name">Content</label>
                    <?php echo form_textarea('content', $newsfeed->content, 'class="form-control" rows="5"' ); ?>
                </div>
            </div>

        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="form-control-group">
                    <label for="first_name">Usertype Access</label>
                    <?php echo form_multiselect('user_type[]', $user_type_options, set_value('user_type[]', $news_user_types), 'class="form-control"' ); ?>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="col-sm-12">
                <div class="form-button-group">
                <?php echo form_submit('update-news', 'Update Feed', 'class="btn btn-primary"' );?>
                </div>
            </div>
        </div>
    <?php echo form_close() ?>
    </div>

</div>

<?php
    //End offile list.php