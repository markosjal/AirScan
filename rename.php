<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
// error_reporting(1);
// error_reporting('On');
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$newname=$_GET['newname'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
//$bw=$_GET['bw'];
//$lineart=$_GET['lineart'];
// $deskewedfile= substr($image, 0, -4).$deskew.'.jpg';
$previewimage = $filepath.$image;
// $basename= substr($image, 0, -4);
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$ext = strtolower(pathinfo($_GET['image'], PATHINFO_EXTENSION));
$basename = pathinfo($_GET['image'], PATHINFO_FILENAME);
//$filenamenoext=$basename;
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
/*
if ($_GET['newname'] == $basename)
{
echo 'You must select a different name';
}

elseif ($_GET['newname'] == '')
{
echo 'You must select a name';
}
*/


if (($requireauth == 'yes' ) && ($_SESSION['loggedin'] == 'yes' ) && ($_SESSION['password'] != 'PAM'))
{
$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
// $renamecmd = 'mv '.$_SESSION['userpath'].$image.' '.$_SESSION['userpath'].$newname.'.'.$ext;
$renamecmd = 'mv '.$root.$userpath.$_GET['image'].' '.$root.$userpath.$_GET['newname'].'.'.$ext;
}

elseif (($requireauth == 'yes' ) && ($_SESSION['loggedin'] == 'yes' ) && ($_SESSION['password'] == 'PAM'))
{
$previewimage = $_SESSION['userpath'].$image;
$userpath=$_SESSION['userpath'];
// $renamecmd = 'mv '.$_SESSION['userpath'].$image.' '.$_SESSION['userpath'].$newname.'.'.$ext;
$renamecmd = 'mv '.$userpath.$_GET['image'].' '.$userpath.$_GET['newname'].'.'.$ext;
$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['newname'].'.'.$ext;	
}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
// $rotatecmd="$imagemagicklocation -rotate $degrees $previewimage $filepath$rotatedfile";
$userpath=$filepath;
$renamecmd = 'mv '.$root.$userpath.$_GET['image'].' '.$root.$userpath.$_GET['newname'].'.'.$ext;
}

else
{
$renamecmd="";
}

//echo 'CCC'.$userpath;

//if ((isset($_GET['newname'])) && ($_GET['newname'] != '' )  && ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' ))
// $refreshurl=$userpath.'index.php#'.$_POST["newname"].'.jpg';
?>

<head>
<?php
if ($requireauth !='yes')
{
	if ((isset($_GET['newname'])) && ($image != 'error_log') && ($image != '*') && ($image != 'cgi-bin') && ($image != '.htaccess') && ($image != '' )  && ($image != '/' )  && ($image != ' ' )  && ($image != '..' ) && ($image != '.' ) && ($_GET['newname'] != '*' ) && ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' ))  
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$newname.'.'.$ext.'">';
	}
	elseif ((!isset($_GET['newname'])) && ($image != 'error_log') && ($image != '*') && ($image != 'cgi-bin') && ($image != '.htaccess') && ($image != '' )  && ($image != '/' )  && ($image != ' ' )  && ($image != '..' ) && ($image != '.' ) && ($_GET['newname'] != '*' ) && ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' ))  
	{
	echo '';
	}
	else
	{
	echo '';
	}
}

elseif ($requireauth =='yes')
{
	if (($now >= $_SESSION['expire']) || (!isset($_SESSION['username'])) || ($_SESSION['loggedin'] != 'yes'))  
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
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
	}

	elseif (($_SESSION['password']=='PAM') && (isset($_GET['newname'])) && ($now < $_SESSION['expire']) && ($image != 'error_log') && ($image != '*') && ($image != 'cgi-bin') && ($image != '.htaccess') && ($image != '' )  && ($image != '/' )  && ($image != ' ' )  && ($image != '..' ) && ($image != '.' ) && ($_GET['newname'] != '*' ) && ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' ))  
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url=pamindex.php?rand='.$rand.'#'.$newname.'.'.$ext.'">';
	}

	elseif (($_SESSION['password']!='PAM') && (isset($_GET['newname'])) && ($now < $_SESSION['expire']) && ($image != 'error_log') && ($image != '*') && ($image != 'cgi-bin') && ($image != '.htaccess') && ($image != '' )  && ($image != '/' )  && ($image != ' ' )  && ($image != '..' ) && ($image != '.' ) && ($_GET['newname'] != '*' ) && ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' ))  
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$newname.'.'.$ext.'">';
	}

	elseif ((!isset($_GET['newname'])) && ($now < $_SESSION['expire']) && ($image != 'error_log') && ($image != '*') && ($image != 'cgi-bin') && ($image != '.htaccess') && ($image != '' )  && ($image != '/' )  && ($image != ' ' )  && ($image != '..' ) && ($image != '.' ) && ($_GET['newname'] != '*' ) && ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' ))  
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION['expire']- $now).'; url=logout.php#sound=yes">';
	}

	else
	{
	echo '';
	}
}






