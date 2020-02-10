<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
include_once 'config.inc.php';
include_once 'lang.php';
$now=time();





if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
$dlepdffilescmd='rm '.$_SESSION['userpath'].$_GET['pdfname'].'_*';


        if (($_SESSION['expire'] - $now) <= $addtime)
        {
        $_SESSION['expire']=($_SESSION['expire'] + $buytime);
        }

        else
        {
        echo '';
        }


echo '<html lang="'.$lang.'">';
?>
<head>
<?php 
//if ($_POST['confirmdelete']=='yes')
//{
// echo '<meta HTTP-EQUIV="REFRESH" content="'.$deleterefresh.'; url='.$refreshurl.'">';
echo $refreshurl;

//}
/*
else 
{
echo '';
}*/


echo '
  <meta HTTP-EQUIV="REFRESH" content="0; url=airscan.php?pdfname='.$_GET['pdfname'].'&mppdf=yes&pdfdone=yes">
  <meta charset="<?php echo $charset;?>">
  <meta http-equiv="Cache-Control" content="private, no-store" /> 
  <meta name="Expires" content="'.$rfc_1123_date.'"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
  <title>'.$pagetitle.'</title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/style.css" type="text/css" /

</head>
<body>
';




echo '<center><p><span style="color:#666; font-weight:bold">'.$waitdeletingtxt.'...&nbsp;'.$image.'</span></p></center>';
echo '<center><img src="images/spinner.gif"></center>';
        //if ($preferphpcommands!='yes')
        //{
        ob_flush();
        flush();


shell_exec($dlepdffilescmd);


}
else
{
//echo '';
}




?>
</body>
</html>
