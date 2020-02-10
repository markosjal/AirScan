<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
// error_reporting( -1 );
// ini_set( 'display_errors', 1 );

include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
// $previewimage = $filepath.$image;
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$now=time();
if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
	if (($_SESSION['expire'] - $now) <= $addtime)
	{
	$_SESSION['expire']=($_SESSION['expire'] + $buytime);
	}

	else
	{
	echo '';
	}
}
else
{
echo '';
}

if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes'))
{
$previewimage = $_SESSION['userpath'].$image;

}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;

}

else
{
}


/*  just seems wrong
if (isset($printscalewidth) && ($printscalewidth != '' || $printscalewidth != NULL))
{
$widthadjx=($printscalewidth*$printscaletrimw);
}
else 
{
$widthadjx=($widthadj*$printscaletrimw);
}
if (isset($printscaleheight) && ($printscaleheight != '' || $printscaleheight != NULL))
{
$heightadjx=($printscaleheight*$printscaletrimh);
}

else
{
$heightadjx=($heightadj*$printscaletrimh);
}

*/

if ((isset($printscalewidth)) && (($printscalewidth != '') || ($printscalewidth != NULL)))
{
$widthadjx=($printscalewidth*$printscaletrimw);
}
else 
{
$widthadjx=($widthadj*$printscaletrimw);
}
if ((isset($printscaleheight)) && (($printscaleheight != '') || ($printscaleheight != NULL)))
{
$heightadjx=($printscaleheight*$printscaletrimh);
}
else
{
$heightadjx=($heightadj*$printscaletrimh);
}






list($width, $height, $type, $attr) = getimagesize($previewimage);
//list($imgwidth, $imgheight, $imgtype, $imgattr) = getimagesize('scans/Mark/'.$file);

/*
function get_dpi($filename){
$a = fopen($filename,’r’);
$string = fread($a,20);
fclose($a);

$data = bin2hex(substr($string,14,4));
$x = substr($data,0,4);
$y = substr($data,0,4);
return array(hexdec($x),hexdec($y));
}

*/

$heightadjdec=($heightadjx/100);

$widthadjdec=($widthadjx/100);

$widthinnum= (number_format((float)($width / $resolution), 2, '.', ''));

$heightinnum= (number_format((float)($height / $resolution), 2, '.', ''));

$heightinchesadjusted=(($heightinnum)*($heightadjdec)).'in';

$widthinchesadjusted=(($widthinnum)*($widthadjdec)).'in';

$widthinches= (number_format((float)($width / $resolution), 2, '.', '')).'in';

$heightinches= (number_format((float)($height / $resolution), 2, '.', '')).'in';

$widthcm= (number_format((float)(($width / $resolution)*2.54), 2, '.', '')).'cm';

$heightcm= (number_format((float)(($height / $resolution)*2.54), 2, '.', '')).'cm';

if (($widthinnum >= $letterlegalwidthoverride) && ($printsize == 'legal')) {
$marginoverride='0.0cm';
$override='over legal-letter size width'; 

}

elseif (($heightinnum >= $letterheightoverride) && ($printsize == 'letter')) {
$marginoverride='0.0cm';
$override='over letter size height'; 
}

elseif (($heightinnum >= $legalheightoverride) && ($printsize == 'legal')) {
$marginoverride='0.0cm';
$override='over legal size height'; 
}

elseif (($widthinnum >= $a4widthoverride) && ($printsize == 'A4')) {
$marginoverride='0.0cm';
$override='over a4 size width'; 

}

elseif (($heightinnum >= $a4heightoverride) && ($printsize == 'A4')) {
$marginoverride='0.0cm';
$override='over a4 size height'; 
}



elseif (($widthinnum >= $jisb5widthoverride) && ($printsize == 'JISB5')) {
$marginoverride='0.0cm';
$override='over jisb5 size width'; 

}

elseif (($heightinnum >= $jisb5heightoverride) && ($printsize == 'JISB5')) {
$marginoverride='0.0cm';
$override='over jisb5 size height'; 
}



elseif (($widthinnum >= $isob5widthoverride) && ($printsize == 'ISOB5')) {
$marginoverride='0.0cm';
$override='over isob5 size width'; 

}

elseif (($heightinnum >= $isob5heightoverride) && ($printsize == 'ISOB5')) {
$marginoverride='0.0cm';
$override='over isob5 size height'; 
}



elseif (($widthinnum >= $abwidthoverride) && ($printsize == 'AB')) {
$marginoverride='0.0cm';
$override='over AB size width'; 

}

elseif (($heightinnum >= $abheightoverride) && ($printsize == 'AB')) {
$marginoverride='0.0cm';
$override='over AB size height'; 
}





else {
$marginoverride=$margin;
}

?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="private, no-store" />
<meta name="Expires" content="Tue, 01 Jun 1999 19:58:02 GMT"> 
  <title><?php echo $image; ?></title>
<style>
@media print
{
   @page
   {
    size: <?php echo $printsize; ?> <?php echo $orientation; ?>; !important;
    margin: <?php echo $marginoverride; ?>  <?php echo $marginoverride; ?>  <?php echo $marginoverride; ?>  <?php echo $marginoverride; ?> !important;
    padding: <?php echo $padding; ?> !important;
    }
   body  
    { 
    /* this affects the margin on the content before sending to printer */ 
    margin: 0px !important;
    }
    html
    {
        background-color: #FFFFFF !important;
        margin: 0px !important;  /* this affects the margin on the html before sending to printer */
    }


img.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
    	width: <?php echo $widthinchesadjusted;?> !important;
    	height: <?php echo $heightinchesadjusted;?> !important;
}



}
@media screen
{
   @page
   {


    width: 70%;

  }

img {
    max-width: 70%
}

img.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
}
}
</style>
</head>
<?php
if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
	if (($_SESSION['expire'] - $now) <= $addtime)
	{
	$_SESSION['expire']=($_SESSION['expire'] + $buytime);
	}

	else
	{
	echo '';
	}
}
else
{
echo '';
}

?>

<body>
<?php //echo $_GET['resolution'].'<br>'.$width.'<br>'.$height.'<br/>'.$widthinnum.'<br>'.$heightinnum.'<br>'.$previewimage;
//echo $imgheight; 
//echo '<br>init '.(int)$height;
//echo '<br>float '.(float)$height;
// print_r(getimagesize('scans/Scan20190218161022.jpg')); ?>

<?php 

if ($_SESSION['password']=='PAM')
{
$file = $previewimage;
	if (file_exists($file))
	{
     	$b64image = base64_encode(file_get_contents($file));
     	//echo "<img src = 'data:image/jpg;base64,$b64image'>";
	echo "<img class='center' src = 'data:image/jpg;base64,$b64image' download='$image'/>";
	}

}
else 
{
echo '<img src ="'.$previewimage.'" class="center"/>';
}
?>

 <script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
</body>
</html>
