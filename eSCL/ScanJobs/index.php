<?php
header('HTTP/1.1 201 Created');
header('Location: http://'.gethostname().'/eSCL/Scans/');
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
header( 'Cache-Control: post-check=0, pre-check=0', false ); 
header( 'Pragma: no-cache' ); 
$unique= uniqid();
include_once '../../config.inc.php';
mkdir($root.'/eSCL/Scans/', 0755);

//$scandebug='yes';
//header('Location: http://'.gethostname().'./eSCL/Scans', false);
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
// In this file we mostly parse the POSTed XML from an eSCL scan client in preparation 
// to pass to included esclscan.php to do the actual scanning
// which is for initiating the command line scan.
   function get_string_between($string, $start, $end)
   {
   $string = ' ' . $string;
   $ini = strpos($string, $start);
   if ($ini == 0) return '';
   $ini += strlen($start);
   $len = strpos($string, $end, $ini) - $ini;
   return substr($string, $ini, $len);
   }

// save this for later
/*function uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

echo  uuid();
$jobuuid = uuid();
*/

$job= file_get_contents('php://input');
//You can replace the above $job=... line with one of the variable strings below then use a web browser at 
//http://ipaddress/eSCL/ScanJob to initiate a scan with one of the pre - defined profiles below.

//Scan Job no resolution defined

/*
$job='<?xml version="1.0" encoding="UTF-8"?>
<scan:ScanSettings xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03">
  <pwg:Version>2.0</pwg:Version>
  <pwg:ScanRegions>
    <pwg:ScanRegion>
      <pwg:Height>3300</pwg:Height>
      <pwg:ContentRegionUnits>escl:ThreeHundredthsOfInches</pwg:ContentRegionUnits>
      <pwg:Width>2550</pwg:Width>
      <pwg:XOffset>0</pwg:XOffset>
      <pwg:YOffset>0</pwg:YOffset>
    </pwg:ScanRegion>
  </pwg:ScanRegions>
  <pwg:InputSource>Platen</pwg:InputSource>
  <scan:ColorMode>RGB24</scan:ColorMode>
</scan:ScanSettings>';

 typical scan job
$job='<?xml version="1.0" encoding="UTF-8"?>
<scan:ScanSettings xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm">
   <pwg:Version>2.6</pwg:Version>
   <pwg:ScanRegions>
      <pwg:ScanRegion>
         <pwg:Height>3300</pwg:Height>
         <pwg:ContentRegionUnits>escl:ThreeHundredthsOfInches</pwg:ContentRegionUnits>
         <pwg:Width>2550</pwg:Width>
         <pwg:XOffset>0</pwg:XOffset>
         <pwg:YOffset>0</pwg:YOffset>
      </pwg:ScanRegion>
   </pwg:ScanRegions>
   <scan:DocumentFormatExt>application/pdf</scan:DocumentFormatExt>
   <pwg:ContentType>TextAndPhoto</pwg:ContentType>
   <scan:XResolution>300</scan:XResolution>
   <scan:YResolution>300</scan:YResolution>
   <scan:ColorMode>Grayscale8</scan:ColorMode>
</scan:ScanSettings>
';
*/

if ($scandebug == 'yes')
{ // this will save the xml request from client if enabled in config.inc.php
file_put_contents($root.'eSCL/Scans/scancmd.xml', $job);
}
else
{
}
$scanjob=$job;
$string=$job;   // NEED THIS??

//<scan:Intent>Preview</scan:Intent>
$beginafter='<scan:Intent>'; //application/pdf or image/jpeg  some scanners may support other formats like TIFF or PNG
$endbefore='</scan:Intent>';
$scanintent= trim(get_string_between($scanjob, $beginafter, $endbefore));    
$beginafter='<scan:DocumentFormatExt>'; //application/pdf or image/jpeg  some scanners may support other formats like TIFF or PNG
$endbefore='</scan:DocumentFormatExt>';
$formatext= trim(get_string_between($scanjob, $beginafter, $endbefore));    
$beginafter='<pwg:DocumentFormat>'; //application/pdf or image/jpeg  some scanners may support other formats like TIFF or PNG
$endbefore='</pwg:DocumentFormat>';// seems to be 2 variations on this!
$formatx= trim(get_string_between($scanjob, $beginafter, $endbefore)); 
$beginafter='<scan:ColorMode>';
$endbefore='</scan:ColorMode>';
$colormode= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<scan:XResolution>';
$endbefore='</scan:XResolution>';
$xresolution= trim(get_string_between($scanjob, $beginafter, $endbefore));// below is not used for s400w but may be useful for other scanners
$beginafter='<scan:YResolution>';
$endbefore='</scan:YResolution>';
$yresolution= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<pwg:Height>';// seems to be 2 variations on this!
$endbefore='</pwg:Height>';
$height= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<pwg:Width>';// seems to be 2 variations on this!
$endbefore='</pwg:Width>';
$width= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<scan:MinWidth>';
$endbefore='</scan:MinWidth>';
$scanminwidth= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<scan:MinHeight>';
$endbefore='</scan:MinHeight>';
$scanminheight= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<scan:MaxWidth>';// seems to be 2 variations on this!
$endbefore='</scan:MaxWidth>';
$scanmaxwidth= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<scan:MaxHeight>';// seems to be 2 variations on this!
$endbefore='</scan:MaxHeight>';
$scanmaxheight= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<pwg:ContentRegionUnits>';
$endbefore='</pwg:ContentRegionUnits>';
$contentregionunits= trim(get_string_between($scanjob, $beginafter, $endbefore));
$beginafter='<pwg:XOffset>';
$endbefore='</pwg:XOffset>';
$xoffset= trim(get_string_between($scanjob, $beginafter, $endbefore));         
$beginafter='<pwg:YOffset>';
$endbefore='</pwg:YOffset>';
$yoffset= trim(get_string_between($scanjob, $beginafter, $endbefore));         
 

// because DocumentFormat can come in either, and aparently sometimes undefined now too!..
if ((($formatext=='') || ($formatext==NULL) || (!isset($formatext))) && (($formatx=='') || ($formatx==NULL) || (!isset($formatx))))
{
$format='image/jpeg';  //default is 'image/jpeg' if undefined
}   
elseif (($formatext=='') || ($formatext==NULL) || (!isset($formatext)))
{
$format=$formatx;
}   
elseif (($formatx=='') || ($formatx==NULL) || (!isset($formatx)))
{
$format=$formatext;
}     
$beginafter='<pwg:ContentType>';//Text,TextAndPhoto, Photo (mopira seems to offer all of these regardless of capabilities
$endbefore='</pwg:ContentType>';
$content= trim(get_string_between($scanjob, $beginafter, $endbefore));// above is not used for s400w but may be useful for other scanners
$jobid=$unique;
include_once('../../esclscan.php');
// Need Job counter and system UUID? As well as Job UUID.

$expiration=file_get_contents($root.'eSCL/lastscan.txt'); //if we just did a scan this has an valid expiration to keep it from showing "No Page" when we should see "processing"	




//$key = false;
/*
    while($key){ // this keeps the page busy till Scanner Status shows ready
        sleep(1);
	$nowagain=time();
        if($expiration >= $nowagain) $key = true;
    }
*/
?>
