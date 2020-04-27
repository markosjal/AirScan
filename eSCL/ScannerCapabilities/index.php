<?php
header("Content-type: text/xml");
include_once '../../checkstatusescl.php';
include_once '../../config.inc.php';
?>
<?xml version="1.0" encoding="UTF-8"?>
<?php
//$nowscanning='no';
if ($scanneronline=='yes')
{
	$version = "$s400w $host $port version";
	$versionoutput = shell_exec("$version");
	$string = $versionoutput;
	$last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
	$last_word = substr($string, $last_word_start); // $last_word = PHP.
	$lastwordb=preg_replace('/\s+/', '', $last_word);
}
else
{
}
if ((trim($lastwordb) !="") && (trim($lastwordb) !=NULL)) 
{
$lastwordc=$lastwordb;
 }
else 
{
$lastwordc='Stopped';
}
$scannercapabilities='<scan:ScannerCapabilities xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
        <pwg:Version>2.0</pwg:Version>
	<pwg:MakeAndModel>AirScan</pwg:MakeAndModel>
        <pwg:SerialNumber>'.$serialnumber.'</pwg:SerialNumber>
        <scan:UUID>4509a320-00a0-008e-00b6-000507510ecc</scan:UUID>
        <scan:AdminURI>http://'.$hostname.'./airscan.php</scan:AdminURI>
	<scan:IconURI>http://'.$hostname.'/images/AirScanIcon2.png</scan:IconURI>
        <scan:Platen>
                <scan:PlatenInputCaps>
                        <scan:MinWidth>300</scan:MinWidth>
                        <scan:MaxWidth>2575</scan:MaxWidth>
                        <scan:MinHeight>300</scan:MinHeight>
                        <scan:MaxHeight>4783</scan:MaxHeight>
                        <scan:MaxScanRegions>0</scan:MaxScanRegions>
                        <scan:SettingProfiles>
                                <scan:SettingProfile>
                                        <scan:ColorModes>
                                                <scan:ColorMode>RGB24</scan:ColorMode>
                                                <scan:ColorMode>Grayscale8</scan:ColorMode>
                                                <!--<scan:ColorMode>Binary</scan:ColorMode>-->
                                        </scan:ColorModes>
                                        <scan:ContentTypes>
                                                <pwg:ContentType>TextAndPhoto</pwg:ContentType>
                                        </scan:ContentTypes>
                                        <scan:DocumentFormats>
                                                <pwg:DocumentFormat>image/jpeg</pwg:DocumentFormat>
                                                <pwg:DocumentFormat>application/pdf</pwg:DocumentFormat>
                                                <pwg:DocumentFormat>application/octet-stream</pwg:DocumentFormat>
                                                <scan:DocumentFormatExt>image/jpeg</scan:DocumentFormatExt>
						<!--<scan:DocumentFormatExt>image/png</scan:DocumentFormatExt>
                                                <scan:DocumentFormatExt>image/tiff</scan:DocumentFormatExt>-->
                                                <scan:DocumentFormatExt>application/pdf</scan:DocumentFormatExt>
                                                <scan:DocumentFormatExt>application/octet-stream</scan:DocumentFormatExt>
                                        </scan:DocumentFormats>
                                        <scan:SupportedResolutions>
                                                <scan:DiscreteResolutions>
                                                        <scan:DiscreteResolution>
                                                                <scan:XResolution>300</scan:XResolution>
                                                                <scan:YResolution>300</scan:YResolution>
                                                        </scan:DiscreteResolution>
                                                        <scan:DiscreteResolution>
                                                                <scan:XResolution>600</scan:XResolution>
                                                                <scan:YResolution>600</scan:YResolution>
                                                        </scan:DiscreteResolution>
                                                </scan:DiscreteResolutions>
                                        </scan:SupportedResolutions>
                                        <scan:ColorSpaces>
                                                <scan:ColorSpace>sRGB</scan:ColorSpace>
                                        </scan:ColorSpaces>
                                </scan:SettingProfile>
                        </scan:SettingProfiles>
                        <scan:SupportedIntents>
                                <scan:Intent>Preview</scan:Intent>
                                <scan:Intent>TextAndGraphic</scan:Intent>
                        </scan:SupportedIntents>
                        <scan:MaxOpticalXResolution>600</scan:MaxOpticalXResolution>
                        <scan:MaxOpticalYResolution>600</scan:MaxOpticalYResolution>
                </scan:PlatenInputCaps>
        </scan:Platen>
        <scan:eSCLConfigCap>
                <scan:StateSupport>
                        <scan:State>disabled</scan:State>
                        <scan:State>enabled</scan:State>
                </scan:StateSupport>
                <scan:ScannerAdminCredentialsSupport>true</scan:ScannerAdminCredentialsSupport>
        </scan:eSCLConfigCap>
</scan:ScannerCapabilities>';
echo $scannercapabilities;
?>
