<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>'; 
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );

include_once 'config.inc.php';
include_once 'lang.php';
$resolution=$_GET['resolution'];
$deskew=$_GET['deskew'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
$currentpage=$_GET['currentpage'];
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$mppdf=$_GET['mppdf'];
$jpgpdf=$_GET['jpgpdf'];
$requireauth='yes';
// for demo
$random=(rand(1, 4));
//$_SESSION['scanneronline'] ='yes';
//if (($_GET['mppdf']=='yes') && (!isset($_GET['pdfname'])))

if ($_GET['mppdf']=='yes')
{
	if ((isset($_GET['pdfname'])) && ($_GET['pdfname']!='') && ($_GET['pdfname']!=NULL) && ($_GET['pdfname']!='.') && ($_GET['pdfname']!='/'))	
	{
	$pdfname=$_GET['pdfname'];
	}
	else
	{ //random PDF name
	$length = 4;    
	$pdfname=substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);	
	}
}
else
{
}

function convertDateTime($unixTime) {
   $dt = new DateTime("@$unixTime");
   return $dt->format('YmdHis');
}

$dateVarName = convertDateTime(time ());

if ($scanner=='SANE')
{
	if ((isset($pdfname))&& ($_GET['mppdf']=='yes')) // && ($scanner='s400w'))
	{
	$filename=$pdfname.'_'.time().'.png';
	}
	//elseif ($scanner='s400w')
	else
	{
	$filename=$fileprefix.$dateVarName.'.png';   // do i need fileprefix??
	}
}

else
{
	if ((isset($pdfname))&& ($_GET['mppdf']=='yes')) // && ($scanner='s400w'))
	{
	$filename=$pdfname.'_'.time().'.jpg';
	}
	//elseif ($scanner='s400w')
	else
	{
	$filename=$fileprefix.$dateVarName.'.jpg';   // do i need fileprefix??
	}
}

//echo 'online?'.$_SESSION['scanneronline'];
//echo 'scanner?'.$scanner;


$scansize=$_GET['pagesize'];





if (($_SESSION['loggedin']=='yes') && ($scanner=='eSCL') && ($_SESSION['scanneronline']=='yes')) //start produce escl-xml scan
{
$previewimage = $_SESSION['userpath'].$filename;
	if ($scansize=='letter') //2550 x 3300 Pixels
	{
	$scanheight=3300;
	$scanwidth=2550;
	}
	elseif ($scansize=='A4')//2480 x 3508
	{
	$scanheight=3508; 
	$scanwidth=2480;
	}

	elseif ($scansize=='legal') //2550 x 4200 Pixels
	{
	$scanheight=4200;
	$scanwidth=2550;
	}
	elseif ($scansize=='AB') //2362 x 3579 pix Pixels
	{
	$scanheight=3579;
	$scanwidth=2362;
	}

	elseif ($scansize=='ISOB5') //2079 x 2953 Pixels
	{
	$scanheight=2953;
	$scanwidth=2079;
	}
	elseif ($scansize=='JISB5') // 2160 x 3030 Pixels
	{
	$scanheight=3030;
	$scanwidth=2160;
	}

$scanresolution=$_GET['resolution'];

//if ($_GET['mode']=='color')
//{
//$scanmode='RGB24';
//}
//elseif ($_GET['mode']=='bw')
//{
//$scanmode='Grayscale8';
//}



//A4', 'letter', 'legal', 'AB', 'ISOB5' or 'JISB5'


$xmlbase='
<?xml version="1.0" encoding="UTF-8"?>
<scan:ScanSettings xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03">
  <pwg:Version>2.0</pwg:Version>
  <pwg:ScanRegions>
    <pwg:ScanRegion>
      <pwg:Height>'.$scanheight.'</pwg:Height>
      <pwg:ContentRegionUnits>escl:ThreeHundredthsOfInches</pwg:ContentRegionUnits>
      <pwg:Width>'.$scanwidth.'</pwg:Width>
      <pwg:XOffset>0</pwg:XOffset>
      <pwg:YOffset>0</pwg:YOffset>
    </pwg:ScanRegion>
  </pwg:ScanRegions>
  <pwg:InputSource>Platen</pwg:InputSource>
  <scan:ColorMode>RGB24</scan:ColorMode>
  <scan:XResolution>'.$_GET['resolution'].'</scan:XResolution>
  <scan:YResolution>'.$_GET['resolution'].'</scan:YResolution>
</scan:ScanSettings>';




	function get_string_between($string, $start, $end)
	{
    	$string = ' ' . $string;
    	$ini = strpos($string, $start);
    	if ($ini == 0) return '';
    	$ini += strlen($start);
    	$len = strpos($string, $end, $ini) - $ini;
    	return substr($string, $ini, $len);
	}

//file_put_contents('ScanSettings.xml',$xmlbase);
//echo $xmlbase;

// initialise the curl request
//echo $_SESSION["esclip"];
$requesturl='http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScanJobs';
$request = curl_init($requesturl);

//$request = curl_init('http://localhost:80/eSCL/ScanJobs');
// send a file
curl_setopt($request, CURLOPT_POST, true);
//enable headers
curl_setopt($request, CURLOPT_HEADER, 1);
//get only headers
curl_setopt($request, CURLOPT_NOBODY, 1);
curl_setopt(
    $request,
    CURLOPT_POSTFIELDS,
    array(
      'file' => '@' . realpath('ScanSettings.xml')
    ));

// output the response
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
$curlresult= curl_exec($request);

$beginafter='201';
$endbefore=PHP_EOL;
$confirmcreated= strtolower(trim(get_string_between($curlresult, $beginafter, $endbefore)));

$beginafter='Location:';
$endbefore=PHP_EOL;
$confirmlocation= trim(get_string_between($curlresult, $beginafter, $endbefore));
// close the session
curl_close($request);

	if ($_SESSION['password']=='PAM')
	{
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$filename;
	sleep("$chmodsleep");
	shell_exec("$chmod");
	}
	else
	{
	}


}  // end xml-escl scan produce


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
$params['image'] = $filename;
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






