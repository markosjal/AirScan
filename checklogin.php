<?php
include_once 'phppagestart.php';
include_once 'lang.php';
include_once 'config.inc.php';
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
$now = time();
$logininsec = ($_SESSION['expire'] - $now);
if (( $requireauth == 'yes' ) && ( $_SESSION['loggedin'] == 'yes' ) && ( $_SESSION['expire'] > ($now + $addtime) ))
{
	if (round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN) == 1 )
	{
	$min=$minute;
	}

	else
	{
	$min=$minutes;
	}
$loginmessagetxt='<span style="font-size: larger; color:#484; font-weight:bold">'.$sessionexpiresin.round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN).$min.'</span>' ;
}



elseif (( $requireauth == 'yes' ) && ( $_SESSION['loggedin'] == 'yes' ) && ( $_SESSION['expire'] <= ($now + $addtime)) && (($_SESSION['expire'] - $now) > 120))
{
	if (round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN) == 1 )
	{
	$min=$minute;
	}

	else
	{
	$min=$minutes;
	}
	if ($_SESSION['fromfilelister']!='imageedit')
	{
	$loginmessagetxt='<span style="font-size: larger;  color:#A80; font-weight:bold">'.$sessionexpiresin.round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN).$min.'</span></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$increasetime ;
	}
	elseif ($_SESSION['fromfilelister']=='imageedit')
	{
	$loginmessagetxt='<span style="font-size: larger;  color:#A80; font-weight:bold">'.$sessionexpiresin.round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN).$min.'</span></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	

}

elseif (( $requireauth == 'yes' ) && ( $_SESSION['loggedin'] == 'yes' ) && ( $_SESSION['expire'] <= ($now + $addtime)) && (($_SESSION['expire'] - $now) > 0))
{
	if (round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN) == 1 )
	{
	$min=$minute;
	}
	else
	{
	$min=$minutes;
	}

	if ($_SESSION['fromfilelister']!='imageedit')
	{
	$loginmessagetxt='<span style="font-size: larger;  color:#F44; font-weight:bold">'.$sessionexpiresin.round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN).$min.'</span></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$increasetime ;
	}
	elseif ($_SESSION['fromfilelister']=='imageedit')
	{
	$loginmessagetxt='<span style="font-size: larger;  color:#F44; font-weight:bold">'.$sessionexpiresin.round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN).$min.'</span></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	}
}


elseif (( $requireauth == 'yes' ) && ( $_SESSION['loggedin'] == 'yes' ) && (($_SESSION['expire'] - $now) <= 0))
{
// $logininsec = ($_SESSION['expire'] - $now);
$loginmessagetxt='<span style="font-size: larger; color:#F44; font-weight:bold">'.$sessionexpired.'</span></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/login.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$login.'</span></a>';
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();
// $loginjsrefresh = '7200000';
// $loginmessagetxt= '<script>
// function myFunction() {
//   location.reload();
// }
// </script>';
}
/*
elseif (( $requireauth == 'yes' ) && ( $_SESSION['loggedin'] == 'yes' ) && (($_SESSION['expire'] - $now) <= 0))
{
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);
session_destroy();
$loginmessagetxt= '<script>
function myFunction() {
  location.reload();
}
</script>';
}
*/
elseif ($requireauth !='yes')
{
$loginmessagetxt= '';
}

else
{
// $logininsec = ($_SESSION['expire'] - $now);
$loginmessagetxt='<span style="font-size: larger; color:#F44; font-weight:bold">'.$sessionexpired.'</span></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/login.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$login.'</span></a>';
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();
// $loginjsrefresh = '7200000';
}

// echo $_SESSION['expire'];

echo "retry: $loginjsrefresh\n\ndata: {$loginmessagetxt}\n\n";
/*
elseif (( $requireauth == 'yes' ) && ( $_SESSION['loggedin'] == 'yes' ) && ( $_SESSION['expire'] >= $now ) &&    ($_SESSION['expire'] - $now) <= $addtime))
{
$loginmessagetxt=$sessionexpiresin.round(($logininsec / 60),  0, PHP_ROUND_HALF_DOWN).$increasetime ;
}
*/
?>

