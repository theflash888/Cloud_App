<?php

if (!empty($_FILES)) {
	$temp = $_FILES['files'][tmp_name];
	$dir_separator = DIRECTORY_SEPARATOR;
	$folder = "uploads";

	echo $destination_path = dirname(__FILE__).$dir_separator.$folder.$dir_separator;

	$target_path = $destination_path.$_FILES['files']['name'];
	move_uploaded_file($temp, $target_path);
}

?>