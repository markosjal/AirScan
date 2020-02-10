<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>';
include_once('config.inc.php');
include_once('lang.php');
// session_destroy();
session_unset($_SESSION["loggedin"]);
session_unset($_SESSION["expire"]);
session_unset($_SESSION["username"]);
session_unset($_SESSION["password"]);
session_unset($_SESSION["userpath"]);
session_unset($_SESSION['scanneronline']);
session_unset($_SESSION['fromuserfolder']);
session_unset($_SESSION['fromuserfilelister']);
$now = time();

$_SESSION['testparam'] = 'yes';
echo '<html lang="'.$lang.'">';
?>

<head>
  <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="root">
  <meta name="robots" content="noindex">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title><?php echo $pagetitle; ?></title>
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/site.webmanifest">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#777aff">
<meta name="msapplication-TileColor" content="#ff0000">
<meta name="theme-color" content="#777AFF">
  <link rel="stylesheet" href="css/style.css" type="text/css" />

</head>

<?php
/*
if ($sound=='doorbell')
{
$soundfile='/jetsndb.wav';
}
elseif ($sound=='car')
{
$soundfile='/jetson5.wav';
}
elseif ($sound=='none')
{
$soundfile='';
}
*/
?>
<body>

<table id='page_header'><tr><td>
        <a href='airscan.php'>
          <img id='logo' src='/images/AirScan.png' alt='AirScan'> 

<?php
if ($demomode=='yes')
{
	if ($lang=='es')
	{
	echo '<a href="http://airscan.teknogeekz.com/login.php"><span style="font-size: large; float: right; color:#777AFF; font-weight:bold"> <br/>English</span></a>';
	}
	elseif ($lang=='en')
	{
	echo '<a href="http://airscan.tecnologiadeleon.com/login.php"><span style="font-size: large; float: right; color:#777AFF; font-weight:bold"> <br/>Español</span></a>';
	}
	else
	{
	echo '<a href="http://airscan.tecnologiadeleon.com/login.php"><span style="font-size: large; float: right; color:#777AFF; font-weight:bold"> <br/>Español</span></a>';
	}
}
else 
{
}
?>
        </a></td>
</tr>
	<tr><td><hr></td></tr>
</table>

<center>
<p><b><span style='color:#666; font-weight:bold'><?php echo $loginmessage;?></span></b></p>
<?php /*
<br/><br/>
<table align='center'><tr><td>
*/ ?>

<form action="airscan.php" method="post"><table border=0>
  <tr>
    <td><p><span style='color:#666; font-weight:bold'><?php echo $usertxt;?></span></p></td>
    <td><input type="text" name="username" value ="<?php echo $_POST['userfromadmin']; ?>" id="username" style="width: 150px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" /></td>
  </tr>



 <tr>
    <td><p><span style='color:#666; font-weight:bold'><?php echo $passtxt;?></span></p></td>
    <td><input type="password" name="password" value="<?php echo $_POST['passfromadmin']; ?>" id="password" style="width: 150px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" /></td></tr>
<tr style="vertical-align: middle"><td></td><td>
	<input style="color:#666; font-weight:bold" type="checkbox" onclick="myFunction()"><span style='vertical-align: middle; color:#666; font-weight:bold'><?php echo ' '.$showpassword; ?></span>
</td>
  </tr>
  <tr>
    <td colspan="2"><p></p></td>
  </tr>
  <tr>
    <td></td><td><input type="submit" value="<?php echo $submittxt;?>"></td>
</tr>