echo '<html lang="'.$lang.'">';
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
        <a href='/airscan.php'>
          <img id='logo' src='/images/AirScan.png' alt='AirScan'>
        </a></td>

</tr>
	<tr><td><hr></td></tr><tr><td>
<?php 
if (!isset($_GET['newname']))
{
include_once 'livemenu.php';
}

else
{
}


?>
</td></tr>
</table>

<?php 

// echo ($_SESSION['expire'] - $now);




/*


echo '<a href="/airscan.php"><span style="color:#777AFF; font-weight:bold">'.$scanpage.'</span></a>';

if (($showfilemanager=='yes') && ($requireauth=='yes'))
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$userpath.'index.php"><span style="color:#777AFF; font-weight:bold">'.$userfilestxt.' '.$_SESSION['username'].'</span></a>';
}

elseif (($showfilemanager == 'yes') && ($requireauth != 'yes'))
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php"><span style="color:#777AFF; font-weight:bold">'.$alluserfilestxt.'</span></a>';
}

else
{
echo '';
}


if ($_SESSION['username']=='admin')
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="/usermanager.php"><span style="color:#777AFF; font-weight:bold">'.$adminbutton.'</span></a>';
}




if ($_SESSION['loggedin']=='yes')
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="/logout.php"><span style="color:#777AFF; font-weight:bold">'.$logout.'</span></a>';
}



*/

//echo '<center><p>'.$waitrotatingtxt.'...&nbsp;'.$rotatedfile.'</p></center>';


if (!isset($_GET['newname']))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$renaming.' '.$image.'</span></p>';


// margin: 0; padding: 0; border: none; width: value; height: value




//echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
 	if (($ext=='pdf') && ($_SESSION['password'] != 'PAM'))
	{ 
	echo '<embed src="/'.$userpath.$image.'" type="application/pdf" width="'.$fileopmaxwidth.'" height="'.$fileopmaxheight.'" />';
	}
	elseif (($ext=='pdf') && ($_SESSION['password'] == 'PAM'))
	{
	echo '
    	<iframe class="frame" style = "margin: 0; padding: 0; border: none; width: '.$fileopmaxwidth.'; height: '.$fileopmaxheight.'" src="showpdf.php?image='.$image.'"></iframe>';
	}
	elseif (($ext!='pdf') && ($_SESSION['password'] != 'PAM'))
	{
	echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
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
	echo "<img id='myImg' class='js-img' src='$userpath$image' alt='$image' style='width:$fileopwidth;max-width:$fileopmaxwidth;height:$fileopheight;max-height:$fileopmaxheight'/>";
	}




	if (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']!='PAM'))
	{
	echo '<form onsubmit="return validateForm();"  name="renamefile" id="renamefile" method="get" action="rename.php?image='.$image.'">
	<br/>
  	<input type="text" value="'.$basename.'" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" name="newname"  id="newname"><span style="color:#666; font-weight:bold">.'.$ext.'</span><br />
    <span id="nameErrMsg" class="error"></span> <br />
	<input name="image"type="hidden" value="'.$_GET['image'].'">  	
	<table border=0>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td><input onclick="validateForm();" type="submit" value="'.$confirm.'">
	</form>


	</td><td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>
	<form name="cancel" method="post" action="'.$userpath.'index.php?rand='.$rand.'#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form>
	</td></tr></table>
	</center>';
	}

	elseif (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']=='PAM'))
	{
	echo '<form onsubmit="return validateForm();" name="renamefile" id="renamefile" method="get" action="rename.php?image='.$image.'">
	<br/>
  	<input type="text" value="'.$basename.'" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" name="newname"  id="newname"><span style="color:#666; font-weight:bold">.'.$ext.'</span><br />
    <span id="nameErrMsg" class="error"></span> <br />
	<input name="image"type="hidden" value="'.$_GET['image'].'">  	
	<table border=0>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td><input onclick="validateForm();" type="submit" value="'.$confirm.'">
	</form>


	</td><td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>
	<form name="cancel" method="post" action="pamindex.php?rand='.$rand.'#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form>
	</td></tr></table>
	</center>';
	}
	elseif ($_SESSION['fromfilelister']!='yes')
	{
	echo '<form onsubmit="return validateForm();" name="renamefile" id="renamefile" method="get" action="rename.php?image='.$image.'">
	<br/>
  	<input type="text" value="'.$basename.'" style="width: 160px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" name="newname" id="newname"><span style="color:#666; font-weight:bold">.'.$ext.'</span><br />
    <span id="nameErrMsg" class="error"></span> <br />
	<input name="image"type="hidden" value="'.$_GET['image'].'">  	
	<table border=0>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td><input onclick="validateForm();" type="submit" value="'.$confirm.'">
	</form>
	
	</form>
	</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<form name="cancel" method="post" action="/airscan.php?rand='.$rand.'&image='.$image.'&resolution='.$resolution.'&deskew='.$deskew.'&mode='.$mode.'&printscalewidth='.$printscalewidth.'&printscaleheight='.$printscaleheight.'&autocrop='.$autocrop.'&print='.$print.'">
	<input type="submit" value="'.$cancel.'">





	</form></td></tr></table>
	</center>';
	include_once 'footer.inc.php';
	}
}


//$preferphpcommands='yes';
elseif ((isset($_GET['newname'])) && ($image != 'error_log') && ($image != 'cgi-bin') && ($image != '.htaccess') && ($image != '' )  && ($image != '/' )  && ($image != ' ' )  && ($image != '..' ) && ($image != '.' )&& ($_GET['newname'] != '/' )  && ($_GET['newname'] != ' ' )  && ($_GET['newname'] != '..' ) && ($_GET['newname'] != '.' )) 
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitrenamingtxt.' '.$image.' '.$to.' '.$_GET['newname'].'.'.$ext.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
ob_flush();
flush();
	if ($preferphpcommands!='yes')
	{
	shell_exec($renamecmd);

		if ($_SESSION['password']=='PAM')
		{
		//sleep("$chmodsleep");	
		shell_exec("$chmod");
		//echo $chmod;
		}
	}
	
	elseif ($preferphpcommands=='yes')
	{
		
		if ($_SESSION['password']=='PAM')
		{
		//sleep("$chmodsleep");	
		shell_exec("$chmod");
		//echo $chmod;
		
			if( copy($userpath.$image, $userpath.$newname.'.'.$ext) )
			{
			unlink($userpath.$image);
			}

		}
		else
		{
			if( copy($root.$userpath.$image, $root.$userpath.$newname.'.'.$ext) )
			{
			unlink($root.$userpath.$image);
			}
		}		
	}

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
<script>
validateForm = function () {
    return checkName();
}

function checkName() {
    var x = document.renamefile;
    var input = x.name.value;
    var errMsgHolder = document.getElementById('newname');
    if (input.length < 3) {
        errMsgHolder.innerHTML =
            'Please enter a name with at least 3 letters';
        return false;
    } else if (!(/^\S{3,}$/.test(input))) {
        errMsgHolder.innerHTML =
            'Name cannot contain whitespace';
        return false;
    } else {
        errMsgHolder.innerHTML = '';
        return undefined;
    }
}
</script>
</body>
</html>
