<?php
error_reporting( -1 );
ini_set( 'display_errors', 1 );
include_once('config.inc.php');
include_once('lang.php');

echo '<div id="msg">
<table border=0 style = "width: 100%;"><tr><td style="text-align: center;"><span style="color:#666; font-weight:bold"><br/><br/>'.$loadingpleasewait.'</span></br></br><br/>
<img src="images/spinner.gif"><ul></td></tr></table>
</div><div id="body" style="display:none;">';

// echo 'XXX';
if ($requireauth=='yes') //&& ($_GET['PAM'] == 'yes'))
{

echo '<table border=0 width=50%><tr><th align="center"><span style="color:#666; font-weight:bold">'.$jpgfilesintxt;
echo $_SESSION['viewuser'].'</span></th><tr><td>';
$upath=$_SESSION['viewpath'];
}



else
{
echo $filestxt.'<br/><br/>';
$upath=$filepath;
}

//////////////////////////////////////////////////////////////
//echo '<br/>'.$_SESSION['viewpath'].'<br/>'; 
//echo $pampath;  
//echo '<ul>';

//if (($_GET['PAM']!='yes') || ($_GET['PAM']=='yes'))
//{
//sleep (8);
echo '<ul style="list-style: none">';
//$pamdir=NULL;
//$dh = opendir($upath);
	if (($_SESSION['viewpath'] != '') && ($_SESSION['viewpath'] != NULL) && ($_SESSION['viewpath'] != ' ') && ($_SESSION['viewpath'] != '/'))
	{
	$i=0;
	//$i=1;

//$files = glob($upath.'*');
$files=array_map('basename', glob($upath.'*'));
natcasesort($files);
foreach ($files as $file) 


		//foreach(array_map('basename', glob($upath.'*')) as $file) 
		//while (($file = readdir($dh)) !== false) 
		{


    			if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin" && $file != "PDF") 
			{  //$i=$i+1;
					$i++;					
					//$file = $_SESSION['viewpath'].$entry;
					$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        				if (($ext== 'pdf') && ($_GET['PAM']!='yes'))
					{
/*
					echo '<div style="display:none;"><div id="image'.$i.'">
					<iframe class="frame" style = "margin: 0; padding: 0; border: none; width:'.$adminfilelistzoompdfwidth.';max-width:'.$adminfilelistzoompdfmaxwidth.';height:'.$adminfilelistzoompdfheight.';max-height:'.$adminfilelistzoompdfmaxheight.'" src="showpdf.php?image='.$entry.'"></iframe>
					<span style="color:#666; font-weight:bold; text-align:center" >
					<p>'.$i.' '.$file.'</p></span></div></div>';
					echo '<li><span style="color:#666; font-weight:bold"> '.$i.' </span><a href="#" id="featherlight-image" data-featherlight="#image'.$i.'" download="'.$file.'"><span style="color:#777AFF; font-weight:bold">'.$file.'</span></a></li>';
*/					echo '<div style="display:none;"><div id="image'.$i.'">
					<iframe class="frame" style = " overflow-y: auto;margin-top: 0px; margin-bottom: 0px; margin-left: 25px; margin-right: 25px; padding: 0px; border: 0px; width:'.$adminfilelistzoompdfwidth.';max-width:'.$adminfilelistzoompdfmaxwidth.';height:'.$adminfilelistzoompdfheight.';max-height:'.$adminfilelistzoompdfmaxheight.'" src="/showpdf.php?image='.$file.'"></iframe>
					<span style="color:#666; font-weight:bold; text-align:center" >
					<p>'.$i.' '.$file.'</p></span></div></div>';
					// <embed style = "margin-top: 0px; margin-bottom: 10px; margin-left: 25px; margin-right: 25px; padding: 0px; border: 0px; width:'.$adminfilelistzoompdfwidth.';max-width:'.$adminfilelistzoompdfmaxwidth.';height:'.$adminfilelistzoompdfheight.';max-height:'.$adminfilelistzoompdfmaxheight.'" src="'.$_SESSION['viewpath'].$file.'"></embed>
					echo '<li><span style="color:#666; font-weight:bold"> '.$i.' </span><a href="#" id="featherlight-image" data-featherlight="#image'.$i.'" download="'.$file.'"><span style="color:#777AFF; font-weight:bold">'.$file.'</span></a></li>';					
					}

					elseif (($ext== 'pdf') && ($_GET['PAM']=='yes'))
					{
					//echo $_SESSION['viewpath'].$entry;
					echo '<div style="display:none;"><div id="image'.$i.'">
					<iframe style = "overflow-y: auto; margin-top: 0px; margin-bottom: 0px; margin-left: 25px; margin-right: 25px; padding: 0px; border: 0px; width:'.$adminfilelistzoompdfwidth.';max-width:'.$adminfilelistzoompdfmaxwidth.';height:'.$adminfilelistzoompdfheight.';max-height:'.$adminfilelistzoompdfmaxheight.'" src="/showpdf.php?image='.$file.'"></iframe>
					<span style="color:#666; font-weight:bold; text-align:center" >
					<p>'.$i.' '.$file.'</p></span></div></div>';
					echo '<li><span style="color:#666; font-weight:bold"> '.$i.' </span><a href="#" id="featherlight-image" data-featherlight="#image'.$i.'" download="'.$file.'"><span style="color:#777AFF; font-weight:bold">'.$file.'</span></a></li>';
					}



					elseif (($_GET['PAM']=='yes') && (($ext=='jpg') || ($ext=='jpeg') || ($ext=='gif') || ($ext=='png') || ($ext=='webp')))
					{
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
					$b64image = base64_encode(file_get_contents($upath.$file));
					//echo $_SESSION['viewpath']; 
					echo '<div style="display:none;"><div id="image'.$i.'">
					<img src="data:image/'.$mimeext.';base64,'.$b64image.'" style="margin-left:: 1%; z-index: 0; width:'.$adminfilelistzoomwidth.';max-width:'.$adminfilelistzoomwidth.';height:'.$adminfilelistzoomheight.';max-height:'.$adminfilelistzoommaxheight.'"/>
					<span style="color:#666; font-weight:bold; text-align:center" >
					<p>'.$i.' '.$file.'</p></span></div></div>';
					echo '<li><span style="color:#666; font-weight:bold"> '.$i.' </span><a href="#" id="featherlight-image" data-featherlight="#image'.$i.'" download="'.$file.'"><span style="color:#777AFF; font-weight:bold">'.$file.'</span></a></li>';
					}


					elseif (($_GET['PAM']!='yes') && (($ext=='jpg') || ($ext=='jpeg') || ($ext=='gif') || ($ext=='png') || ($ext=='webp')))
					{
					echo '<div style="display:none;"><div id="image'.$i.'">
					<img src="'.$_SESSION['viewpath'].$file.'" style="z-index: 0; width:'.$adminfilelistzoomwidth.';max-width:'.$adminfilelistzoommaxwidth.';height:'.$adminfilelistzoomheight.';max-height:'.$adminfilelistzoommaxheight.'"/>
					<span style="color:#666; font-weight:bold; text-align:center" >
					<p>'.$i.' '.$file.'</p></span></div></div>';
					echo '<li><span style="color:#666; font-weight:bold"> '.$i.' </span><a href="#" id="featherlight-image" data-featherlight="#image'.$i.'" download="'.$file.'"><span style="color:#777AFF; font-weight:bold">'.$file.'</span></a></li>';
					}
			
    			}
//$i++;
		}
		//closedir($dh);

	}
//}



echo '</ul></td></tr></table>';
echo '</div>

<script type="text/javascript">

$(document).ready(function() {
    $(\'#body\').show();
    $(\'#msg\').hide();
});
</script>';
//echo $i;
if ($i == 0)
{

echo '<span style="color:#F44; font-weight:bold">'.$nofilesfound.'</span>';;
}
else
{
}
/*
<div style="display:none;">
  <div id="bio-john">
 <img src="data:image/jpg;base64,<?php echo $b64image;?>"/>
  <p>
    Insert the bio text here
  </p>
    </div>
    </div>
*/
?>
<?php /*
 <a href="#" data-featherlight="#bio-john">Learn About John</a>
*/ ?>
<?//php echo $_SESSION['viewpath'];
?> 





