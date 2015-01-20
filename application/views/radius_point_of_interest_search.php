<head>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
	</script>
	<?php echo $map['js']; ?>
	</head>
<body>
<div id="locationField">
  <input type="text" id="myPlaceTextBox" />
</div>
<div>
<?php echo $map['html']; ?>
</div>
<div style='position:right'>


</div>
<div>
<?php
echo form_open('simple_marker/radius_search');
echo form_submit('submit', 'Back');
echo form_close();
?>

</div>
<div>
<?php
echo form_open('simple_marker/geo_search');
echo form_submit('submit', 'Geo Location Search');
echo form_close();
?>
</div>
</body>