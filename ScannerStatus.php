<?php
header('Content-Type: application/xml; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
echo '<?xml version="1.0" encoding="UTF-8"?>';
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
include_once '../checkstatusescl.php';
include_once '../config.inc.php';
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
$lastwordc='on '.$lastwordb;
 }
else 
{
$lastwordc='';
}
/*
$xml='<scan:ScannerStatus xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 ../../schemas/eSCL-1_90.xsd">
<pwg:Version>2.63</pwg:Version>
<pwg:State>'.$pwgstate.'</pwg:State> 
</scan:ScannerStatus>';  //Processing /Idle//$pwgstate //$lastword $lastword //2.0
*/
//$pwgjobstatereason=$lastword;
$unique=file_get_contents($root.'eSCL/unique.txt');

if (($scanage <= 300 ) && ($scanage >= 1 ))
{
$xml='<!-- THIS DATA SUBJECT TO DISCLAIMER(S) INCLUDED WITH THE PRODUCT OF ORIGIN. -->
<scan:ScannerStatus xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>Idle</pwg:State>
<scan:Jobs>
<scan:JobInfo>
<pwg:JobUri>/eSCL/Scans/'.$unique.'</pwg:JobUri>
<pwg:JobUuid>'.$unique.'</pwg:JobUuid>
<scan:Age>'.$scanage.'</scan:Age>
<pwg:JobState>Completed</pwg:JobState>
<pwg:ImagesToTransfer>1</pwg:ImagesToTransfer>
<pwg:ImagesCompleted>1</pwg:ImagesCompleted>
<pwg:JobStateReasons>
<pwg:JobStateReason>JobCompletedSuccessfully</pwg:JobStateReason>
</pwg:JobStateReasons>
</scan:JobInfo>
</scan:Jobs>
</scan:ScannerStatus>';
}

elseif (($pwgjobstatereason =='') || ($pwgjobstatereason ==NULL) || ( (is_numeric($scanage)) && ($scanage >=300) ))
{
$xml='<!-- THIS DATA SUBJECT TO DISCLAIMER(S) INCLUDED WITH THE PRODUCT OF ORIGIN. -->
<scan:ScannerStatus xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>'.$pwgstate.'</pwg:State>
<pwg:StateReasons>
<pwg:StateReason>None</pwg:StateReason>
</pwg:StateReasons>
</scan:ScannerStatus>';
}

elseif ($pwgstate=='Processing')
{
$xml='<!-- THIS DATA SUBJECT TO DISCLAIMER(S) INCLUDED WITH THE PRODUCT OF ORIGIN. -->
<scan:ScannerStatus xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>'.$pwgstate.'</pwg:State>
<scan:Jobs>
<scan:JobInfo>
<pwg:JobUri>/eSCL/Scans/'.$unique.'</pwg:JobUri>
<scan:TransferRetryCount>0</scan:TransferRetryCount>
<pwg:JobState>'.$pwgjobstate.'</pwg:JobState>
<pwg:JobStateReasons>
<pwg:JobStateReason>'.$pwgjobstatereason.'</pwg:JobStateReason>
</pwg:JobStateReasons>
</scan:JobInfo>
</scan:Jobs>
</scan:ScannerStatus>';
}

elseif (($pwgjobstatereason !='') || ($pwgjobstatereason !=NULL))
{/*
$xml='<!-- THIS DATA SUBJECT TO DISCLAIMER(S) INCLUDED WITH THE PRODUCT OF ORIGIN. -->
<scan:ScannerStatus xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>'.$pwgstate.'</pwg:State>
<scan:Jobs>
<scan:JobInfo>
<pwg:JobUri>/eSCL/Scans/'.$unique.'</pwg:JobUri>
<scan:Age>'.$scanage.'</scan:Age>
<pwg:ImagesCompleted>1</pwg:ImagesCompleted>
<pwg:ImagesToTransfer>1</pwg:ImagesToTransfer>
<scan:TransferRetryCount>0</scan:TransferRetryCount>
<pwg:JobState>'.$pwgjobstate.'</pwg:JobState>
<pwg:JobStateReasons>
<pwg:JobStateReason>Completed</pwg:JobStateReason>
</pwg:JobStateReasons>
</scan:JobInfo>
</scan:Jobs>
</scan:ScannerStatus>';
*/
$xml='
<scan:ScannerStatus xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03">
<pwg:Version>2.0</pwg:Version>
<pwg:State>Idle</pwg:State>
<pwg:StateReasons>
<pwg:StateReason>None</pwg:StateReason>
</pwg:StateReasons>
<scan:Jobs>
<scan:JobInfo>
<pwg:JobUri>/eSCL/Scans/'.$unique.'</pwg:JobUri>
<pwg:JobUuid>'.$unique.'</pwg:JobUuid>
<scan:Age>'.$scanage.'</scan:Age>
<pwg:JobState>Completed</pwg:JobState>
<pwg:ImagesToTransfer>1</pwg:ImagesToTransfer>
<pwg:ImagesCompleted>1</pwg:ImagesCompleted>
<pwg:JobStateReasons>
<pwg:JobStateReason>JobCompletedSuccessfully</pwg:JobStateReason>
</pwg:JobStateReasons>
</scan:JobInfo>
</scan:Jobs>
</scan:ScannerStatus>';
}




