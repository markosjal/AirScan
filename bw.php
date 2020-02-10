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
$deskew=$_GET['deskew'];
$mode=$_GET['mode'];
$deltmp=$_GET['deltmp'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$basename = pathinfo($image, PATHINFO_FILENAME);
$blackwhitefile= $basename.$blackwhite.'.'.$ext;
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
$params['image'] = $blackwhitefile;
$params['rand'] = $rand;
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;

//echo $url;

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


if ((isset($_GET['image'])) && ($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now))
{
$previewimage = $_SESSION['userpath'].$image;
$blackwhitecmd=$imagemagicklocation.' '.$previewimage.' -type Grayscale '.$_SESSION['userpath'].$blackwhitefile;
$deltmpcmd='rm '.$previewimage;
$userpath=$_SESSION['userpath'];
	if ($_SESSION['password']=='PAM')
	{	
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$blackwhitefile;	
	}
	else 
	{	
	$chmod= '';	
	}

}
/*
elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$blackwhitecmd=$imagemagicklocation.' '.$previewimage.' -type Grayscale '.$filepath.$blackwhitefile;
$deltmpcmd='rm '.$previewimage;
$userpath=$filepath;
}
*/
else
{
$blackwhitecmd='';
$deltmp='';
}


if (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']!='PAM'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url='.$userpath.'index.php?rand='.$rand.'#'.$blackwhitefile.'">';
}

elseif (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']=='PAM'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=pamindex.php?rand='.$rand.'#'.$blackwhitefile.'">';
}
elseif ($_SESSION['fromfilelister']!='yes')
{

	if ($_GET['jpgpdf']!='yes')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=airscan.php'.$urlvars.'">';
	} /*
	elseif ($_GET['deskew']=='yes')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=deskew.php'.$urlvars.'">';
	}
	elseif ($_GET['autocrop']=='yes')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=autocrop.php'.$urlvars.'">';
	} */
	elseif ($_GET['jpgpdf']=='yes')
	{
		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		unset($params['print']);
		unset($params['printscaleheight']);
		unset($params['printscalewidth']);
		unset($params['pdfname']);
		unset($params['mppdf']);
		//unset($params['rand']);
		// change the print param
		$params['image'] = $blackwhitefile;
		$params['pdfres'] = $resolution;
		$params['confirm'] = 'yes';
		$params['rand'] = $rand;
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=mkmppdf.php'.$urlvars.'">';
	}

}

echo '<html lang="'.$lang.'">';
?>
<head>
<?php echo $refreshurl;?>
<meta charset="<?php echo $charset;?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/style.css" type="text/css" />
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
// echo 'FromFileLister '.$_SESSION['fromfilelister'];
if ((isset($_GET['image'])) && ($requireauth=='yes') && (isset($_SESSION['loggedin'])))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitbwingtxt.'...&nbsp;'.$blackwhitefile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
ob_flush();
flush();

shell_exec('nice -n '.$niceness.' '.$blackwhitecmd);

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
elseif ((isset($_GET['image'])) && ($requireauth!='yes'))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitbwingtxt.'...&nbsp;'.$blackwhitefile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
ob_flush();
flush();

shell_exec('nice -n '.$niceness.' '.$blackwhitecmd);
	if ($_GET['deltmp']=='yes')
	{
	//sleep("$chmodsleep");	
	shell_exec("$deltmpcmd");
	//echo $deltmpcmd;
	//echo $chmod;
	}
	else
	{
	}
}
else{}
//echo $blackwhitecmd;
?>
</body>
</html>