</table></form>
<?php
// echo $lang;
if ($demomode=='yes')
{
	if ($lang=='es')
	{
	echo '<span style="color:#666; font-weight:bold"><br/><br/>Aquí es el demo en vivo de AirScan por Tecnologiadeleon.com 
		.<br/><br/>Usa usuario/contraseña admin/Teknogeekz para entrar comos admin o Lenny/Hello para entrar como usuario.<br/><br/>
		</span><table><th><span style="color:#666; font-weight:bold">AirScan soporte los siguientes escaneros:</span></th><tr><td><span style="color:#666; font-weight:bold">
		<ul><li>ION AirCopy</li>
		<li>ION AirCopy E-Post Edition</li>
		<li>Halo Magic Scanner</li>
		<li>Mustek iScan Air / S400W</li>
		<li>Century CPS-A4WF</li>
		<li>Transcription Patri Kun A4 Wi-Fi Portable Scanner</li>
		<li>転写パットリくん A4 Wi-Fiポータブルスキャナー</li></ul></td></tr></table>
		</span>
		<br><a href="http://airscan.tecnologiadeleon.com"><span style="font-size: large; color:#777AFF; font-weight:bold">
		Más información</span></a>';
	}
	elseif ($lang=='en')
	{
	echo '<span style="color:#666; font-weight:bold"><br/><br/>This is a live demo of our AirScan product by 
		Teknogeekz.com.<br/><br/>Use user/pass admin/Teknogeekz to enter as admin or Lenny/Hello to enter as a user.<br/><br/>
		</span><table><th><span style="color:#666; font-weight:bold">AirScan supports the following scanners:</span></th><tr><td><span style="color:#666; font-weight:bold">
		<ul><li>ION AirCopy</li>
		<li>ION AirCopy E-Post Edition</li>
		<li>Halo Magic Scanner</li>
		<li>Mustek iScan Air / S400W</li>
		<li>Century CPS-A4WF</li>
		<li>iScan Fly</li>
		<li>Transcription Patri Kun A4 Wi-Fi Portable Scanner</li>
		<li>転写パットリくん A4 Wi-Fiポータブルスキャナー</li></ul></td></tr></table>
		</span><br><a href="http://airscan.teknogeekz.com"><span style="font-size: large; color:#777AFF; font-weight:bold">
		More information</span></a>';
	}
	else
{
	echo '<span style="color:#666; font-weight:bold"><br/><br/>This is a live demo of our AirScan product by 
		Teknogeekz.com.<br/><br/>Use user/pass admin/Teknogeekz to enter as admin or Lenny/Hello to enter as a user.<br/><br/>
		</span><table><th><span style="color:#666; font-weight:bold">AirScan supports the following scanners:</span></th><tr><td><span style="color:#666; font-weight:bold">
		<ul><li>ION AirCopy</li>
		<li>ION AirCopy E-Post Edition</li>
		<li>Halo Magic Scanner</li>
		<li>Mustek iScan Air / S400W</li>
		<li>Century CPS-A4WF</li>
		<li>iScan Fly</li>
		<li>Transcription Patri Kun A4 Wi-Fi Portable Scanner</li>
		<li>転写パットリくん A4 Wi-Fiポータブルスキャナー</li></ul></td></tr></table>
		</span><br><a href="http://airscan.teknogeekz.com"><span style="font-size: large; color:#777AFF; font-weight:bold">
		More information</span></a>';
	}
}
else 
{
}
 /*
</table>

<form target="_blank" action="status.php" method="post">
Gmail email address:</td><td><input type="text" name="gmail" value ="" >
<i>This MUST be the same Gmail that has this Google Voice account</i><br/><br/><br/>

Google Voice Phone Number: <input type="text" name="gvnumber" value ="" ><br/>
<i>This must be 10 digits not staring with "1". Purely numeric.<br/>No dashes, Spaces, nor parenthesis</i><br/><br/><br/>

Password: <input type="text" name="token" value ="" ><br/>
<i>This is also referred to as "Refresh Token".</i><br/><br/><br/>

<input type="submit">
</form>
</td></tr><table>

*/ ?>
</center>
<?php /*
if ($_GET['sound']=='yes')
echo'<audio autoplay> 
  <source src="'.$soundfile.'">
</audio>';
*/ ?>

<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>

</html>

