<head>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
		var initialize_map = false;
		function search_radius(){
		var lat = $('input[name=latitude]').val();
		var lon = $('input[name=longitude]').val();
		var rad = $('input[name=radius]').val();
		}

	</script>
	<?php echo $map['js']; ?>
	</head>
<body>
<div>
<?php echo $map['html']; ?>
</div>
<div style='position:right'>

<form action='' onsubmit='search_radius()'>
Latitude: <input type="text" name="latitude" id = "latitude"><br>
Longitude: <input type="text" name="longitude" id="longitude"><br>
Radius (in km): <input type="text" name="radius" id="radius"><br>
<input type="submit" value="Do Radius Search">
</form>

</div>
</body>