<!DOCTYPE html>
<html>

<?php 
// error_reporting( -1 );
// ini_set( 'display_errors', 1 );

include_once 'config.inc.php';
include_once 'lang.php';

$resolution=$_GET['resolution'];
$deskew=$_GET['deskew'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
$currentpage=$_GET['currentpage'];
// $totalpages=$_GET['totalpages'];
// $pdf=$_GET['pdf'];
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];




function convertDateTime($unixTime) {
   $dt = new DateTime("@$unixTime");
   return $dt->format('YmdHis');
}

$dateVarName = convertDateTime(time ());

$filename=$fileprefix.$dateVarName.'.jpg';
session_start();
$filename=$fileprefix.'testscan.jpg';

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


// $_SESSION['fromfilelister']='no';
if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes'))
{
$previewimage = $_SESSION['userpath'].$filename;
$scan= $s400w.' '.$host.' '.$port.' scan '.$resolution.' '.$_SESSION['userpath'].$filename;
}

elseif ($requireauth !='yes') 
{
$previewimage = $filepath.$filename;
$scan= $s400w.' '.$host.' '.$port.' scan '.$resolution.' '.$filepath.$filename;
}

else
{
$previewimage='';
}



// $previewimage = $filepath.$filename;
/*

include 'checkscanner.php';

if ($online == 'yes')
{
sleep(1);

$status = "$s400w $host $port status";
$statusoutput = shell_exec("$status");

$string = $statusoutput;

$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
$last_word = substr($string, $last_word_start); // $last_word = PHP.
$lastword=preg_replace('/\s+/', '', $last_word);
}

else 
{
'';
}





if (($online =='yes') && ($lastword != 'nopaper'))
{

// $scan= "$s400w $host $port scan $resolution $filepath$filename";
// sleep(1);

   if ($deskew == 'yes')
   {
   $refreshurl="deskew.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight"; 
   $statusmessage='deskew';
   }


   elseif ($autocrop == 'yes')
   {
   $refreshurl="autocrop.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=yes&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight"; 
   $statusmessage='crop & print';
   }

   elseif (($autocrop != 'yes') && ($mode == 'lineart'))
   {
   $refreshurl="lineart.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";
   $statusmessage='no crop & print';
   }

   elseif (($autocrop != 'yes') && ($mode == 'edgedetect'))
   {
   $refreshurl="lineart.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";

   $statusmessage='no crop & print';
   }

   elseif (($autocrop != 'yes') && ($mode == 'charcoal'))
   {
   $refreshurl="lineart.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";

   $statusmessage='no crop & print';
   }
   elseif (($autocrop != 'yes') && ($mode == 'sketch'))
   {
   $refreshurl="lineart.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";

   $statusmessage='no crop & print';
   }




   elseif (($autocrop != 'yes') && ($mode == 'bw'))
   {
   $refreshurl="bw.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";
   $statusmessage='no crop & print';
   }


   elseif (($autocrop != 'yes') && ($deskew != 'yes') && ($mode  =='color'))
   {
   $refreshurl="airscan.php?image=$filename&resolution=$resolution&deskew=$deskew&autocrop=$autocrop&print=$print&mode=$mode&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight";
   $statusmessage='crop turned off &  print';
   }


   else
   {
   $refreshurl='airscan.php?output=error';
   }
}

elseif (($online =='yes') && ($lastword =='nopaper'))
{
$refreshurl='airscan.php?offline=nopaperscan';
}


elseif ($online =='no')
{
$refreshurl='airscan.php?output=offline';
}

else
{
$refreshurl='airscan.php?output=error';
}
*/

?>

<head>

<meta HTTP-EQUIV="REFRESH" content='<?php echo $scanrefresh;?>; url=<?php echo $refreshurl;?>'>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <link rel="icon" href="../../favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="../../css/style.css" type="text/css" />
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
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $actual_link;
?>
<?php

echo "<center><p><span style='color:#666; font-weight:bold'>$waitscanningtxt...&nbsp;$filename</span></p></center><center><img src='images/spinner.gif'></center>";
//$output = exec("$scan");
$output= "exec('nohup'.$scan.' > /dev/null 2>&1 &');";
//exec('nohup'.$scan.' > /dev/null 2>&1 &');
exit();
echo $output;
?>
<div id=\"scanStatus\">
<img src="images/scan.jpg width="430">
</div>
</script>
<script type="text/javascript">
if(typeof(EventSource)!=="undefined") {
    var statusSource = new EventSource("checkimage.php");
    statusSource.onmessage = function(event) {
            document.getElementById("scanStatus").innerHTML = 
event.data;
    };
}
else {

document.getElementById("scanStatus").innerHTML="'.$nosupporttxt.'";
}
</script>

?>
</body>
</html>
