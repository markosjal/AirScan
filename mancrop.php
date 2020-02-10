<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
include_once('config.inc.php');
include_once('lang.php');
$clipX = (int)$_GET['crop_x'];
$clipY = (int)$_GET['crop_y'];
$filename = (string)$_GET['image'];
$resizedHeight = (int)$_GET['height'];
$resizedWidth = (int)$_GET['width'];
//$newcrop= substr($filename, 0, -4).$mcrop.'.jpg';
$newcrop= substr($filename, 0, -4).$mcrop.'.'.$ext;
$now=time();
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$basename = pathinfo($_GET['image'], PATHINFO_FILENAME);
if ($ext=='jpg')
{
$mimeext='jpeg';
}
else
{
$mimeext=$ext;
}
function get_all_get()
{
        $output = "?"; 
        $firstRun = true; 
        foreach($_GET as $key=>$val) { 
        if($key != $parameter) { 
            if(!$firstRun) { 
                $output .= "&"; 
            } else { 
                $firstRun = false; 
            } 
            $output .= $key."=".$val;
         } 
    } 

    return $output;
}   
$url= get_all_get();
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




/* exec("convert $target_path -crop ".$w."x".$h."+$x+$y +repage $target_path");
https://stackoverflow.com/questions/29089307/cropping-an-image-using-jcrop-and-imagemagick
convert input.png -crop ${x}x${y}+${a}+${b} output.png */
// $filename=$_POST['image'];
if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now) && ($_SESSION['password']!='PAM'))
{
//$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
$mcropcmd=$imagemagicklocation.' '.$root.$_SESSION['userpath'].$filename.' -crop '.$_GET["width"].'x'.$_GET["height"].'+'.$_GET["crop_x"].'+'.$_GET['crop_y'].' +repage '.$root.$userpath.$_GET['newname'].'.'.$_GET['newext'];
//$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now)&& ($_SESSION['password']=='PAM'))
{
//$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
$mcropcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$filename.' -crop '.$_GET["width"].'x'.$_GET["height"].'+'.$_GET["crop_x"].'+'.$_GET['crop_y'].' +repage '.$userpath.$_GET['newname'].'.'.$_GET['newext'];
$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newname'].'.'.$_GET['newext'];
echo $mcropcmd;

}


elseif ($requireauth !='yes') 
{
//$previewimage = $filepath.$image;
$userpath=$filepath;
$mcropcmd=$imagemagicklocation.' '.$root.$_SESSION['userpath'].$filename.' -crop '.$_GET["width"].'x'.$_GET["height"].'+'.$_GET["crop_x"].'+'.$_GET['crop_y'].' +repage '.$root.$_userpath.$_GET['newname'].'.'.$_GET['newext'];

}

else
{
$mcropcmd='';
}

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


echo '<html lang="'.$lang.'">';
?>
<head>
<?php

/* 
if ($_POST['confirmdelete']=='yes')
{
echo '<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$refreshurl.'">';
}

else 
{
echo '';
}

*/
if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && (($_SESSION['expire'] - $now ) > 1) && ($_SESSION['password']!='PAM')) 
{
//echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';

	if (($_GET['return']!='airscan.php') && (isset($_GET['image'])) && (isset($_GET['crop_x'])) && (isset($_GET['crop_y'])) && (isset($_GET['height'])) && (isset($_GET['width'])))
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$_GET['newname'].'.'.$_GET['newext'].'">';
	}

	elseif (($_GET['return']=='airscan.php') && (isset($_GET['image'])) && (isset($_GET['crop_x'])) && (isset($_GET['crop_y'])) && (isset($_GET['height'])) && (isset($_GET['width'])))
	{
	list($path, $query_string) = explode('?', $url, 2);
	// parse the query string
	parse_str($query_string, $params);
	// delete image param
	unset($params['image']);
	// change the print param
	//$params['image'] = $blackwhitefile;
	$params['rand'] = $rand;
	// rebuild the query
	$query_string = http_build_query($params);
	// reassemble the URL
	$urlvars = $path . '?' . $query_string;
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php'.$urlvars.'&image='.$_GET['newname'].'.'.$_GET['newext'].'">';
	}


	elseif ((!isset($_GET['image'])) || (!isset($_GET['crop_x'])) || (!isset($_GET['crop_y'])) || (!isset($_GET['height'])) || (!isset($_GET['width'])))
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';
	}

	else
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);	
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
	session_destroy();
	}

}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && (($_SESSION['expire'] - $now ) > 1) && ($_SESSION['password']=='PAM')) 
{
//echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';

	if ((isset($_GET['image'])) && (isset($_GET['crop_x'])) && (isset($_GET['crop_y'])) && (isset($_GET['height'])) && (isset($_GET['width'])))
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="10; url=pamindex.php?rand='.$rand.'#'.$_GET['newname'].'.'.$_GET['newext'].'">';
	}

	elseif ((!isset($_GET['image'])) || (!isset($_GET['crop_x'])) || (!isset($_GET['crop_y'])) || (!isset($_GET['height'])) || (!isset($_GET['width'])))
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';
	}

	else
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);	
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
	session_destroy();
	}

}

