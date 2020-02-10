<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
//error_reporting(1);
//error_reporting('On');
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$newimage=$_GET['newimage'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
//$bw=$_GET['bw'];
//$lineart=$_GET['lineart'];
// $deskewedfile= substr($image, 0, -4).$deskew.'.jpg';
$previewimage = $filepath.$image;
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
//$newext = strtolower(pathinfo($newimage, PATHINFO_EXTENSION));
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$basename = pathinfo($image, PATHINFO_FILENAME);
//$basename= substr($image, 0, -4);
//$without_extension = basename($filename, '.'.$ext');
$timeremaining=($_SESSION['expire'] - $now);
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
if ($ext=='jpg')
{
$mimeext='jpeg';
}

else
{
$mimeext=$ext;
}

if (($requireauth == 'yes' ) && ($_SESSION['loggedin'] == 'yes' ))
{
$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$userpath=$filepath;

}

else
{
// $convertcmd="";
}


if ($requireauth == 'yes')
{ 
//echo '<br>AuthRequired'.$requireauth ;


	if ((($_SESSION['expire'] - $now ) > 0) && ($_SESSION['password'] != 'PAM') && ($_SESSION['loggedin'] == 'yes') && (isset($_GET['newimage'])) && (isset($_GET['newext']))) // do conversion
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$_GET['newimage'].'.'.$_GET['newext'].'">';
	//echo 'have new name ext '.($_SESSION['expire'] - $now);
	}
	elseif ((($_SESSION['expire'] - $now ) > 0) && ($_SESSION['password'] == 'PAM') && ($_SESSION['loggedin'] == 'yes') && (isset($_GET['newimage'])) && (isset($_GET['newext']))) // do conversion
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=pamindex.php?rand='.$rand.'#'.$_GET['newimage'].'.'.$_GET['newext'].'">';
	//echo 'have new name ext '.($_SESSION['expire'] - $now);
	}
	elseif ((($_SESSION['expire'] - $now ) > 0) && ($_SESSION['loggedin'] == 'yes') && (!isset($_GET['newimage'])) && (!isset($_GET['newext']))) // no name.ext , to webform
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire'] - $now).'; url=/logout.php?sound=yes">';	
	//echo 'no new name ext  '.($_SESSION['expire'] - $now);
	}
	elseif ((($_SESSION['expire'] - $now ) > 0)  && ($_SESSION['loggedin'] != 'yes')) //expired session
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	//echo 'expired session'.$_SESSION['expire'] - $now ;
	}

	elseif ((($_SESSION['expire'] - $now ) <= 0)  && ($_SESSION['loggedin'] == 'yes'))  //not loggedin
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	//echo 'not loggedin' ;
	}

	elseif ((($_SESSION['expire'] - $now ) <= 0)  && ($_SESSION['loggedin'] != 'yes'))  //not loggedin , no session
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	//echo 'not loggedin & no session' ;
	}

}

elseif ($requireauth != 'yes')
{
//echo 'NoAutRequired<br>';

}























//if ((isset($_POST['newname'])) && ($_POST['newname'] != '' )  && ($_POST['newname'] != '/' )  && ($_POST['newname'] != ' ' )  && ($_POST['newname'] != '..' ) && ($_POST['newname'] != '.' ))
// $refreshurl=$userpath.'index.php#'.$_POST["newname"].'.jpg';
echo '<html lang="'.$lang.'">';
?>

<head>

  <meta charset="<?php echo $charset;?>"> 
  <?php echo $refreshurl;?>
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

// http://airscan.tecnologiadeleon.com/convert.php?image=Scan20190301202455.jpg&newimage=Scan20190301202455&newext=gif
if ((!isset($_GET['newimage'])) || (!isset($_GET['newext'])))
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
//echo 'Loggedin?'.$_SESSION['loggedin'];



// here we begin to display image

