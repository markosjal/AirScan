<?php
include_once 'phppagestart.php';
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
/*
echo '  Require auth?  '.$requireauth;
echo '<br>  logged in? '.$_SESSION['loggedin'];
echo '<br>  expires at  '.$_SESSION['expire'];
echo '<br>  NOW is  '.$now;
echo '<br>  expires in '.($_SESSION['expire']-$now);
echo '<br>  SessionID '.session_id();
*/
// session_name('airscan');

//echo $_SERVER['REQUEST_URI'];

//echo basename($_SERVER['PHP_SELF']);
//$_SESSION['scanneronline']='yes';

//echo 'XX'.$_SESSION['userpath'];

function get_all_get()
{
        $urloutput = "?"; 
        $firstRun = true; 
        foreach($_GET as $key=>$val) { 
        if($key != $parameter) { 
            if(!$firstRun) { 
                $urloutput .= "&"; 
            } else { 
                $firstRun = false; 
            } 
            $urloutput .= $key."=".$val;
         } 
    } 

    return $urloutput;
}   
$url= get_all_get();



echo '<!DOCTYPE html>';


if ((isset($_POST['username'])) && (!isset($_SESSION['username'])))
{
$username= $_POST['username'];
$_SESSION['tempname']=$_POST['username'];
}


elseif ((!isset($_POST['username'])) && (isset($_SESSION['username'])))
{
$username= $_SESSION['username'];
$_SESSION['tempname']=$_SESSION['username'];
}

elseif ((((isset($_POST['username'])) && (isset($_SESSION['username']))) && ($_SESSION['username'] == $_POST['username'])))
{
$username= $_SESSION['username'];
$_SESSION['tempname']=$_SESSION['username'];
}

else 
{
$username= $_POST['username'];
$_SESSION['tempname']=$_POST['username'];
}

include_once 'config.inc.php';
include_once 'lang.php';
$mppdf=$_GET['mppdf'];
$jpgpdf=$_GET['jpgpdf'];

if (($_GET['pdfname']!='') && ($_GET['pdfname']!=NULL))
{
$pdfname=$_GET['pdfname'];
}
else 
{
unset($pdfname);
}

$image= $_GET['image'];
$output=$_GET['output'];
$print=$_GET['print'];
$mode=$_GET['mode'];
$returntofiles=$_GET['returntofiles'];
//session_unset($_SESSION["fromfilelister"]);
$_SESSION['fromfilelister']='no';
// $resolution=$_GET['resolution'];
$currentpage=$_GET['currentpage'];
$totalpages=$_GET['totalpages'];
$pdf=$_GET['pdf'];
//$deskew=$_GET['deskew'];
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$offline=$_GET['offline'];
$view= $_GET['view'];
echo '<html lang="'.$lang.'">';
$now = time();
$randtip=(rand(1, 4));
$pdfrandtip=(rand(1, 3));
$scanrandom=${'scantip'.$randtip};
$pdfscanrandom=${'pdfscantip'.$pdfrandtip};
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$basename = pathinfo($image, PATHINFO_FILENAME);
if ($ext=='jpg')
{
$mimeext='jpeg';
}
elseif ($ext=='tif')
{
$mimeext='tiff';
}
else
{
$mimeext=$ext;
}



if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
	if ((($_SESSION['expire'] - $now) <= $addtime) && (($_SESSION['expire'] - $now) > 0))
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





$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=logout.php">';
$pagehead='<meta charset="'.$charset.'"> 
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta name="Expires" content="'.$rfc_1123_date.'">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta http-equiv="content-type" content="text/html; charset='.$charset.'">
<title>'.$pagetitle.'</title>
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/site.webmanifest">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#777aff">
<meta name="msapplication-TileColor" content="#ff0000">
<meta name="theme-color" content="#777AFF">
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="/javascript/jquery.min.js" type="text/javascript"></script>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {
  opacity: 0.7;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 20px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: '.$scanzoomwidth.';
  max-width: '.$scanzoommaxwidth.';
  height:  '.$scanzoomheight.';
  max-height:'.$scanzoommaxheight.';
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 50%;
  max-width: auto;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 70px;
}

/* Add Animation */
.modal-content,
#caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {
    -webkit-transform: scale(0);
  }
  to {
    -webkit-transform: scale(1);
  }
}

@keyframes zoom {
  from {
    transform: scale(0);
  }
  to {
    transform: scale(1);
  }
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
  .modal-content {
    width: 100%;
  }
}


/* end modal*/


/* begin overlay , pinned menu*/


/* body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}*/

.top-container {
  background-color: #f1f1f1;
  padding: 0px;
  text-align: center;
}

.header {
  padding: 0px 16px;
  background: #FFF;
  color: #f1f1f1;
}

.content {
  padding: 0px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1;
}

.sticky + .content {
  padding-top: 2px;
}
/* end overlay */


/*drop downs*/


/* -------------------- Select Box Styles: bavotasan.com Method (with special adaptations by ericrasch.com) */
/* -------------------- Source: http://bavotasan.com/2011/style-select-box-using-only-css/ */
.styled-select {
   background: url(images/15xvbd5.png) no-repeat 90% 0;
   height: 25px;
   overflow: hidden;
   width: 150px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 13px;
   font-weight: bold;
   height: 25px;
   padding: 0px; /* If you add too much padding here, the options wont show in IE */
   width: 150px;
}

.styled-select.slate {
   background: url(images/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #ddd; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #666; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
   background: #58B14C url("images/15xvbd5.png") no-repeat scroll 319px center;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(images/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   /*border: 1border: 1px solid #AAA;*/
border: 1border: 0px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
}

select#soflow-color {
   color: #fff;
   background-image: url(images/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}




    #loading
    {
        display:none;
        position:fixed;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(255,255,255,0.8);
        z-index:1000;
    }
  
    #loadingcontent
    {
        display:table;
        position:fixed;
        left:0;
        top:0;
        width:100%;
        height:100%;
    }
  
    #loadingspinner
    {
        display: table-cell;
        vertical-align:middle;
        width: 100%;
        text-align: center;
        font-size:larger;
        padding-top:70px;
    }

</style>
</head>
<body>
<table id="page_header"><tr><td>
        <a href="airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td><hr></td></tr><tr><td>';
	

if ($pwauthinstalled=='yes')
{
	class PWAuth
	{
		//global $pwauthpath;
 		//private $pwauthPath = $pwauthpath;
		private $pwauthPath = '/usr/sbin/pwauth';
		/** Performs authentication and returns an array with user data if positive, or false if not
		* 
		* @param string $external_uid
		* @param string $external_passwd
		*/
			public function Authenticate($external_uid, $external_passwd) 
			{
			// Start
			$handle = popen($this->pwauthPath, 'w');
				if($handle === FALSE) 
				{
				die('pwauth open error');
				return false;
				}
		       
				if(fwrite($handle, "$external_uid\n$external_passwd\n") === FALSE) 
				{
				die('pwauth communication error');
				return false;
				}
			$result = pclose($handle);
			
				if($result==0) 
				{    // Login OK
				$etcPasswd = file('/etc/passwd');
					foreach($etcPasswd as $singleLine) 
					{
						if(substr($singleLine, 0, strlen($external_uid ) + 1) == $external_uid.':') 
						{
						$explodedLine = explode(':', $singleLine);
							
						$return = array();
						$return['user']    = $explodedLine[0];
						$return['uid']     = $explodedLine[2];
						$return['gid']     = $explodedLine[3];
						$return['comment'] = $explodedLine[4];
						$return['dir']     = $explodedLine[5];
						$return['shell']   = $explodedLine[6];
		                    
						// GECOS field (comment)
						$userData = explode(',', $return['comment']);
		                    
						$name               = $userData[0];
						$building           = $userData[1];
						$phone              = $userData[2];
						$other              = $userData[3];
						$return['name']     = $name;
						$return['building'] = $building;
						$return['phone']    = $phone;
						$return['other']    = $other;
								
			                    
						return $return;
						}  //end nest if
					} //end foreach
				}// end master if class
				return false;
			} // end public function	
	} // end class
} //end if

//echo $result;
if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] >= $now)) // && ($_SESSION["username"] !='') && ($_SESSION["username"] != NULL) && ($_SESSION["username"] !='/') && ($_SESSION["password"] != NULL) && ($_SESSION["password"] != '/') && ($_SESSION["password"] != ''))
{
//echo 'loggedin already';
//$username=$_SESSION["username"]; get rif of 
//$password=$_SESSION["password"]; get rid of
$filename=$_SESSION['userpath'].$image;


}


elseif (($requireauth=='yes') && ($_SESSION['loggedin']!='yes'))
{
sleep($randlogin);
	if ($pwauthinstalled=='yes')
	{
	$pwauth = new PWAuth;
	$login = $pwauth->Authenticate($_POST['username'], $_POST['password']);

	}
	else
	{
	}
	if (($login['user'] == $_POST['username']) && ($login['user'] != '') && ($login['user'] != NULL) && ($login['uid'] >= $lowuid ) && ($login['uid'] <= $highuid )) // cooking with PAM
	{
	$_SESSION['username']=$_POST['username'];
	$_SESSION['password']='PAM';
	$_SESSION['loggedin'] ='yes';
	$_SESSION['userpath'] = $login['dir'].$pamscansdir;
	$_SESSION['start'] = time(); // Taking now logged in time.
	$_SESSION['expire'] = $_SESSION['start'] + ($logintimeout * 60);
	$_SESSION['txtfilemanager']='no';
	$_SESSION['pamfilemanager']='yes';
	//$showfilemanager='no';
	$filename=$_SESSION['userpath'].$pamscansdir.$image;
	$pamuid=$login['uid'];
	//$pamugid=$login['gid'];
	}
	elseif (($usetxtauth=='yes') && (file_exists($usersfilespath.$_POST['username'].'.php')))
	{
	include_once($usersfilespath.$username.'.php');
	$_SESSION['userpath'] = $userpath;
	$filename=$userpath.$image;
	//$upath=$userpath;
		if ($_POST['password']==$pass)  // cooking text mode
		{
		$_SESSION['username']=$_POST['username'];
		$_SESSION['password']='TXT';
		$_SESSION['loggedin'] ='yes';
		$_SESSION['userpath'] = $userpath;
		$_SESSION['start'] = time(); // Taking now logged in time.
		$_SESSION['expire'] = $_SESSION['start'] + ($logintimeout * 60);
		$_SESSION['txtfilemanager']='yes';
		$_SESSION['pamfilemanager']='no';
		}
		else
        	{
		//echo '<head>'.$refreshurl.$pagehead.'</table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';
		echo '<head>'.$refreshurl.$pagehead.'</table><br/>';				
		session_unset($_SESSION["loggedin"]);
		session_unset($_SESSION["expire"]);
		session_unset($_SESSION["username"]);
		session_unset($_SESSION["password"]);
		session_unset($_SESSION["userpath"]);
		session_unset($_SESSION['scanneronline']);
		session_unset($_SESSION['fromuserfolder']);
		session_unset($_SESSION['fromuserfilelister']);
		session_unset($_SESSION['tempname']);
		session_unset($_SESSION['txtfilemanager']);
		session_unset($_SESSION['pamfilemanager']);
        	session_destroy();		
        	}
	}

	elseif (($_SESSION['loggedin']=='yes') && ($_SESSION['expire'] <= $now))                 
	{ 
	//echo '<head>'.$refreshurl.$pagehead.'</table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';
	echo '<head>'.$refreshurl.$pagehead.'</table><br/>';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
	session_unset($_SESSION['tempname']);
	session_unset($_SESSION['txtfilemanager']);
	session_unset($_SESSION['pamfilemanager']);
	session_destroy();
	}

	elseif (($_SESSION['loggedin']!='yes') || ($_SESSION['expire'] <= $now) || ($_SESSION['username']=='') || ($_SESSION['username']==NULL) || ($_SESSION['password']=='') || ($_SESSION['password']==NULL))              
	{ 
	//echo '<head>'.$refreshurl.$pagehead.'</table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';
	echo '<head>'.$refreshurl.$pagehead.'</table><br/>';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
	session_unset($_SESSION['tempname']);
		session_unset($_SESSION['txtfilemanager']);
		session_unset($_SESSION['pamfilemanager']);
	session_destroy();
	}
	else
	{ 
	//echo '<head>'.$refreshurl.$pagehead.'</table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';
	echo '<head>'.$refreshurl.$pagehead.'</table><br/>';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);	
	session_unset($_SESSION['tempname']);
		session_unset($_SESSION['txtfilemanager']);
		session_unset($_SESSION['pamfilemanager']);	
	session_destroy();
	}
}

	
else 
{
$filename=$filepath.$image;
$_SESSION['userpath'] = $filepath;
}
	if (($requireauth=='yes') && ($_SESSION['password']=='PAM'))
	{
	$_SESSION['txtfilemanager']='no';
	$_SESSION['pamfilemanager']='yes';
	}
	elseif (($requireauth=='yes') && ($_SESSION['password']!='PAM'))
	{
	$_SESSION['txtfilemanager']='yes';
	$_SESSION['pamfilemanager']='no';
	}
	elseif ($requireauth!='yes')
	{
	$_SESSION['txtfilemanager']='yes';
	$_SESSION['pamfilemanager']='no';
	}