/* 
JobState
http://www.pwg.org/mfd/navigate/PwgSmRev1-185_JobStateWKV.html
    <xs:enumeration value="Aborted"/>
    <xs:enumeration value="Canceled"/>
    <xs:enumeration value="Completed"/>
    <xs:enumeration value="Pending"/>
    <xs:enumeration value="PendingHeld"/>
    <xs:enumeration value="Processing"/>
    <xs:enumeration value="ProcessingStopped"/>



jobstatereasons
http://www.pwg.org/mfd/navigate/PwgSmRev1-185_JobStateReasonsWKV.html
JobCompletedSuccessfully
JobScanning
ScannerStopped
ServiceOffLine
JobCanceledAtDevice
JobCanceledByUser
JobTimedOut	
JobTransferring	
JobTransforming
*/
/*
$scannercapabilities='<?xml version="1.0" encoding="UTF-8"?>
<!-- THIS DATA SUBJECT TO DISCLAIMER(S) INCLUDED WITH THE PRODUCT OF ORIGIN. -->
<scan:ScannerCapabilities xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
        <pwg:Version>2.0</pwg:Version>
	<pwg:MakeAndModel>AirScanning on'.$lastwordc.'</pwg:MakeAndModel>
        <!--<pwg:SerialNumber>'.$lastwordc.'</pwg:SerialNumber>
        <scan:UUID>574E4333-4A34-3438-3736-84A93E4FA59A</scan:UUID>-->
        <scan:AdminURI>http://'.gethostname().'./airscan.php</scan:AdminURI>
	<scan:IconURI>http://'.gethostname().'/images/AirScanIcon2.png</scan:IconURI>
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
                                                <scan:ColorMode>Binary</scan:ColorMode>
                                        </scan:ColorModes>
                                        <scan:ContentTypes>
                                                <pwg:ContentType>TextAndPhoto</pwg:ContentType>
                                        </scan:ContentTypes>
                                        <scan:DocumentFormats>
                                                <pwg:DocumentFormat>image/jpeg</pwg:DocumentFormat>
                                                <pwg:DocumentFormat>application/pdf</pwg:DocumentFormat>
                                                <pwg:DocumentFormat>application/octet-stream</pwg:DocumentFormat>
                                                <scan:DocumentFormatExt>image/jpeg</scan:DocumentFormatExt>
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
        </scan:eSCLConfigCap>';

$scannercapabilities='<?xml version="1.0" encoding="UTF-8"?>
<!-- THIS DATA SUBJECT TO DISCLAIMER(S) INCLUDED WITH THE PRODUCT OF ORIGIN. -->
<scan:ScannerCapabilities xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 eSCL.xsd">
        <pwg:Version>2.0</pwg:Version>
	<pwg:MakeAndModel>AirScanning on'.$lastwordc.'</pwg:MakeAndModel>
        <!--<pwg:SerialNumber>'.$lastwordc.'</pwg:SerialNumber>
        <scan:UUID>574E4333-4A34-3438-3736-84A93E4FA59A</scan:UUID>-->
        <scan:AdminURI>http://'.gethostname().'./airscan.php</scan:AdminURI>
	<scan:IconURI>http://'.gethostname().'/images/AirScanIcon2.png</scan:IconURI>
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
                                                <scan:ColorMode>Binary</scan:ColorMode>
                                        </scan:ColorModes>
                                        <scan:ContentTypes>
                                                <pwg:ContentType>TextAndPhoto</pwg:ContentType>
                                        </scan:ContentTypes>
                                        <scan:DocumentFormats>
                                                <pwg:DocumentFormat>image/jpeg</pwg:DocumentFormat>
                                                <pwg:DocumentFormat>application/pdf</pwg:DocumentFormat>
                                                <pwg:DocumentFormat>application/octet-stream</pwg:DocumentFormat>
                                                <scan:DocumentFormatExt>image/jpeg</scan:DocumentFormatExt>
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
*/
//                                <scan:Intent>Document</scan:Intent>
//                                <scan:Intent>Photo</scan:Intent>
//                                <scan:Intent>Preview</scan:Intent>




echo $xml;

?>