if ((isset($_GET['newext'])) && (isset($_GET['newimage'])))
{
//echo'VVVVVVV';
}
elseif ((!isset($_GET['newext'])) || (!isset($_GET['newimage'])))
{
echo '<p><span style="color:#666; font-weight:bold">'.$converting.' '.$image.'</span></p>';
	if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now))
	{
		if ($ext=='pdf')
		{
			if ($_SESSION['password']=='PAM')
			{
			echo '<iframe class="frame" style = "margin: 0; padding: 0; border: none; width: '.$fileopmaxwidth.'; height: '.$fileopmaxheight.'" src="showpdf.php?image='.$image.'"></iframe>';
			}
		
			else
			{
			echo '<embed src="/'.$userpath.$image.'" type="application/pdf" width="'.$fileopmaxwidth.'" height="'.$fileopmaxheight.'" />';
			}	
		}
		elseif ($ext!='pdf')
		{
			if ($_SESSION['password']=='PAM')
			{
		
			$file = $_SESSION['userpath'].$image;
				if (file_exists($file))
				{
     				$b64image = base64_encode(file_get_contents($file));
     				//echo "<img src = 'data:image/jpg;base64,$b64image'>";
				echo "<img id='myImg' class='js-img' src = 'data:image/$mimeext;base64,$b64image' download='$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";  //pam image
				}
			}
			else
			{
			echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
			}
		}
	
	}
	elseif ($requireauth!='yes')
	{
		if ($ext=='pdf')
		{
		echo '<embed src="/'.$userpath.$image.'" type="application/pdf" width="'.$fileopmaxwidth.'" height="'.$fileopmaxheight.'" />';
		}

		else
		{

		echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
			
			
		}
	}
}

else 
{
echo'';
}
	/*if ($_SESSION['fromfilelister']=='yes')
	{*/

