<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
include_once('lang.php');
include_once('config.inc.php');
$now=time();
if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
	if (($_SESSION['expire'] - $now) <= $addtime)
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
if (($_GET['deluser'] =='*') || ($_GET['deluser'] =='') || ($_GET['deluser']  =='/') || ($_GET['deluser'] !=$_GET['deluser'])) {
$deluser=NULL;
}
else {
$deluser=$_GET['deluser'] ;
}

?>
<html><head>


<?php 
if (($_SESSION['username'] != 'admin') || ($_SESSION['loggedin'] != 'yes')  )
{
echo "<meta HTTP-EQUIV='REFRESH' content='1 url=logout.php'>";
}

elseif (($_GET['confirm'] =='yes' ) && ($_SESSION['loggedin'] == 'yes') && (isset($_GET['deluser'])) && ($_GET['deluser'] != NULL) && ($_GET['deluser'] != '') && ($_SESSION['username'] == 'admin')) 
{
echo "<meta HTTP-EQUIV='REFRESH' content='$deleterefresh url=usermanager.php?rand=$rand'>";
}

elseif (($_GET['confirm'] !='yes' ) && ($_SESSION['loggedin'] == 'yes') && (isset($_GET['deluser'])) && ($_GET['deluser'] != NULL) && ($_GET['deluser'] != '') && ($_SESSION['username'] == 'admin')) 
{
echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION["expire"]-$now).' url=logout.php&sound=yes">';
}

elseif (($_SESSION['username'] != 'admin') || ($_SESSION['loggedin'] != 'yes')  )
{
echo "<meta HTTP-EQUIV='REFRESH' content='1 url=logout.php'>";
}

?>	
<meta charset="UTF-8">
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title><?php echo $pagetitle; ?></title>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/css/style.css" type="text/css" />

<style>
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
</style>

</head><body>
<table id='page_header'><tr><td>
        <a href='/airscan.php'>
          <img id='logo' src='/images/AirScan.png' alt='AirScan'>
        </a></td></tr>
        <tr><td><hr></td></tr>
<tr><td>
<?php include_once 'livemenu.php';?>

</td></tr></table>
<?php
if (($_SESSION['loggedin'] == 'yes') && ($_SESSION['username'] == 'admin')) 
{
//if (isset($_GET['deluser'])){
 	if ((isset($_GET['deluser'])) && ($_GET['deluser'] != NULL) && ($_SESSION['username'] == 'admin') && ($_GET['confirm'] != 'yes'))  
	{
  	echo "<br/><br/><br/><center><p><span style='color:#666; font-weight:bold'>$suredeleteuser $deluser? $thiswilldeletscans</span></p>";
  ?>
    <table><tr><td>
    <form name="confirmdeleteuser" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name='deluser' value='<?php echo $deluser;?>'>
    <input type="hidden" name='confirm' value='yes'>
    <input type="submit" value="<?php echo $confirm; ?> ">
    </form>
    </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
    <form name="canceleleteuser" method="post" action="usermanager.php?rand=<?php echo $rand;?>&user=<?php echo $deluser;?>">
    <input type="submit" value="<?php echo $cancel; ?>">
    </form>
    </td></tr></table></center>
        <?php }

	elseif (($_GET['confirm'] =='yes' ) && ($_GET['deluser'] != '*') && ($_GET['deluser'] != NULL) && ($_GET['deluser'] != 'admin') && ($_GET['deluser'] != '') && ($_GET['deluser'] != '/'))
 	{
	$deletethisuser = shell_exec('rm '.$usersfilespath.$deluser.'.php');
        $deletethisscan = shell_exec('rm -r '.$filepath.$deluser);
        echo "<center><p><span style='color:#666; font-weight:bold'>$userdeletesuccess</span></p></center>";
        // echo "<br/><a href='mark.php'>Go back</a><br/>";
         }
    
}


else {
echo "<br/><br/><center><span style='color:#666; font-weight:bold'>$sorrymustlogin</span></center>";
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);	
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
session_destroy();

}

/*
echo '<br>confirm '.$_GET['confirm'] ;
echo '<br>loggedin '.$_SESSION['loggedin'] ;
echo '<br>deluser '.$_GET['deluser']; 
echo '<br>username '.$_SESSION['username']; 
*/
// echo $scansdelete;
include_once 'livemenujs.php';
?>
</body></html>





