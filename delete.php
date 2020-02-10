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
$mppdf=$_GET['mppdf'];
$jpgpdf=$_GET['jpgpdf'];
$pdfname=$_GET['pdfname'];
$basename = pathinfo($image, PATHINFO_FILENAME);
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

if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes'))
{
$previewimage = $_SESSION['userpath'].$image;
$deletecmd="rm $previewimage";
$userpath=$_SESSION['userpath'];
}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$deletecmd="rm $previewimage";
$userpath=$filepath;
}

else
{
$deletecmd='';
}







if ($requireauth!='yes')
{
	if (($_SESSION['fromfilelister']=='yes') && ($_POST['confirmdelete']!='yes'))
	{
	$url='';
	}
	elseif (($_SESSION['fromfilelister']=='yes') && ($_POST['confirmdelete']!='yes'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$userpath.'index.php?rand='.$rand.'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_POST['confirmdelete']=='yes'))  // correct
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url=airscan.php?mppdf='.$mppdf.'&pdfname='.$pdfname.'&jpgpdf='.$jpgpdf.'&resolution='.$resolution.'&deskew='.$deskew.'&autocrop='.$autocrop.'&print='.$print.'&printscaleheight='.$printscaleheight.'&printscalewidth='.$printscalewidth.'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_POST['confirmdelete']!='yes'))
	{
	$refreshurl='';
	}
	else
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
	}
}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']=='yes'))
{
	if (($_SESSION['fromfilelister']=='yes') && ($_POST['confirmdelete']!='yes'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=logout.php?sound=yes">';
	}
	elseif (($_SESSION['fromfilelister']=='yes') && ($_POST['confirmdelete']=='yes') && ($_SESSION['password']!='PAM'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$userpath.'index.php?rand='.$rand.'">';
	}
	elseif (($_SESSION['fromfilelister']=='yes') && ($_POST['confirmdelete']=='yes') && ($_SESSION['password']=='PAM'))
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url=pamindex.php?rand='.$rand.'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_POST['confirmdelete']=='yes'))  // correct
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url=airscan.php?mppdf='.$mppdf.'&pdfname='.$pdfname.'&jpgpdf='.$jpgpdf.'&resolution='.$resolution.'&deskew='.$deskew.'&autocrop='.$autocrop.'&print='.$print.'&printscaleheight='.$printscaleheight.'&printscalewidth='.$printscalewidth.'">';
	}
	elseif (($_SESSION['fromfilelister']!='yes') && ($_POST['confirmdelete']!='yes'))
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
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
}






echo '<html lang="'.$lang.'">';
?>
<head>
<?php 
//if ($_POST['confirmdelete']=='yes')
//{
// echo '<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$refreshurl.'">';
echo $refreshurl;

//}
/*
else 
{
echo '';
}*/

?>
  <meta charset="<?php echo $charset;?>">
  <meta http-equiv="Cache-Control" content="private, no-store" /> 
  <meta name="Expires" content="<?php echo $rfc_1123_date;?>"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="javascript/jquery.min.js"></script>
<script src="javascript/tiff.min.js" ></script>
<script src="'.$webroot.'javascript/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<link href="'.$webroot.'css/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />

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
if ($_POST['confirmdelete']!='yes')
{
include_once 'livemenu.php';
}

else
{
}
?>
</td></tr></table>

<?php

// echo ($_SESSION['expire'] - $now);

//echo $previewimage;
//echo $pdfname;
if ($_POST['confirmdelete']=='yes')
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitdeletingtxt.'...&nbsp;'.$image.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
	if ($preferphpcommands!='yes')
	{
	ob_flush();
	flush();
	shell_exec("$deletecmd");
	// echo $deletecmd;
	}
	
	elseif ($preferphpcommands=='yes')
	{
	ob_flush();
	flush();
	unlink($previewimage);
	//echo $root.$userpath.$image.', '.$root.$userpath.$newname.'.'.$ext;
	}




// use unlink
// $output = 
//shell_exec("$deletecmd");
// echo $deletecmd;
}

