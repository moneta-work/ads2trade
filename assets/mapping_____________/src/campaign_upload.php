<?php
/**
 * User: Keith
 * Date: 2014/08/21
 * Time: 19:10
 */

$image_path_base = '../images/uploaded/';






$campaign = array(
	'id' =>  0,
	'images' => array(
		'user' => array(),
		'map' => array()
	)
);


if (array_key_exists('campaign_id', $_POST)) {
	$campaign['id'] = $_POST['campaign_id'];
	unset($_POST['campaign_id']);
}



foreach ($_POST as $key => $value) {
	list($type, $id, $desc_or_image) = explode('_', $key);
	if (!array_key_exists($id, $campaign['images'][$type])) {
		$campaign['images'][$type][$id] = array(
			'description' => '',
			'image_path' => ''
		);
	}
	if ($desc_or_image == 'description') {
		$campaign['images'][$type][$id]['description'] = $value;
	}else{
		//Convert the image, move it and link its url
		list($img_type, $data) = explode(';', $value);
		list(, $ext) = explode('/', $img_type);
		if (trim($ext) == '') {

		}
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);
		do {
			$filename = uniqid($type."_") . "." . $ext;
			$full_path = $image_path_base . $filename;
		}while(file_exists($full_path));
		if (!file_put_contents($full_path, $data)){
			$campaign['images'][$type][$id]['image_path'] = 'Error';
		}
		$campaign['images'][$type][$id]['image_path'] = $full_path;
	}
}