// echo 'expires'.(($_SESSION["expire"] - $now)/60).'<br>session user '.$_SESSION["username"].'<br>loggedin '.$_SESSION["loggedin"].'<br>passwordset '.(isset($_SESSION["password"])).'<br>expireset '.(isset($_SESSION["expire"])).'<br>expires'.($_SESSION["expire"] - $now).'<br>buy'.$buytime;









if (($_SESSION['loggedin'] =='yes') || ($requireauth != 'yes')) 
{
	if (($mode != NULL) || ($mode != ''))
	{
	$currentmode=$mode;
	}

	else
	{
	$currentmode=$defaultmode;
	}

	if ($_GET['resolution'] != NULL && $_GET['resolution'] != '')
	{
	$resolution=$_GET['resolution'];
	}

	else 
	{ 
	//echo $filename;
	$exif = exif_read_data($filename);
		$xres = eval('return '.$exif["XResolution"].';');
		$yres = eval('return '.$exif["YResolution"].';');
		if (($exif["XResolution"]) == ($exif["YResolution"]))
   		{
			if (($exif["XResolution"] == '300/1') || ($exif["XResolution"] == '300')) 
        		{
        		$resolution='300';
        		}
        		elseif (($exif["XResolution"] == '600/1') || ($exif["XResolution"] == '600')) 
        		{
        		$resolution='600';
        		}
        		else 
        		{
        		$resolution=$dpierror;
			}
    	}

	else 
	{
	$resolution=$dpierror;
	}
}















// if (($showdeskew=='yes') && ($freeversion == 'no'))
if (($_GET['deskew']=='yes') && ($showdeskew=='yes') && ($freeversion == 'no'))
{
$deskew=$_GET['deskew'];
}






if (($_GET['autocrop']=='yes') && ($showautocrop=='yes') && ($freeversion == 'no') && ($_GET['deskew']=='yes'))
{
$autocrop='no';
}

elseif (($_GET['autocrop']=='yes') && ($showautocrop=='yes') && ($freeversion == 'no'))
{
$autocrop=$_GET['autocrop'];
}



if ($print != NULL)
{
$currentprint=$print;
}

else 
{
$currentprint=$defaultprint;
}



if ($resolution == 300 || $resolution == 600)
{
$currentresolution=$resolution;
}

else 
{
$currentresolution=$defaultresolution;
}





if ($deskew != NULL)
{
$currentdeskew=$deskew;
}

else 
{
$currentdeskew=$defaultdeskew;
}









if ($_GET['autocrop'] != NULL)
{
$currentautocrop=$_GET['autocrop'];
}

else 
{
$currentautocrop=$defaultautocrop;
}

//echo $_GET['autocrop'];

if ($scanner=='s400w')
{
$statuscmd = "$s400w $host $port status";
$versioncmd = "$s400w $host $port version";
}



echo '<head>'; 
$timeremaining=($_SESSION['expire'] - $now);
if ($requireauth == 'yes')
{
	if (($_SESSION['expire'] <= $now) || ($_SESSION['loggedin'] != 'yes'))
	{ 

	echo '<head>'.$refreshurl.$pagehead.'</table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';;
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);
	session_unset($_SESSION['scanneronline']);
	session_unset($_SESSION['fromuserfolder']);
	session_unset($_SESSION['fromuserfilelister']);
	session_unset($_SESSION['tempname']);
	session_unset($_SESSION['txtfilemanager']);
	session_unset($_SESSION['pamfilemanager']);
	session_destroy();
	}




	if (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($_POST['username'] =='admin'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=/usermanager.php?rand='.$rand.'">';
	$fastload='yes';	
	}

	elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($returntofiles !='yes') && ($_SESSION['username'] !='admin'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
	//$fastload='yes';	
	}

	elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($returntofiles !='yes') && ($_POST['username'] !='admin'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
	//$fastload='yes';	
	}

	elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($returntofiles !='yes') && ($_POST['username'] =='admin'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
	//$fastload='yes';	
	}


	elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($returntofiles =='yes') && ($_SESSION['password']!='PAM'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$_SESSION["userpath"].'index.php?rand='.$rand.'#'.$image.'">';
	$fastload='yes';	
	}

	elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($returntofiles =='yes') && ($_SESSION['password']=='PAM'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=pamindex.php?rand='.$rand.'#'.$image.'">';
	$fastload='yes';	
	}

	elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now) && ($returntofiles !='yes'))
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
	//$fastload='yes';	
	}




	/*elseif (($requireauth == 'yes') && ($_SESSION['password'] == $pass) && ($_SESSION['expire'] > $now) && ($returntofiles!='yes'))
	{ 
	echo '';	
	}*/

	else
	{	
	echo '';
	}
}


