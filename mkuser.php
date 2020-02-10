<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
// error_reporting( -1 );
// ini_set( 'display_errors', 1 );
include_once('lang.php');
$newuser=$_POST['newuser'];
$newpass=$_POST['newpass'];
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
// one page method below


if (($_POST['newuser'] !='null' ) && ($_POST['newuser'] !='' ) && ($_POST['newuser'] !='/' ) && ($_POST['newuser'] !='admin' ) && ($_POST['newuser'] !='Admin' )) 
{
// echo '<meta charset="UTF-8">';
echo "<meta HTTP-EQUIV='REFRESH' content='1; url=usermanager.php?rand=$rand&user=$newuser'>";
}

else
{
echo '';
}

?>
  <meta charset="UTF-8">
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title><?php echo $title; ?></title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
</head><body>


<table id='page_header'><tr><td>
        <a href='airscan.php'>
          <img id='logo' src='images/AirScan.png' alt='AirScan'>
        </a></td>

</tr>
	<tr><td><hr></td></tr>
</table>



<?php
if (($_SESSION['username'] == 'admin') && ($_SESSION['loggedin'] == 'yes') && ($pass=$_SESSION['password']))
{


  if ((($_POST['newuser'] != '' )  && ($_POST['newuser'] != '' ) && ($_POST['newuser'] != '/' ) && ($_POST['newuser'] != 'admin' ) && ($_POST['newuser'] != 'Admin' )) && (($_POST['newpass'] !='null' ) && ($_POST['newpass'] != '' ) && ($_POST['newpass'] != '/' )))
  {


    $mkuser1 = 'mkdir '.$filepath.$newuser;
    $mkdir1 = shell_exec($mkuser1);
    //echo "<pre>$mkdir1</pre><br/><br/>";

    $copytemplate1='cp usertemplate/index.php '.$filepath.$newuser;
    $copyindex1 = shell_exec($copytemplate1);
    //echo '<pre>'.$copytemplate.'</pre><br/><br/>';


    $mkuser2 = 'mkdir '.$usersfilespath.$newuser;
    $mkdir2 = shell_exec($mkuser);
    //echo "<pre>$mkdir2</pre><br/><br/>";

    // fopen("users/$newuser.php", "w")

    $newuserfile = fopen($usersfilespath.$_POST['newuser'].'.php', 'w') or die("Unable to open file!");
    $opentxt = "<?php\n";
    fwrite($newuserfile, $opentxt);
    $eol="\n";
//    $newpassword = '$pass = '.$_POST['newpass'].';';
//    fwrite($newuserfile, $newpassword);
//    fwrite($newuserfile, $eol);
//    $newpath = '$userpath = scans/'.$_POST['newuser'].';';

    $newpassword = '$pass = \''.$_POST['newpass'].'\';';
    fwrite($newuserfile, $newpassword);
    fwrite($newuserfile, $eol);
    //$newpath = '$userpath = $filepath.$_POST['newuser'].'/\';';
    // $newpath = '$userpath = \'scans/'.$_POST['newuser'].'/\';'
    //$newpath = '$userpath = $filepath.$_POST['newuser'].'/\';';
    $newpath = '$userpath = \''.$filepath.$_POST['newuser'].'/\';';

    fwrite($newuserfile, $newpath);
    fwrite($newuserfile, $eol);
    $closetxt = "?>\n";
    fwrite($newuserfile, $closetxt);
    fclose($newuserfile);

    echo '<br/><center><span style="color:#666; font-weight:bold">'.$newuser.' '.$createdsuccessfully.'</span><br/></center>';
    // echo "<br/><a href='usermanager.php?user=$newuser>Go back</a><br/>";
  }

  else 
  {
  echo '<br/><center>'.$sorryerror.'
<br/><br/>
<button onclick="goBack()">'.$goback.'</button>

<script>
function goBack() {
  window.history.back();
}
</script></center>';
  }

} 



else 
{
echo '<br/><center>'.$sorrymustlogin.'
<br/><br/>
<button onclick="goBack()">'.$goback.'</button>

<script>
function goBack() {
  window.history.back();
}
</script></center>';
}
echo $usersfilepath;
?>
</body></html>`
