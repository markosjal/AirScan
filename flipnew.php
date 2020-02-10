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
$degrees=$_GET['degrees'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$rotatedfile= substr($image, 0, -4).$rotate.'.'.$ext;
// $previewimage = $filepath.$image;
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$now=time();
//$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
//$basename = pathinfo($image, PATHINFO_FILENAME);
//$requireauth='yes';
//$flippedfile= $basename.$flipname.'.'.$_GET['newext'];
//$floppedfile= $basename.$flopname.'.'.$_GET['newext'];
$timeremaining=($_SESSION['expire'] - $now);
function get_all_get()
{
        $output = "?"; 
        $firstRun = true; 
        foreach($_GET as $key=>$val) 
	{ 
        	if($key != $parameter) 
		{ 
            		if(!$firstRun) 
			{ 
                	$output .= "&"; 
            		} 
			else 
			{ 
                $firstRun = false; 
            	} 
            	$output .= $key."=".$val;
         	} 
    	} 

    return $output;
}   
$url= get_all_get();



if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && ($_SESSION['expire'] >= $now))
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

if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && (isset($_GET['flip'])))// && ($_SESSION['expire'] >= $now))
{
$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
$flipcmd = $imagemagicklocation.' -flip '.$previewimage.' '.$_SESSION["userpath"].$flippedfile;
$flopcmd = $imagemagicklocation.' -flop '.$previewimage.' '.$_SESSION['userpath'].$floppedfile;

	if ($_SESSION['password']=='PAM')
	{	
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$rotatedfile;	
	}
	else 
	{	
	$chmod= '';	
	}
}


else
{
$flipcmd="";
}


if (!isset($_GET['flip']))