elseif ($requireauth != 'yes')
{
	if ($returntofiles == 'yes')
	{ 
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$_SESSION['userpath'].'index.php?rand='.$rand.'#'.$image.'">';
	$fastload='yes';	
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
?>
<?php 
//echo $_SESSION['password'];
echo $pagehead;

/*
echo ' Auth:';
echo $requireauth;
echo ' User:';
echo $_SESSION['username'].' ';
echo ' Pass:';
echo $_SESSION['password'].' ';
echo ' Expires:';
echo ($_SESSION['expire'] - $now).' ';
echo ' PAM File Manager:';
echo $_SESSION['pamfilemanager'];
echo ' Text File Manager:';
echo $_SESSION['txtfilemanager'];
echo ' Show File Manager:';
echo $showfilemanager;

*/
include'livemenu.php';
if ($scanner=='eSCL')
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
//echo $_SESSION['esclport'];
elseif ($esclipv4only!='yes')
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



if ($fastload !='yes')
{
//$esclstatus=file_get_contents('http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerStatus');
$scannercapabilities=file_get_contents('http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerCapabilities');

$beginafter='<pwg:Height>';// seems to be 2 variations on this!
$endbefore='</pwg:Height>';
$pwgheight= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<pwg:Width>';// seems to be 2 variations on this!
$endbefore='</pwg:Width>';
$pwgwidth= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<scan:MaxWidth>';// seems to be 2 variations on this!
$endbefore='</scan:MaxWidth>';
$scanmaxwidth= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<scan:MaxHeight>';// seems to be 2 variations on this!
$endbefore='</scan:MaxHeight>';
$scanmaxheight= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
/* These are values we do not need for now . Later after figuring out how to process the xml better 
we can use more scanner specifc settings. For now items scanned at 600 or 300 DPI as JPG 
which all scanners I have seen so far support

$beginafter='<scan:DocumentFormatExt>'; //application/pdf or image/jpeg  some scanners may support other formats like TIFF or PNG
$endbefore='</scan:DocumentFormatExt>';
$formatext= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));    
$beginafter='<pwg:DocumentFormat>'; //application/pdf or image/jpeg  some scanners may support other formats like TIFF or PNG
$endbefore='</pwg:DocumentFormat>';// seems to be 2 variations on this!
$formatx= trim(get_string_between($scannercapabilities, $beginafter, $endbefore)); 
$beginafter='<scan:ColorMode>';
$endbefore='</scan:ColorMode>';
$colormode= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<scan:XResolution>';
$endbefore='</scan:XResolution>';
$xresolution= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));// below is not used for s400w but may be useful for other scanners
$beginafter='<scan:YResolution>';
$endbefore='</scan:YResolution>';
$yresolution= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<scan:MinWidth>';
$endbefore='</scan:MinWidth>';
$scanminwidth= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<scan:MinHeight>';
$endbefore='</scan:MinHeight>';
$scanminheight= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<pwg:ContentRegionUnits>';
$endbefore='</pwg:ContentRegionUnits>';
$contentregionunits= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));
$beginafter='<pwg:XOffset>';
$endbefore='</pwg:XOffset>';
$xoffset= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));         
$beginafter='<pwg:YOffset>';
$endbefore='</pwg:YOffset>';
$yoffset= trim(get_string_between($scannercapabilities, $beginafter, $endbefore));        

/* we do not care, we will always scan Color JPG and convert here Like VueScan does
// because DocumentFormat can come in either....
if (($formatext=='') || ($formatext==NULL) || (!isset($formatext)))
{
$format=$formatx;
}   
elseif (($formatx=='') || ($formatx==NULL) || (!isset($formatx)))
{
$format=$formatext;
}     
elseif ($formatx==$formatext)
{
$format=$formatext;
} 
*/

// max height logic
if (($pwgheight=='') || ($pwgheight==NULL) || (!isset($pwgheight)))
{
$esclmaxheight=$scanmaxheight;
}   
elseif (($scanmaxheight=='') || ($scanmaxheight==NULL) || (!isset($scanmaxheight)))
{
$scanmaxheight=$pwgheight;
}     
elseif ($scanmaxheight==$pwgheight)
{
$esclmaxheight=$pwgheight;
} 
else
{
$esclmaxheight=$pwgheight;
} 

// max width logic
if (($width=='') || ($width==NULL) || (!isset($width)))
{
$esclmaxwidth=$scanmaxwidth;
}   
elseif (($scanmaxwidth=='') || ($scanmaxwidth==NULL) || (!isset($scanmaxwidth)))
{
$esclmaxwidth=$width;
}     
elseif ($scanmaxwidth==$width)
{
$esclmaxwidth=$width;
} 
else
{
$esclmaxwidth=$width;
} 

//echo 'sss'.$esclmaxwidth;

//echo 'sss'.$esclmaxheight;
//echo $esclmaxheight;
}  // end if eSCL

else  // this just makes me feel better
{
}
//echo '<pre>'.$esclstatus.'</pre>';

}
?>


</td></tr></table>
<?php

//echo $scanrandom;
if (($showtips=='yes') && ($_GET['mppdf']!='yes')) //&& (!isset($_GET['pdfname'])))
{
echo '<center><br/><span style="color:#A80; font-weight:bold">'.$scanrandom.'</span></center>';
}
elseif (($showtips=='yes') && ($_GET['mppdf']=='yes')) // || (!isset($_GET['pdfname']))))
{
echo '<center><br/><span style="color:#A80; font-weight:bold">'.$pdfscanrandom.'</span></center>';
}
else
{
}
?>
<table id='page_body' style='height: 655px;'><tr><td id='tab_preview'>
<?php
	
//echo'xx';


if (($output == 'status') && ($scanner=='s400w'))
{
// include_once 'checkscanner.php';
   //if ($online =='yes')
   if (($_SESSION['scanneronline'] =='yes') && ($scanner=='s400w'))// start if online yes
   {
   $statusoutput = shell_exec("$statuscmd");
   $statusoutput2 = '';
   $versionoutput =shell_exec("$versioncmd");
   $string = $statusoutput;
   $last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
   $last_word = substr($string, $last_word_start); // $last_word = PHP.
   $lastword=preg_replace('/\s+/', '', $last_word);

        if ($lastword=='nopaper'){
        $outputline=$nopaper.'<br/>';
        }


        elseif ($lastword=='scanready'){
        $outputline=$scanready.'<br/>';
        }

        elseif ($lastword=='devbusy'){
        $outputline=$devbusy.'<br/>';
        }


        elseif ($lastword=='battlow'){
        $outputline=$battlow.'<br/>';
        }


        else
        {
        $outputline=$errortxt.'<br/>';
        }

   }  //end if online yes

   else
   {      // start if online no
   $statusoutput='';
   $statusoutput2="<p><b>$notconnectedtxt</b></p><p><b>$checkscannerontxt</b></p>";

   $versionoutput = "";
   }   //end if online no

}  // end if output status


elseif (($output == 'sanetest') && ($scanner=='SANE'))
{
//$sanesanity='ls -l';
$sanesanity='scanimage -T -d "'.$sanename.'"';
$statusoutput = shell_exec("$sanesanity");
echo $statusoutput;
echo '<table  style="width: 432px;"><tr><td><small><pre>'.$statusoutput.'</pre></small></td></tr></table>';
}



elseif (($output == 'sanescannerinfo') && ($scanner=='SANE'))
{
//$sanesanity='ls -l';
$sanesanity='scanimage -A';
$statusoutput = shell_exec($sanesanity);
//echo $sanesanity;

//echo '<iframe src="http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerCapabilities" frameborder="0"  height="595px" width = "432px">';

//echo '<table  style="width: 432px;"><tr><td><small><pre>'.$statusoutput.'</pre></small></td></tr></table>';
echo '<div style="height:595px;width:432px;border:0px solid #ccc;font:12px/16px Georgia, Garamond, Serif;overflow:auto;">
<small><pre>'.$statusoutput.'</pre></small>
</div>';

}
elseif (($output == 'sanescanners') && ($scanner=='SANE'))
{
//$sanesanity='ls -l';
$sanesanity0='scanimage -V';
$statusoutput0 = shell_exec($sanesanity0);
$sanesanity='scanimage -n -L';
$statusoutput = shell_exec($sanesanity);
//$sanesanity2='scanimage -n -L';
//$statusoutput2 = shell_exec($sanesanity2);
//echo $sanesanity;
echo '<table  style="width: 432px;"><tr><td><br/><br/><small>SANE Info<br/><pre>'.$statusoutput0.'</pre><br/>Detected Scanners<br/><pre>'.$statusoutput.'</pre><br/>Configured Scanner<pre>'.$sanename.'</pre></small></td></tr></table>';
}



elseif (($output == 'esclstatus') && ($scanner=='eSCL'))
{
   if ($_SESSION['scanneronline'] =='yes') //&& ($scanner=='eSCL'))// start if online yes
   {
   //$esclstatuscmd= 'curl -s http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerStatus';	
   //$esclstatus = shell_exec($esclstatuscmd);
   echo '<iframe src="http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerStatus" frameborder="0"  height="295px" width = "432px">';
   echo '</iframe>';   
   //echo $esclstatuscmd;
//echo $esclstatus;
   }
}

elseif (($output == 'esclcapabilities') && ($scanner=='eSCL'))
{
   if ($_SESSION['scanneronline'] =='yes') //&& ($scanner=='eSCL'))// start if online yes
   {
   //echo filegetcontents('http://localhost/eSCL/ScannerCapabilities');
   //$esclcapabilitiescmd= 'curl -s http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerCapabilities';
   //$esclcapabilities = shell_exec($esclcapabilitiescmd);   
   echo '<iframe src="http://'.$_SESSION["esclip"].':'.$_SESSION["esclport"].'/eSCL/ScannerCapabilities" frameborder="0"  height="595px" width = "432px">';

   //$esclcapabilities = shell_exec($esclcapabilitiescmd);
   //echo $esclcapabilitiescmd;
   echo '</iframe>';   

//   echo $esclcapabilitiescmd;   
   //echo '<pre>'.$esclcapabilities.'</pre>';
 }
}

elseif (($output == 'bonjourstatus') && ($scanner=='eSCL'))
{
	if ($_SESSION['scanneronline'] =='yes') //&& ($scanner=='eSCL'))// start if online yes
   	{
	$esclscanner = shell_exec('avahi-browse -t -r _uscan._tcp');
	// $esclscanner below is for testing , leave deactivated and above activated for normal use
	/*
	$esclscanner='+ wlp61s0 IPv6 Canon MG5700 series                           _uscan._tcp          local
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
	echo '<table  style="width: 432px;"><tr><td><br/>';


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
			} 
		}	
	}
//eSCL Scanner IP

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

	$typeipport=trim($escltype).'@'.trim($esclip).':'.trim($esclport);
	echo '<span style="color:#484; font-weight:bold">'.$typeipport.'</span><span style="color:#666; font-weight:bold"><br/>';

	$beginafter='"adminurl=';
	$endbefore='"';
	$escladminurl= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($escladminurl!='') && ($escladminurl!=NULL))
		{
		echo '<br/>Admin URL:<br/>';
		echo '<a href="'.$escladminurl.'"><span style="color:#777AFF; font-weight:bold">'.$escladminurl.'</span></a><br/>'; 
		echo '<br/><br/>';
		}

	$beginafter='"cs=';
	$endbefore='"';
	$esclcs= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclcs!='') && ($esclcs!=NULL))
		{
		echo 'Modes:<br/>';
		echo $esclcs; 
		echo '<br/><br/>';
		}

	$beginafter='"is=';
	$endbefore='"';
	$esclis= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclis!='') && ($esclis!=NULL))
		{
		echo 'Source:<br/>';
		echo $esclis; 
		echo '<br/><br/>';
		}


	$beginafter='"duplex=';
	$endbefore='"';
	$esclduplex= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclduplex!='') && ($esclduplex!=NULL))
		{
		echo 'Duplex:<br/>';
		echo $esclduplex; 
		echo '<br/><br/>';
		}

	$beginafter='"pdl=';
	$endbefore='"';
	$esclpdl= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclpdl!='') && ($esclpdl!=NULL))
		{
		echo 'PDL:<br/>';
		echo $esclpdl; 
		echo '<br/><br/>';
		}

	$beginafter='"txtvers=';
	$endbefore='"';
	$escltxtvers= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($escltxtvers!='') && ($escltxtvers!=NULL))
		{
		echo 'Text Version:<br/>';
		echo $escltxtvers; 
		echo '<br/><br/>';
		}

	$beginafter='"uuid=';
	$endbefore='"';
	$escluuid= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($escluuid!='') && ($escluuid!=NULL))
		{
		echo 'UUID:<br/>';
		echo $escluuid; 
		echo '<br/><br/>';
		}

	$beginafter='"rs=';
	$endbefore='"';
	$esclrs= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclrs!='') && ($esclrs!=NULL))
		{
		echo 'Resource:<br/>';
		echo $esclrs; 
		echo '<br/><br/>';
		}

	$beginafter='"usb_MDL=';
	$endbefore='"';
	$esclusbmdl= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclusbmdl!='') && ($esclusbmdl!=NULL))
		{
		echo 'USB Model:<br/>';
		echo $esclusbmdl; 
		echo '<br/><br/>';
		}


	$beginafter='"usb_MFG=';
	$endbefore='"';
	$esclusbmfg= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($escusbmfg!='') && ($esclusbmfg!=NULL))
		{
		echo 'USB Manufacturer:<br/>';
		echo $esclusbmfg; 
		echo '<br/><br/>';
		}

	$beginafter='"mfg=';
	$endbefore='"';
	$esclmfg= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclmfg!='') && ($esclmfg!=NULL))
		{
		echo 'Manufacturer:<br/>';
		echo $esclmfg;
		echo '<br/><br/>';
		}

	$beginafter='"mdl=';
	$endbefore='"';
	$esclmdl= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($escmdl!='') && ($escmdl!=NULL))
		{
		echo 'Model:<br/>';
		echo $esclmdl; 
		echo '<br/><br/>';
		}

	$beginafter='"representation=';
	$endbefore='"';
	$esclrepresentation= trim(get_string_between($esclscanner, $beginafter, $endbefore));
		if (($esclrepresentation!='') && ($esclrepresentation!=NULL))
		{
		echo 'Representation:<br/>';
		echo $esclrepresentation.'<br/>';
		echo '<img src="'.$esclrepresentation.'" alt="'.$esclrepresentation.'">'; 
		}
	echo '</span></td></tr></table>';


	}  //end if online yes //escl

   	else
   	{      // start if online no
   	$statusoutput='';
   	$statusoutput2="<p><b>$notconnectedtxt</b></p><p><b>$checkscannerontxt</b></p>";
   	$versionoutput = "";
   	}   //end if online no

}  // end if output status


elseif (($output== 'calibrate') && ($scanner=='s400w'))
{

//include_once 'checkscanner.php';
   //if ($online =='yes')
   if (($_SESSION['scanneronline'] =='yes') && ($scanner=='s400w'))
   {
   $calibrateoutput = shell_exec("$s400w $host $port calibrate");
   $string = $calibrateoutput;
   $last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
   $last_word = substr($string, $last_word_start); // $last_word = PHP.
   $lastword=preg_replace('/\s+/', '', $last_word);
        if ($lastword=='calibrate')
        {
        $outputline=$calibratesuccesstxt;
        $cleanedorcalibrated='yes';
        }
        elseif ($lastword=='nopaper'){
        $outputline=$nocalibrationsheet;
        }

        elseif ($lastword=='devbusy'){
        $outputline=$devbusy;
        }


        elseif ($lastword=='battlow'){
        $outputline=$battlow;
        }


        else
        {
        $outputline=$errortxt;
        }
   }

   else
   {
   $outputline = "<p><b>$notconnectedtxt</b></p><p><b>$checkscannerontxt</b></p>";
   }
}


elseif (($output == 'clean') && ($scanner=='s400w'))
{
// include_once 'checkscanner.php';
   //if ($online =='yes')
   if ($_SESSION['scanneronline'] =='yes')   
   {
   $cleanoutput = shell_exec("$s400w $host $port clean");
   $string = $cleanoutput;
   $last_word_start = strrpos($string, ' ') + 1; // +1 so we don't include the space in our result
   $last_word = substr($string, $last_word_start); // $last_word = PHP.
   $lastword=preg_replace('/\s+/', '', $last_word);
	if ($lastword=='cleanend')
	{
	$outputline=$cleansuccesstxt;
	$cleanedorcalibrated='yes';
	}

        elseif ($lastword=='nopaper')
	{
        $outputline=$nocleaningsheet;
        }

        elseif ($lastword=='devbusy')
	{
        $outputline=$devbusy;
        }


        elseif ($lastword=='battlow')
	{
        $outputline=$battlow;
        }


	else
	{ 
	$outputline=$errortxt;
	}
   }
   else
   {
   $outputline = "<p><b>$notconnectedtxt</b></p><p><b>$checkscannerontxt</b></p>";
   }
}

if ($output== 'status') 
{
echo "<table  style='width: 432px;'><tr><td><pre><small>$versionoutput</small></pre><pre><small>$statusoutput</small></pre>$statusoutput2</td></tr><tr><td>$outputline<a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif ($output== 'bonjourstatus') 
{
echo "<table  style='width: 432px;'><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif ($output== 'esclstatus') 
{
echo "<table  style='width: 432px;'><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif ($output== 'esclcapabilities') 
{
echo "<table  style='width: 432px;'><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif (($offline== 'nopaperscan') && ($scanner=='s400w'))
{
echo "<table style='width: 432px;'><tr><td><p>$nopaperscan</p></td></tr><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif (($output== 'calibrate') && ($scanner=='s400w'))
{
echo "<table style='width: 432px;'><tr><td><pre><small>$calibrateoutput</small></pre><p>$outputline</p</td></tr><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif (($output== 'clean') && ($scanner=='s400w'))
{ 
echo "<table style='width: 432px;'><tr><td><pre><small>$cleanoutput</small></pre><p>$outputline</p></td></tr><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif ($output== 'offline') //&& ($scanner=='s400w'))
{
echo "<table style='width: 432px;'><tr><td><p>$notconnectedtxt</p><p>$checkscannerontxt</p></td></tr><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}

elseif ($output== 'error') // && ($scanner=='s400w'))
{
echo "<table style='width: 432px;'><tr><td><p>$errortxt</p></td></tr><tr><td><a href='javascript:history.back()'><br/>$returntoscanpagetxt</a></td></tr></table>";
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// NO PAM image

elseif ((($image != NULL) && ($requireauth=='yes') && ($ext !='pdf') && (($_SESSION['password']!='PAM')) || ($requireauth !='yes')))//auth, no PAM
{
// $previewimage = $filepath.$image;
$previewimage=$filename;
echo "<img id='myImg' class='js-img' src='$previewimage' alt='$image' style='width:432px;height:auto'/>";
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////
////// PAM image
elseif (($image != NULL) && ($requireauth=='yes') && ($_SESSION['password']=='PAM') && ($ext!='pdf')) //auth with PAM
{

$file = $filename;
	if (file_exists($file))
	{
     	$b64image = base64_encode(file_get_contents($file));
	echo "<img download='$image' id='myImg' class='js-img' src = 'data:image/jpg;base64,$b64image' alt='$image' style='width:432px;height:auto'/>";
	}
}

echo '<table width="100%" border=0 cellpadding=0 cellspacing=0><tr>';


//PAM and No PAM

//echo 'XXX';
if  (($_GET['image'] =='') || ($_GET['image'] ==NULL)) 
{
}
elseif (($showfilemanager=='yes') && ($_SESSION['password'] !='PAM') && ($_GET['mppdf'] !='yes') && ($ext!='pdf'))
{
//echo '<td><a href="'.$_SESSION['userpath'].'index.php?rand='.$rand.'#'.$image.'"><span style="color:#777AFF; font-weight:bold">'.$image.'</span></a></td>';
echo '<td><span style="color:#666; font-weight:bold">'.$image.'</span></td>';

}

elseif (($_SESSION['password'] =='PAM') && ($_GET['mppdf'] !='yes') && ($ext!='pdf'))
{
//echo '<td><span style="color:#666; font-weight:bold">'.$image.'</span></td>';
echo "<td><span style='color:#666; font-weight:bold'>$image</span></td>";
//echo "<td><a href='data:image/jpg;base64,$b64image' download='$image'><span style='color:#777AFF; font-weight:bold'>$image</span></a></td>";
}



elseif (($showfilemanager=='yes') && ($_GET['mppdf'] =='yes') && (isset($_GET['pdfname']) && ($ext !='pdf')))
{
echo '<td><span style="color:#666; font-weight:bold">'.$image.'</span></td>';
}
elseif ($ext !='pdf')
{
echo '<td><a href="'.$_SESSION['userpath'].'index.php?rand='.$rand.'#'.$image.'"><span style="color:#777AFF; font-weight:bold">'.$image.'</span></a></td>';
}


if ((($_GET['image'] !='') || ($_GET['image'] !=NULL)) && ($ext!='pdf'))
{
	if ($resolution=='300' || $resolution=='600')
	{
	echo '<td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;'.$resolution.'&nbsp;'.$dpi.'&nbsp;&nbsp;</span></td>';
	}
	elseif ($resolution==$dpierror)
	{
	echo '<td><span style="color:#666; font-weight:bold">&nbsp;&nbsp;'.$resolution.'&nbsp;&nbsp;</span></td>';
	}
	else
	{
	echo '<td></td>';
	}
}
else
{
echo '<td></td>';
}

if ((($_GET['image'] !='') || ($_GET['image'] !=NULL)) &&  ($ext!='pdf'))
{
	if (($showdeleteafterscan=='yes') && (isset($_GET['image']) && ($_GET['image'] !='') && ($ext!='pdf')))
	{
	echo '<td><form>';
	echo '<input style="hidden" name="mppdf" type="hidden" value="'.$mppdf.'"/>';
	echo '<input style="hidden" name="pdfname" type="hidden" value="'.$pdfname.'"/>';
	echo '<input style="hidden" name="jpgpdf" type="hidden" value="'.$jpgpdf.'"/>';
	echo '<input style="hidden" name="printscaleheight" type="hidden" value="'.$printscaleheight.'"/>';
	echo '<input style="hidden" name="printscalewidth" type="hidden" value="'.$printscalewidth.'"/>';
	echo '<input style="hidden" name="autocrop" type="hidden" value="'.$autocrop.'"/>';
	echo '<input style="hidden" name="mode" type="hidden" value="'.$mode.'"/>';
	echo '<input style="hidden" name="print" type="hidden" value="'.$print.'"/>';
	echo '<input style="hidden" name="resolution" type="hidden" value="'.$resolution.'"/>';
	echo '<input style="hidden" name="image" type="hidden" value="'.$image.'"/>';
	echo '<button style="height: 36px; background-image: url(images/trash-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 33px; color:#666; font-weight:bold" type="submit" formaction="/delete.php">'.$deletetxt.'</button></form></td></tr><tr>
	<td colspan=3><hr></td></tr></table>';
	}
	else
	{
	echo '<td></td></tr></table>';
	}


	if (($showrenameafterscan=='yes') && (isset($_GET['image'])) && ($_GET['image'] !='') && ($ext!='pdf'))
	{
		
	echo '<table width="100%" cellpadding=0 cellspacing=0 border=0><tr><td><span style="color:#666; font-weight:bold">'.$renametxt.': </span></td>
	<td><form>';
	echo '<input style="width: 150px; height: 16px; color:#666; background-color: #DDD; font-weight:bold"  name="newname" type="text" value="'.$basename.'"  /><span style="color:#666; font-weight:bold">.'.$ext.'</span></td>';
	echo '<input style="hidden" name="mppdf" type="hidden" value="'.$mppdf.'"/>';
	echo '<input style="hidden" name="pdfname" type="hidden" value="'.$pdfname.'"/>';
	echo '<input style="hidden" name="jpgpdf" type="hidden" value="'.$jpgpdf.'"/>';
	echo '<input style="hidden" name="printscaleheight" type="hidden" value="'.$printscaleheight.'"/>';
	echo '<input style="hidden" name="printscalewidth" type="hidden" value="'.$printscalewidth.'"/>';
	echo '<input style="hidden" name="autocrop" type="hidden" value="'.$autocrop.'"/>';
	echo '<input style="hidden" name="mode" type="hidden" value="'.$mode.'"/>';
	echo '<input style="hidden" name="print" type="hidden" value="'.$print.'"/>';
	echo '<input style="hidden" name="resolution" type="hidden" value="'.$resolution.'"/>';
	echo '<input style="hidden" name="image" type="hidden" value="'.$image.'"/>';
	echo '<td><button style="height: 36px; background-image: url(images/rename-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 33px; color:#666; font-weight:bold" type="submit" formaction="/rename.php">'.$renametxt.'</button></form></td></tr><tr>
	<td colspan=3><hr></td></tr></table>';
	}
	else
	{
	echo '<td></td></tr></table>';
	}

}
else
{
echo '<td></td></tr></table>';
}



//if ((isset($_GET['image'])) && (($_GET['image'] !='') || ($_GET['image'] !=NULL)))
if ((($_GET['image'] !='') || ($_GET['image'] !=NULL)) && ($ext!='pdf'))
{
	if (($showprintafterscan == 'yes') && ($freeversion != 'yes') && ($_GET['image'] !=''))
	{
	echo '<table width="100%" cellpadding=0 cellspacing=0 border=0><tr><td><form action="/airscan.php" method="get"><span style="color:#666; font-weight:bold">'.$printtxt.': </span></td><td>&nbsp;&nbsp;<span style="color:#666; font-weight:bold">'.$widthtxt.'</span><input style="width: 45px; height: 16px; color:#666; background-color: #DDD; font-weight:bold" id="printscalewidth"  name="printscalewidth" type="number" min="1" max="999" step="1" value="';
		if (isset($printscalewidth) && $printscalewidth != '')
		{
		echo $printscalewidth;
		}
		else
		{
		echo $widthadj;
		}
	echo '" /><span style="color:#666; font-weight:bold"><span style="color:#666; font-weight:bold">%&nbsp;&nbsp;';
	echo $heighttxt.'</span><input style="width: 45px; height: 16px; color:#666; background-color: #DDD; font-weight:bold"  name="printscaleheight" type="number" min="1" max="999" step="1" value="';
 		if (isset($printscaleheight) && $printscaleheight != '')
		{
        	echo $printscaleheight;
        	}
        	else
        	{
        	echo $heightadj;
        	}

	echo '" /><span style="color:#666; font-weight:bold">%&nbsp;&nbsp;</span></td><td>';
	echo '<input style="hidden" name="mppdf" type="hidden" value="'.$mppdf.'"/>';
	echo '<input style="hidden" name="pdfname" type="hidden" value="'.$pdfname.'"/>';
	echo '<input style="hidden" name="jpgpdf" type="hidden" value="'.$jpgpdf.'"/>';
	echo '<input style="hidden" name="autocrop" type="hidden" value="'.$autocrop.'"/>';
	echo '<input style="hidden" name="mode" type="hidden" value="'.$mode.'"/>';
	echo '<input style="hidden" name="resolution" type="hidden" value="'.$resolution.'"/>';
	echo '<input style="hidden" name="image" type="hidden" value="'.$image.'"/>';
	echo '<input style="hidden" name="print" type="hidden" value="yes"/>';
	echo '<button style="height: 36px; background-image: url(images/Printer-icon.png); background-repeat: no-repeat; background-position: left;padding-left: 41px; color:#666; font-weight:bold" type="submit" formaction="/airscan.php">'.$printtxt.'</button></form>';
	echo '</td></tr><tr><td colspan=3><hr></td></tr></table>';
	}
	else
	{
	echo '';
	}
}
//  here it is
if (($_GET['image'] !='') || ($_GET['image'] !=NULL))

{
list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
// change the print param
//$params['image'] = $pdfpage;
$params['rand'] = $rand;
$params['newext'] = 'png';
$params['return'] = 'airscan.php';
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;

/*
	if (($imagemagick == 'yes') && ($showrotateflip='yes') && ($freeversion !='yes') && ($ext!='pdf'))
	{
	echo "
	<table cellpadding=0 cellspacing=0 border=0 style='width: 100%;'>
	<tr><td colspan=4><span style='color:#666; font-weight:bold'>$quickedit</span></td></tr><tr>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='bw.php$urlvars'><img src='images/grayscale-btn.png' alt='$grayscaletxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$grayscaletxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='rotate.php$urlvars'><img src='images/rotate-btn.png' alt='$rotatetxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$rotatetxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='autocrop.php$urlvars'><img src='images/autocrop-btn.png' alt='$croptxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$croptxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='resize.php$urlvars'><img src='images/resize-btn.png' alt='$resizetxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$resizetxt</span></a></td>
	</tr><tr>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='lineart.php$urlvars'><img src='images/lineart-btn.png' alt='$linearttxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$linearttxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='flip.php$urlvars'><img src='images/fliph-btn.png' alt='$fliptxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$fliptxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='mancrop.php$urlvars'><img src='images/manualcrop-btn.png' alt='$mcrop' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$mcrop</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: bottom; width: 25%;'><a href='convert.php$urlvars'><img src='images/convert-btn.png' alt='$converttxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$converttxt</span></a></td>
		</tr><tr><td colspan=4><hr></td></tr></table>";
	}
*/
if (($imagemagick == 'yes') && ($showrotateflip=='yes') && ($freeversion !='yes') && ($ext!='pdf'))
	{
	echo "
	<table cellpadding=0 cellspacing=0 border=0 style='width: 100%;'>
	<tr><td colspan=6><span style='color:#666; font-weight:bold'>$quickedit</span></td></tr><tr>
	<td style='padding: 5px; text-align: center; vertical-align: top; width: 16.66%;'><a href='bw.php$urlvars'><img src='images/grayscale-btn.png' alt='$grayscaletxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$grayscaletxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: top; width: 16.66%;'><a href='rotate.php$urlvars'><img src='images/rotate-btn.png' alt='$rotatetxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$rotatetxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: top; width: 16.66%;'><a href='autocrop.php$urlvars'><img src='images/autocrop-btn.png' alt='$croptxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$croptxt</span></a></td>
	
	<td style='padding: 5px; text-align: center; vertical-align: top; width: 16.66%;'><a href='deskew.php$urlvars'><img src='images/deskew-btn.png' alt='$deskewtxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$deskewtxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: top; width: 16.66%;'><a href='resize.php$urlvars'><img src='images/resize-btn.png' alt='$resizetxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$resizetxt</span></a></td>
	<td style='padding: 5px; text-align: center; vertical-align: top; width: 16.66%;'><a href='lineart.php$urlvars'><img src='images/lineart-btn.png' alt='$linearttxt' height='50' width='50'><br/><span style='color:#777AFF; font-weight:bold'>$linearttxt</span></a></td>
		</tr><tr><td colspan=6><hr></td></tr></table>";
	}





	else
        {
        }
}
else
{
}
//}

























//}






//-------------------------------------------------------------------------------------------------------------------






if ($_SESSION ['username']=='admin')
{
$_SESSION['viewpath']=$filepath;
}

else
{
}


if (($_GET['pdfdone']=='yes') && ($_GET['mppdf']=='yes') && (isset($_GET['pdfname'])) && (!isset($_GET['image'])))
{
echo '<embed src="showpdf.php?image='.$_GET['pdfname'].'.pdf" width="430" height="594">';
}

elseif (($_GET['pdfdone']=='yes') && (isset($_GET['image'])) && ($ext == 'pdf'))
{
echo '<embed src="showpdf.php?image='.$_GET['image'].'" width="430" height="594">';
}

elseif ((($_GET['image']=='') || ($_GET['image']==NULL)) && (!isset($_GET['output'])) && (!isset($_GET['offline'])))
{
//$previewimage = '/images/scan.jpg';
$previewimage = $defaultimage;
echo "<img src='$previewimage' id='preview_image' width='430'/>";
}

else
{
}

?>

</td><td id='tab_menu'><table border=0 id='tab_menu_settings' width='<?php 
if ($scanner=='eSCL')
{
echo $scanrightcolumwidthescl;
}
elseif ($scanner=='s400w')
{
echo $scanrightcolumwidths400w;
}
elseif ($scanner=='SANE')
{
echo $scanrightcolumwidthsane;
}
?>px'><tr><td colspan='2'>
<?php 
if ($fastload!='yes') // && ($scanner=='s400w'))
{
echo "<div id=\"scannerPing\">$checkscannerpingtxt</div>";
	if ($_GET['output']!='offline')
	{
	echo "<div id=\"scannerStatus\">$checkscannerstatustxt</div>";
	}
	else
	{
	echo "<div id=\"scannerStatus\">&nbsp;</div>";
	}	
}/*
elseif (($fastload!='yes') && ($scanner=='eSCL'))
{
echo "<div id=\"scannerPing\">$checkscannerpingtxt</div>";
}*/
else
{
}
 ?>
</td></tr><tr><td  colspan='2'>
<?php 
//if ($fastload!='yes')  //&& ($scanner=='s400w'))
//{

//}
//if (($fastload!='yes')  && ($scanner=='eSCL'))
//{
//echo "<div id=\"NothingHere\">&nbsp;</div>";
//}

//else
//{
//}
?></td></tr>
<tr><td>
<form id="scan-form" action="/scan.php" method="get">
<?php 
if ($scanner=='s400w')
{
echo'<span style="color:#666; font-weight:bold"><i class="qtip tip-left" data-tip="'.$pagesizetips400w.'">'.$pagesizetxt.'</i></span></td><td><span style="color:#666; font-weight:bold">'.$autodetectedtxt.'</span>';
}
elseif ($scanner=='SANE')
{
echo'<span style="color:#666; font-weight:bold"><i class="qtip tip-left" data-tip="'.$pagesizetipsane.'">'.$pagesizetxt.'</i></span></td><td><span style="color:#666; font-weight:bold">'.$sanepagesizesmenu.'</span>';
}
elseif ($scanner=='eSCL')
{
echo'<span style="color:#666; font-weight:bold"><i class="qtip tip-left" data-tip="'.$pagesizetipescl.'">'.$pagesizetxt.'</i></span></td><td><div class="styled-select blue semi-square" ><select  name="pagesize">';
	if (($esclmaxwidth >= 2550) && ($esclmaxheight >= 3300))
	{
	echo '<option value="letter"';

		if ($defaultscansize=='letter') //2550 x 3300 
		{
		echo ' selected';
		}	
	echo '/>'.$lettertxt.'</option>';
	}
	if (($esclmaxwidth >= 2480) && ($esclmaxheight >= 3508))
	{
	echo '<option value="A4"';
		if ($defaultscansize=='A4') //2480 x 3508
		{
		echo ' selected';
		}
 	echo'/>'.$A4txt.'</option>';
	}
	if (($esclmaxwidth >= 2550) && ($esclmaxheight >= 4200))
	{
	echo '<option value="legal"';
		if ($defaultscansize=='legal') //2550 x 4200
		{
		echo ' selected';
		}
	echo'/>'.$legaltxt.'</option>';
	}
	if (($esclmaxwidth >= 2362) && ($esclmaxheight >= 3579))
	{
	echo '<option value="AB"';
		if ($defaultscansize=='AB') // 2362 x 3579
		{
		echo ' selected';
		}
	}
	echo'/>'.$ABtxt.'</option>';
	if (($esclmaxwidth >= 2079) && ($esclmaxheight >= 2953))
	{
	echo '<option value="ISOB5"';
		if ($defaultscansize=='ISOB5') //2079 x 2953
		{
		echo ' selected';
		}
	}
	echo'/>'.$ISOB5txt.'</option>';

	if (($esclmaxwidth >= 2160) && ($esclmaxheight >= 3030))
	{
	echo '<option value="JISB5"';

		if ($defaultscansize=='JISB5') //2160 x 3030
		{
		echo ' selected';
		}
	echo'/>'.$JISB5txt.'</option>';
	}

echo'</div>';
}
?>

</td></tr>




















<?php


	if (($_GET['mppdf']=='yes') || (isset($pdfname)))
	{
	$hideshowa=' style="display:none; "';
	$showhidea=' style="display: block "';
	}
	elseif ($_GET['mppdf']!='yes') 
	{
	$showhidea=' style="display: none "';
	$hideshowa=' style="display: block "';
	}

if ($imagemagick == 'yes')
{
echo' 
<tr><td colspan=2 style="height:2px;"><hr></td></tr><tr><td>

<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'" ><i class="qtip tip-left" data-tip="'.$mppdftip.'">'.$multipage.'</i></span> <br/>
</span><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'" ><div id="field0" '.$hideshowa.'><i class="qtip tip-left" data-tip="'.$pdfjpgtip.'">'.$pdfjpg.'</i> 

</div><div id="field" '.$showhidea.'><i class="qtip tip-left" data-tip="'.$pdfnametip.'">'.$pdfproject.' </i></div></span></td>';
echo'<td><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;'.$no.'</span><input type="radio" name="mppdf" value="no" onChange="getValuea(this)"';


// echo '<td><hr><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;No</span><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck"';

	if ($_GET['mppdf']!='yes') //|| (!isset($pdfname)))
	{
	//$showhidea=' style="display: none "';
	//$hideshowa=' style="display: block "';
	echo ' checked';
	}
	else
	{
	}

echo '><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$yes.'</span><input type="radio" name="mppdf" value="yes" onChange="getValuea(this)"';
//  echo '><span style="color:#666; font-weight:bold; line-height: 300%">&nbsp;&nbsp;&nbsp;&nbsp;Yes</span><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"';

	if ($_GET['mppdf']=='yes') //&& (isset($pdfname)))
	{
	//$hideshowa=' style="display:none; "';
	//$showhidea=' style="display: block "';
	echo ' checked';
	}
	else
	{
	}
/// starts pdf name
echo '><div id="field1" '.$showhidea.'>';
echo'<input style="width: 120px; height: 16px; color:#666; background-color: #DDD; font-weight:bold" type="text" value="'.$_GET['pdfname'].'" placeholder="'.$name.'" id="pdfname" name="pdfname"'; 
/*
	if ($_GET['mppdf']=='yes') 
	{
	echo ' checked';
	}
	else
	{
	}
*/
echo'><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">.pdf</span></div>';

/*

echo'><br/>
    <div id="ifYes" '.$showhide.'>
	<input style="width: 120px; height: 16px; color:#666; background-color: #DDD; font-weight:bold" type="text" placeholder="'.$name.'" id="yes" name="yes"'; 

	if ($_GET['mppdf']=='yes') 
	{
	echo ' checked';
	}
	else
	{
	}

echo'><span style="color:#666; font-weight:bold; line-height: 300%">.pdf</span></div>';  

///ends pdf name
*/


/// starts jpg/pdf
// echo' <div id="field2" style="display:none;"> ';
echo' <div id="field2" '.$hideshowa.'"> ';

	if ($_GET['jpgpdf']=='yes') //|| ($_GET['mppdf']=='yes') || (isset($pdfname)))
	{
	$hideshowm=' style="display:none; "';
	$showhidem=' style="display: block "';
	}
	else // if (($_GET['mppdf']!='yes') && (!isset($pdfname)))
	{
	$showhidem=' style="display: none "';
	$hideshowm=' style="display: block "';
	}
echo'
<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;jpg</span><input type="radio" value="no" onChange="getValuem(this)" name="jpgpdf" id="jpgpdf"';
	if (($_GET['jpgpdf']!='yes') && ($_GET['mppdf']!='yes'))// && (!isset($_GET['pdfname'])))
	{
	echo ' checked';

	}
	else
	{
	}
echo '><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;&nbsp;&nbsp;&nbsp;pdf</span><input type="radio" value="yes" onChange="getValuem(this)" name="jpgpdf" id="jpgpdf"';

	if (($_GET['jpgpdf']=='yes') || ($_GET['mppdf']=='mpgpdf')) //|| (isset($_GET['pdfname'])))
	{
	echo ' checked';
	}
	else
	{
	}


echo'>    
</div>';

/*
echo'<div id="ifno" '.$hideshow.'>
<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;jpg</span><input type="radio" name="jpgpdf" id="JPG"';
	if ($_GET['mppdf']!='yes') 
	{
	echo ' checked';
	}
	else
	{
	}
echo '><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;&nbsp;&nbsp;&nbsp;pdf</span><input type="radio" name="jpgpdf" id="PDF"';

	if ($_GET['mppdf']=='yes')
	{
	echo ' checked';
	}
	else
	{
	}


echo'>    
</div>';
*/

//echo'</td></tr><tr><td colspan=2 style="height:2px;"><hr>
echo'</td></tr>';
} //ends if imagemagic req

//echo $scangrouplineheight;
//echo ((int) filter_var($scangrouplineheight, FILTER_SANITIZE_NUMBER_INT)*0.70);
?>





<tr><td colspan=2 style="height:2px;"><hr>
</td></tr>
<tr><td><span style="color:#666; font-weight:bold; line-height:<?php echo $scangrouplineheight;?>;"><i class="qtip tip-left" data-tip="<?php echo $modetip;?>"><?php echo $modetxt;?></i><br/><i class="qtip tip-left" data-tip="<?php echo $dpitip;?>"><?php  echo $dpitxt; ?></i></span></td>
<?php
if (($imagemagick == 'yes') && ($showcolorselect == 'yes') && ($freeversion == 'no'))
{
// echo '<td><style="width:20px;"><select name="mode">';   ; line-height: '.$scangrouplineheight.'
echo '<td><div class="styled-select blue semi-square" ><select  name="mode">';

	if ($currentmode=='bw')
	{
	echo'
	<option value="color">'.$colorselecttxt.'</option>
  	<option value="bw" selected>'.$grayselecttxt.'</option>';
		//if ($scanner=='s400w')
		//{
   		echo '<option value="lineart">'.$lineartselecttxt.'</option>';
		//}
	}
        elseif ($currentmode=='lineart')
        {
        echo'
        <option value="color">'.$colorselecttxt.'</option>
        <option value="bw">'.$grayselecttxt.'</option>';
		//if ($scanner=='s400w')
		//{
   		echo '<option value="lineart" selected>'.$lineartselecttxt.'</option>';
		//}
	}

        else
        {
        echo'
        <option value="color" selected>'.$colorselecttxt.'</option>
        <option value="bw">'.$grayselecttxt.'</option>';
        	//if ($scanner=='s400w')
		//{
   		echo '<option value="lineart">'.$lineartselecttxt.'</option>';
		//}
        }

// echo '</style></select></td>';
echo '</select></div>';
}

else
{
echo '<td>'.$colortxt;
}
?>

<?php
if ($showresolution=='yes')
{
/*
$sane72dpi='no';
$sane75dpi='no';
$sane100dpi='no';
$sane200dpi='no';
$sane300dpi='yes';
$sane600dpi='yes';
$sane900dpi='no';
$sane1200dpi='no';
$sane2400dpi='no';
$sane3600dpi='no';
$sane4800dpi='no';
*/
/*
if ($sane4800dpi=='yes')
{
$highestsaneres=4800;
}
else
{	
	if ($sane3600dpi=='yes')
	{	
	$highestsaneres=3600;

	}
	else
	{	
		if ($sane240000dpi=='yes')
		{	
		$highestsaneres=2400;
		}
		else
		{
			if ($sane1200dpi=='yes')
			{	
			$highestsaneres=1200;
			}
			else
			{
				if ($sane900dpi=='yes')
				{	
				$highestsaneres=900;
				}
				else
				{
					if ($sane600dpi=='yes')
					{	
					$highestsaneres=600;
					}
					else
					{
						if ($sane300dpi=='yes')
						{	
						$highestsaneres=300;
						}
						else
						{
							if ($sane200dpi=='yes')
							{	
							$highestsaneres=200;
							}
							else
							{
								if ($sane150dpi=='yes')
								{	
								$highestsaneres=150;
								}
								else
								{
									if ($sane100dpi=='yes')
									{	
									$highestsaneres=100;
									}
									else
									{
										if ($sane75dpi=='yes')
										{	
										$highestsaneres=75;
										}
										else
										{
											if ($sane72dpi=='yes')
											{	
											$highestsaneres=72;
											}
										}		
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
		
*/
	if ($scanner=='SANE')
	{
	echo '<br/>';
		if ($sane72dpi=='yes')
		{
		echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>72<input type='radio' name='resolution' value='72'";

			if ($pdfres=='72') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='72') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}
		if ($sane75dpi=='yes')
		{
			echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>75<input type='radio' name='resolution' value='75'";

			if ($pdfres=='75') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='75') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}
		if ($sane100dpi=='yes')
		{
			echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>100<input type='radio' name='resolution' value='100'";

			if ($pdfres=='100') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='100') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}
		if ($sane150dpi=='yes')
		{
			echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>150<input type='radio' name='resolution' value='150'";

			if ($pdfres=='150') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='150') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}
		if ($sane200dpi=='yes')
		{
			echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>200<input type='radio' name='resolution' value='200'";

			if ($pdfres=='200') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='200') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}

		if ($sane300dpi=='yes')
		{
			echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>300<input type='radio' name='resolution' value='300'";

			if ($pdfres=='300') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='300') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}
		if ($sane600dpi=='yes')
		{
	echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>600<input type='radio' name='resolution' value='600'";

			if ($pdfres=='600') // && ($mppdf=='yes') && (isset($pdfname))))
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			elseif ($currentresolution=='600') 
			{
			echo ' checked>&nbsp;&nbsp;&nbsp;</span>';
			}
			else
			{
			echo ' >&nbsp;&nbsp;&nbsp;</span>';
			}
		}




	}


	else
	{
	echo "<br/><span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>300<input type='radio' name='resolution' value='300'";
		if ($pdfres=='300') // && ($mppdf=='yes') && (isset($pdfname))))
		{
		echo ' checked></span>';
		}
		elseif ($currentresolution=='300') 
		{
		echo ' checked></span>';
		}
		else
		{
		echo ' ></span>';
		}
	echo "<span style='color:#666; font-weight:bold; line-height: $dpilineheight; vertical-align: $dpiverticalalign;'>&nbsp;&nbsp;&nbsp;&nbsp;600<input type='radio' name='resolution' value='600'";
		if ($pdfres=='600') // && ($mppdf=='yes') && (isset($pdfname))))
		{
		echo ' checked></span>';
		}
		elseif ($currentresolution=='600') 
		{
		echo ' checked></span>';
		}
        	else
        	{
        	echo ' ></span>';
        	}
	}

   // echo"></td></tr>";
}
else
{
echo "<td>$defaultresolution<input type='hidden' name='resolution' value='$defaultresolution'";
}
echo"</td></tr>";












