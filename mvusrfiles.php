<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
include_once('lang.php');
include_once('config.inc.php');
// $destusr=$_GET['$to'];
// $confirm=$_GET['confirm'];

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
?>
<html><head>


<?php 
function GetUserpathFromUid($uid) 
{ 
  if (function_exists('posix_getpwuid')) 
  { 
    $a = posix_getpwuid($uid); 
    return $a['dir']; 
  } 
  # This works on BSD but not with GNU 
  elseif (strstr(php_uname('s'), 'BSD')) 
  { 
    exec('id -u ' . (int) $uid, $o, $r); 

    if ($r == 0) 
      return trim($o['0']); 
    else 
      return $uid; 
  } 
  elseif (is_readable('/etc/passwd')) 
  { 
    exec(sprintf('grep :%s: /etc/passwd | cut -d: -f1', (int) $uid), $o, $r); 
    if ($r == 0) 
      return trim($o['0']); 
    else 
      return $uid; 
  } 
  else 
    return $uid; 
}




function GetUsernameFromUid($uid) 
{ 
  if (function_exists('posix_getpwuid')) 
  { 
    $a = posix_getpwuid($uid); 
    return $a['name']; 
  } 
  # This works on BSD but not with GNU 
  elseif (strstr(php_uname('s'), 'BSD')) 
  { 
    exec('id -u ' . (int) $uid, $o, $r); 

    if ($r == 0) 
      return trim($o['0']); 
    else 
      return $uid; 
  } 
  elseif (is_readable('/etc/passwd')) 
  { 
    exec(sprintf('grep :%s: /etc/passwd | cut -d: -f1', (int) $uid), $o, $r); 
    if ($r == 0) 
      return trim($o['0']); 
    else 
      return $uid; 
  } 
  else 
    return $uid; 
}

if (is_numeric($_GET['touser']))
{
$source=$_SESSION["viewpath"];
$destination= GetUserpathFromUid($_GET['touser']).$pamscansdir;
$tousername= GetUsernameFromUid($_GET['touser']);
//$destination=$touserpath;	

}

else 
{
	if (file_exists($usersfilespath.$_GET['touser'].'.php')) 
	{
	include_once($usersfilespath.$_GET['touser'].'.php');
	$source=$_SESSION["viewpath"];
	$destination=$root.$userpath;
	$tousername=$_GET['touser'];
	}
}


if ($_GET['confirm'] =='yes' ) 
{
echo '<meta HTTP-EQUIV="REFRESH" content="10; url=usermanager.php?rand='.$rand.'&user='.$_GET['fromuser'].'">';
}