else
{
	if ($_SESSION['fromfilelister']=='yes')// from file lister
	{
	echo '<center><p><span style="color:#666; font-weight:bold">'.$deleting.' '.$image.'</span></p>';
 	if (($ext=='pdf') && ($_SESSION['password'] != 'PAM'))
	{ 
	echo '<embed src="/'.$userpath.$image.'" type="application/pdf" width="'.$fileopmaxwidth.'" height="'.$fileopmaxheight.'" />';
	}
	elseif (($ext=='pdf') && ($_SESSION['password'] == 'PAM'))
	{
	echo '
    	<iframe class="frame" style = "margin: 0; padding: 0; border: none; width: '.$fileopmaxwidth.'; height: '.$fileopmaxheight.'" src="showpdf.php?image='.$image.'"></iframe>';
	}



		elseif ((($image != NULL) && ($requireauth=='yes') && ($_SESSION['password']=='PAM')) || ($requireauth!='yes'))  // pam
		{
		$file = $_SESSION['userpath'].$image;
			if (file_exists($file))
			{
     			$b64image = base64_encode(file_get_contents($file));
     			//echo "<img src = 'data:image/jpg;base64,$b64image'>";
			echo "<img id='myImg' class='js-img' src = 'data:image/$mimeext;base64,$b64image' download='$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";  //pam image
			}
		}

		else  // (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='webp'))	no pam
		{
		echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>"; //no pam image
		}

	echo '<form name="deletefile" method="post" action="delete.php?image='.$image.'&mppdf='.$mppdf.'&pdfname='.$pdfname.'&jpgpdf='.$jpgpdf.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'"> 
	<p><span style="color:#666; font-weight:bold">'.$confirmdelete.'</span></p>
  	<table border=0><tr><td><input type="hidden" name="confirmdelete" value="yes">
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>';

	
		if (($_SESSION['password']=='PAM') && ($_SESSION['fromfilelister']=='yes'))
		{
		echo '<form method="post" action="pamindex.php?rand='.$rand.'#'.$image.'">';
		}
		elseif (($_SESSION['password']!='PAM') && ($_SESSION['fromfilelister']=='yes'))
		{
		echo '<form method="post" action="'.$userpath.'index.php?rand='.$rand.'#'.$image.'">';
		}
		elseif ($_SESSION['fromfilelister']!='yes')
		{
		echo '<form method="post" action="/airscan.php?image='.$image.'&mppdf='.$mppdf.'&pdfname='.$pdfname.'&jpgpdf='.$jpgpdf.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'">';
		}

	echo'<input type="submit" value="'.$cancel.'"></form></td></tr></table></center>';

	}







	elseif ($_SESSION['fromfilelister']!='yes') // from scan
	{
	echo '<center><p><span style="color:#666; font-weight:bold">'.$deleting.' '.$image.'</span></p>';

		if ((($image != NULL) && ($requireauth=='yes') && ($_SESSION['password']=='PAM')) || ($requireauth!='yes')) //auth with PAM
		{

		$file = $_SESSION['userpath'].$image;
			if (file_exists($file))
			{
     			$b64image = base64_encode(file_get_contents($file));
     			//echo "<img src = 'data:image/jpg;base64,$b64image'>";
			echo "<img id='myImg' class='js-img' src = 'data:image/jpg;base64,$b64image' download='$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>"; //pam image
					}
		}

		else  // (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='webp'))	
		{
		echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>"; // no pam image
		}
	

	echo '<form name="deletefile" method="post" action="delete.php?image='.$image.'&mppdf='.$mppdf.'&pdfname='.$pdfname.'&jpgpdf='.$jpgpdf.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'"> 
	<p><span style="color:#666; font-weight:bold">'.$confirmdelete.'</span></p>
  	<table border=0><tr><td><input type="hidden" name="confirmdelete" value="yes">
  	<input type="submit" value="'.$confirm.'">
	</form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form method="post" action="/airscan.php?image='.$image.'&mppdf='.$mppdf.'&pdfname='.$pdfname.'&jpgpdf='.$jpgpdf.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'"> 
	<input type="submit" value="'.$cancel.'">
	</form></td></tr></table>
	</center>';
	} 
}
//echo $deletecmd;
if ($_POST['confirmdelete']!='yes')
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


<?php include_once 'livemenujs.php';?>

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
</body>
</html>
