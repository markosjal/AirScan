<?php
 include_once('config.inc.php');
include_once('lang.php');
// Posted parameters
$clipX = (int)$_POST['crop_x'];
$clipY = (int)$_POST['crop_y'];
$filename = (string)$_POST['image'];
$resizedHeight = (int)$_POST['height'];
$resizedWidth = (int)$_POST['width'];
$newcrop= substr($filename, 0, -4).$mcrop.'.jpg';

$mcropcmd=$imagemagicklocation.' '.$filename.' -crop '.$_POST["width"].'x'.$_POST["height"].'+'.$_POST["crop_x"].'+'.$_POST['crop_y'].' +repage '.$newcrop;

// echo 'clipx '.$clipX.'<br/>clipy '.$clipY.'<br/>File '.$filename.'<br/>New height '.$resizedHeight.'<br/>New Width '.$resizedWidth.'<br/>New file '.$newcrop.'<br/>command '.$mcropcmd;



shell_exec("$mcropcmd");
?>