else 
{
echo '<meta HTTP-EQUIV="REFRESH" content="'.($_SESSION["expire"]-$now).' url=logout.php?sound=yes">';
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




</head><body>
<table id='page_header'><tr><td>
        <a href='/airscan.php'>
          <img id='logo' src='/images/AirScan.png' alt='AirScan'>
        </a></td></tr>
        <tr><td><hr></td></tr>
</table>










<?php

/*

//https://stackoverflow.com/questions/2889995/how-to-make-php-lists-all-linux-users
function getUsers() {
    $result = [];
    // @see http://php.net/manual/en/function.posix-getpwnam.php 
    $keys = ['name', 'passwd', 'uid', 'gid', 'gecos', 'dir', 'shell'];
    $handle = fopen('/etc/passwd', 'r');
    if(!$handle){
        throw new \RuntimeException("failed to open /etc/passwd for reading! ".print_r(error_get_last(),true));
    }
    while ( ($values = fgetcsv($handle, 1000, ':')) !== false ) {
        $result[] = array_combine($keys, $values);
    }
    fclose($handle);
    return $result;
}



$pamusers= getUsers();
$filtered = array_filter(
    $pamusers,
    function($a) use ($lowuid, $highuid) {
        return $a['uid'] >= $lowuid && $a['uid'] <= $highuid;
    }
);
$filtered_users = array_values($filtered);




foreach(array_keys($filtered_users) as $key => $value) //Lists PAM users
{

//$${$filtered_users[$value]["name"]}=$filtered_users[$value]["name"];
//$${'pampath'.$filtered_users[$value]["name"]}=$filtered_users[$value]["dir"].$pamscansdir;

//$copyto.$$filtered_users[$value]['name'].'name'=$filtered_users[$value]['name'];
//$copyto.$filtered_users[$value]['uid']=$filtered_users[$value]['uid'];
//$copyto.$filtered_users[$value]['name']=$filtered_users[$value]['dir'].$pamscansdir;

// if ($filtered_users[$value]["name"] != $_GET['fromuser'])
// {
echo $filtered_users[$value]["dir"];

//}
}
*/

/*
if (isnumeric($_GET['touser']))
{*/




?>

<?php
//echo $_SESSION["viewpath"].' to '.$_SESSION['copytopath'];
if (($_SESSION['loggedin'] == 'yes') && ($_SESSION['username'] == 'admin')&& ($_GET['fromuser'] != '*') && ($_GET['fromuser'] != NULL) && ($_GET['fromuser'] != 'admin') && ($_GET['fromuser'] != '') && ($_GET['fromuser'] != '/')) 
{
/*
echo "logged in as admin<br>";
echo 'user ';
echo $_GET['fromuser'];
echo '<br/> Session username';
echo $_SESSION['username'];
echo '<br/> confirm ';
echo $_GET['confirm'];
*/
	if ((isset($_GET['fromuser'])) && ($_GET['fromuser'] != NULL) && ($_GET['confirm'] !='yes' ))  
  	{
  	echo '<br/><br/><br/><center><p><span style="color:#666; font-weight:bold">'.$startquestion.$suremovefiles.' '.$from.' '.$_GET['fromuser'].' '.$to.' '.$tousername.$endquestion.'</span></p>';
 	echo '<table><tr><td>
    	<form name="confirmdeleteuser" method="get" action="'.$_SERVER["PHP_SELF"].'">
    	<input type="hidden" name="fromuser" value="'.$_GET['fromuser'].'">
        <input type="hidden" name="touser" value="'.$_GET['touser'].'">
    	<input type="hidden" name="confirm" value="yes">
    	<input type="submit" value="'.$confirm.'">
    	</form>
    	</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
    	<form name="canceleleteuser" method="post" action="usermanager.php?user='.$_GET['fromuser'].'&rand='.$rand.'"> 
	<input type="hidden" name="rand" value="'.$rand.'">    	
	<input type="submit" value="'.$cancel.'">
    	</form>
    	</td></tr></table></center>';
 	//echo 'test1';
	}



	elseif (($_GET['fromuser'] == 'admin') && ($_GET['confirm'] =='yes' )) 
	{
	//$_SESSION['copytopath'] = $filepath;  // this is default path in config
	//$destination=$touserpath;	
	$source=$filepath;
	//echo $source.' to '.$destination;
	}


	elseif ((isset($source)) && (isset($destination)) && ($_GET['touser'] != NULL) && ($_GET['touser'] != '') && ($_GET['fromuser'] != '') && ($_GET['fromuser'] != NULL) && ($_GET['fromuser'] != 'admin') && ($_GET['confirm'] =='yes' )) //&& ($_GET['PAM'] != 'yes')
	{
		//if ($preferphpcommands == 'yes')
		//{
		$files = scandir($source);

			foreach ($files as $file) 
			{
  				if (in_array($file, array(".","..","index.php", "index.htm", "index.html"))) continue;
  				// If we copied this successfully, mark it for deletion
  					if (copy($source.$file, $destination.$file)) 
					{
    					$delete[] = $source.$file;
  					}
				}
			// Delete all successfully-copied files
			foreach ($delete as $file) 
			{
				if (in_array($delete, array(".","..","index.php", "index.htm", "index.html"))) continue;
  				unlink($file);
			}
		//}
		
/*		else
		{
		$moveuserscans = 'cp '.$source.'. '.$destination; 
		shell_exec($moveuserscans);
		}*/
	$chmod='chmod 777 '.$destination.'*';
	ob_flush();
	flush();
	shell_exec($chmod);
	echo '<br/><br/><center><span style="color:#666; font-weight:bold">'.$filemovesuccess.$_GET['fromuser'].' '.$to.' '.$tousername.'
	<br/> '.$from.' '.$source.' '.$to.' '.$destination.'</span></center>';
	}
    













	else 
	{
	echo "<br/><br/><center><span style='color:#666; font-weight:bold'>$sorrymustlogin</span></center>";
	}
}
else 
{
echo "<br/><br/><center><span style='color:#666; font-weight:bold'>$sorrymustlogin</span></center>";
}
// echo $scansdelete;
//echo $source.' to '.$destination;
//echo '<br/>';
//echo $usersfilespath.$_GET['touser'].'.php';
//echo $userpath;
//echo $moveuserscans;
//echo '<br>';
//echo $chmod;
?>
</body></html>