if (($showdeskewautocrop=='yes') && ($imagemagick=='yes') && ($freeversion == 'no'))
{
echo '<tr><td colspan=2 style="height:2px;"><hr>
</td></tr>';
echo '<tr><td>';
echo '<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'"><i class="qtip tip-left" data-tip="'.$deskewtip.'">'.$deskewtxt.':</i><br/><i class="qtip tip-left" data-tip="'.$autocroptip.'">'.$autocroptxt.'</i></span></td><td>';
	//if ((($currentdeskew != 'yes') && ($currentautocrop != 'yes')) || (($currentdeskew == 'yes') && ($currentautocrop == 'yes')))
	//{
	
	

	//echo '<span style="color:#666; font-weight:bold">'.$deskewtxt.': <br/>'.$autocroptxt.'</span></td>';
		if (($deskew!='yes') && ($autocrop!='yes')) // this accommodates GET variables
		{
		$hideshowX='style="display: block;">';
		$showhideX='style="display: none;">';
		$hideshowY='style="display: none;">';
		$showhideY='style="display: block;">';		
		}
		/*elseif (($deskew=='yes') && ($autocrop=='yes'))
		{
		$hideshowX='style="display: block;">';
		$showhideX='style="display: none;">';
		$hideshowY='style="display: block;">';
		$showhideY='style="display: none;">';
		}*/
		elseif ($autocrop=='yes')
		{
		$hideshowX='style="display: none;">';
		$showhideX='style="display: block;">';
		$hideshowY='style="display: none;">';
		$showhideY='style="display: block;">';
		}
		elseif ($deskew=='yes')
		{
		$hideshowX='style="display: block;">';
		$showhideX='style="display: none;">';
		$hideshowY='style="display: block;">';
		$showhideY='style="display: none;">';
		}
		
	echo '<div id="field5" '.$showhideX.'<span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">
  	&nbsp;'.$no.'</span><input type="radio" name="deskew" value="no" disabled
  	><span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;&nbsp;&nbsp;
	'.$yes.'</span><input type="radio" name="deskew" value="yes" disabled><br>
  	</div>


  	<div id="field6"'.$hideshowX.'<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'"> 
	&nbsp;'.$no.'</span><input onChange="getValueb(this)" type="radio" name="deskew" value="no"';  

	if (($deskew=='no') || ($deskew=='') || ($deskew==NULL))
	{
	echo ' checked';
	}
	else
	{
	}
	echo '><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">
  	&nbsp;&nbsp;&nbsp;'.$yes.'</span><input onChange="getValueb(this)" type="radio" name="deskew" value="yes"';
	if ($deskew=='yes')
	{
	echo ' checked';
	}
	else
	{
	}
	echo '>
  	</div>';

	echo '<div id="field4" '.$hideshowY.'<span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">
  	&nbsp;'.$no.'</span><input type="radio" name="autocrop" value="no" disabled><span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">&nbsp;&nbsp;&nbsp;
  	'.$yes.'</span><input type="radio" name="autocrop" value="yes" disabled><br>
  	</div>
  
    	<div id="field3" '.$showhideY.'<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">
  	&nbsp;'.$no.'</span><input onChange="getValuec(this)" type="radio" name="autocrop" value="no"';

	if (($autocrop=='no') || ($autocrop=='') || ($autocrop==NULL))
	{
	echo ' checked';
	}
	else
	{
	}
 	echo '><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">
  	&nbsp;&nbsp;&nbsp;'.$yes.'</span><input onChange="getValuec(this)" type="radio" name="autocrop" value="yes"';


	if ($autocrop=='yes')
	{
	echo ' checked';
	}
	else
	{
	}


	echo'>
  	</div>';


echo '</td></tr>';
}
else 
{
echo '';
}







