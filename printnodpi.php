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
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
if ($ext=='jpg')
{
$mimeext='jpeg';
}

else
{
$mimeext=$ext;
}
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

if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && (isset($_POST['resolution'])))
{
$previewimage = $_SESSION['userpath'].$image;
//$deletecmd="rm $previewimage";
$userpath=$_SESSION['userpath'];
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php#'.$_GET['image'].'">';

}

elseif (($requireauth !='yes') && (isset($_POST['resolution'])))
{
$previewimage = $filepath.$image;
//$deletecmd="rm $previewimage";
$userpath=$filepath;
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php#'.$_GET['image'].'">';
}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && (!isset($_POST['resolution'])))
{
$previewimage = $_SESSION['userpath'].$image;
//$deletecmd="rm $previewimage";
$userpath=$_SESSION['userpath'];
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=logout.php?sound=yes">';
}

elseif (($requireauth !='yes') && (!isset($_POST['resolution'])))
{
$previewimage = $filepath.$image;
//$deletecmd="rm $previewimage";
$userpath=$filepath;
$refreshurl='';
}



else
{
$refreshurl='';
//$deletecmd='';
}

list($imgwidth, $imgheight, $imgtype, $imgattr) = getimagesize($userpath.$image);
echo '<html lang="'.$lang.'">';
?>
<head>
<?php 


echo $refreshurl;






?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/style.css" type="text/css" />
 <link rel="stylesheet" href="css/jquery.jcrop.css" type="text/css" />
 <script src="/javascript/jquery.min.js" type="text/javascript"></script>
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
<?php include_once 'livemenu.php';?></td></tr>
</table>

<?php

// echo ($_SESSION['expire'] - $now);

/*(if (isset($_POST['resolution']))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitdeletingtxt.'...&nbsp;'.$image.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
*/
// use unlink
// $output = 
//shell_exec("$deletecmd");
// echo $deletecmd;
//}

//else
//{
	//if ($_SESSION['fromfilelister']=='yes')
	//{

if (($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now))
{
//echo 'AAA';
echo '<center><p><span style="color:#666; font-weight:bold">'.$printingnodpi.' '.$image.'.</span></p>';
	if ($_SESSION['password'] !='PAM')
	{
	echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
	}

	elseif ($_SESSION['password'] =='PAM')
	{
	$file=$_SESSION['userpath'].$image;
		if (file_exists($file))
		{
//		echo 'XXX';
		
     		$b64image = base64_encode(file_get_contents($file));
		echo "<img id='myImg' class='js-img' src = 'data:image/$mimeext;base64,$b64image' download='$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";  //pam image
		}
	}
}
/*
	echo '<form name="printnodpi" method="get" action="airscan.php">
	<p><span style="color:#666; font-weight:bold">'.$confirmprintnodpi.'</span></p>

  	<table border=0><tr><td>
	<input id="image"  name="image" type="hidden" value="'.$image.'" /> 
	<input style=" color:#666; font-weight:bold; width: 45px;" id="resolution"  name="resolution" type="number" min="1" max="999" step="1" value="300" />
       <input id="print"  name="print" type="hidden" value="yes" /> 
	<input id="returntofiles"  name="returntofiles" type="hidden" value="yes" /> 
	</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form method="post" action="'.$userpath.'index.php#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td></tr></table>
	</center>';
*/

	// echo 'x'.$imgheight;
	

