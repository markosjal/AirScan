<?php
include_once 'config.inc.php';
include_once 'checkpingescl.php';
// Generates staus messages to pass to eSCL Protocol XML ScannerStatus(.xml). Only "Stopped" , "Idle" and "Processing" apply to eSCL. Any other result may show unpredictable or "unknown" status, but here they are anyway.
if ($scanneronline=='yes')
{
$status = "$s400w $host $port status";
$string = shell_exec("$status");
//$string = $statusoutput;
	if (($string!='') && ($string!=NULL) && (isset($string)))
	{
	$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
	$last_word = substr($string, $last_word_start); // $last_word = PHP.
	$lastword=preg_replace('/\s+/', '', $last_word);
	$now=time();
	// apparently no session support at least on mopria so we save to file
       	$expiration=file_get_contents($root.'eSCL/Scans/lastscan.txt'); //if we just did a scan this has an valid expiration to keep it from showing "No Page" when we should see "processing"	
	//echo $expiration-$now;
/*Idle Status
Aborted
Canceled
Completed
Processing		if (!is_numeric($expiration))
		{
		$pwgstate=$expiration;
		}
		else*/
		//$now=time();
//$jobdownloaded=file_get_contents
		if  ((is_numeric($expiration)) && ($expiration+10>=$now)) //(($expiration-$now <= 0) && ($expiration-$now >= 15))
		{
		$pwgstate='Processing'; // need proper response here! ScanReady ???? ReadyToUpload?? Ready??
		$pwgjobstatereason='JobScanning';
		$pwgjobstate='Processing';
		}		

/* elseif (($nowscanning=='yes')&&($lastword=='nopaper'))
{
$pwgstate='Idle';
$pwgjobstate='Aborted';
$pwgjobstatereason='JobRestartable';
}*/
		elseif ((is_numeric($expiration)) && ($expiration+10<=$now)) // ((trim($lastword)=='nopaper') && ($expiration+15<=$now)) 
		{  //online but no page loaded  -nested if
       		$pwgstate='Idle';
		$pwgjobstatereason='JobCompletedSuccessfully';
		$pwgjobstate='Processing';   //!!! pretty sure this is correct
		$scanage=$now-$expiration;    
       		}

		elseif (!is_numeric($expiration)) //&& (($expiration=='Completed')) // && ($expiration>=$now)) // && ($expiration>=$now))  // ((trim($lastword)=='nopaper') && ($expiration+15<=$now)) 
		{  //online but no page loaded  -nested if
       		$pwgstate='Idle';
		$pwgjobstatereason='';
		$pwgjobstate=$expiration;  // !!!  pretty sure this is  correct		
		$scanage='';   
       		}
		elseif ((trim($lastword)=='') || (trim($lastword)==NULL) || (!isset($lastword))) 
		{ //(trim($lastword)=='')) {  //online scanning  -nested if //getting '' while scanning on halo magic scanner
       		$pwgstate='Processing';
		$pwgjobstatereason='JobScanning';
		$pwgjobstate='Processing';
       		}
       		elseif (trim($lastword=='devbusy'))
		{  //online device is busy  -nested if
       		$pwgstate='Processing';
		$pwgjobstatereason='JobScanning';
		$pwgjobstate='Processing';
       		}
       		elseif (trim($lastword=='battlow'))
		{  //online but battery low  -nested if
       		$pwgstate='Disable()';
		$pwgjobstatereason='';
		$pwgjobstate='';
       		}
       		elseif (trim($lastword=='scanready'))
		{   //online with page loaded  -nested elseif
     		$pwgstate='Idle';
		$pwgjobstatereason='';
		}
       		elseif (trim($lastword)=='calgo')
		{   //online calibrating  -nested elseif
		$pwgstate='Disable()';
		$pwgjobstatereason='JobScanning';
		$pwgjobstate='Processing';
		}
        	elseif (trim($lastword)=='cleango')
		{   //online cleaning  -nested elseif
       		$pwgstate='Disable()';
		$pwgjobstatereason='JobScanning';
		$pwgjobstate='Processing';
		}
        	elseif (trim($lastword)=='calibrate')
		{   //online calibration complete  -nested elseif
       		$pwgstate='Disable()';
		$pwgjobstatereason='';
		$pwgjobstate='';
		}
 	       	elseif (trim($lastword)=='cleanend')
		{   //online cleaning complete  -nested elseif
       		$pwgstate='Idle';
		$pwgjobstatereason='';
		}
        	elseif (trim($lastword)=='dpifine')
		{   //600dpi calibrating  -nested elseif
       		$pwgstate='600DPI';
		$pwgjobstatereason='';
		$pwgjobstate='';
		}
	        elseif (trim($lastword)=='dpistd')
		{   //300dpi  -nested elseif
       		$pwgstate='300DPI';
		$pwgjobstatereason='';
		$pwgjobstate='';
		}
		else {    //other- unknown paper condition -nested else
	        //$pwgstate= 'Stopped';
		$pwgstate= 'Stopped';
		$pwgjobstatereason='';
		$pwgjobstate='';
		}
	}
	else
	{
	$pwgstate= 'Idle';
	$pwgjobstatereason='';
$pwgjobstate='';
	}
}	
elseif ($scanneronline=='no')
{    						//offline -nested else
$pwgstate= 'Stopped'; 
$pwgjobstatereason='';
$pwgjobstate=''; //found "Stopped" in PWG document. Makes red dot on Mopria , so seems to work! //
}                               //So when scanner off we still generate ScannerStatus.xml. 
				//This shows Red Dot and "Stopped" in Mopria instad of yellow dot and "unknown"
				//Coincides with indicators on scanner 
/*
echo $expiration;
echo '<br>';
echo $now;
$key = false;

    while($key){
        sleep(1);
	$now2=time();
        if($expiration <= $nowagain) $key = true;
    }
echo '<br>Exp'.$expiration;
echo '<br>now'.$now2;
echo '<br>dif'.$expiration - $nowagain;*/
?>
