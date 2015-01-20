<?php //var_dump($asset_type);exit;?>
<head><script type="text/javascript">
		//onload = function getAssetType(){
   
		// alert('mese');
		//}

		var centreGot = false;
		
	</script>
	<?php echo $map['js']; ?>
	</head>
<body>
<div>
<p> Chosen Media type : <? echo '<strong>',strtoupper($asset_type),'</strong>';?>
</div>
<div>
<?php echo $map['html']; ?>
</div>
<div style='position:right'>
<?php
echo form_open('simple_marker/cluster_management');
echo "<p>", form_submit('submit', 'Cluster Management');
echo form_close();
?>
</div>
</body>