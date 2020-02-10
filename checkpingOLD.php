<?php
include_once 'config.inc.php';
include_once 'lang.php';
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
old file no longer needed ??

// include_once 'checkscanner.php';

/*
if (($requireauth=='yes') && ($_SESSION['loggedin'] == 'yes'))
{
//include_once 'checkscanner.php';
echo "retry: $ping\ndata: {$_SESSION['connectstatusmessagetxt']}\n\n";

}

elseif ($requireauth!='yes')
{
//include_once 'checkscanner.php';
echo "retry: $ping\ndata: {$_SESSION['connectstatusmessagetxt']}\n\n";
}

else 
{
// $ping=7200;
//include_once 'checkscanner.php';
echo "retry: $ping\ndata: {$_SESSION['connectstatusmessagetxt']}\n\n";
}
*/
// echo "retry: $ping\ndata: {$_SESSION['connectstatusmessagetxt']}\n\n";
?>


