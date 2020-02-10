<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);
session_unset($_SESSION["scanneronline"]);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();
include_once('lang.php');
include_once('config.inc.php');
if ($_GET['sound']=='yes')
{
echo'<audio autoplay> 
  <source src="'.$soundfile.'">
  </audio>';
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$logoutrefresh.'; url=login.php">';
}
else
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$loginrefresh.'; url=login.php">';
}
?>

<!DOCTYPE html>
<?php echo '<html lang="'.$lang.'">';
?>
<head>
  <meta charset="UTF-8">
<?php echo $refreshurl;?>
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pagetitle; ?></title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>

<table id='page_header'><tr><td>
        <a href='airscan.php'>
          <img id='logo' src='images/AirScan.png' alt='AirScan'>
        </a></td>
</tr>
        <tr><td><hr></td></tr>
</table>
<br/>
<br/>
<?php echo '<center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center>';
/*
echo '  Require auth?  '.$requireauth;
echo '<br>  logged in? '.$_SESSION['loggedin'];
echo '<br>  expires at  '.$_SESSION['expire'];
echo '<br>  NOW is  '.$now;
echo '<br>  expires in '.($_SESSION['expire']-$now);
echo '<br>  SessionID '.session_id();
*/

?>
</body>
</html>
