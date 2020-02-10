<?php 
$remoteImage = "/var/www/html/eSCL/Scans/XYZ.jpg";
$ext = pathinfo($remotemage, PATHINFO_EXTENSION);
if ($ext=='pdf') 
{
header("Content-type:application/pdf");
}

else 
{
$imginfo = getimagesize($remoteImage);
header("Content-type: {$imginfo['mime']}");
readfile($remoteImage);
}

die();
?>
