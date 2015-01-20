<head>
</head>
<body>
<div>
<p /> Please choose media type you want to upload
<?php
echo form_open('simple_marker/media_types');
$options = array(
                  'billboards'  => 'billboards',
                  'street pole'    => 'street pole',
                  'bins'   => 'bins',
                  'rolling banner' => 'rolling banner',
                );
echo form_dropdown('med_type', $options, 'billboards');
echo "<p>", form_submit('submit', 'Continue');
echo form_close();
?>
</div>
<div style='position:right'>
</div>
</body>
