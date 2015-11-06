<?php

function sanitize_input($input) {
	return htmlspecialchars(stripslashes(trim($input)));
}

function ext_check($file) {
	$flag = false;
	$types = array("mp3", "wma", "wav", "m4a", "aif", "avi", "m4v", "wmv", "mp4", "mov", "doc", "wps", "pdf", "jpg", "pdf" , "tif", "tiff", "png", "zip", "rar", "7z", "txt", "rtf");
	$fileType = pathinfo($file,PATHINFO_EXTENSION);
	if (in_array($fileType,$types)) { return true; }
	else { return false; }
}

?>	