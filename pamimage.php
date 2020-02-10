<?php
/*
    if(strtoupper($_SERVER['REQUEST_METHOD']) == 'GET'
    && isset($_GET['image']) && isset($_GET['path']))
    {    header('Content-type: image/jpeg');
         readfile("{$_GET['path']}{$_GET['image']}");
         // THIS WILL HAVE THE FOLLOWING VALUE ONCE CALLED:
         // readfile("d:/path/to/my/file/myfile.jpg");
         exit();
    }
*/
/*
header('Content-type: image/jpeg');
echo imagejpeg("/home/kodi/Pictures/scans/Scan20190315060808.jpg");
die;
*/
/*
header('Content-type: image/jpeg');
readfile("/home/kodi/Pictures/scans/Scan20190315060808.jpg");
exit();
*/
/*
header('Content-Type: image/jpg');
//readfile("$_GET['path']" . $_GET['pamimage']);
readfile("/home/kodi/Pictures/scans/Scan20190315060808.jpg");
*/

$filename = 'Scan20190315060808.jpg';
$fileDir = "/home/kodi/Pictures/scans";
$file = $fileDir . $filename;
if (file_exists($file))
{
     $b64image = base64_encode(file_get_contents($file));
     echo "<img src = 'data:image/jpg;base64,$b64image'>";
}


?>
