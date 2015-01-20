<?php $tab = !isset($tab) ?  "active" : $tab ?>

<ul class="nav navbar-nav section-menu">
    <li class="<?php echo ($tab == "new") ? 'active' : '' ?>" ><a href="<?php echo site_url("newsfeed/create") ?>">New Feed</a></li>
    <li class="<?php echo ($tab == "active") ? 'active' : '' ?>" ><a href="<?php echo site_url("newsfeed/active") ?>">Active Feeds</a></li>
    <!--
    <li class="<?php echo ($tab == "suspended") ? 'active' : '' ?>" ><a href="<?php echo site_url("newsfeed/suspended") ?>">Suspended Feeds</a></li>
    -->
</ul>

<?php
    //End offile _nav.php