if (($showprint=='yes') && ($freeversion == 'no'))

{


echo '<tr><td colspan=2 style="height:2px;"><hr>
</td></tr>';
echo '<tr><td>';

echo '<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'"><i class="qtip tip-left" data-tip="'.$printtip.'">'.$printtxt.':</i><br/><i class="qtip tip-left" data-tip="'.$printscaletip.'">'.$printscale.'</i></span></td><td>';
echo '<div id="field11" '.$hideshowm.'"><span style="color:#666; font-weight:bold"; line-height: '.$scangrouplineheight.'">&nbsp;'.$no.'<input type="radio" name="print" value="no" onChange="getValued(this)"';
	if (($currentprint=='no') || ($currentprint=='') || ($currentprint==NULL))
	{
	$showhided=' style="display: none "';
	$hideshowd=' style="display: block "';
	echo ' checked /></span><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
	}
	elseif ($currentprint=='yes')
	{
	$showhided=' style="display: block "';
	$hideshowd=' style="display: none "';
	echo ' />';
	echo '</span><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
	}
echo '<span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">'.$yes.'<input type="radio" name="print" value="yes" onChange="getValued(this)"';
	if ($currentprint=='yes')
        {
	$showhided=' style="display: block "';
	$hideshowd=' style="display: none "';
        echo ' checked></span></div>';
        }

	elseif ($currentprint!='yes')
	{
	$showhided=' style="display: none "';
	$hideshowd=' style="display: block "';
	echo '></span></div>';
	}
echo '<div id="field10" '.$showhidem.'"><span style="color:#bbb; font-weight:bold"; line-height: '.$scangrouplineheight.'">&nbsp;'.$no.'<input type="radio" name="print" value="no" disabled /></span><span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">'.$yes.'<input type="radio" name="print" value="yes" disabled /></span></div>';



	echo '<div id="field7" '.$showhided.'><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">'.$widthtxt.'</span><input style="width: 45px; height: 16px; color:#666; background-color: #DDD; font-weight:bold" id="printscalewidth"  name="printscalewidth" type="number" min="1" max="999" step="1" value="';
        	if (isset($printscalewidth) && $printscalewidth != '')
        {
        echo $printscalewidth;
        }

	else
	{
        echo $widthadj;
        }
echo '" /><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">%&nbsp';
echo $heighttxt.'</span><input style="width: 45px; height: 16px; color:#666; background-color: #DDD; font-weight:bold" id="printscaleheight"  name="printscaleheight" type="number" min="1" max="999" step="1" value="';
	if (isset($printscaleheight) && $printscaleheight != '')
        {
        echo $printscaleheight;
        }
        else
        {
        echo $heightadj;
        
        }


echo '"/><span style="color:#666; font-weight:bold; line-height: '.$scangrouplineheight.'">%</span></div>';





echo '<div id="field8" '.$hideshowd.'><span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">'.$widthtxt.'</span><input style="width: 45px; height: 16px; color:#bbb; background-color: #DDD; font-weight:bold" id="printscalewidth"  name="printscalewidth" type="number" min="1" max="999" step="1" value="';
        	if (isset($printscalewidth) && $printscalewidth != '')
        {
        echo $printscalewidth;
        }

	else
	{
        echo $widthadj;
        }
echo '" disabled /><span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">%&nbsp';
echo $heighttxt.'</span><input style="width: 45px; height: 16px; color:#bbb; background-color: #DDD; font-weight:bold" id="printscaleheight"  name="printscaleheight" type="number" min="1" max="999" step="1" value="';
	if (isset($printscaleheight) && $printscaleheight != '')
        {
        echo $printscaleheight;
        }
        else
        {
        echo $heightadj;
        
        }
echo '" disabled /><span style="color:#bbb; font-weight:bold; line-height: '.$scangrouplineheight.'">%</span></div>';
}
else;
{
echo '';
}














