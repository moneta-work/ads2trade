<?php
$user_name = "root";
    $password = "";
    $database = "ads2trade";
    $server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
