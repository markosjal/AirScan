<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
error_reporting( -1 );
ini_set( 'display_errors', 1 );
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$flip=$_GET['flip'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$flippedfile= substr($image, 0, -4).$flipname.'.'.$ext;
$floppedfile= substr($image, 0, -4).$flopname.'.'.$ext;
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
$flipcmd = $imagemagicklocation.' -flip '.$previewimage.' '.$_SESSION["userpath"].$flippedfile;
$flopcmd = $imagemagicklocation.' -flop '.$previewimage.' '.$_SESSION['userpath'].$floppedfile;
	if (($_SESSION['password']=='PAM') && ($flip=='flop'))
	{	
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$floppedfile;	
	}
	elseif (($_SESSION['password']=='PAM') && ($flip=='flip'))
	{	
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$flippedfile;	
	}
	else 
	{	
	$chmod= '';	
	}

$userpath=$_SESSION['userpath'];
}


// echo $_SESSION['userpath'];
elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$flipcmd="$imagemagicklocation -flip $previewimage $filepath$flippedfile";
$flopcmd="$imagemagicklocation -flop $previewimage $filepath$floppedfile";
$userpath=$filepath;
}


/*
else
{
$flipcmd='';
$flopcmd='';
}
*/

if (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']!='PAM'))
{
        if  ($flip=='flip')
        {
        $refreshurl=$userpath.'index.php?rand='.$rand.'#'.$flippedfile;
	}


        elseif  ($flip=='flop')
        {
        // $refreshurl="airscan.php?image=$floppedfile&resolution=$resolution";
        $refreshurl=$userpath.'index.php?rand='.$rand.'#'.$floppedfile;

        }

}


elseif (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']=='PAM'))
{
        if  ($flip=='flip')
        {
        $refreshurl='pamindex.php?rand='.$rand.'#'.$flippedfile;
	}


        elseif  ($flip=='flop')
        {
        // $refreshurl="airscan.php?image=$floppedfile&resolution=$resolution";
        $refreshurl='pamindex.php?rand='.$rand.'#'.$floppedfile;

        }

}


else
{
	if  ($flip=='flip')
	{
	// $refreshurl=$_SESSION['userpath'].'index.php#'.$flippedfile;
        $refreshurl="airscan.php?image=$flippedfile&resolution=$resolution";
	}


	elseif  ($flip=='flop')
	{
	$refreshurl="airscan.php?image=$floppedfile&resolution=$resolution";
	}
}
echo '<html lang="'.$lang.'">';
?>
<head>
<meta HTTP-EQUIV="REFRESH" content='<?php echo $autocroprefresh; ?>; url=<?php echo $refreshurl;?>'>
  <meta charset="<?php echo $charset;?>">  
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<table id='page_header'><tr><td>
        <a href='airscan.php'>
          <img id='logo' src='images/AirScan.png' alt='AirScan'>
        </a></td>

</tr>
	<tr><td><hr></td></tr>
</table>
<?php
// echo ($_SESSION['expire'] - $now);
if ($flip=='flip')
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitflippingtxt.'...&nbsp;'.$flippedfile.'</span></p></center>';
}

elseif ($flip=='flop')
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitflippingtxt.'...&nbsp;'.$floppedfile.'</span></p></center>';
}

else
{
echo '';
}

echo '<center><img src="images/spinner.gif"></center>';

// $flipcmd="$imagemagicklocation -flip $previewimage $filepath$flippedfile";
// $flopcmd="$imagemagicklocation -flop $previewimage $filepath$floppedfile";
ob_flush();
flush();
if  ($flip=='flip')
{
//$output = 
shell_exec("$flipcmd");
	if ($_SESSION['password']=='PAM')
	{	
	sleep("$chmodsleep");
	shell_exec("$chmod");
	//echo $chmod;
	}
	else
	{
	}
}


elseif  ($flip=='flop')
{
//$output = 
shell_exec("$flopcmd");
	if ($_SESSION['password']=='PAM')
	{
	sleep("$chmodsleep");	
	shell_exec("$chmod");
	//echo $chmod;
	}
	else
	{
	}
}

else 
{
$output = '';
}

?>
</body>
</html>