if ((!isset($_GET["newext"])) || (!isset($_GET["newimage"])))
{ 

	echo '<table border=0><tr><td colspan=2><center><span style="color:#666; font-weight:bold">'.$convertnewnametxt.'</span></center></td></tr>
	<tr><td colspan=2><center><table><tr><td>
	<form name="convertfile" method="get" action="convert.php">
	<input type="hidden" name="image" value="'.$image.'">
  	<input type="text" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" name="newimage" value="'.$basename.'">
	<span style="color:#666; font-weight:bold">.</span>
	</td><td>
	<div class="styled-select blue semi-square"><select name="newext">';

		if ($ext=='jpg')  			//from jpg
		{		
		echo '<option value="gif"';    				//start to gif			
			if ($_GET["newext"]=="gif") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>gif</option><option value="png"';    		//start to png
			if ($_GET["newext"]=="png") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>png</option>';
                        /*
			<option value="tif"'; 		//start to tiff
			if ($_GET["newext"]=="tif") 
			{
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>tif</option>
*/
			echo '<option value="pdf"'; 		//start to pdf
			if ($_GET["newext"]=="pdf") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>pdf</option>';/*

<option value="webp"'; 		//start to webp NOT WORKING
			
			if ($_GET["newext"]=="webp") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>webp</option>';
*/
		}	                                 //end from JPG


	
		elseif ($ext=='gif')                     // from GIF
		{		
		echo '<option value="jpg"';    				//start to jpg			
			if ($_GET["newext"]=="jpg") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>jpg</option><option value="png"';    		//start to png
			if ($_GET["newext"]=="png") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>png</option>';
/*
			<option value="tif"'; 				//start to tiff
			if ($_GET["newext"]=="tif") 
			{
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>tif</option>
*/
			echo '<option value="pdf"'; 			//start to pdf
			if ($_GET["newext"]=="pdf") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>pdf</option>';/*
<option value="webp"'; 		//start to webp NOT WORKING
			
			if ($_GET["newext"]=="webp") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>webp</option>';
*/
		}				//end from GIF
/*
		{
		echo'<option value="jpg">jpg</option>
  		<option value="png">png</option>
   		<option value="tif">tif</option>
		<option value="pdf">pdf</option>';
		}*/
		elseif ($ext=='png')		//start from PNG
		{		
		echo '<option value="gif"';    				//start to gif			
			if ($_GET["newext"]=="gif") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>gif</option><option value="jpg"';    		//start to jpg
			if ($_GET["newext"]=="jpg") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>jpg</option>';
/*
			<option value="tif"'; 		//start to tiff
			if ($_GET["newext"]=="tif") 
			{
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>tif</option>
*/

			echo'<option value="pdf"'; 		//start to pdf
			if ($_GET["newext"]=="pdf") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
			echo '>pdf</option>';/*

<option value="webp"'; 		//start to webp NOT WORKING
			
			if ($_GET["newext"]=="webp") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>webp</option>';
*/
		}					//end from png
		/*{
		echo'<option value="gif">gif</option>
  		<option value="jpg">jpg</option>
   		<option value="tif">tif</option>
		<option value="pdf">pdf</option>';
		}*/
		elseif ($ext=='tif')			//start from tif
		{		
		echo '<option value="gif"';    				//start to gif			
			if ($_GET["newext"]=="gif") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>gif</option><option value="jpg"';    		//start to jpg
			if ($_GET["newext"]=="jpg") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>jpg</option><option value="png"'; 		//start to png
			if ($_GET["newext"]=="png") 
			{
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>png</option><option value="pdf"'; 		//start to pdf
			if ($_GET["newext"]=="pdf") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>pdf</option><option value="webp"'; 		//start to webp NOT WORKING
			
			if ($_GET["newext"]=="webp") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>webp</option>';
		}							//end from TIFF
/*{
		echo'<option value="gif">gif</option>
  		<option value="jpg">jpg</option>
   		<option value="png">png</option>
		<option value="pdf">pdf</option>';
		}*/
		elseif ($ext=='pdf')			//start from PDf
		{		
		echo '<option value="gif"';    				//start to gif			
			if ($_GET["newext"]=="gif") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>gif</option><option value="jpg"';    		//start to jpg
			if ($_GET["newext"]=="jpg") 
			{
			echo ' selected '; 
			}
			else 
			{
			echo '';
			}
		echo '>jpg</option><option value="png"'; 		//start to png
			if ($_GET["newext"]=="png") 
			{
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>png</option>';
		/*
		<option value="tif"'; 		//start to tif
			if ($_GET["newext"]=="tif") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>tif</option>';

		*/
		}					//end from PDF
		/*{
		echo'<option value="gif">gif</option>
  		<option value="jpg">jpg</option>
   		<option value="png">png</option>
		<option value="tif">tif</option>';
		}*/

	echo '</div>
	</td></tr></table></center></td></tr><tr><td colspan=2><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;</span></td></tr><tr><td colspan=2>
		<center><table border=0><tr><td>
	<input type="submit" value="'.$confirm.'">
	</form></td><td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>';

if  ($_SESSION['password']=='PAM')
{
	echo '<form name="cancel" method="post" action="pamindex.php?rand='.$rand.'#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td><tr></table></center>
	</td></tr></table>
	</center><br/><center>';
}

else
{
	echo '<form name="cancel" method="post" action="'.$userpath.'index.php?rand='.$rand.'#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form></td><tr></table></center>
	</td></tr></table>
	</center><br/><center>';
}

	include 'footer.inc.php';
	echo '</center>';


}










if ((isset($_GET['newimage'])) && ($_SESSION['password']!='PAM') && (isset($_GET['newext'])) && ($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now)) 
{
//$convertcmd=$imagemagicklocation.' '.$root.$_SESSION['userpath'].$image.' '.$root.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
	if ($_GET['newext']=='webp')
	{
	$convertcmd=$imagemagicklocation.' '.$root.$_SESSION['userpath'].$image.' -quality '.$webpquality.' -define webp:lossless='.$webplossless.' '.$root.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
	}

	else 
	{
	$convertcmd=$imagemagicklocation.' '.$root.$_SESSION['userpath'].$image.' '.$root.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
	}


//echo $convertcmd;

echo '<center><p><span style="color:#666; font-weight:bold">'.$waitconvertingtxt.' '.$image.' '.$to.' '.$_GET['newimage'].'.'.$_GET['newext'].'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
ob_flush();
flush();
shell_exec("$convertcmd");
//sleep(10);
}



elseif ((isset($_GET['newimage'])) && ($_SESSION['password']=='PAM') && (isset($_GET['newext'])) && ($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now)) 
{
	if ($_GET['newext']=='webp')
	{
	$convertcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$image.' -quality '.$webpquality.' -define webp:lossless='.$webplossless.' '.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
	}

	else 
	{
	$convertcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$image.' '.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
	}
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitconvertingtxt.' '.$image.' '.$to.' '.$_GET['newimage'].'.'.$_GET['newext'].'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
ob_flush();
flush();
//sleep(10);
shell_exec("$convertcmd");
	if ($_SESSION['password']=='PAM')
	{
	//sleep("$chmodsleep");
	shell_exec("$chmod");
	}
	else
	{
	}

//echo $convertcmd;
 //echo $chmod;


}
/*
elseif ((isset($_GET['newimage'])) && (isset($_GET['newext'])) && ($requireauth!='yes') ) 
{
$convertcmd=$imagemagicklocation.' '.$root.$_SESSION['userpath'].$image.' '.$root.$_SESSION['userpath'].$_GET['newimage'].'.'.$_GET['newext'];
ob_flush();
flush();
shell_exec("$convertcmd");
 //echo $convertcmd;

echo '<center><p><span style="color:#666; font-weight:bold">'.$waitconvertingtxt.' '.$image.' '.$to.' '.$_GET['newimage'].'.'.$_GET['newext'].'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
}
*/

else
{
include_once 'footer.inc.php';
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
