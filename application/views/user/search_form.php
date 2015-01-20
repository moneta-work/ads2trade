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

<?php echo form_open(null, array('method' => 'get'), array('list' => $list, 'status' => $status )) ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-control-group">
                <label for="first_name">Username</label>                         
                <?php echo form_input('user_name',set_value('user_name', @$this->input->get_post('user_name')), ' class="form-control"' ); ?>
            </div>
        </div>
    
        <div class="col-sm-3">
            <div class="form-control-group">
                <label for="first_name">Name</label>
                <?php echo form_input('name',set_value('name', @$this->input->get_post('name')), ' class="form-control"' ); ?>
            </div>
        </div>
    
        <div class="col-sm-3">
            <div class="form-control-group">
                <label for="first_name">Status</label>
                <?php echo form_dropdown('status', $user_status_options, set_value('status', @$this->input->get_post('status')) , ' class="form-control"' ); ?>
            </div>
        </div>

    </div>
    
    <div class="row" >
        <div class="col-sm-12">
            <div class="form-button-group">
            <?php echo form_submit('search-filter', 'Filter  >>', 'class="btn btn-primary"' );?>
            <?php echo form_submit('reset-filter', 'Reset  >>', 'class="btn btn-secondary"' );?>
            </div>
        </div>
    </div>

<?php echo form_close() ?>

<?php
    //End offile search_form.php