elseif ($requireauth!='yes')
{
//echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';

	if ((isset($_GET['image'])) && (isset($_GET['crop_x'])) && (isset($_GET['crop_y'])) && (isset($_GET['height'])) && (isset($_GET['width'])))
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$newcrop.'">';
	}

	elseif ((!isset($_GET['image'])) || (!isset($_GET['crop_x'])) || (!isset($_GET['crop_y'])) || (!isset($_GET['height'])) || (!isset($_GET['width'])))
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';
	}

	else
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	}

}

else
{
echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php">';
}

?>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="private, no-store" />
<meta name="Expires" content="<?php echo $rfc_1123_date;?>"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title><?php echo $pagetitle; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="javascript/jquery.min.js"></script>
<script src="javascript/jquery.jcrop.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.jcrop.css" type="text/css" /> 
 <?php /* <link rel="stylesheet" href="css/jcrop.main.css" type="text/css" /> */ ?>
<style>

/*drop downs*/


/* -------------------- Select Box Styles: bavotasan.com Method (with special adaptations by ericrasch.com) */
/* -------------------- Source: http://bavotasan.com/2011/style-select-box-using-only-css/ */
.styled-select {
   background: url(images/15xvbd5.png) no-repeat 90% 0;
   height: 25px;
   overflow: hidden;
   width:70px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 13px;
   font-weight: bold;
   height: 29px;
   padding: 0px; /* If you add too much padding here, the options wont show in IE */
   width: 66px;
}

