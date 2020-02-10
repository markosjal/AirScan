<?php 
include_once 'checkstatusescl.php';
//$nowscanning='yes';
/*if ($lastword=='nopaper')
{
$pwgstate='Idle';
$pwgjobstate='Aborted';
$pwgjobstatereason='JobRestartable';
}*/
//below we modify the parameters for use with s400w command line scanner there may be other options on some scanners
//Sleep(1);
$now=time();
/*
function struuid($entropy)
{
    $s=uniqid("",$entropy);
    $num= hexdec(str_replace(".","",(string)$s));
    $index = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $base= strlen($index);
    $out = '';
        for($t = floor(log10($num) / log10($base)); $t >= 0; $t--) {
            $a = floor($num / pow($base,$t));
            $out = $out.substr($index,$a,1);
            $num = $num-($a*pow($base,$t));
        }
    return $out;
}
//echo struuid(false); //Return sample: F4518NTQTQ
//echo struuid(true);  //Return sample: F451FAHSUCD90N6YNRBQHLZ9E1W
$jobid=struuid(false);
*/
//echo $jobid;
if ($colormode=='RGB24')
{
$mode='color';
}
elseif ($colormode=='Grayscale8')
{
$mode='bw';
}
elseif ($colormode=='LineArt')
{
$mode='lineart';
}
elseif ($colormode=='Binary')
{
$mode='lineart';
}
else
{
$mode='color';
}

/*
$xml='<scan:ScannerStatus xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 ../../schemas/eSCL-1_90.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>Processing</pwg:State>
</scan:ScannerStatus>';  //Idle
*/

// if you modify this script  for another scanner, you will probably need to modify the order of the options below
// can most likely be used with SANE scanimage. Use scanimage -L to get your scanner name
// whatever scanner should support botrh jpg and PDF output at a minimum
//you can use imagemagic to convert to the required formats of jpg and PDF 

if (($xresolution == $yresolution) && ($yresolution==300)) 
{
$resolution=$xresolution;
} 
elseif (($xresolution == $yresolution) && ($yresolution==600)) 
{
$resolution=$xresolution;
} 
else
{
$resolution=$defaultresolution;
} 
echo $scanintent;

if ($scanintent=='Preview')
{
$copypreview='cp /var/www/html/images/scan.jpg '.$root.'eSCL/Scans/'.$unique.'/XYZ.jpg';
shell_exec($copypreview);
file_put_contents($root.'eSCL/Scans/lastscan.txt', $endtime);
}

elseif  (($scanintent!='Preview') && (trim($lastword)=='nopaper')) //(($scanner=='s400w') &&) //(  ($_SESSION['loggedin']=='yes') && ($_SESSION['expires']>=$now)) //  && (trim($lastword)=='scanready') &&
{
file_put_contents($root.'eSCL/Scans/lastscan.txt', 'Aborted');
exit();
}

elseif  (($scanintent!='Preview') && (trim($lastword)=='scanready')) //(($scanner=='s400w') &&) //(  ($_SESSION['loggedin']=='yes') && ($_SESSION['expires']>=$now)) //  && (trim($lastword)=='scanready') &&
{
$scan= $s400w.' '.$host.' '.$port.' scan '.$resolution.' '.$root.'eSCL/Scans/'.$unique.'/XYZ.jpg';  //original color JPG is always XYZ.jpg
	if ($scandebug == 'yes')
	{ // this will save the request sent to s400w or other command line scanner if enabled in config.inc.php
	file_put_contents($root.'eSCL/Scans/scancmd.txt', $scan);
	}
$starttime=$now+30;  	//make sure we do not see "no Page", instead we need "Processing"

//file_put_contents($root.'eSCL/Scans/lastscan.txt', 'Pending');
file_put_contents($root.'eSCL/Scans/lastscan.txt', $starttime); // overrides status for 60 seconds it will now shopw processing or until overwitten
//file_put_contents('php://memory/scantime', $starttime);
usleep(500000);
shell_exec($scan);
//$now=time();
$endtime=$now+3; 	//make sure we do not see "no Page", instead we need "Processing"
file_put_contents($root.'eSCL/Scans/lastscan.txt', $endtime);
}
else 
{
$scan='';
}
//echo $scanner;
//echo file_get_contents("php://memory/scantime");

