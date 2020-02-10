<?php
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
session_start();
chdir ('/var/www/html/');
$username= $_SESSION['username'];
include_once('/config.inc.php');
include_once('/lang.php');
$_SESSION['fromuserfolder']='yes';
// $_SESSION['fromuserfilelister']='yes';
$now = time();


if (($requireauth == 'yes') && ($_SESSION['loggedin'] != 'yes'))
{
include_once('deauthorize.php');
}

if (($requireauth == 'yes') && ($_SESSION['loggedin'] == 'yes') && ($_SESSION['expire'] > $now))//  && ($_SESSION['expire'] > $now))
{
include_once('filelister.php');
}

elseif ($requireauth != 'yes') 
{
include_once('filelister.php');
}

elseif (($requireauth == 'yes') && ($_SESSION['loggedin'] != 'yes'))
{
include_once('deauthorize.php');
}

elseif (($requireauth == 'yes') && ($_SESSION['expire'] <= $now))
{
include_once('deauthorize.php');
}



?>

