<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$image=$_GET['image'];
$deskew=$_GET['deskew'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
//$bw=$_GET['bw'];
//$lineart=$_GET['lineart'];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$croppedfile= substr($image, 0, -4).$crop.'.'.$ext;
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
$params['image'] = $croppedfile;
$params['rand'] = $rand;
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;



if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
 $deltmpcmd='rm '.$_SESSION['userpath'].$image;	
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

echo '<html lang="'.$lang.'">';
echo '<head>';
if ($requireauth=='yes')
{
	if (($_SESSION['loggedin']!='yes') || (($_SESSION['expire'] - $now ) < 1)) 
	{
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);		
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);	
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
	session_destroy();	
	}
	elseif (($_SESSION['loggedin']=='yes') && (($_SESSION['expire'] - $now ) > 1))
	{
	$previewimage = $_SESSION['userpath'].$image;
	$autocropcmd=$imagemagicklocation.' '.$previewimage.' -fuzz '.$fuzz.'% -trim +repage '.$_SESSION['userpath'].$croppedfile;
	$userpath=$_SESSION['userpath'];

		if ($_SESSION['password']=='PAM')
		{	
		$chmod= 'chmod 777 '.$_SESSION['userpath'].$croppedfile;	
		}

		else 
		{	
		$chmod= '';	
		}

		if (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']!='PAM'))
		{
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$userpath.'index.php?rand='.$rand.'#'.$croppedfile.'">';
		}

elseif ($_SESSION['fromfilelister']!='yes')
{
	if (($_GET['jpgpdf'] !='yes') && ($_GET['mode'] !='bw') && ($_GET['mode'] !='lineart'))
	//if ($_GET['jpgpdf']!='yes')
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
	$params['image'] = $croppedfile;
	$params['pdfres'] = $resolution;
	$params['confirm'] = 'yes';
	// rebuild the query
	$query_string = http_build_query($params);
	// reassemble the URL
	$urlvars = $path . '?' . $query_string;
	$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=mkmppdf.php'.$urlvars.'">';
	}

}


		elseif (($_SESSION['fromfilelister']=='yes') && ($_SESSION['password']=='PAM'))
		{
		echo '<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=pamindex.php?rand='.$rand.'#'.$croppedfile.'">';
		}
		else
		{


			if (($mode =='color') && ($_GET['postscan']!='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode == 'color') && ($_GET['postscan']=='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode == NULL) && ($_GET['postscan']=='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode == '') && ($_GET['postscan']=='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode == NULL) && ($_GET['postscan']!='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode == '') && ($_GET['postscan']!='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode =='bw') && ($_GET['postscan']!='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=bw.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode =='bw') && ($_GET['postscan']=='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode =='lineart') && ($_GET['postscan']=='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			elseif (($mode =='lineart') && ($_GET['postscan']!='yes'))
			{
			echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=lineart.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
			}

			else
			{
			echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
			session_unset($_SESSION["loggedin"]);
			session_unset($_SESSION["expire"]);
			session_unset($_SESSION["username"]);
			session_unset($_SESSION["password"]);
			session_unset($_SESSION["userpath"]);	
			session_unset($_SESSION['scanneronline']);
			session_unset($_SESSION['fromuserfolder']);
			session_unset($_SESSION['fromuserfilelister']);
			session_destroy();	
			}

		}
	}
}
elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$image;
$autocropcmd=$imagemagicklocation.' '.$root.$previewimage.' -fuzz '.$fuzz.'% -trim +repage '.$root.$filepath.$croppedfile;
$userpath=$filepath;
	if ($_SESSION['fromfilelister']=='yes')
	{
	echo '<meta HTTP-EQUIV="REFRESH" content='.$autocroprefresh.'; url='.$userpath.'index.php?rand='.$rand.'#'.$croppedfile.'">';
	}
	else
	{
	
		if ($mode =='color')
		{
		echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
		}

		elseif ($mode == NULL)
		{
		echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
		}

		elseif ($mode == '')
		{
		echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=color&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
		}

		elseif ($mode =='bw') 
		{
		echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=bw.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
		}

		elseif ($mode =='lineart') 
		{
		echo "<meta HTTP-EQUIV='REFRESH' content='$autocroprefresh; url=lineart.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight'>";
		}

		else
		{
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
		// $refreshurl="airscan.php?image=$croppedfile&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";
		session_unset($_SESSION["loggedin"]);
		session_unset($_SESSION["expire"]);
		session_unset($_SESSION["username"]);
		session_unset($_SESSION["password"]);
		session_unset($_SESSION["userpath"]);	
		session_unset($_SESSION['scanneronline']);
		session_unset($_SESSION['fromuserfolder']);
		session_unset($_SESSION['fromuserfilelister']);
		session_destroy();	
		}

	}
}

else
{
echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/logout.php?sound=yes">';
$autocropcmd='';
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);	
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();
}

// echo $_GET['image'].'<br/>auth'.$requireauth.'<br/>Loggedin'.$_SESSION['loggedin'];



///was here


?>
<?php echo $refreshurl;?>
  <meta charset="<?php echo $charset;?>">
  <meta http-equiv="Cache-Control" content="private, no-store" /> 
  <meta name="Expires" content="Tue, 01 Jun 1999 19:58:02 GMT"> 
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
// echo $refreshurl.'<br/>';
//echo $autocropcmd;

if ((isset($_GET['image'])) && ($requireauth=='yes') && (isset($_SESSION['loggedin'])))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitcroppingtxt.'...&nbsp;'.$croppedfile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
ob_flush();
flush();
$output = shell_exec("$autocropcmd");
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

echo '<center><p><span style="color:#666; font-weight:bold">'.$waitcroppingtxt.'...&nbsp;'.$croppedfile.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
//$output = 
ob_flush();
flush();
shell_exec("$autocropcmd");

}
else
{
}
?>
</body>
</html>