{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';

}
elseif (($_GET['return']=='index.php') && ($_SESSION['password']!='PAM') && ($_GET['flip']=='flip'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$flippededfile.'">';
//$refreshurl=$userpath.'index.php?rand='.$rand.'#'.$rotatedfile;
}

elseif (($_GET['return']=='index.php') && ($_SESSION['password']!='PAM') && ($_GET['flip']=='flop'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$floppedfile.'">';
//$refreshurl=$userpath.'index.php?rand='.$rand.'#'.$rotatedfile;
}

elseif (($_GET['return']=='pamindex.php') && ($_SESSION['password']=='PAM') && ($_GET['flip']=='flip'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=pamindex.php?rand='.$rand.'#'.$flippedfile.'">';
//$refreshurl='pamindex.php?rand='.$rand.'#'.$rotatedfile;
}

elseif (($_GET['return']=='pamindex.php') && ($_SESSION['password']=='PAM') && ($_GET['flip']=='flop'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=pamindex.php?rand='.$rand.'#'.$floppedfile.'">';
//$refreshurl='pamindex.php?rand='.$rand.'#'.$rotatedfile;
}

elseif (($_GET['return']=='airscan.php')  && ($_GET['flip']=='flip'))
{
list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
//unset($params['degrees']);
// change the print param
$params['image'] = $flippedfile;
$params['rand'] = $rand;
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php'.$urlvars.'">';
//$refreshurl="airscan.php$urlvars";
}




elseif (($_GET['return']=='airscan.php')  && ($_GET['flip']=='flip'))
{
list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
//unset($params['degrees']);
// change the print param
$params['image'] = $floppedfile;
$params['rand'] = $rand;
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php'.$urlvars.'">';
//$refreshurl="airscan.php$urlvars";
}



echo '<html lang="'.$lang.'">';




?>
<head>
<?php echo $refreshurl;?>
  <meta charset="UTF-8">  
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title><?php echo $title; ?></title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />

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


/* for PDF iframe PAM 
.wrap {
    width: 400px;
    height: 600px;
    padding: 0;
    overflow: hidden;
}

.frame {
    width: 1200px;
    height: 1800px;
    border: 0;
    -ms-transform: scale(0.25);
    -moz-transform: scale(0.25);
    -o-transform: scale(0.25);
    -webkit-transform: scale(0.25);
    transform: scale(0.25);

    -ms-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    -o-transform-origin: 0 0;
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
}*/
</style>

</head>
<body>
<table id='page_header'><tr><td>
        <a href='airscan.php'>
          <img id='logo' src='images/AirScan.png' alt='AirScan'>
        </a></td>

</tr>
	<tr><td><hr></td></tr>
	<?php
	if (!isset($_GET['degrees']))
	{
	echo '<tr><td>';
	include 'livemenu.php';
	echo '</td></tr></table>';

	echo '';


	}
	else {
	echo'</table>';
}
	?>
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01" />
      <div id="caption"></div>
    </div>
<?php

if (!isset($_GET['degrees']))
{

	


	echo '<center><p><span style="color:#666; font-weight:bold">'.$rotating.' '.$image.'</span></p>';

		 if (($ext=='pdf') && ($_SESSION['password'] != 'PAM'))
		{ 
		echo '<embed src="/'.$previewimage.'" type="application/pdf" width="'.$fileopmaxwidth.'" height="'.$fileopmaxheight.'" />';
		}
		elseif (($ext=='pdf') && ($_SESSION['password'] == 'PAM'))
		{
		echo '
			<iframe class="frame" style = "margin: 0; padding: 0; border: none; width: '.$fileopmaxwidth.'; height: '.$fileopmaxheight.'" src="showpdf.php?image='.$image.'"></iframe>';
		}
		elseif (($ext!='pdf') && ($_SESSION['password'] != 'PAM'))
		{
		echo "<img id='myImg' class='js-img' src='$previewimage' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
		}
	
		elseif (($ext!='pdf') && ($_SESSION['password'] == 'PAM'))
		{
		$file = $_SESSION['userpath'].$image;
			if (file_exists($file))
			{
				 $b64image = base64_encode(file_get_contents($file));
			echo "<img id='myImg' class='js-img' src = 'data:image/$mimeext;base64,$b64image' download='$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";  //pam image
			}
		//echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
		}
	
		else  // (($ext=='jpg') || ($ext=='jpeg') || ($ext=='png') || ($ext=='gif') || ($ext=='webp'))	
		{
		echo "<img id='myImg' class='js-img' src='$previewimage' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
		}
	
	

		if (($_GET['return']=='pamindex.php') || ($_GET['return']=='index.php'))
		{
		echo '<form name="rotatefile" method="get" action="rotate.php?image='.$image.'">
		<br/><table border=1><tr><td>
		  <input type="text" value="'.$basename.'" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" name="newname"></td><td><span style="color:#666; font-weight:bold">.</span></td><td>';

airscan.php




	echo '<div class="styled-select blue semi-square"><select name="newext">';

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
		echo '>pdf</option>';
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
		echo '>pdf</option>';
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
		echo '>pdf</option>';//<option value="webp"'; 		//start to webp NOT WORKING
			/*if ($_GET["newext"]=="webp") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>webp</option?';*/
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
		echo '>pdf</option>';
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

	echo '</div></td></tr><tr><td colspan=3>';







		echo '<br/>
		<input name="image"type="hidden" value="'.$_GET['image'].'">  	
		<table border=0>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr><td><input type="submit" value="'.$confirm.'">
		</form>
	
	
		</td><td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>
		<form name="cancel" method="post" action="pamindex.php?rand='.$rand.'#'.$image.'">
		<input type="submit" value="'.$cancel.'">
		</form>
		</td></tr></table></td><tr></table>
		</center>';
		}
		elseif ($_GET['return']=='airscan.php')
		{
		echo '<form name="rotatefile" method="get" action="rotate.php?image='.$image.'">
		<br/><table border=0><tr><td>
		  <input type="text" value="'.$basename.$rotate.'" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" name="newname"></td><td><span style="color:#666; font-weight:bold">.</span></td><td>';





	echo'<div class="styled-select blue semi-square"><select name="newext">';

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
		echo '>pdf</option>';
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
		echo '>pdf</option>';
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
		echo '>pdf</option>';//<option value="webp"'; 		//start to webp NOT WORKING
			/*if ($_GET["newext"]=="webp") 
			{			
			echo ' selected ';
			}
			else 
			{
			echo '';
			}
		echo '>webp</option?';*/
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
		echo '>pdf</option>';
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

	echo '</div></td></tr><tr><td colspan=3>

<table border=0><tr>
<td>&nbsp;&nbsp;
<input type="radio" name="degrees" value="-90" ?><span style="color:#666; font-weight:bold">'.$rotaterighttxt.'</span>
</td></tr><tr><td>&nbsp;&nbsp;
<input type="radio" name="degrees" value="90" ?><span style="color:#666; font-weight:bold">'.$rotatelefttxt.'</span>
</td></tr><tr><td>&nbsp;&nbsp;
<input type="radio" name="degrees" value="180" ?><span style="color:#666; font-weight:bold">'.$rotate180txt.'</span>
</td></tr></table>



<tr><td colspan=3>';





		echo '<br/>
		<input name="image" type="hidden" value="'.$_GET['image'].'"> 
		<input name="return" type="hidden" value="'.$_GET['return'].'">
		<table border=0>
		
		<tr><td><input type="submit" value="'.$confirm.'">
		</form>
		
		</form>
		</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
		<form name="cancel" method="post" action="/airscan.php?rand='.$rand.'&image='.$image.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'">
		<input type="submit" value="'.$cancel.'">
	
	
	
	
	
		</form></td></tr></table></td></tr></table>
		</center>';
		include_once 'footer.inc.php';
		}






}
else
{
}


if (isset($_GET['degrees']))
{


// echo ($_SESSION['expire'] - $now);
//echo 'XXX'.$rotatecmd;
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitrotatingtxt.'...&nbsp;'.$rotatedfile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';

// $rotatecmd="$imagemagicklocation -rotate $degrees $previewimage $filepath$rotatedfile";
ob_flush();
flush();
//$output = 
shell_exec("$rotatecmd");
//echo $rotatecmd;
	if ($_SESSION['password']=='PAM')
	{
	//sleep("$chmodsleep");	
	shell_exec("$chmod");
	//echo $chmod;
	}
	else
	{
	}
}
if (!isset($_GET['degrees']))
	{
	include 'livemenujs.php';
	}
//echo 'gg'.$rotatecmd;
?>
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