echo '<tr><td colspan=2 style="height:2px;"><hr>
</td></tr>';


?>
<tr><td>

<span style="color:#666; font-weight:bold; line-height: <?php echo $scangrouplineheight ;?>"><i class="qtip tip-left" data-tip="<?php echo $deltmptip;?>"><?php echo $deltmptxt;?></i><br/><i class="qtip tip-left" data-tip="<?php echo $scantip;?>"><?php echo $scantxt;?>


</span></td>


<?php 


echo "<td><span style='color:#666; font-weight:bold; line-height: $scangrouplineheight;'>&nbsp;$no<input type='radio' name='deltmp' value='no'";

	if ($_GET['deltmp']!='yes') // && ($mppdf=='yes') && (isset($pdfname))))
	{
	echo ' checked></span>';
	}
	elseif ($currentdeltmp=='no') 
	{
	echo ' checked></span>';
	}
	else
	{
	echo ' ></span>';
	}
echo "<span style='color:#666; font-weight:bold; line-height: $scangrouplineheight;'>&nbsp;&nbsp;&nbsp;&nbsp;$yes<input type='radio' name='deltmp' value='yes'";
	if ($_GET['deltmp']=='yes') // && ($mppdf=='yes') && (isset($pdfname))))
	{
	echo ' checked></span>';
	}
	elseif ($currentdeltmp=='yes') 
	{
	echo ' checked></span>';
	}
        else
        {
        echo ' ></span>';
        }

   // echo"></td></tr>";



