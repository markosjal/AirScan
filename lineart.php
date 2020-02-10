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
$mode=$_GET['mode'];
$deskew=$_GET['deskew'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$basename = pathinfo($image, PATHINFO_FILENAME);
$lineartfile= $basename.$lineart.'.'.$ext;
//$previewimage = $_SESSION['userpath'].$image;
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
$params['image'] = $lineartfile;
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

if ((isset($_GET['image'])) && ($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now))
{
$previewimage = $_SESSION['userpath'].$image;
//$lineartcmd=$imagemagicklocation.' '.$previewimage.' -threshold '.$threshold.'% '.$_SESSION['userpath'].$lineartfile.' > /dev/null 2>&1 &';
$lineartcmd=$imagemagicklocation.' '.$previewimage.' -threshold '.$threshold.'% '.$_SESSION['userpath'].$lineartfile;

$userpath=$_SESSION['userpath'];
	if ($_SESSION['password']=='PAM')
	{	
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$lineartfile.'/dev/null 2>&1 &';
 	$deltmpcmd='rm '.$_SESSION['userpath'].$image;	
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
//$lineartcmd=$imagemagicklocation.' '.$previewimage.' -threshold '.$threshold.'% '.$filepath.$lineartfile.' > /dev/null 2>&1 &';
$lineartcmd=$imagemagicklocation.' '.$previewimage.' -threshold '.$threshold.'% '.$filepath.$lineartfile;
$userpath=$filepath;
}
*/
else
{
$lineartcmd='';
}




if (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']!='PAM'))
{
//$refreshurl=$userpath.'index.php?rand='.$rand.'#'.$lineartfile;
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url='.$userpath.'index.php?rand='.$rand.'#'.$lineartfile.'">';
}

elseif (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']=='PAM'))
{
//$refreshurl='pamindex.php?rand='.$rand.'#'.$lineartfile;
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=pamindex.php?rand='.$rand.'#'.$lineartfile.'">';

}

elseif ($_SESSION['fromfilelister']!='yes')
{

	if ($_GET['jpgpdf']!='yes')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=airscan.php'.$urlvars.'">';
	}
	/* elseif ($_GET['deskew']=='yes')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=deskew.php'.$urlvars.'">';
	}
	//elseif ($_GET['autocrop']=='yes')
	{
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=autocrop.php'.$urlvars.'">';
	} */
	elseif ($_GET['jpgpdf']=='yes')
	{
	list($path, $query_string) = explode('?', $url, 2);
	// parse the query string
		// delete image param
		unset($params['print']);
		unset($params['printscaleheight']);
		unset($params['printscalewidth']);
		unset($params['pdfname']);
		unset($params['mppdf']);
		//unset($params['rand']);
		// change the print param
		$params['image'] = $lineartfile;
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
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
  <title><?php echo $title; ?></title>
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
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitlineartingtxt.'...&nbsp;'.$lineartfile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';

/*
if ($mode == 'edgedetect')
{
$lineartcmd=$imagemagicklocation.' '.$previewimage.' -negate -separate -lat 5x5+5% -negate -evaluate-sequence add '.$filepath.$lineartfile;
}

elseif ($mode == 'sketch')
{
$lineartcmd=$imagemagicklocation.' '.$previewimage.' -colorspace gray -sketch 0x20+120 '.$filepath.$lineartfile;
}

elseif ($mode == 'charcoal')
{
$lineartcmd=$imagemagicklocation.' '.$previewimage.' -charcoal 5 '.$filepath.$lineartfile;
}


else
{
*/
// $lineartcmd=$imagemagicklocation.' '.$previewimage.' -threshold '.$threshold.'% '. $filepath.$lineartfile;
// }




if ((isset($_GET['image'])) && ($requireauth=='yes') && (isset($_SESSION['loggedin'])))
{
ob_flush();
flush();

shell_exec("$lineartcmd");
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
ob_flush();
flush();

exec("$lineartcmd");
	if ($_GET['deltmp']=='yes')
	{
	//sleep("$chmodsleep");	
	shell_exec("$deltmpcmd");
	//echo $deltmpcmd;
	}
	else
	{
	}
//shell_exec("$lineartcmd");
}

*/
//echo $lineartcmd;

?>
</body>
</html>
