<?php
    $list = isset($list) ? $list : 'adv';
    if ($list == 'adv'){
        $list1 = 'med';
        $diff_user = 'Media Owner List';
        
        }else{
            $list1 = 'adv';
        $diff_user = 'Advertiser List';
            
        }
?>

<ul class="nav navbar-nav section-menu">
    <li class="<?php echo ($status == "new") ? 'active' : '' ?>" ><a href="<?php echo site_url("user?list=".$list."&st=new") ?>">New Users</a></li>
    <li class="<?php echo ($status == "active") ? 'active' : '' ?>" ><a href="<?php echo site_url("user?list=".$list."&st=active") ?>">Active Users</a></li>
    <li class="<?php echo ($status == "suspended") ? 'active' : '' ?>" ><a href="<?php echo site_url("user?list=".$list."&st=suspended") ?>">Suspended Users</a></li>
    <li class="" ><a href="<?php echo site_url("user?list=".$list1."&st=active") ?>"><?php echo $diff_user?></a></li>

</ul>

<?php
    //End offile _nav.php