if ($mode=='color')// && ($format='image/jpeg'))
{
	if ($format=='image/jpeg')
	{
	$newscan='eSCL/Scans/'.$unique.'/XYZ.jpg';
	}

	elseif ($format=='application/pdf')
	{
	$starttime=$now+60;
	file_put_contents($root.'eSCL/Scans/lastscan.txt', $starttime);  // Sets the Preparing message if queried
		if ($xresolution=300)
		{
		$mkpdfcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/'.$unique.'/XYZ.jpg -density '.$xresolution.' -units pixelsperinch -background White -gravity center -extent '.$width.'x'.$height.' +write info: '.$root.'eSCL/Scans/'.$unique.'/XYZ.pdf';
		}
		elseif ($xresolution=600)
		{
		$mkpdfcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/'.$unique.'/XYZ.jpg -density '.$xresolution.' -units pixelsperinch -background White -gravity center -extent '.($width*2).'x'.($height*2).' +write info: '.$root.'eSCL/Scans/'.$unique.'/XYZ.pdf';
		}	
	shell_exec('nice -n '.$niceness.' '.$mkpdfcmd);
	$newscan='eSCL/Scans/'.$unique.'/XYZ.pdf';	
	}
//make sure we do not see "no Page", instead we need "Processing"
$now=time();
$endtime=$now;
file_put_contents($root.'eSCL/Scans/lastscan.txt', $endtime);   // Kills the Preparing message if queried
}

elseif ($mode=='lineart') 
{
$starttime=$now+30;
file_put_contents($root.'eSCL/Scans/lastscan.txt', $starttime);  // Sets the Preparing message if queried
$lineartcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/'.$unique.'/XYZ.jpg.jpg -threshold '.$threshold.'% '.$root.'eSCL/Scans/'.$unique.'/XYZla.jpg';
shell_exec('nice -n '.$niceness.' '.$lineartcmd);
	if ($format=='image/jpeg')
	{
	$newscan='eSCL/Scans/'.$unique.'/XYZla.jpg';
	}
	elseif ($format=='application/pdf')
	{
		if ($xresolution=300)
		{
		$mkpdfcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/'.$unique.'/XYZla.jpg -density '.$xresolution.' -units pixelsperinch -background White -gravity center -extent '.$width.'x'.$height.' +write info: '.$root.'eSCL/Scans/'.$unique.'/XYZla.pdf';
		}
		elseif ($xresolution=600)
		{
		$mkpdfcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/'.$unique.'/XYZla.jpg -density '.$xresolution.' -units pixelsperinch -background White -gravity center -extent '.($width*2).'x'.($height*2).' +write info: '.$root.'eSCL/Scans/'.$unique.'/XYZla.pdf';
		}
	shell_exec('nice -n '.$niceness.' '.$mkpdfcmd);
	$newscan='eSCL/Scans/'.$unique.'/XYZla.pdf';	
	}
$now=time();
$endtime=$now;
file_put_contents($root.'eSCL/Scans/lastscan.txt', $endtime);  // Kills the Preparing message if queried
}

elseif ($mode=='bw') //&& ($format='image/jpeg'))
{
$now=time();
$starttime=$now+30;
file_put_contents($root.'eSCL/Scans/lastscan.txt', $starttime); // Sets the Preparing message if queried
$blackwhitecmd=$imagemagicklocation.' '.$root.'eSCL/Scans/XYZ.jpg -type Grayscale '.$root.'eSCL/Scans/'.$unique.'/XYZbw.jpg';
shell_exec('nice -n '.$niceness.' '.$blackwhitecmd);
	if ($format=='image/jpeg')
	{
	$newscan='eSCL/Scans/'.$unique.'/XYZbw.jpg';
	}
	elseif ($format=='application/pdf')
	{
		if ($xresolution=300)
		{
		$mkpdfcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/XYZbw.jpg -density '.$xresolution.' -units pixelsperinch -background White -gravity center -extent '.$width.'x'.$height.' +write info: '.$root.'eSCL/Scans/XYZbw.pdf';
		}
		elseif ($xresolution=600)
		{
		$mkpdfcmd=$imagemagicklocation.' '.$root.'eSCL/Scans/XYZbw.jpg -density '.$xresolution.' -units pixelsperinch -background White -gravity center -extent '.($width*2).'x'.($height*2).' +write info: '.$root.'eSCL/Scans/XYZbw.pdf';
		}
	shell_exec('nice -n '.$niceness.' '.$mkpdfcmd);
	$newscan='eSCL/Scans/'.$unique.'/XYZbw.pdf';	
	}
$now=time();
$endtime=$now;
file_put_contents($root.'eSCL/Scans/lastscan.txt', $endtime); // Kills the "Preparing" message if queried ta sets to end time
}