//if ($scanner='s400w')
//{

// for testing javascript enable disable
//echo '<br/><span style="vertical-align: '.$scanbuttonverticalalign.'"><button id="submitbtn" style="height: 36px; background-image: url(images/btn_accep_scanner.png); background-repeat: no-repeat; background-position: left;padding-left: 36px; color:#666; font-weight:bold" type="submit" formaction="/scan.php">'.$scannowtxt.'</button></span></form>';


echo '<br/><span style="vertical-align: '.$scanbuttonverticalalign.'"><button id="submitbtn" style="height: 36px; background-image: url(images/btn_accep_scanner.png); background-repeat: no-repeat; background-position: left;padding-left: 36px; color:#666; font-weight:bold" type="submit" formaction="/scan.php">'.$scannowtxt.'</button></span></form>';
/*}

elseif ($scanner='eSCL')
{
echo '<br/><span style="vertical-align: '.$scanbuttonverticalalign.'"><button style="height: 36px; background-image: url(images/btn_accep_scanner.png); background-repeat: no-repeat; background-position: left;padding-left: 36px; color:#666; font-weight:bold" type="submit" formaction="/scan.php">'.$scannowtxt.'</button></span></form>';
}*/
?>






</td></tr>






<?php

//echo'<tr><td colspan=2 ></td></tr>';



echo '<a name="loadpdf"></a>';

if ((!isset($_GET['pdfname']))&&(!isset($_GET['image'])))
{
echo '<tr><td colspan=3 style="height:2px;">
<a name="loadpdf"><hr></a>
</td></tr>
<tr><td colspan=3>

<div id="fieldY" '.$showhidea.'>
<table style="width: 100%; "><tr><td align="left" colspan=2><span style="float: left; color:#666; font-weight:bold">'.$loadmppdfproject.'
<br/>&nbsp;&nbsp;'.$pdfprojectname.'</span></td></tr>
<form action="/airscan.php" method="get"><tr><td align="right">
<input style="hidden" name="mppdf" type="hidden" value="yes"/>
<input style="width: 120px; height: 16px; color:#666; background-color: #DDD; font-weight:bold" id="pdfname"  name="pdfname" type="text" placeholder="'.$name.'" value="" />	
</td>
<td align="right"><button style="float: left; height: 36px; background-image: url(images/pdf-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 39px; color:#666; font-weight:bold" type="submit" formaction="airscan.php#loadpdf">'.$loadproject.'</button></td>
</td></form></tr></table>
</div>


<div id="fieldX" '.$hideshowa.'>
<table style="width: 100%; ">

<tr><td colspan=3>';

	if ($scanner=='s400w')
	{
	echo'
	<span style="color:#666; font-weight:bold">'.$cleancalibratetxt.'</span>
	</td></tr>
	<tr><td align="left">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="status">'.$statustxt.'</button></form>
	</td><td align="center">
	<form><button style="height: 36px; background-image: url(images/btn_clean.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="clean">'.$cleantxt.'</button></form>
	</td><td align="right">
	<form><button style="height: 36px; background-image: url(images/btn_calibrate.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="calibrate">'.$calibratetxt.'</button></form>
	</td></tr></table>
	</div></td></tr>';
	}
	elseif ($scanner=='eSCL')
	{
	echo'
	</td></tr>
	<tr><td width="33%" align="left">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="bonjourstatus">'.$bonjourstatustxt.'</button></form>
	</td><td width="33%" align="center">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="esclstatus">'.$esclstatustxt.'</button></form>
	</td><td width="33%" align="right">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="esclcapabilities">'.$esclcapabilitiestxt.'</button></form>
	</td></tr></table>
	</div></td></tr>';
	}
	elseif ($scanner=='SANE')
	{
	echo'
	</td></tr>
	<tr><td width="33%" align="left">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="sanescanners">'.$sanescannerstxt.'</button></form>
	</td><td width="33%" align="center">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="sanescannerinfo">'.$sanescannerinfotxt.'</button></form>
	</td><td width="33%" align="right">
	<form><button style="height: 36px; background-image: url(images/btn_status.png); background-repeat: no-repeat; background-position: left; padding-left: 36px; color:#666; font-weight:bold" formaction="airscan.php" type="hidden" name="output" value="sanetest">'.$sanetesttxt.'</button></form>
	</td></tr></table>
	</div></td></tr>';
	}

}
else
{
echo'';
}


