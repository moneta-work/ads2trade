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

<h3>Deleting Newsfeed :: <?php echo $newsfeed->title ?></h3>

<?php $this->load->view("newsfeeds/_nav", array("tab" => "delete") ) ?>

    <div class="table_div">
    <?php echo form_open_multipart("news/delete/".$newsfeed->id) ?>
        <?php echo form_hidden("id", $newsfeed->id) ?>
        
        <div class="row">
            <div class="col-sm-12">
                <p>
                    Are you sure you want to delete the newsfeed: <?php echo $newsfeed->title ?>
                </p>
            </div>
           
        </div>
        
        <div class="row" >
            <div class="col-sm-12">
                <div class="form-button-group">
                <?php echo form_submit('delete-news', 'Delete Feed', 'class="btn btn-danger"' );?>
                </div>
            </div>
        </div>
    <?php echo form_close() ?>
    </div>

</div>

<?php
    //End offile list.php