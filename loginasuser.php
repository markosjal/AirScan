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

if (($_SESSION['viewuser'] =='*') || ($_SESSION['viewuser'] =='') || ($_SESSION['viewuser']  =='/')) {
$deluser='NULL';
}
else {
$deluser=$_SESSION['viewuser'] ;
}

?>
<html><head>


<?php 

if ($_POST['confirm'] !='yes' ) 
{
echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION["expire"]-$now).' url=logout.php&sound=yes">';
}
else
{
}

?>	
  <meta charset="UTF-8">
  <meta name="author" content="root">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
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
          <tr><td><hr></td></tr><tr><td>
<?php include_once 'livemenu.php';?>

</td></tr></table>
<?php
// echo $_POST['user'];
// echo $_POST['pass'];
// echo $_SESSION['username'];
if (($_SESSION['loggedin'] == 'yes') && ($_SESSION['username'] == 'admin')) 
  	{
	
  	if ((isset($_POST['userfromadmin'])) && (isset($_POST['passfromadmin'])) && ($_SESSION['username'] == 'admin'))  
  	{
	echo '<br/><br/><br/><center><span style="color:#666; font-weight:bold"><p>'.$logoutadmin.$_POST["userfromadmin"].'.</p>';
  	?>
    	</span><table><tr><td>
    	<form name="confirmloginasuser" method="post" action="/login.php">
    	<input type="hidden" name='userfromadmin' value='<?php echo $_POST['userfromadmin']; ?>'>
    	<input type="hidden" name='passfromadmin' value='<?php echo $_POST['passfromadmin']; ?>'>
    	<input type="submit" value="<?php echo $confirm; ?> ">
    	</form>
    	</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
    	<form name="cancelloginuser" method="post" action="usermanager.php?rand=<?php echo $rand; ?>&user=<?php echo $_POST['userfromadmin']; ?>">
    	<input type="submit" value="<?php echo $cancel; ?>">
    	</form>
    	</td></tr></table></center>
        <?php 
		if (($_POST['confirm'] =='yes' ) && ( $_SESSION['loggedin'] =='yes') && ($_POST['deluser'] != 'null') && ($_POST['deluser'] != 'admin') && ($_POST['deluser'] != '') && ($_POST['deluser'] != '/')) {
//        $userdelete = "rm -r users/$deluser";
//        $scansdelete = "rm -r scans/$deluser";
 //       $userdelete = 'rm users/'.$deluser.'.php';
//         $scansdelete = "rm scans/$deluser/*";

//        $deletethisuser = shell_exec($userdelete);



//	$deletethisuser = shell_exec('rm users/'.$deluser.'.php');
//        $deletethisscan = shell_exec("rm -r scans/$deluser");




        // echo "<pre>$deletethisuser</pre><br/>";
        // echo $userdelete ;
        echo "<center><span style='color:#666; font-weight:bold'>$userdeletesuccess<span></center>";
        // echo "<br/><a href='mark.php'>Go back</a><br/>";
         }
    }
}


else {
echo "<br/><br/><center><span style='color:#666; font-weight:bold'>$sorrymustlogin</span></center>";
}

// echo $scansdelete;
include_once 'livemenujs.php';
?>

</body></html>
