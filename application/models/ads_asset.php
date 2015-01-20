<?php

class assssssetsi extends CI_Model{
	
function insertAsset ($latitude, $longitude, $asset_type)

	{
	$user_name = "root";
    $password = "";
    $database = "ads2trade";
    $server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) { 


		$result = mysql_query("INSERT INTO ads_asset (latitude, longitude, asset_type)
        VALUES ($latitude, $longitude, '$asset_type')");
		return true;
		//mysql_query($sql);
	}
	else{
	echo "Failed to connect to the database BOSS"; exit;
	}
	}
	
//get all the long and lat values from the ads asset table

function allCoordinates (){
$user_name = "root";
    $password = "";
    $database = "ads2trade";
    $server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) { 

		$result = mysql_query("SELECT * FROM `assssssetsi` LIMIT 10, 10");

		while ($row = mysql_fetch_assoc($result)){
		
		$data[] = $row;
			
			}
		
		
		return $data;
		}
		else{
		return false;
		}

	}


}