if (($_SESSION['loggedin']=='yes') && ($scanner=='s400w'))
{
$previewimage = $_SESSION['userpath'].$filename;
	if ($demomode!='yes') 
	{
 	$scan= $s400w.' '.$host.' '.$port.' scan '.$resolution.' '.$_SESSION['userpath'].$filename;
		if ($_SESSION['password']=='PAM')
		{	
		$chmod= 'chmod 777 '.$_SESSION['userpath'].$filename;	
		}	
	}

		
	elseif ($demomode=='yes')
	{	
	$scan='cp '.$root.$resolution.'_'.$random.'.jpg '.$root.$_SESSION['userpath'].$filename;
	}
}

elseif (($_SESSION['loggedin']=='yes') && ($scanner=='SANE'))
{
$previewimage = $_SESSION['userpath'].$filename;
	if ($demomode!='yes') 
	{
	//scanimage --device "pixma:04A91749_247936" --format=tiff > test.tiff
 	//$scan= 'scanimage -d "'.$sanename.'" --format jpg --mode Color --progress --verbose --verbose --verbose --resolution '.$resolution.' > '.$_SESSION['userpath'].$filename;
	$scan= 'scanimage -d "'.$sanename.'" --format png --mode Color --progress --verbose --verbose --verbose --resolution '.$resolution.' > '.$_SESSION['userpath'].'scan.pnm';

		if ($_SESSION['password']=='PAM')
		{	
		$chmod= 'chmod 777 '.$_SESSION['userpath'].$filename;	
		}	
	}

		
	elseif ($demomode=='yes')
	{	
	$scan='cp '.$root.$resolution.'_'.$random.'.jpg '.$root.$_SESSION['userpath'].$filename;
	}
}
elseif (($_SESSION['loggedin']=='yes') && ($scanner=='eSCL'))
{
$previewimage = $_SESSION['userpath'].$filename;
	if ($demomode!='yes')
	{

		if ($_SESSION['password']=='PAM')
		{	
		$chmod= 'chmod 777 '.$_SESSION['userpath'].$filename;	
		}	
	}

		

}
elseif (($_SESSION['loggedin']=='yes') && ($scanner=='SANE'))
{
$previewimage = $_SESSION['userpath'].$filename;
	if ($demomode!='yes')
	{

		if ($_SESSION['password']=='PAM')
		{	
		$chmod= 'chmod 777 '.$_SESSION['userpath'].$filename;	
		}	
	}

		

}

else
{
$previewimage='';
}


if (($_SESSION['scanneronline'] == 'yes') && ($scanner=='s400w'))
{


$status = "$s400w $host $port status";

$statusoutput = shell_exec("$status");
usleep(500000);
$string = $statusoutput;

$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
$last_word = substr($string, $last_word_start); // $last_word = PHP.
$lastword=preg_replace('/\s+/', '', $last_word);
}

else 
{
//'';
}