if (($_GET['mppdf'] =='yes')  && (isset($_GET['pdfname'])) && ($showmppdf=='yes')) //&& ($_SESSION['password']!='PAM'))
{
$pdffilesdir=$_SESSION['userpath'].$_GET['pdfname'].'_*';
$count=0;
$oldpdfres='';
echo '<tr><td colspan=2><a name="loadpdf"><hr></a></td></tr><tr><td colspan=2><table style="width: 100%; "><tr><td>';
echo '<span style="color:#666; font-weight:bold; line-height: 180%">'.$pdfprojectscans.' '.$_GET['pdfname'].'.';
//echo '<ul style="list-style: none">';
echo '<table style="width: 100%; "><tr><th>'.$page.'</th><th style="text-align: center">'.$name.'</th><th>'.$dpi.'</th></tr>';
	foreach(array_map('basename', glob($pdffilesdir)) as $pdfpage)   
    	{ 
	$pdfresolution=$no;
	$pdfpageext = strtolower(pathinfo($pdfpage, PATHINFO_EXTENSION));
		if ($pdfpageext=='jpg')
		{
		$pdfexif = exif_read_data($_SESSION['userpath'].$pdfpage);
		$pdfxres = eval('return '.$pdfexif["XResolution"].';');
		$pdfyres = eval('return '.$pdfexif["YResolution"].';');	
		

			if (($pdfexif["XResolution"]) == ($pdfexif["YResolution"]))
   			{
				if (($pdfexif["XResolution"] == '300/1') || ($pdfexif["XResolution"] == '300')) 
       				{
       				$pdfresolution='300';
       				}
       				elseif (($pdfexif["XResolution"] == '600/1') || ($pdfexif["XResolution"] == '600')) 
       				{
       				$pdfresolution='600';
       				}
       				else 
        			{
        			$pdfresolution=$no;
				}
			}
		
 		}
	$count=$count+1;
	echo '<tr ';

		if ($_GET['image'] ==$pdfpage)
		{
		echo 'style="background-color: #FF6"';
		}
		else
		{
		}


	echo '><td style="text-align: center"><span style="color:#666; font-weight:bold; line-height: 180%">'.$count.'&nbsp;</span></td><td>';
	
		if ($_GET['image'] !=$pdfpage)
		{
		echo '<a href="airscan.php';

		list($path, $query_string) = explode('?', $url, 2);
		// parse the query string
		parse_str($query_string, $params);
		// delete image param
		//unset($params['rand']);
		unset($params['print']);
		// change the print param
		$params['image'] = $pdfpage;
		$params['rand'] = $rand;
		//$params['print'] = 'no';
		// rebuild the query
		$query_string = http_build_query($params);
		// reassemble the URL
		$urlvars = $path . '?' . $query_string;

		echo $urlvars;
		}
		else
		{
		}

		if ($_GET['image'] ==$pdfpage)
		{
		echo '<span style="color:#666; font-weight:bold; line-height: 180%">'.$pdfpage.'</span>&nbsp;</td><td><span style="color:#666; font-weight:bold; line-height: 180%"> '.$pdfresolution.'</span></td>';
		}
		else
		{
		echo '"><span style="color:#777AFF; font-weight:bold; line-height: 180%">'.$pdfpage.'</span></a>&nbsp;</td><td><span style="color:#666; font-weight:bold; line-height: 180%"> '.$pdfresolution.'</span></td>'; 
	
		}





		if ($oldpdfres=='') 
		{
		$pdfres=$pdfresolution;
		}
		elseif (($oldpdfres!='') && ($oldpdfres==$pdfresolution)) 
		{
		$pdfres=$pdfresolution;
		}
		else
		{
		$pdfres='mix';
		}
	$oldpdfres=$pdfresolution;
	//$count=$count+1;	  
   	} //end foreach 	 
	
} //end if

	if (($count >=1) && (isset($_GET['pdfname'])))
	{
	echo '</table></td></tr></table>';
	echo '<div style="clear: both;"><table style="width: 100%; "><tr>';
	echo '<td ><form action="/airscan.php" method="get">	
	<input style="hidden" name="pdfname" type="hidden" value="'.$_GET['pdfname'].'"/>
	<input style="hidden" name="pdfres" type="hidden" value="'.$pdfres.'"/>	
	<button style="float: left; height: 36px; background-image: url(images/makepdf-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 39px; color:#666; font-weight:bold" type="submit" formaction="/mkmppdf.php">'.$makepdf.'</button>
	</form></td>';
	echo'<td ><form action="/airscan.php" method="get">	
	<input style="hidden" name="pdfname" type="hidden" value="'.$_GET['pdfname'].'"/>	
	<button style="float: right; height: 36px; background-image: url(images/trash3-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 39px; color:#666; font-weight:bold" type="submit" formaction="/deletepdfscans.php">'.$deletescans.'</button>
	</form></td>';
		/*if (($_GET['pdfdone']=='yes') && ($_SESSION['password']!='PAM'))
		{
		echo '<tr><td colspan=2 style="text-align; center;"><form action="/'.$_SESSION['userpath'].$_GET['pdfname'].'.pdf" method="post">	jpgpdf
		<button style="float: center; margin-right:auto !important; margin-left:auto !important;  height: 36px; background-image: url(images/preview-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 39px; color:#666; font-weight:bold" type="submit">'.$viewpdf.'</button>
		</form></td></tr>';
		} //end if

		if ($_GET['pdfdone']=='yes') //&& ($_SESSION['password']=='PAM'))
		{
		echo '<tr><td colspan=2 style="text-align; center;"><form action="showpdf.php?image='.$_GET['pdfname'].'.pdf" method="post">	
		<button style="float: center; margin-right:auto !important; margin-left:auto !important;  height: 36px; background-image: url(images/preview-btn.png); background-repeat: no-repeat; background-position: left;padding-left: 39px; color:#666; font-weight:bold" type="submit">'.$viewpdf.'</button>
		</form></td></tr>';
		} //end if

		else 
		{
		} //end else
*/
	echo '</table></div>';	
	} //end if
	elseif (($count ==0) && (isset($_GET['pdfname'])) && ($_GET['pdfname']!='') )
	{
	echo '<tr><td colspan=3><span style="color:#F44; font-weight:bold;">'.$nofilesfound.'</span><a href="airscan.php?mppdf=yes#loadpdf"<span style="color:#777aff; font-weight:bold;"><br/>'.$tryagain.'</span></td></tr>';
	echo '</table></td></tr></table>';	
	} //end elseif


//} //   was end foreach




//echo $count;
?></td></tr></table></td></tr></table>  
<div id="loading">
    <div id="loadingcontent">
        <p id="loadingspinner"><img src="images/spinner.gif"><br/><br/><br/>
            <span style="color:#666; font-weight:bold"><?php echo $waitscanning;?></span>
        </p>
    </div>
</div>

<?php /*
<div id="field10" <?php echo $showhidem;?> ">
field10
</div>

<div id="field11" <?php echo $hideshowm;?> ">
field11
</div>
*/ ?>

<?php
if ($fastload!='yes')
{
echo '

<script type="text/javascript">
if(typeof(EventSource)!=="undefined") {
        var statusSource = new EventSource("checklogin.php");
        statusSource.onmessage = function(event) {
                document.getElementById("loginStatus").innerHTML = event.data;
        };
}
else {
        document.getElementById("loginStatus").innerHTML="'.$nosupporttxt.'";
}
</script>
<script type="text/javascript">
if(typeof(EventSource)!=="undefined") {
        var eSource = new EventSource("checkping.php");
        eSource.onmessage = function(event) {
                document.getElementById("scannerPing").innerHTML = event.data;
        };
}
else {
        document.getElementById("scannerPing").innerHTML="'.$nosupporttxt.'";
}
</script>
<script type="text/javascript">
if(typeof(EventSource)!=="undefined") {
        var statusSource = new EventSource("checkstatus.php");
        statusSource.onmessage = function(event) {
                document.getElementById("scannerStatus").innerHTML = event.data;
        };
}
else {
        document.getElementById("scannerStatus").innerHTML="'.$nosupporttxt.'";
}
</script>
';
}
//echo $pdfres;
if ($print=='yes'){
echo "<iframe src=\"printcopy.php?image=$image&resolution=$resolution&printscalewidth=$printscalewidth&printscaleheight=$printscaleheight\" style= \"width:0;height:0;border:0; border:none;\"></iframe>";
}


include 'footer.inc.php';

}

if ($image != NULL)
{
      echo '<div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01" />
      <div id="caption"></div>
    </div>


<script>
// Get the modal
var modal = document.getElementById("myModal");
console.log(modal);

// Get the image and insert it inside the modal - use its "alt" text as a caption
var imgs = document.getElementsByClassName("js-img")
console.log(Array.from(imgs))
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
// Array.from is necessary because document.getElementsByClassName
// do not return an array but a HTMLCollection : https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByClassName
// you can use querySelectorAll (which is a more recent function), see here : https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelectorAll
Array.from(imgs).forEach(function(img) {
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  };
})

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};


</script>';
}

else
{
echo '';
}
/*
<script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    } else {
        document.getElementById('ifYes').style.visibility = 'hidden';
    }

</script>

loadingWait
*/
?>

<?php
if ($fastload != 'yes')
{
echo'
<script>
function getValuea(a) {
  if(a.value == "no"){
    document.getElementById("field1").style.display = "none"; // you need a identifier for changes
        document.getElementById("field2").style.display = "block"; // you need a identifier for changes
		document.getElementById("field0").style.display = "block"; // you need a identifier for changes
			document.getElementById("field").style.display = "none"; // you need a identifier for changes
				document.getElementById("fieldX").style.display = "block"; // you need a identifier for changes
					document.getElementById("fieldY").style.display = "none"; // you need a identifier for changes
  }
  else{
    document.getElementById("field1").style.display = "block";  // you need a identifier for changes
        document.getElementById("field2").style.display = "none";  // you need a identifier for changes
		document.getElementById("field0").style.display = "none";  // you need a identifier for changes
			document.getElementById("field").style.display = "block";  // you need a identifier for changes
				document.getElementById("fieldX").style.display = "none";  // you need a identifier for changes
					document.getElementById("fieldY").style.display = "block";  // you need a identifier for changes
  }
}
</script>

<script>
function getValueb(b) {
  if(b.value == "no"){
    document.getElementById("field4").style.display = "none"; // you need a identifier for changes
        document.getElementById("field3").style.display = "block"; // you need a identifier for changes
  }
  else{
    document.getElementById("field4").style.display = "block";  // you need a identifier for changes
        document.getElementById("field3").style.display = "none";  // you need a identifier for changes
    
  }
}
</script>
<script>
function getValuec(c) {
  if(c.value == "no"){
    document.getElementById("field5").style.display = "none"; // you need a identifier for changes
        document.getElementById("field6").style.display = "block"; // you need a identifier for changes
  }
  else{
    document.getElementById("field5").style.display = "block";  // you need a identifier for changes
        document.getElementById("field6").style.display = "none";  // you need a identifier for changes
    
  }
}
</script>
<script>
function getValued(d) {
  if(d.value == "no"){
    document.getElementById("field7").style.display = "none"; // you need a identifier for changes
        document.getElementById("field8").style.display = "block"; // you need a identifier for changes
  }
  else{
    document.getElementById("field7").style.display = "block";  // you need a identifier for changes
        document.getElementById("field8").style.display = "none";  // you need a identifier for changes
    
  }
}
</script>

</script>
<script>
function getValuem(m) {
  if(m.value == "no"){
    document.getElementById("field10").style.display = "none"; // you need a identifier for changes
        document.getElementById("field11").style.display = "block"; // you need a identifier for changes
		    document.getElementById("field7").style.display = "block"; // you need a identifier for changes
        document.getElementById("field8").style.display = "none"; // you need a identifier for changes
  }
  else{
    document.getElementById("field10").style.display = "block";  // you need a identifier for changes
        document.getElementById("field11").style.display = "none";  // you need a identifier for changes
    document.getElementById("field7").style.display = "none";  // you need a identifier for changes
        document.getElementById("field8").style.display = "block";  // you need a identifier for changes

    
  }
}
</script>





<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

</script>
';
}
?>

<script type="text/javascript">
    $(function () {
        $("#submitbtn").click(function () {
            $("#loading").fadeIn();
        });
    });
</script>


<?php $_SESSION['fromfilelister']='no'; ?>
</body>
</html>
