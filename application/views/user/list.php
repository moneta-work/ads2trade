<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span><?php echo !empty($title) ? $title : 'Users' ?></h1>
</div>
    
<div class="main col-xs-12" >
    <h3>User List : <?php echo ucfirst($status)?></h3>
    
    <?php $this->load->view('user/_nav', array('status' => $status, 'list' => $list)) ?>

    <?php $this->load->view("user/search_form", $search_data) ?>
    
    <div class="table_div">

    <table width="100%" border="1" cellpadding="1"  cellspacing="1" class="table table-bordered headed">
    <thead>
        <tr > 
            <th><div align="left">Username</div></th>
            <th><div align="left">User Type</div></th>
            <th><div align="left">Company</div></th>
            <th><div align="left">Email</div></th>
            <th><div align="left">Mobile #</div></th>
            <th><div align="left">Reg Date</div></th>
            <th><div align="left">Country</div></th>
            <th><div align="left">Status</div></th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($users as $user) {
    ?>
        <tr>
            <td><a href="<?php echo site_url("user/edit?id=".$user->use_id) ?>"><?php echo $user->use_username?></a></td>
            <td><?php echo $user->ust_description?></td>
            <td><?php echo $user->use_company_name ?></td>
            <td><?php echo $user->use_email?></td>
            <td><?php echo $user->use_mobile_number?></td>
            <td><?php echo $user->use_registration_date ?></td>
            <td><?php echo $user->cou_name ?></td>
            <td><?php echo $this->user->getStatus($user->use_status)?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    </div>

</div>

<?php
    //End offile list.php