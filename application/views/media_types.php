<?php //echo $_POST['med_type'];?>
<head>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		function getMarkerPosition(newLat, newLng)
		{//alert('we are here now' + newLng + ' and ' + newLng);
		//alert (window.location.href);
		
			 //call the controller and pass the coordinates to it
			//var old_url = window.location.href;
			//var re = new RegExp(old_url, 'simple_marker/');
			//var str = str.replace(re,'');
			window.location.href= 'http://localhost/ads2trade/index.php/save_location_details/?lat=' + newLat + '&lng=' + newLng + '&med_type=' + '<?php echo $_POST['med_type'];?>';
			
			//end call to controller
			
		}
		
	</script>
<?php echo $map['js']; ?>
</head>
<body>
<div><p>Chosen Media Type : <?= echo '<strong>',strtoupper($_POST['med_type']),'</strong>';?></div>
<div>
<?php echo $map['html']; ?>
</div>
<div>


</div>
<div>
<?php
echo form_open('simple_marker/center_map');
//adding the input fields for the latitude and the longitude
$data = array(
              'name'        => 'latitude',
              'id'          => 'latitude',
              //'value'       => 'johndoe',
              'maxlength'   => '15',
              'size'        => '150',
              'style'       => 'width:10%',
            );

echo "Enter Latitude ", form_input($data)."\n";
$data2 = array(
              'name'        => 'longitude',
              'id'          => 'longitude',
              //'value'       => 'johndoe',
              'maxlength'   => '15',
              'size'        => '150',
              'style'       => 'width:10%',
            );

echo "<p>", "Enter Longitude", form_input($data2);
echo "<p>", form_submit('submit', 'Center Map');
echo form_close();
?>
</div>
<div style='position:right'>
<?php
echo form_open('simple_marker/media_type');
echo "<p>", form_submit('submit', 'Drop Markers');
echo form_close();
?>
</div>
</body>
