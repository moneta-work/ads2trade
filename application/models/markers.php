<?php
class markers extends CI_Model{
	
function insertAsset ($latitude, $longitude)

	{
	$user_name = "root";
    $password = "";
    $database = "ads2trade";
    $server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) { 
		$result = mysql_query("INSERT INTO ads_asset (latitude, longitude)
        VALUES ($latitude, $longitude)");
		return true;
		//mysql_query($sql);
	}
	else{
	echo "Failed to connect to the database BOSS"; exit;
	}
	}
	}