<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$deskew=$_GET['deskew'];
$mode=$_GET['mode'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$deskewedfile= substr($image, 0, -4).$deskewed.'.'.$ext;
// $previewimage = $filepath.$image;
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$now=time();
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

list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
// change the print param
$params['image'] = $deskewedfile;
$params['rand'] = $rand;
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;


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


if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now))
{
$deltmpcmd='rm '.$_SESSION['userpath'].$image;	
$previewimage = $_SESSION['userpath'].$image;
$deskewcmd=$imagemagicklocation.' '.$previewimage.' -background black -fuzz 75% -deskew 50% -trim +repage '.$_SESSION["userpath"].$deskewedfile;
$userpath=$_SESSION['userpath'];
	if ($_SESSION['password']=='PAM')
	{	
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$deskewedfile;	
	}
	else 
	{	
	$chmod= '';	
	}

}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$rotatecmd = $imagemagicklocation.' -rotate '.$degrees.' '.$previewimage.' '.$filepath.$rotatedfile;
$deskewcmd=$imagemagicklocation.' '.$root.$previewimage.' -background black -fuzz 75% -deskew 50% -trim +repage '.$root.$filepath.$deskewedfile;
$userpath=$filepath;
}

else
{
$deskewcmd="";
}

if (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']=='PAM'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; pamindex.php?rand='.$rand.'#'.$deskewedfile.'">';
}









elseif (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']!='PAM'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; '.$_SESSION["userpath"].'index.php?rand='.$rand.'#'.$deskewedfile.'">';
}











elseif ($_SESSION['fromfilelister']!='yes')
{

	if (($_GET['jpgpdf'] !='yes') && ($_GET['mode'] !='bw') && ($_GET['mode'] !='lineart'))
	{

	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=airscan.php'.$urlvars.'">';
	} 
	elseif ($_GET['mode']=='bw')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=bw.php'.$urlvars.'">';
	}
	elseif ($_GET['mode']=='lineart')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=lineart.php'.$urlvars.'">';
	} 
	elseif ($_GET['jpgpdf']=='yes')
	{
	list($path, $query_string) = explode('?', $url, 2);
	// parse the query string
	parse_str($query_string, $params);
	// delete image param
	//unset($params['rand']);
	// change the print param
	$params['image'] = $deskewedfile;
	$params['pdfres'] = $resolution;
	$params['confirm'] = 'yes';
	// rebuild the query
	$query_string = http_build_query($params);
	// reassemble the URL
	$urlvars = $path . '?' . $query_string;
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=mkmppdf.php'.$urlvars.'">';
	}

}
?>

<head>
<?php echo $refreshurl;?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="root">
  <meta name="robots" content="noindex">
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
	<tr><td><hr></td></tr>
</table>
<?php
// echo ($_SESSION['expire'] - $now);
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitdeskewingtxt.'...&nbsp;'.$deskewedfile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';

// $output = 

if ((isset($_GET['image'])) && ($requireauth=='yes') && ($_SESSION['loggedin']=='yes'))
{
ob_flush();
flush();
shell_exec("$deskewcmd");
	if ($_SESSION['password']=='PAM')
	{
	sleep("$chmodsleep");	
	shell_exec("$chmod");
	//echo $chmod;
	}
	else
	{
	}
	if ($_GET['deltmp']=='yes')
	{
	//sleep("$chmodsleep");	
	shell_exec("$deltmpcmd");
	//echo $deltmpcmd;
	}
	else
	{
	}
}
/*
elseif ((isset($_GET['image'])) && ($requireauth!='yes'))
{
shell_exec("$deskewcmd");
}
*/



?>
</body>
</html>
