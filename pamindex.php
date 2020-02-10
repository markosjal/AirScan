<?php
include_once 'phppagestart.php';
// error_reporting( -1 );
// ini_set( 'display_errors', 1 );
$username= $_SESSION['username'];
include_once('config.inc.php');
include_once('lang.php');
chdir ($root);
$_SESSION['fromuserfolder']='yes';
$_SESSION['fromuserfilelister']='yes';
$now = time();

if (($requireauth == 'yes') && ($_SESSION['loggedin'] != 'yes'))
{

//echo 'excuse 1';
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
//echo 'excuse 2';
include_once('deauthorize.php');
}

elseif (($requireauth == 'yes') && ($_SESSION['expire'] <= $now))
{
//echo 'excuse 3';
include_once('deauthorize.php');
}
//echo $_SESSION['username'];
//echo $_SESSION['password'];
// echo '<br/>';
//echo $_SESSION['userpath'];
?>
