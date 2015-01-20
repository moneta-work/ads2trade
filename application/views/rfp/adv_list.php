<?php $this->helper("text") ?>

<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Campaign</h1>
</div>

<div class="main col-xs-12">

    <h3>My Campaign List</h3>

    <div class="table_div">

      <table width="100%" border="1" cellpadding="1"  cellspacing="1" class="table table-bordered table-hover headed">
        <thead>
        <tr > 
            <th nowrap="nowrap">Cam#</th>
            <th><div align="left">Title</div></th>
            <th><div align="left">Start Date</div></th>
             <th><div align="left">End Date</div></th>
             <th><div align="left">Description</div></th>
            <th><div align="left">Budget</div></th>
            <th><div align="left">Assets Proposed</div></th>
        <th><div align="left">Asset Types Proposed</div></th>
      <th><div align="left">Status</div></th>
          </tr>
        </thead>
        <tbody>
            <?php
                foreach ($campaigns as $row) {
                    $campaign = $row;
            ?>
            <tr>
                <td height="30"><a href="<?php echo site_url("campaign/show?id=".$campaign->cam_id) ?>"><?php echo $row->cam_number;?></a></td>
                <td><?php echo $row->cam_title;?></td>
                <td><?php echo $row->cam_requested_start_date;?></td>
                <td><?php echo $row->cam_requested_end_date;?></td>
                <td><?php echo character_limiter($row->cam_description, 25); ?></td>
                <td><?php echo $row->cam_budget;?></td>
                <td><?php echo 'Awaiting'?></td>
                <td><?php echo '';?></td>
                <td><?php echo '' //$stats;?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

</div>
