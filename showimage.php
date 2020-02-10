<?php
include_once 'phppagestart.php';

$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
if ($ext=='jpg')
{
$mimeext='jpeg';
}
elseif ($ext=='tif')
{
$mimeext='tiff';
}
else
{
$mimeext=$ext;
}

header("Content-type:image/$mimeext");
$image=$_GET['image'];
$pathimage=$_SESSION['userpath'].$_GET['image'];
header('Content-disposition: inline; filename="'.$image.'"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
//Scan20190318010759.jpg
@readfile($pathimage);
//@readfile("/home/kodi/Pictures/scans/Scan20190318010759.jpg");

/*
if ($ext=='jpg')
{
$mimeext='jpeg';
}
else
{
$mimeext=$ext;
}
*/
//header('Content-type: application/jpg');
//$file=$_SESSION[''].$_GET['image'];
//$filename=$_GET['image'];
//$basename = pathinfo($image, PATHINFO_FILENAME);
// $basename= substr($image, 0, -4);
//echo $_SESSION['loggedin'];
//error_reporting(1);
//error_reporting('On');
?>