.styled-select.slate {
   background: url(images/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #ddd; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #666; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
   background: #58B14C url("images/15xvbd5.png") no-repeat scroll 319px center;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(images/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
}

select#soflow-color {
   color: #fff;
   background-image: url(images/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}

/* begin overlay , pinned menu*/


/* body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}*/

.top-container {
  background-color: #f1f1f1;
  padding: 0px;
  text-align: center;
}

.header {
  padding: 0px 16px;
  background: #FFF;
  color: #f1f1f1;
}

.content {
  padding: 0px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1;
}

.sticky + .content {
  padding-top: 2px;
}
/* end overlay */
</style>
 
</head>
<body>
<table id='page_header'><tr><td>
        <a href='/airscan.php'>
          <img id='logo' src='/images/AirScan.png' alt='AirScan'>
        </a></td>

</tr>
	<tr><td><hr></td></tr><tr><td>
<?php 



list($imgwidth, $imgheight, $imgtype, $imgattr) = getimagesize($userpath.$_GET['image']);
$exif = exif_read_data($userpath.$_GET['image']);
$xres = eval('return '.$exif["XResolution"].';');
$yres = eval('return '.$exif["YResolution"].';');

if ((!is_numeric($yres)) || (!is_numeric($xres)))
{
$resolution=$dpierror;
}
elseif ((is_numeric($yres)) || (is_numeric($xres)))
{
$resolution=$xres.' x '.$yres.$dpi;
}
else
{
$resolution=$dpierror;
}




if ((!isset($_GET['crop_x'])) || (!isset($_GET['crop_y'])) || (!isset($_GET['width'])) || (!isset($_GET['height'])))  //crop_x=104&crop_y=27&width=452&height
{
include_once 'livemenu.php';
}

else
{
}
?>
</td></tr>
</table>

<center>
<?php

if ((!isset($_GET['crop_x'])) || (!isset($_GET['crop_y'])) || (!isset($_GET['height'])) || (!isset($_GET['width'])))
{
	if ($showtips=='yes')
	{
	echo '<span style="color:#A80; font-weight:bold">'.$mancroptip1.'</span>';
	}
	else
	{

	}

?>


<span style="color:#666; font-weight:bold"><?php echo $cropping;?> <?php echo $filename;?>
<br/><?php echo $imgwidth;?> x <?php echo $imgheight.$pixels;?> <?php echo $resolution;?></span><br/>
<span style="color:#666; font-weight:bold"><p><?php echo $mancroptxt;?></p></span>


<?php 
if ($_SESSION['password'] != 'PAM')
{
echo '<img style="z-index: 0" id="cropbox" src="'.$userpath.$filename.'"/>';
}
elseif ($_SESSION['password'] == 'PAM')
{
$b64image = base64_encode(file_get_contents($userpath.$filename));
echo "<img id='cropbox' class='js-img' src = 'data:image/$mimeext;base64,$b64image' download='$image' alt='$image' style='z-index: 0 width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
}
?>




<span style="color:#666; font-weight:bold"><p><?php echo $mancroptxt2;?></p></span>
<table border=0><tr><td colspan=3><center>

<form action="mancrop.php" enctype="multipart/form-data" method="get">
<input name="image" type="hidden" value="<?php echo $filename; ?>" />
<input id="crop_x" name="crop_x" type="hidden" value="0" />
<input id="crop_y" name="crop_y" type="hidden" value="0" />
<input id="width" name="width" type="text" style="width: 45px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" value="" /><span style="color:#666; font-weight:bold"><?php echo $widthtxt.' x';?></span>
<input id="height" name="height" type="text" style="width: 45px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" value="" /><span style="color:#666; font-weight:bold"><?php echo $heighttxt ;?></span><br/>

</center></td></tr><tr><td colspan=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td colspan=3>





<table style="width: 100%; text-align:center; border: 0px solid black;">
<tr><td style="text-align: center">
<input type="text" id="newname" name="newname" value="<?php echo $basename.$mcrop;?>"style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold">
</td><td>
<span style="color:#666; font-weight:bold">.</span></td><td>
<div class="styled-select blue semi-square"><select name="newext">
<?php

// above was ; font-weight:bold" placeholder="Enter height..." onblur="calc
//if ($ext=='jpg')  			//from jpg
//{		
echo '<option value="gif"';    					//start to gif			
	if ($ext=="gif") 
	{
	echo ' selected '; 
	}
	else 
	{
	echo '';
	}
echo '>gif</option>

<option value="jpg"';     					//start to jpg
	if ($ext=="jpg") 
	{
	echo ' selected '; 
	}
	else 
	{
	echo '';
	}

echo '>jpg</option>

<option value="pdf"'; 		//start to pdf
	if ($ext=="pdf") 
	{			
	echo ' selected ';
	}
	else 
	{
	echo '';
	}
echo '>pdf</option>

<option value="png"';    		//start to png
	if ($ext=="png") 
	{
	echo ' selected '; 
	}
	else 
	{
	echo '';
	}
echo '>png</option>';
				
?>


	</div></td></tr></table>






</td></tr><tr><td colspan=3>&nbsp;</td></tr><tr><td>
<input type="submit" value="<?php echo $confirm; ?>" /></form>
</td>
<td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>


<?php
//echo $_GET['return'];
if ($_GET['return'] !='airscan.php')
{
echo '<form method="post" action="'.$userpath.'index.php?rand='.$rand.'#'.$_GET['image'].'"><input type="submit" value="'.$cancel.'"></form></td></tr></table>';
}

elseif ($_GET['return'] =='airscan.php')
{
///echo'cccc';  
list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['image']);
// change the print param
//$params['image'] = $blackwhitefile;
$params['rand'] = $rand;
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;

//echo $urlvars;
echo '<form method="post" action="airscan.php'.$urlvars.'"><input type="submit" value="'.$cancel.'"></form></td></tr></table>';
//echo '  <form method="post" action="'.$userpath.'index.php"><input type="submit" value="'.$cancel.'"></form></td></tr></table>';

}
?>
<br/><center>

</center>
<?php include'footer.inc.php';?>
<?php /*
        $("#crop_x").Math.round(val(cropbox.x));
        $("#crop_y").Math.round(val(cropbox.y));
        $("#width").Math.round(val(cropbox.w));
        $("#height").Math.round(val(cropbox.h));


        $("#crop_x").val(Math.round(cropbox.x));
        $("#crop_y").val(Math.round(cropbox.y));
        $("#width").val(Math.round(cropbox.w));
        $("#height").val(Math.round(cropbox.h));
*/ 

//echo $basename;

?>






<script>
$(function() {
    $('#cropbox').Jcrop({ boxWidth: <?php echo $boxwidth;?>, boxHeight: <?php echo $boxheight;?> });
});


$(document).ready(function()
{
    // Update co-ordinates
    function updateCoordinates(cropbox)
    {
        $("#crop_x").val(Math.round(cropbox.x));
        $("#crop_y").val(Math.round(cropbox.y));
        $("#width").val(Math.round(cropbox.w));
        $("#height").val(Math.round(cropbox.h));
    }


 
    // Attach jCrop
    $("#cropbox").Jcrop({
        <?php echo (isset($_POST['aspect_ratio']) ? 'aspectRatio: ' . ((float)$_POST['width'] / (float)$_POST['height']) . ',' : ''); ?>
        onChange: updateCoordinates,
        onSelect: updateCoordinates
    });
});
-->
</script>




<?php
}

if ((isset($_GET['image'])) && (isset($_GET['crop_x'])) && (isset($_GET['crop_y'])) && (isset($_GET['height'])) && (isset($_GET['width'])))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitcroppingtxt.'...&nbsp;'.$filename.' '.$to.' '.$_GET['newname'].'.'.$_GET['newext'].'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';


//$mcropcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$filename.' -crop '.$_GET["width"].'x'.$_GET["height"].'+'.$_GET["crop_x"].'+'.$_GET['crop_y'].' +repage '.$_SESSION['userpath'].$newcrop;
ob_flush();
flush();
shell_exec("$mcropcmd");
	if ($_SESSION['password']=='PAM')
	{
	sleep("$chmodsleep");
	shell_exec("$chmod");
	}
	else
	{
	}

//echo $mcropcmd;
}
?></center>
<?php include_once 'livemenujs.php';?>
</body>
</html>



