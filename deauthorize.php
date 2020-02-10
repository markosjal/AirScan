<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
include_once('lang.php');
include_once('config.inc.php');
echo '<html lang="'.$lang.'">';
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=/login.php">';
$pagehead='<meta charset="UTF-8">  
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>'.$pagetitle.'</title>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="/javascript/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<table id="page_header"><tr><td>
        <a href="airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td><hr></td></tr>';
echo '<head>'.$refreshurl.$pagehead.'</table><br/><p><center>'.$goodbye.'</center><br/></p>';
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);	
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();		
?>