if ($filemanagerunits =='both')
{
	echo '<form name="printnodpi" method="get" action="airscan.php">
	<p><span style="color:#666; font-weight:bold">'.$confirmprintnodpi.'</span></p>

  	<table border=0><tr><td colspan=5><center><table border=0><tr><td><center>
	<input id="image"  name="image" type="hidden" value="'.$image.'" /> 
	<input style="color:#666; background-color: #DDD; font-weight:bold" size="3" id="resolution" name="resolution" type="text" Value="" /><span style="color:#666; font-weight:bold">'.$dpi.' </span></td><td>
        <input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="widthin" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$inches.'x </span></td><td>
	<input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="heightin" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$inches.'</span></td></tr><tr><td></td><td>
        <input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="widthcm" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$centimeters.' x </span></td><td>
	<input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="heightcm" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$centimeters.'</span>
        <input id="print"  name="print" type="hidden" value="yes" /> 
	<input id="fastload"  name="fastload" type="hidden" value="yes" />
	<input id="returntofiles"  name="returntofiles" type="hidden" value="yes" /></center></td></tr></table>
	</center></td></tr><tr><td>
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form method="post" action="'.$userpath.'index.php#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td></tr></table>
	</center>';
}
elseif ($filemanagerunits =='in')
{
	echo '<form name="printnodpi" method="get" action="airscan.php">
	<p><span style="color:#666; font-weight:bold">'.$confirmprintnodpi.'</span></p>

  	<table border=0><tr><td colspan=5><center><table border=0><tr><td><center>
	<input id="image"  name="image" type="hidden" value="'.$image.'" /> 
	<input style="color:#666; background-color: #DDD; font-weight:bold" size="3" id="resolution" name="resolution" type="text" Value="" /><span style="color:#666; font-weight:bold">'.$dpi.' </span></td><td>
        <input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="widthin" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$inches.'x </span></td><td>
	<input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="heightin" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$inches.'</span>
        <input id="print"  name="print" type="hidden" value="yes" /> 
	<input id="fastload"  name="fastload" type="hidden" value="yes" />
	<input id="returntofiles"  name="returntofiles" type="hidden" value="yes" /></center></td></tr></table>
	</center></td></tr><tr><td>
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form method="post" action="'.$userpath.'index.php#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td></tr></table>
	</center>';
}

elseif ($filemanagerunits =='cm')
{
	echo '<form name="printnodpi" method="get" action="airscan.php">
	<p><span style="color:#666; font-weight:bold">'.$confirmprintnodpi.'</span></p>

  	<table border=0><tr><td colspan=5><center><table border=0><tr><td><center>
	<input id="image"  name="image" type="hidden" value="'.$image.'" /> 
	<input style="color:#666; background-color: #DDD; font-weight:bold" id="resolution" name="resolution" size="3" type="text" Value="" /><span style="color:#666; font-weight:bold">'.$dpi.' </span></td><td>
        <input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="widthcm" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$centimeters.' x </span></td><td>
	<input style="color:#666; background-color: #FFF; font-weight:bold" size="3" id="heightcm" readonly="readonly" value=""/><span style="color:#666; font-weight:bold">'.$centimeters.'</span>
        <input id="print"  name="print" type="hidden" value="yes" /> 
	<input id="fastload"  name="fastload" type="hidden" value="yes" />
	<input id="returntofiles"  name="returntofiles" type="hidden" value="yes" /></center></td></tr></table>

	</center></td></tr><tr><td>
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form method="post" action="'.$userpath.'index.php#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td></tr></table>
	</center>';

}




	//}
	/*elseif ($_SESSION['fromfilelister']!='yes')
	{
	echo '<center><p><span style="color:#666; font-weight:bold">'.$deleting.' '.$image.'</span></p>';
	echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
	echo '<form name="deletefile" method="post" action="delete.php?image='.$image.'">
	<p><span style="color:#666; font-weight:bold">'.$confirmdelete.'</span></p>
  	<table border=0><tr><td><input type="hidden" name="confirmdelete" value="yes">
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form method="post" action="/airscan.php?image='.$image.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'">
	<input type="submit" value="'.$cancel.'">
	</form></td></tr></table>
	</center>';
	}*/
//}
?>
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01" />
      <div id="caption"></div>
    </div>
<br/><center>
<?php include'footer.inc.php';?>
</center>
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
$(document).ready(function()
{
    function updatePrice()
    {
        var resolution = parseFloat($("#resolution").val());
        var total = <?php echo $imgwidth;?> / (resolution);
        var total = total.toFixed(2);
        $("#widthin").val(total);
           
        var resolution = parseFloat($("#resolution").val());
        var total = <?php echo $imgheight;?> / (resolution);
        var total = total.toFixed(2);
        $("#heightin").val(total);

        var resolution = parseFloat($("#resolution").val());
        var total = (<?php echo $imgwidth;?> / resolution) * 2.54 ;
        var total = total.toFixed(2);
        $("#widthcm").val(total);
           
        var resolution = parseFloat($("#resolution").val());
        var total = (<?php echo $imgheight;?> / resolution) * 2.54 ;
        var total = total.toFixed(2);
        $("#heightcm").val(total);
        

    

    }

    $(document).on("change, keyup", "#resolution", updatePrice);
});
</script>
</body>
</html>
