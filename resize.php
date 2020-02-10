<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$flip=$_GET['flip'];
//$flippedfile= substr($image, 0, -4).$flipname.'.jpg';
//$floppedfile= substr($image, 0, -4).$flopname.'.jpg';
// $previewimage = $filepath.$image;
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$ext = strtolower(pathinfo($_GET['image'], PATHINFO_EXTENSION));
$basename = pathinfo($_GET['image'], PATHINFO_FILENAME);
//$basename= substr($image, 0, -4);
//$without_extension = basename($filename, '.'.$ext');
$now=time();
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
//echo $ext;

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

if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['password']=='PAM'))
{
$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
$resizecmd=$imagemagicklocation.' '.$userpath.$image.' -resize '.$_GET["width"].'x'.$_GET["height"].'\! '.$userpath.$_GET['newname'].'.'.$_GET['newext'];
$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['newname'].'.'.$_GET['newext'];
}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['password']!='PAM'))
{
$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
$resizecmd=$imagemagicklocation.' '.$root.$userpath.$image.' -resize '.$_GET["width"].'x'.$_GET["height"].'\! '.$root.$userpath.$_GET['newname'].'.'.$_GET['newext'];
}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$deletecmd="rm $previewimage";
$userpath=$filepath;
$resizecmd=$imagemagicklocation.' '.$root.$userpath.$image.' -resize '.$_GET["width"].'x'.$_GET["height"].'\! '.$root.$userpath.$_GET['newname'].'.'.$_GET['newext'];
}

else
{
$previewimage =NULL;
$deletecmd='';
$userpath='';
$resizecmd='';
}




list($imgwidth, $imgheight, $imgtype, $imgattr) = getimagesize($previewimage);
$exif = exif_read_data($previewimage);
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



// print_r($exif);

// echo $imgwidth.'X'.$imgheight;
// print_r($exif);

if ($requireauth!='yes')
{
	if (($_SESSION['fromfilelister']=='yes') && ($_GET['confirm']!='yes'))
	{
	$refreshurl='';
	}
	elseif (($_SESSION['fromfilelister']=='yes') && ($_GET['confirm']!='yes'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$_GET['newname'].'.'.$_GET['newext'].'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_GET['confirm']=='yes'))  // correct
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php?resolution='.$resolution.'&deskew='.$deskew.'&autocrop='.$autocrop.'&print='.$print.'&printscaleheight='.$printscaleheight.'&printscalewidth='.$printscalewidth.'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_GET['confirm']!='yes'))
	{
	$refreshurl='';
	}
	else
	{
	$refreshurl='';
	}
}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']=='yes'))
{
	if (($_SESSION['fromfilelister']=='yes') && ($_GET['confirm']!='yes'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=logout.php?sound=yes">';
	}
	elseif (($_SESSION['fromfilelister']=='yes') && ($_GET['confirm']=='yes') && ($_SESSION['password']=='PAM'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=pamindex.php?rand='.$rand.'#'.$_GET['newname'].'.'.$_GET['newext'].'">';
	}
	elseif (($_SESSION['fromfilelister']=='yes') && ($_GET['confirm']=='yes') && ($_SESSION['password']!='PAM'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$_GET['newname'].'.'.$_GET['newext'].'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_GET['confirm']=='yes'))  // correct
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php?resolution='.$resolution.'&deskew='.$deskew.'&autocrop='.$autocrop.'&print='.$print.'&printscaleheight='.$printscaleheight.'&printscalewidth='.$printscalewidth.'&image='.$_GET['newname'].'.'.$_GET['newext'].'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_GET['confirm']!='yes'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=logout.php?sound=yes">';
	}
	else
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
	}
}
else 
{
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
}




echo '<html lang="'.$lang.'">';
?>

<head>
 
  <meta charset="<?php echo $charset;?>"> 
  <?php echo $refreshurl;?>
  <meta http-equiv="Cache-Control" content="private, no-store" /> 
  <meta name="Expires" content="Tue, 01 Jun 1999 19:58:02 GMT"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/style.css" type="text/css" />

<?php // echo 'Loggedin?'.$_SESSION['loggedin'];?>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {
  opacity: 0.7;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 20px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: <?php echo $fileopzoomwidth;?>;
  max-width: <?php echo $fileopzoommaxwidth;?>;
  height:  <?php echo $fileopzoomheight;?>;
  max-height: <?php echo $fileopzoommaxheight;?>;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 50%;
  max-width: auto;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 70px;
}

/* Add Animation */
.modal-content,
#caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {
    -webkit-transform: scale(0);
  }
  to {
    -webkit-transform: scale(1);
  }
}

