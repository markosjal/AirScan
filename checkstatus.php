<?php // this file used onlt for s400w scanner
include_once 'phppagestart.php';
include_once 'lang.php';
include_once 'config.inc.php';
 // session_start();
// include_once 'checkscanner.php';
//$_SESSION['modulerunning']='no';
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
 if ($demomode=='yes')
{
//$refresh='1800';
$statusmessagetxt=$pagereadytxt;
//sleep(4);
}

elseif (($demomode!='yes') && ($scanner=='s400w'))  // Get s400w status
{
usleep(500000);
	if (($_SESSION['scanneronline']=='yes') && ($requireauth=='yes') && ($_SESSION['loggedin'] == 'yes') && ($scanner=='s400w'))
	{
	$status = "$s400w $host $port status";
	$statusoutput = shell_exec("$status");
	$string = $statusoutput;
	$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
	$last_word = substr($string, $last_word_start); // $last_word = PHP.
	$lastword=preg_replace('/\s+/', '', $last_word);
        	if ($lastword=='nopaper'){  //online but no page loaded  -nested if
        	$statusmessagetxt=$insertpagetxt;
        	}
        	elseif (($lastword=='scango') || (trim($lastword)=='')) {  //online device is busy  -nested if
        	$statusmessagetxt=$scanningtxt;
        	}
        	elseif ($lastword=='devbusy'){  //online device is busy  -nested if
        	$statusmessagetxt=$devbusytxt;
        	}
        	elseif ($lastword=='battlow'){  //online but battery low  -nested if
        	$statusmessagetxt=$battlowtxt;
        	}
        	elseif ($lastword=='scanready'){   //online with page loaded  -nested elseif
       		$statusmessagetxt=$pagereadytxt;
		}
        	else {    //other- unknown paper condition -nested else
        	$statusmessagetxt= '<span style="color:#FFF; font-weight:bold">&nbsp;&nbsp;</span>';
		}
	}
	elseif (($requireauth!='yes') && ($_SESSION['scanneronline'] =='yes') && ($scanner=='s400w'))
	{
	$status = "$s400w $host $port status";
	$statusoutput = shell_exec("$status");
	$string = $statusoutput;
	$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
	$last_word = substr($string, $last_word_start); // $last_word = PHP.
	$lastword=preg_replace('/\s+/', '', $last_word);
        	if ($lastword=='nopaper'){  //online but no page loaded  -nested if
        	$statusmessagetxt=$insertpagetxt;
        	}
        	elseif ($lastword=='devbusy'){  //online device is busy  -nested if
        	$statusmessagetxt=$devbusytxt;
        	}
        	elseif ($lastword=='battlow'){  //online but battery low  -nested if
        	$statusmessagetxt=$battlowtxt;
        	}
        	elseif ($lastword=='scanready'){   //online with page loaded  -nested elseif
       		$statusmessagetxt=$pagereadytxt;
		}
        	else {    //other- unknown paper condition -nested else
        	$statusmessagetxt= '<span style="color:#FFF; font-weight:bold">&nbsp;&nbsp;</span>';
		}
	}


	elseif (($requireauth=='yes') && ($_SESSION['loggedin'] != 'yes') && ($_SESSION['scanneronline'] =='yes') && ($scanner=='s400w'))
	{
	$statusmessagetxt= '<span style="color:#FFF; font-weight:bold">&nbsp;&nbsp;</span>';
	}

	elseif (($requireauth=='yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['scanneronline'] !='yes') && ($scanner=='s400w'))
	{
	$statusmessagetxt= '<span style="color:#FFF; font-weight:bold">&nbsp;&nbsp;</span>';
	}

	elseif (($_SESSION['scanneronline']=='no') && ($scanner=='s400w'))
	{
	$statusmessagetxt= '<span style="color:#FFF; font-weight:bold">&nbsp;&nbsp;</span>';
	}

}
elseif (($_SESSION['scanneronline'] =='yes') && ($scanner=='SANE'))  // get eSCL Scanner Status
{
$statusmessagetxt='<span style="color:#484; font-weight:bold">Ready</span>';
}
elseif (($_SESSION['scanneronline'] =='yes') && ($scanner=='eSCL'))  // get eSCL Scanner Status
{
   function get_string_between($string, $start, $end)
   {
   $string = ' ' . $string;
   $ini = strpos($string, $start);
   if ($ini == 0) return '';
   $ini += strlen($start);
   $len = strpos($string, $end, $ini) - $ini;
   return substr($string, $ini, $len);
   }
usleep(500000);
$scannerstatus=file_get_contents('http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerStatus');
if (($scannerstatus==NULL) ||($scannerstatus==''))
{
//echo 'EMPTY!';
//echo 'AAA'.$scannerstatus;
}

else 
{
//echo 'CCC'.$scannerstatus;
}
$beginafter='<pwg:State>'; //application/pdf or image/jpeg  some scanners may support other formats like TIFF or PNG
$endbefore='</pwg:State>';
$pwgstatetext= trim(get_string_between($scannerstatus, $beginafter, $endbefore)); 

	if ($pwgstatetext=='Stopped')
	{
	$statusmessagetxt=$stopped;
	}
	elseif ($pwgstatetext=='Idle')
	{
	$statusmessagetxt=$idle;
	}
	elseif ($pwgstatetext=='Processing')
	{
	$statusmessagetxt=$processing;
	}
	else
	{
	$statusmessagetxt= '<span style="color:#FFF; font-weight:bold">&nbsp;&nbsp;</span>';
}	

//$statusmessagetxt=${$pwgstatetext};
}

//$_SESSION['modulerunning']='';
echo "retry: $refresh\n\ndata: {$statusmessagetxt}\n\n";
?>

