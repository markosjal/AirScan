<?php
include_once 'phppagestart.php';
include_once 'config.inc.php';
include_once 'lang.php';
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
usleep(500000);
if (($demomode!='yes') && ($scanner=='s400w'))
{
//$ping='1800';
    class CheckDevice {

        public function myOS(){
            if (strtoupper(substr(PHP_OS, 0, 3)) === (chr(87).chr(73).chr(78)))
                return true;

            return false;
        }

        public function ping($host){
            if ($this->myOS()){
                if (!exec("ping -n 1 -w 1 ".$host." 2>NUL > NUL && (echo 0) || (echo 1)"))
                    return true;
            } else {
                if (!exec("ping -q -c1 -w5 ".$host." >/dev/null 2>&1 ; echo $?"))
                    return true;
            }
            return false;
        }
    }
    	if ((new CheckDevice())->ping($host)) 
	{
	$connectstatusmessagetxt=$connectedtxt;
 	//$_SESSION['connectstatusmessagetxt']=$connectedtxt;
      	//$online='yes';
 	$_SESSION['scanneronline']='yes';
}
	else 
	{
	$connectstatusmessagetxt=$notconnectedtxt;
	//$_SESSION['connectstatusmessagetxt']=$notconnectedtxt;
	//$online='no';
 	$_SESSION['scanneronline']='no';
	}
}

elseif (($demomode!='yes') && ($scanner=='SANE'))
{
$_SESSION['scanneronline']='yes';
$connectstatusmessagetxt='<span style="color:#484; font-weight:bold">SANE '.$sanename.'@'.$hostname.'</span>';
}
elseif (($demomode!='yes') && ($scanner=='eSCL'))
{
//$ping='3800';
//$pattern = '^=\s\w+\sIPv4\s(.*)\s+_uscan\._tcp\s+\w+\nhostname\s=\s\[(.*)\]\naddress\s=\s\[(.*)\]\nport\s=\s\[(.*)\]\ntxt\s=\s\[(.*)\]\n$^';
//exec('avahi-browse -t -r -p _uscan._tcp');
//usleep(600000);

//usleep(600000);
/*
$output='+ wlp61s0 IPv6 Canon MG5700 series                      uscan._tcp          local
+ wlp61s0 IPv4 Canon MG5700 series                           _uscan._tcp          local

= wlp61s0 IPv6 Canon MG5700 series                           _uscan._tcp          local
hostname = [ED122D000000.local]
address = [192.168.8.252]
port = [80]
txt = ["duplex=F" "is=platen" "cs=grayscale,color" "rs=eSCL" "representation=http://ED122D000000.local./icon/printer_icon.png" "vers=2.5" "UUID=00000000-0000-1000-8000-00BBC1ED122D" "adminurl=http://ED122D000000.local./index.html?page=PAGE_AAP" "note=Rich\'s office" "pdl=image/jpeg,application/pdf" "ty=Canon MG5700 series" "txtvers=1"]
= wlp61s0 IPv4 Canon MG5700 series                           _uscan._tcp          local
hostname = [ED122D000000.local]
address = [192.168.0.252]
port = [80]
txt = ["duplex=F" "is=platen" "cs=grayscale,color" "rs=eSCL" "representation=http://ED122D000000.local./icon/printer_icon.png" "vers=2.5" "UUID=00000000-0000-1000-8000-00BBC1ED122D" "adminurl=http://ED122D000000.local./index.html?page=PAGE_AAP" "note=Rich\'s office" "pdl=image/jpeg,application/pdf" "ty=Canon MG5700 series" "txtvers=1"]
'; 
*/




function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

$esclscanner = shell_exec('avahi-browse -t -r _uscan._tcp'); //temporarily looking for printer
//Scanner Type
$beginafter='"ty=';
$endbefore='"';
if ((isset($escltypeoverride)) && ($escltypeoverride!='') && ($escltypeoverride!=NULL)) 
{
$escltype=$escltypeoverride;
}
else
{
$escltype= trim(get_string_between($esclscanner, $beginafter, $endbefore));
}

//$esclipv4only='yes';

//IP Address from string

if ($esclipv4only=='yes')
{	
	if ((isset($esclipoverride)) && ($esclipoverride!='') && ($esclipoverride!=NULL)) 
	{
	$esclip=$esclipoverride;
	}
	else
	{
		if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $esclscanner, $ip_match)) 
		{
   		$esclip= $ip_match[0];
		$_SESSION['esclip']=$esclip;
		} 
	}	
}
//Scanner IP

if ($esclipv4only!='yes')
{
$beginafter='address = [';
$endbefore=']';
	if ((isset($esclipoverride)) && ($esclipoverride!='') && ($esclipoverride!=NULL)) 
	{
	$esclip=$esclipoverride;
	}
	else
	{
	$esclip= trim(get_string_between($esclscanner, $beginafter, $endbefore));
	}
}

$beginafter='port = [';
$endbefore=']';
if ((isset($esclportoverride)) && ($esclportoverride!='') && ($esclportoverride!=NULL)) 
{
$esclport=$esclportoverride;

}
else
{
$esclport= trim(get_string_between($esclscanner, $beginafter, $endbefore));
}
$_SESSION['esclport']=$esclport;
//echo 'port'.$esclport;


$typeipport=trim($escltype).'@'.trim($esclip).':'.trim($esclport);
//echo $typeipport.'<br/>';




	if (($typeipport != '') && ($typeipport != NULL) && ($typeipport != '@:')) //&& (isset($connectstatusmessagetxt != '')))
	
	{
	//$result=trim($matches[1]).'@'.trim($matches[3]).':'.trim($matches[4]);
	//echo $result;
	$connectstatusmessagetxt='<span style="color:#484; font-weight:bold">'.$typeipport.'</span>';
	//$_SESSION['connectstatusmessagetxt']='fff';
	//$online='yes';
	$_SESSION['scanneronline']='yes';
	}
	else
	{
	$connectstatusmessagetxt=$notconnectedtxt;
	//$_SESSION['connectstatusmessagetxt']=$notconnectedtxt;
	//$online='no';
 	$_SESSION['scanneronline']='no';
	}
	
}


elseif ($demomode=='yes')
{
sleep (4);
$connectstatusmessagetxt=$connectedtxt;
 //$_SESSION['connectstatusmessagetxt']=$connectedtxt;
 $_SESSION['scanneronline']='yes';
//$online='yes';
}

echo "retry: $ping\n\ndata: {$connectstatusmessagetxt}\n\n";


// disabled for testing
//if ($scanner=='s400w')
//{
/*
if ($_SESSION['scanneronline']=='yes') 
{
$xml='
<scan:ScannerStatus xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 ../../schemas/eSCL-1_90.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>Idle</pwg:State>
</scan:ScannerStatus>';
}
else 
{
$xml='
<scan:ScannerStatus xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 ../../schemas/eSCL-1_90.xsd">
<pwg:Version>2.0</pwg:Version>
<pwg:State>Busy</pwg:State>
</scan:ScannerStatus>'; 
}
file_put_contents('eSCL/ScannerStatus', $xml);
//file_put_contents('eSCL/ScannerStatus', $xml->saveXML());
//}
*/
?>