@keyframes zoom {
  from {
    transform: scale(0);
  }
  to {
    transform: scale(1);
  }
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
  .modal-content {
    width: 100%;
  }
}


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

//http://airscan.tecnologiadeleon.com/resize.php?image=Scan20190301202455.jpg&confirm=yes&width=640&height=945&newname=Scan20190301202455Resiz&newext=gif
if ($_GET['confirm']!='yes')
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
if ((($requireauth!='yes') && (isset($_GET['image'])) && ($_GET['confirm']=='yes') && (isset($_GET['newext'])) && (isset($_GET['newname'])))  || (($requireauth=='yes') && (isset($_GET['image'])) && ($_GET['confirm']=='yes') && ($_SESSION['loggedin']=='yes') && (($_SESSION['expire'] - $now) > 2) && (isset($_GET['newext'])) && (isset($_GET['newname'])) ))
{
	echo '<center><p><span style="color:#666; font-weight:bold">'.$waitresizingtxt.' '.$image.' '.$to.' '.$_GET['newname'].'.'.$_GET['newext'].'</span></p></center>';
	echo '<center><img src="images/spinner.gif"></center>';
	ob_flush();
	flush();
	shell_exec("$resizecmd");
	if ($_SESSION['password']=='PAM')
	{
	sleep("$chmodsleep");
	shell_exec("$chmod");
	}
	else
	{
	}

//echo $resizecmd;
//echo $chmod;



}



elseif ((($requireauth!='yes') && (isset($_GET['image'])) && ($_GET['confirm']!='yes')) || (($requireauth=='yes') && (isset($_GET['image'])) && ($_GET['confirm']!='yes') && ($_SESSION['loggedin']=='yes') && (($_SESSION['expire'] - $now) > 2)))
{
//echo 'this is else';
echo '<center><p><span style="color:#666; font-weight:bold">'.$resizing.' '.$image.'<br/>'.$imgwidth.' x '.$imgheight.$pixels.' '.$resolution.'</span></p>';
/*
 		if ($ext=='pdf')
		{ 
		echo 'PDF';

			if ($_SESSION['password'] == 'PAM')
			{
			echo '
    			<iframe class="frame" style = "margin: 0; padding: 0; border: none; width: '.$fileopmaxwidth.'; height: '.$fileopmaxheight.'" src="showpdf.php?image='.$image.'"></iframe>';
			}
	
			elseif ($_SESSION['password'] != 'PAM')
			{
			echo '<embed src="/'.$userpath.$image.'" type="application/pdf" width="'.$fileopmaxwidth.'" height="'.$fileopmaxheight.'" />';
			}
		}





		else//if  ($ext!='pdf')
		{*/
		//echo 'not pdf';
			if  ($_SESSION['password']=='PAM')
			{
			//echo 'PAM';
			$file = $_SESSION['userpath'].$image;
				if (file_exists($file))
				{
     				$b64image = base64_encode(file_get_contents($file));
				echo "<img id='myImg' class='js-img' src = 'data:image/$mimeext;base64,$b64image' download='$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";  //pam image
				//echo "<img id='myImg' class='js-img' src='$$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
				}
			}	
			else// ($_SESSION['password']!='PAM') // (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='webp'))	
			{
			//echo 'not PAm';
			echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
			
		//}
}
		
?>
<form id="myform" action="resize.php" enctype="multipart/form-data" method="get">
<input type="hidden" id="image" name="image" value="<?php echo $_GET['image'];?>">
<input type="hidden" id="confirm" name="confirm" value="yes">
<table border=0 style="text-align: center; border: 0px solid black;"><tr><td colspan=2 style="text-align: center;"><span style="color:#666; font-weight:bold">&nbsp;</span></td></tr><tr><td colspan=2><span style="color:#666; font-weight:bold"><?php echo $resisingdetailstxt;?></span></td></tr>
<tr><td style="text-align: right;"><input type="number" id="w" name="width" size="9" value="<?php echo $imgwidth;?>" style="width: 45px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" onblur="calculateHeight(this.value)"><span style="color:#666; font-weight:bold"><?php echo $widthtxt;?> x </span>
</td><td style="text-align: left;">
<input type="number" id="h" name="height" size="9" value="<?php echo $imgheight;?>" style="width: 45px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" onblur="calculateWidth(this.value)"><span style="color:#666; font-weight:bold"><?php echo $heighttxt;?></span>

</td></tr><tr><td colspan=2 style="margin:0 auto;"><span style="color:#666; font-weight:bold">&nbsp;</span></td></tr><tr><td colspan=2><span style="color:#666; font-weight:bold"><?php echo $convertnewnametxt;?></span></td></tr>
<tr><td colspan=2 style="margin:0 auto;">
<table border=0 style="margin:0 auto; width: 50%; border: 0px solid black;">
<tr><td style="text-align: center;">
<input type="text" id="newname" name="newname" value="<?php echo $basename.$resizename;?>" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold">
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


	</div></td></tr></table></td></tr><tr><td colspan=2>&nbsp;</td></tr><tr><td style="vertical-align: bottom">

<br/><input type="submit" value="<?php echo $confirm; ?>" />

</td>
</form>
<?php
if ($_SESSION['password']!='PAM')
echo'
<td style="vertical-align: bottom">
<form method="post" action="'.$userpath.'index.php?rand='.$rand.';?>#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td>';



elseif ($_SESSION['password']=='PAM')
echo'
<td style="vertical-align: bottom">
<form method="post" action="pamindex.php?rand='.$rand.';?>#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td>';




?>
</tr></table>


<?php
}
 /*
test<input type="number" id="test" name="test" size="5" type="text" style="color:#666; background-color: #DDD; font-weight:bold" value="" />
*/
?>



