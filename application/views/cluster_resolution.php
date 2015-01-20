<html>
<head><?php echo $map['js']; ?></head>
<body>
<div>
<?php echo $map['html']; ?>
</div>
<div>

<?php
echo form_open('simple_marker/search_location');
echo "<p>", form_submit('submit', 'Search By Location');
echo form_close();
?>

</div>
</body>
</html>