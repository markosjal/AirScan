<?php

// Posted parameters
$clipX = (int)$_POST['crop_x'];
$clipY = (int)$_POST['crop_y'];
$filename = (string)$_POST['image'];
$resizedHeight = (int)$_POST['height'];
$resizedWidth = (int)$_POST['width'];
 
// Original image's details
$original = $filename;
list($originalWidth, $originalHeight, $originalType) = getimagesize($original);
 
// Original image's resource
$types = array(1 => 'gif', 'jpeg', 'png');
$image = call_user_func('imagecreatefrom' . $types[$originalType], $original);
 
// Crop image
if (function_exists('imagecreatetruecolor') && ($temp = imagecreatetruecolor($resizedWidth, $resizedHeight)))
{
    imagecopyresampled($temp, $image, 0, 0, $clipX, $clipY, $resizedWidth, $resizedHeight, $originalWidth, $originalHeight);
}
else
{
    $temp = imagecreate($resizedWidth, $resizedHeight);
    imagecopyresized($temp, $image, 0, 0, $clipX, $clipY, $resizedWidth, $resizedHeight, $originalWidth, $originalHeight);
}
 
// Download image
header('Content-type: image/', $originalType);
header('Content-Disposition: attachment; filename="' . $filename . '"');
call_user_func('image' . $types[$originalType], $temp);

?>