if (($_SESSION['scanneronline'] =='yes') && ($lastword != 'nopaper'))// && ($scanner=='s400w')) works for both as eSCL willnever have "nopaper" status
{


	if ($deskew == 'yes')
   	{
		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		//unset($params['rand']);
		// change the print param
		$params['image'] = $filename;
		$params['pdfres'] = $resolution;
		$params['rand'] = $rand;
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
   	$refreshurl="deskew.php$urlvars"; 
   	$statusmessage='deskew';
   	}


   	elseif ($autocrop == 'yes')
   	{
		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		//unset($params['rand']);
		// change the print param
		$params['image'] = $filename;
		$params['pdfres'] = $resolution;
		$params['rand'] = $rand;
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
   	$refreshurl="autocrop.php$urlvars"; 
   	$statusmessage='crop & print';
   	}
   	elseif (($autocrop != 'yes') && ($mode == 'bw'))
   	{
		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		//unset($params['rand']);
		// change the print param
		$params['image'] = $filename;
		$params['pdfres'] = $resolution;
		$params['rand'] = $rand;
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
   	$refreshurl="bw.php$urlvars";
   	$statusmessage='no crop & print';
   	}

   	elseif (($autocrop != 'yes') && ($mode == 'lineart'))
   	{
		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		//unset($params['rand']);
		// change the print param
		$params['image'] = $filename;
		$params['pdfres'] = $resolution;
		$params['rand'] = $rand;
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
   	$refreshurl="lineart.php$urlvars";
   	$statusmessage='no crop & print';
   	}
   	elseif (($_GET['jpgpdf']!='yes') && ($autocrop != 'yes') && ($deskew != 'yes') && ($mode  =='color')) //&& ($scanner=='s400w'))
   	{
		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		//unset($params['rand']);
		// change the print param
		$params['image'] = $filename;
		$params['pdfres'] = $resolution;
		$params['rand'] = $rand;
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
   	$refreshurl="airscan.php$urlvars";
   	$statusmessage='crop turned off &  print';
   	}


   	elseif (($_GET['jpgpdf']=='yes') && ($_GET['mode']=='color') && ($autocrop != 'yes') && ($deskew != 'yes'))// && ($scanner=='s400w'))
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
		$params['image'] = $filename;
		$params['pdfres'] = $resolution;
		$params['confirm'] = 'yes';
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;
   	$refreshurl="mkmppdf.php$urlvars&confirm=yes";
   	$statusmessage='crop turned off &  print';
   	}
   	else
   	{
   	$refreshurl='airscan.php?output=error';
  	$scanrefresh=0;
   	}
}

elseif (($_SESSION['scanneronline'] =='yes') && ($lastword =='nopaper') && ($scanner=='s400w'))
{
$refreshurl='airscan.php?offline=nopaperscan';
$scanrefresh=0;
}


elseif ($_SESSION['scanneronline'] =='no')
{
$refreshurl='airscan.php?output=offline';
$scanrefresh=0;
}

else
{
$refreshurl='airscan.php?output=error';
$scanrefresh=0;
}

?>

<head>
<meta HTTP-EQUIV="REFRESH" content="0; <?php echo $refreshurl;?>">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="../../favicon.ico" type="image/x-icon" />
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

<?php    // below we initiate scan for s400w

if (($_SESSION['scanneronline'] =='yes') && ($scanner=='s400w') && ($lastword != 'nopaper'))    
{

//$scandebug='yes';
	
	if ($scandebug =='yes')
	{
	file_put_contents('scancmd.txt', $scan);
        file_put_contents('scanrefreshurl.txt', $refreshurl);
	}
	else
	{
	}

shell_exec($scan);


	if ($_SESSION['password']=='PAM')
	{
	sleep("$chmodsleep");
	shell_exec("$chmod");
	}
	else
	{
	}
	
}

elseif ($scanner=='SANE')//(($_SESSION['scanneronline'] =='yes') && ($scanner=='SANE'))// && ($lastword != 'nopaper'))    
{
	
	if ($scandebug =='yes')
	{
	file_put_contents('scancmd.txt', $scan);
	}
	else
	{
	}
//echo $scan;
shell_exec($scan);
$convertcmd=$imagemagicklocation.' '.$_SESSION['userpath'].'scan.pnm'.' '.$root.$_SESSION['userpath'].$filename;
sleep("$chmodsleep");
shell_exec($convertcmd);
$rmcmd='rm '.$_SESSION['userpath'].'scan.pnm';
sleep("$chmodsleep");
shell_exec($rmcmd);


	if ($_SESSION['password']=='PAM')
	{
	sleep("$chmodsleep");
	shell_exec("$chmod");
	}
	else
	{
	}
	
}


?>

</body>
</html>







