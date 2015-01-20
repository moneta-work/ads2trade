<head>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
	</script>
	<?php echo $map['js']; ?>
	</head>
<body>
<div>
<?php echo $map['html']; ?>
</div>
<div style='position:right'>

<form action='http://localhost/ads2trade/index.php/search_radius' method='POST'>
Latitude: <input type="text" name="latitude" id = "latitude"><br>
Longitude: <input type="text" name="longitude" id="longitude"><br>
Radius (in km): <input type="text" name="radius" id="radius"><br>
<input type="submit" value="Do Radius Search">
</form>

</div>
<div>
<?php
echo form_open('spiderfy');
echo form_submit('submit', 'Spiderfy');
echo form_close();
?>
</div>
<div>
<?php
echo form_open('interest_point');
echo form_submit('submit', 'Point Of Interest Search');
echo form_close();
?>
</div>
<div>
<?php
echo form_open('draw_radius');
echo form_submit('submit', 'Draw a radius Option 1');
echo form_close();
?>
</div>

</div>
<div>
<?php
echo form_open('draw_radius/draw2');
echo form_submit('submit', 'Draw a radius Option 2');
echo form_close();
?>
</div>
</body>