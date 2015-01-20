<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span><?php echo !empty($title) ? $title : 'News Feeds' ?></h1>
</div>

<div class="main col-xs-12" >
    <h3>News Feeds</h3>

    <?php $this->load->view('newsfeeds/_nav') ?>

    <?php $this->load->view("newsfeeds/search_form", $search_data) ?>

    <div class="table_div">

        <table width="100%" border="1" cellpadding="1"  cellspacing="1" class="table table-bordered headed">
            <thead>
                <tr >
                    <th><div align="left">Title</div></th>
                    <th><div align="left">News Date</div></th>
                    <th><div align="left">Created Date</div></th>
                    <th><div align="left">User Types</div></th>
                    <th><div align="left">Status</div></th>
                    <th><div align="left">Action</div></th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($newsfeeds as $feed) {
                
                    $user_type_names = $this->newsfeed->getUserTypeNamesByNewsId($feed->id, 'array');
                    
            ?>
                <tr>
                    <td><a href="<?php echo site_url("newsfeed/edit/".$feed->id) ?>"><?php echo $feed->title?></a></td>
                    <td><?php echo $feed->news_date ?></td>
                    <td><?php echo $feed->created_date ?></td>
                    <td>
                    <?php
                        if(count($user_type_names)) {
                            echo implode(";", $user_type_names);
                        } else {
                            echo "";
                        }
                    ?>
                    </td>
                    <td><?php echo $this->newsfeed->getStatus($feed->suspended) ?></td>
                    <td>
                        <a href="<?php echo site_url("news/delete/".$feed->id) ?>" title="Delete feed"><i class="glyphicon glyphicon-remove" ></i>Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php
    //End offile list.php