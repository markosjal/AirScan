
<!DOCTYPE html>
<html>
<?php
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
// $pdffile= substr($image, 0, -4).$deskew.'.jpg';
// $previewimage = $filepath.$image;
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$pdfname=$_GET['pdfname'];
session_start();


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
$pdfcmd=$imagemagicklocation.' -density '.$resolution.'x'.$resolution.' '.$_SESSION['userpath'].'PDF/'.$pdfname.'/* '.$_SESSION['userpath'].'PDF/'.$pdfname.'.pdf';
// $pdfcmd=$imagemagicklocation.' '.$previewimage.' -background black -fuzz 75% -deskew 50% -trim +repage '.$_SESSION["userpath"].$pdffile;
$userpath=$_SESSION['userpath'];
$rmdircmd='rm -r '.$_SESSION['userpath'].'PDF/'.$pdfname;
}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$pdfcmd=$imagemagicklocation.' -density '.$resolution.'x'.$resolution.' '.$filepath.'PDf/'.$pdfname.'/* '.$filepath.'PDf/'.$pdfname.'.pdf';
//$pdfcmd=$imagemagicklocation.' '.$previewimage.' -background black -fuzz 75% -deskew 50% -trim +repage '.$filepath.$pdffile;
$userpath=$filepath;
$rmdircmd='rm -r '.$filepath.'PDF/'.$pdfname;
}

else
{
$pdfcmd="";
}

if ($_SESSION['fromfilelister']=='yes')
{
$refreshurl=$userpath.'index.php#'.$pdffile;
}



else
$refreshurl="airscan.php?image=$pdffile&resolution=$resolution&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight&autocrop=$autocrop";

?>

<head>
<meta HTTP-EQUIV="REFRESH" content='<?php echo $autocroprefresh; ?>; url=<?php echo $refreshurl;?>'>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
	<tr><td class='ruler'></td></tr>
</table>
<?php
// echo ($_SESSION['expire'] - $now);
echo '<center><p>'.$waitpdfingtxt.'...&nbsp;'.$pdffile.'</p></center>';
echo '<center><img src="images/spinner.gif"></center>';

// $output = 
shell_exec("$pdfcmd");
shell_exec("$rmdircmd");
//echo $pdfcmd;
//echo '<br/>';
//echo $rmdircmd;
?>
</body>
</html>