<?php /*
<form id="myform" action="readpost.php" method="GET">

Width<input type="number" id="w" placeholder="Enter width..." onblur="calculateHeight(this.value)">
Height<input type="number" id="h" placeholder="Enter height..." onblur="calculateWidth(this.value)">

<button onclick="javascript: submitform()">
  accept
</button>

</form>
*/
?>






<?php 
/*
<p>
<img id="img" src="scans/Scan20190301195705.jpg">
</p>
*/
if ($_GET['confirm']!='yes')
{
echo '<br/><center>';
include 'footer.inc.php';
echo '</center>';
}
?>

    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01" />
      <div id="caption"></div>
    </div>

<?php include'livemenujs.php';?>

<script>
// Get the modal
var modal = document.getElementById("myModal");
console.log(modal);

// Get the image and insert it inside the modal - use its "alt" text as a caption
var imgs = document.getElementsByClassName("js-img")
console.log(Array.from(imgs))
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
// Array.from is necessary because document.getElementsByClassName
// do not return an array but a HTMLCollection : https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByClassName
// you can use querySelectorAll (which is a more recent function), see here : https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelectorAll
Array.from(imgs).forEach(function(img) {
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  };
})

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};
</script>
<script>
let $img = document.getElementById('myImg');
let $heightInput = document.getElementById('h');
let $widthInput = document.getElementById('w');

function calculateHeight(width){
  let naturalHeight = $img.naturalHeight;
  let naturalWidth = $img.naturalWidth;
  let aspectRatio = naturalHeight/naturalWidth;
  
  let height = (Math.round(width*aspectRatio));
  $heightInput.value = height;
}

function calculateWidth(height){
  let naturalHeight = $img.naturalHeight;
  let naturalWidth = $img.naturalWidth;
  let aspectRatio = naturalWidth/naturalHeight;
  
  console.log(height, naturalHeight, naturalWidth);
  let width = (Math.round(height*aspectRatio));
  $widthInput.value = width;
}

function apply(){
  
  let height = $heightInput.value;
  let width = $widthInput.value;
  
  if(height > 0){
  	$img.style.height = `${height}px`;
  } else {
    $img.style.height = `auto`;
  }
  
  if(width > 0){
  	$img.style.width = `${width}px`;
  } else {
    $img.style.width = `auto`;
  }
}
function submitform()
{
    document.forms["myform"].submit();
}

</script>
</body>
</html>