if ($format=='image/jpeg')
{
$nextscan='<?php
header(\'Cache-Control: no-cache, no-store, must-revalidate\');
header(\'Content-type:image/jpeg\');
include_once \'config.inc.php\';
$src = \''.$root.$newscan.'\';
readfile($src);
file_put_contents(\''.$root.'eSCL/Scans/lastscan.txt\', \'Completed\');
ob_flush();
flush();
sleep(30);
$thisjob=\'/var/www/html/eSCL/Scans/\'.$unique;
rmdir($thisjob);
?>';

}

elseif ($format=='image/tiff')
{
$nextscan='<?php
header(\'Cache-Control: no-cache, no-store, must-revalidate\');
header(\'Content-type:image/tiff\');
include_once \'config.inc.php\';
$src = \''.$root.$newscan.'\';
readfile($src);
file_put_contents(\''.$root.'eSCL/Scans/lastscan.txt\', \'Completed\');
ob_flush();
flush();
sleep(30);
$thisjob=\'/var/www/html/eSCL/Scans/\'.$unique;
rmdir($thisjob);
?>';
}
elseif ($format=='image/png')
{
$nextscan='<?php
header(\'Cache-Control: no-cache, no-store, must-revalidate\');
header(\'Content-type:image/png\');
include_once \'config.inc.php\';
$src = \''.$root.$newscan.'\';
readfile($src);
file_put_contents(\''.$root.'eSCL/Scans/lastscan.txt\', \'Completed\');
ob_flush();
flush();
sleep(30);
$thisjob=\'/var/www/html/eSCL/Scans/\'.$unique;
rmdir($thisjob);
?>';
}
elseif ($format=='image/gif')
{
$nextscan='<?php
header(\'Cache-Control: no-cache, no-store, must-revalidate\');
header(\'Content-type:image/gif\');
include_once \'config.inc.php\';
$src = \''.$root.$newscan.'\';
file_put_contents(\''.$root.'eSCL/Scans/lastscan.txt\', \'Completed\');
ob_flush();
flush();
sleep(30);
$thisjob=\'/var/www/html/eSCL/Scans/\'.$unique;
rmdir($thisjob);
?>';
}
elseif ($format=='application/pdf')
{
$nextscan='<?php
header(\'Cache-Control: no-cache, no-store, must-revalidate\');
header(\'Content-type:application/pdf\');
include_once \'config.inc.php\';
$src = \''.$root.$newscan.'\';
readfile($src);
file_put_contents(\''.$root.'eSCL/Scans/lastscan.txt\', \'Completed\');
ob_flush();
flush();
sleep(30);
$thisjob=\'/var/www/html/eSCL/Scans/\'.$unique;
rmdir($thisjob);
?>';
}

file_put_contents($root.'eSCL/Scans/'.$unique.'/NextDocument.php', $nextscan);




//chdir('/var/www/eSCL/Scans');
//$target = $newscan;
//$link = 'NextDocument';
//unlink($link);
//symlink($target, $link);

//shell_exec('ln -s '.$root.'eSCL/Scans/'.$newscan.' '.$root.'eSCL/Scans/NextDocument');
/*
header("HTTP/1.1 201 Created");
echo '
<PageState>PreparingScan</PageState> 
<BinaryURL>/eSCL/Scans/'.$newscan.'</BinaryURL>';// will change to ReadyToUpload
*/
//echo '<br/>'.$scan;
//ob_flush();
//flush();
//echo $_SESSION['scanneronline'];


/*
if ($format='image/jpeg')
{
//$ext='jpg';
}
elseif ($format='application/pdf')
{
//$ext='pdf';
}
//$ext='jpg';
*/




//echo $mode;
//echo $resolution;
//echo $scan;




//get file from 
//echo $hostname.$root.'eSCL/ScanJobs/ZZZ/'.file_get_contents($root.'eSCL/Scans/NextDocument.txt').'.'.$ext;
/*
header("HTTP/1.1 201 Created");
echo '
<PageState>ReadyToUpload</PageState> 
<BinaryURL>/eSCL/Scans/'.$newscan.'</BinaryURL>';
*/

//ob_flush();
//flush();
/*
$saveallesclfiles='yes';
if ($saveallesclfiles!='yes')
{
//sleep (10);
shell_exec('rm '.$root.'eSCL/ScanJob.xml');
shell_exec('rm '.$root.'eSCL/Scans/*.jpg');
shell_exec('rm '.$root.'eSCL/Scans/*.pdf');
}
else
{
}*/
/*

usleep(500000);
$xml='<scan:ScannerStatus xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 ../../schemas/eSCL-1_90.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>Processing</pwg:State>
</scan:ScannerStatus>';
*/
//echo file_get_contents($root.'eSCL/Scans/NextDocument.txt').'Scan esclscan212 <br/>';
//echo $headerfilename.'Escalscan214 <br/>';


$string = "";
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
for($i=0;$i<10;$i++)
$randstring.=substr($chars,rand(0,strlen($chars)),1);

//echo $randstring;

file_put_contents($root.'eSCL/unique.txt',$unique);

?>
