<?php
include_once 'phppagestart.php';
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
echo '<!DOCTYPE html>';
$_SESSION['pageurl']=$_SERVER['REQUEST_URI'];
$_SESSION['page']=basename($_SERVER['SCRIPT_FILENAME']);
$username= $_SESSION['username'];
// include_once('users/admin.php');  
include_once('lang.php'); 
include_once('config.inc.php');
$randtip=(rand(1, 4));
$usermanagerrandom=${'usermanagertip'.$randtip};
$_SESSION['viewuser']=$_GET['user'];
echo '<html lang="'.$lang.'">';
$now = time();
$_SESSION['fromfilelister']='usermanager';

//echo $_SESSION['password'];

if ($requireauth=='yes')
{
$upath=$_SESSION["userpath"];
}
else
{
$upath=$filepath;
}
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


$timeremaining=($_SESSION['expire'] - $now);



/*
if ($requireauth !='yes')
{
$logouturl='';
}

else
{
$logouturl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=login.php">';
}
*/

if (($requireauth=='yes') && (isset($_SESSION['username'])) && (isset($_SESSION['password'])) && (($_SESSION['expire']-$now)>0) && ($_SESSION['loggedin']== 'yes'))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
}
else
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$loginrefresh.'; url=/logout.php">';
}



/*

if ((($_SESSION['expire'] - $now)>=1) && ( $_SESSION['loggedin'] == 'yes') && ($_SESSION['username'] == 'admin'))
{
$refreshurl='';
}
else
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=login.php">';
}

*/
$pagehead='<meta charset="'.$charset.'">
<meta http-equiv="Cache-Control" content="private, no-store" />
<meta name="Expires" content="'.$rfc_1123_date.'">
<meta name="viewport" content="width=device-width, initial-scale=1">   
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta http-equiv="content-type" content="text/html; charset='.$charset.'">
<title>'.$pagetitle.'</title>
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/site.webmanifest">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#777aff">
<meta name="msapplication-TileColor" content="#ff0000">
<meta name="theme-color" content="#777AFF">




<link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="/javascript/jquery.min.js" type="text/javascript"></script>
<script src="/javascript/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link href="/css/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />


<style>


/* begin modal */
body {
  font-family: Arial, Helvetica, sans-serif;
}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {
  opacity: 0.7;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 20px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: auto;
  max-width: 90%;
  height: auto;
  max-height: 90%;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 50%;
  max-width: auto;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 70px;
}

/* Add Animation */
.modal-content,
#caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {
    -webkit-transform: scale(0);
  }
  to {
    -webkit-transform: scale(1);
  }
}

@keyframes zoom {
  from {
    transform: scale(0);
  }
  to {
    transform: scale(1);
  }
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
  .modal-content {
    width: 100%;
  }
}
/* end modal */

/* begin overlay */


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


/*drop downs*/


/* -------------------- Select Box Styles: bavotasan.com Method (with special adaptations by ericrasch.com) */
/* -------------------- Source: http://bavotasan.com/2011/style-select-box-using-only-css/ */
.styled-select {
   background: url(/images/15xvbd5.png) no-repeat 96% 0;
   height: 25px;
   overflow: hidden;
   width: 92px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 13px;
   font-weight: bold;
   height: 25px;
   padding: 0px; /* If you add too much padding here, the options wont show in IE */
   width: 90px;
}

.styled-select.slate {
   background: url(/images/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #ddd; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #666; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
   background: #58B14C url("/images/15xvbd5.png") no-repeat scroll 319px center;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(/images/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
}

select#soflow-color {
   color: #fff;
   background-image: url(/images/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}
</style>
</head>
<body>
<table id="page_header"><tr><td>
        <a href="airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td><hr></td></tr><tr><td>';






//https://stackoverflow.com/questions/2889995/how-to-make-php-lists-all-linux-users
function getUsers() {
    $result = [];
    /** @see http://php.net/manual/en/function.posix-getpwnam.php */
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

//print_r($filtered_users);
//$_SESSION['filteredpamusers']=$filtered_users;

$pamkey = array_search($_GET['user'], array_column($filtered_users, 'name'));
if ($_GET['PAM'] == 'yes')
{
$pamdir=($filtered_users[$pamkey]['dir']).$pamscansdir;
}
//echo $pamdir;
//echo $pamkey;
//$_SESSION['pamkey']=$pamkey;
//echo $_SESSION['pamkey']; 

//echo $_SESSION['filtered_users']['kodi']['dir'];

// echo $_SESSION['viewpath'];

//$_SESSION['viewpath'] = $_SESSION['filtered_users'][25]['dir'];

///echo $usersfilespath.$_GET['user'];
//echo $_SESSION['viewpath'];

if (($_GET['user'] != 'admin') && ($_GET['PAM'] != 'yes'))
{
include_once($usersfilespath.$_GET['user'].'.php');  
$_SESSION['viewpath'] = $userpath;
}

elseif (($_GET['user'] != 'admin') && ($_GET['PAM'] == 'yes'))
{  
$_SESSION['viewpath'] = $pamdir;
}
elseif ($_GET['user'] == 'admin')
{
$_SESSION['viewpath'] = $filepath;
}
else
{
$_SESSION['viewpath'] = $userpath;
// $_SESSION['viewpath']='scans/'.$_GET["user"].'/';
}


echo '<head>'.$refreshurl.$pagehead; 
// echo ($_SESSION['expire'] - $now);
include'livemenu.php';
?>


</td></tr></table>
<center>

<?php

if ((($_SESSION['expire'] - $now) <= 0) || ( $_SESSION['loggedin'] != 'yes') || ($_SESSION['username'] != 'admin'))
{
			echo'</table><br/><p><center><span style="color:#666; font-weight:bold">'.$goodbye.'</span></center><br/></p>';
			session_unset($_SESSION["loggedin"]);
			session_unset($_SESSION["expire"]);
			session_unset($_SESSION["username"]);
			session_unset($_SESSION["password"]);
			session_unset($_SESSION["userpath"]);
			session_unset($_SESSION['scanneronline']);
			session_unset($_SESSION['fromuserfolder']);
			session_unset($_SESSION['fromuserfilelister']);
        		session_destroy();	
			exit();	
// $refreshurl='<meta HTTP-EQUIV="REFRESH" content="2; url=login.php">';
}

elseif (($_SESSION['username'] == 'admin') && ( $_SESSION['loggedin'] == 'yes') && (($_SESSION['expire'] - $now)>=1)) 

{ // so you logged in eh?

// $_SESSION['loggedin'] ='yes';
$user=$_GET['user'];
$prefix = 'scans/';
$directories = glob('scans' . '/*' , GLOB_ONLYDIR);
/* xyz  this just fixes display in nano */
$count = count($directories);
//echo $usermanagerrandom;



//echo $pamdir;












if ($showtips=='yes')
	{
	echo '<br/><span style="color:#A80; font-weight:bold">'.$usermanagerrandom.'</span><br/><br/>';
	}
	else
	{
	}
echo '<table border=0 style="width: 70%"><tr></td><td style="width:20%; text-align: center"></td><td style="width:30%; text-align: center"><table border=0 style="width:50%; text-align: center"><tr><td style="vertical-align:top; width:50%; text-align: center">';


echo '<table border=0 cellpadding=3 cellspacing-4 style="text-align: center"><tr><th colspan=2 style="text-align: center">';

echo '<span style="color:#666; font-weight:bold">'.$multipleusers.'</span></th></tr><tr><td colspan=2><hr/></td></td>';

//$showcopyfromadmin='no';
if ($showcopyfromadmin=='yes')
{
echo '<tr><td><a href=\'usermanager.php?user=admin\'><span style="color:#777AFF; font-weight:bold; font-weight:bold">admin</span></a></td><td><span style="color:#666; font-weight:bold; font-weight:bold"> '.$_SESSION['password'].'</span></td></tr>';

}
else
{
echo '';
}


for($i=0;$i<$count;$i++)
{
    	if ($directories[$i] != 'scans/PDF') 
	{
	// if (substr($str, 0, strlen($prefix)) == $prefix) 
	echo '<tr><td><a href=\'usermanager.php?user='.substr($directories[$i], strlen($prefix)).'&PAM=no&rand='.$rand.'\'><span style="color:#777AFF; font-weight:bold; font-weight:bold">'.substr($directories[$i], strlen($prefix)).'</span></a></td><td><span style="color:#666; font-weight:bold; font-weight:bold"> '.$_SESSION['password'].'</span></td></tr>';
	}
	else 
	{
	echo '';
	}
}
// echo $filtered_users[25]['dir'];
foreach(array_keys($filtered_users) as $key => $value) //Lists PAM users
{

$pamname=$filtered_users[$value]['name'];
echo "<tr><td><a href='usermanager.php?user=$pamname&PAM=yes&rand=$rand'><span style='color:#777AFF; font-weight:bold; font-weight:bold'>$pamname</span>";
echo '</a></td><td><span style="color:#666; font-weight:bold; font-weight:bold">PAM</span></td></tr>';
}

//print_r ($filtered_users);


echo '</table></td></tr></table><td style="width:50%; text-align: center" ><table border=0 style="width:70%;"><tr><td style="text-align: center">'
?>


<p>
<span style="color:#666; font-weight:bold"><?php echo $makenewuser;?></span></p>
<form name="makeuser" method="post" action="mkuser.php">

  <span style="color:#666; font-weight:bold"><?php echo $newusername;?></span><br/>
  <input style="width: 150px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" type="text" name="newuser" value=""><br/><br/>

  <span style="color:#666; font-weight:bold"><?php echo $newuserpass;?></span><br/>
  <input style="width: 150px; height: 15px; color:#666; background-color: #DDD; font-weight:bold" type="text" name="newpass" value=""><br/><br/>
  <input type="submit" value="<?php echo $submittxt;?>">
</form>

</td></tr></table>
</td></tr></table>







<table border =0 align='center' cellpadding=0 cellspacing=0 width='70%'>
<tr>
<td colspan=2><hr></td></tr><tr><td>
<center><p><span style="color:#666; font-weight:bold">

<?php

if (($user  != NULL) && ($user  != ''))
{
 echo $selecteduseris.' '.$user; 
 echo '</span></p></center>';
}

else 
{
echo '';
}

//echo $_SESSION['viewpath'];
?>








<?php
if ((isset($_GET['user'])) && ($_GET['user'] !='') && ($_GET['user'] !=NULL))
{
echo '<table align="center" border=0 align="center"><tr><td style="vertical-align: bottom"><table border=0 color=#666><tr><td>
<span style="color:#666; font-weight:bold">'.$moveuserfilesto.'</span></td><td style="vertical-align: bottom">';
echo'<form method="get" action="/mvusrfiles.php">
<div class="styled-select blue semi-square">
<input type="hidden" name="fromuser" value="'.$_GET['user'].'">
	  <select name="touser">';
if (($showcopytoadmin=='yes') && ($_GET['user'] != 'admin'))
{
echo'<option value="admin">admin</option>';
}

else 
{
echo '';
} 

for($i=0;$i<$count;$i++)  ///lists text users
{
	if (substr($directories[$i], strlen($prefix)) != $_GET['user'] )
	{
	echo'<option value="'.substr($directories[$i], strlen($prefix)).'">'.substr($directories[$i], strlen($prefix)).'</option>';;


	}
	else 
	{
	echo '';
	}
}

foreach(array_keys($filtered_users) as $key => $value) //Lists PAM users
{

$${$filtered_users[$value]["name"]}=$filtered_users[$value]["name"];
$${'pampath'.$filtered_users[$value]["name"]}=$filtered_users[$value]["dir"].$pamscansdir;

//$copyto.$$filtered_users[$value]['name'].'name'=$filtered_users[$value]['name'];
//$copyto.$filtered_users[$value]['uid']=$filtered_users[$value]['uid'];
//$copyto.$filtered_users[$value]['name']=$filtered_users[$value]['dir'].$pamscansdir;

if ($filtered_users[$value]["name"] != $_GET['user'])
{
echo '<option value="'.$filtered_users[$value]["uid"].'" name="touser">'.$filtered_users[$value]["name"].'</option>';

}
}



echo   '</select>';


//<input type="hidden" name="pampath" value="'.$$pampath.$$filtered_users.'">


  echo'</td></tr><tr><td align = "center" colspan=2>



  <input type="submit" value="'.$submittxt.'">

</div></form>';
echo '</td></tr></table></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="vertical-align: bottom">';
}

else 
{
echo '';
}


if ($_GET['PAM']=='yes')
{
$pass='PAM';
}


//echo $pass;

if ($pass !='PAM')
{
$deleteuserbutton='<br/><form name="deleteuser" method="get" action="deluser.php">
 <input type="hidden" name="deluser" value="'.$user.'">
  <input type="submit" value="'.$deleteuser.$user.' ">
</form>';
}

elseif ($pass =='PAM')
{
$deleteuserbutton='<br/><form name="deleteuser" method="get" action="deluser.php">
 <input type="hidden" name="deluser" value="">
  <input type="submit" value="PAM" disabled>
</form>';
}


if ($confirmuserlogin =='yes')
{
$loginasuserbutton='<br/><form name="loginasuser" method="post" action="loginasuser.php">
 <input type="hidden" name="userfromadmin" value="'.$user.'">
 <input type="hidden" name="passfromadmin" value="'.$pass.'">
  <input type="submit" value="'.$loginasuser.$user.' ">
</form>';
}

elseif ($confirmuserlogin != 'yes')
{
$loginasuserbutton='<br/><form name="loginasuser" method="post" action="login.php">
 <input type="hidden" name="userfromadmin" value="'.$user.'">
 <input type="hidden" name="passfromadmin" value="'.$pass.'">
  <input type="submit" value="'.$loginasuser.$user.' ">
</form>';
}
else
{
}

if (($user  != NULL) && ($user  != ''))
{

echo '<table align="center" border=0 align="center"><tr><td>'.$loginasuserbutton.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.$deleteuserbutton.'</table>';
}
else 
{
echo '';
}


/*




if (($user  != NULL) && ($user  != ''))
{
echo '<span style="color:#55555; font-weight:bold">'.$selecteduseris.' '.$user.'. '.$passwordforuseris.' '.$pass.'. '.$scannedimagesarein.' '.$userpath.'.</span>';
}
else 
{
echo '<span style="color:#55555; font-weight:bold">'.$nouserselected.'.</span>';
}
*/




?>
</td>

</tr><tr><td colspan='5'>


<?php 
/*

$deleteuserbutton='<br/><form name="deleteuser" method="post" action="deluser.php">
 <input type="hidden" name="deluser" value="'.$user.'">
  <input type="submit" value="'.$deleteuser.$user.' ">
</form>';

$loginasuserbutton='<br/><form name="loginasuser" method="post" action="login.php">
 <input type="hidden" name="userfromadmin" value="'.$user.'">
 <input type="hidden" name="passfromadmin" value="'.$pass.'">
  <input type="submit" value="'.$loginasuser.$user.' ">
</form>';
*/
//if ($_GET['PAM']=='yes')
//{
//$pass='PAM';
//}
if (($user  != NULL) && ($user  != '')&& ($_GET['PAM']!='yes'))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$passwordforuser.' '.$user.' '.$is.' '.$pass.'. '.$scannedimagesarein.' '.$root.$userpath.'.</span></p></center>';
}

elseif (($user  != NULL) && ($user  != '') && ($_GET['PAM'] =='yes'))
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$passwordforuser.' '.$user.' '.$is.' '.$pass.'. '.$scannedimagesarein.' '.$_SESSION['viewpath'].'.</span></p></center>';
}
else //(($user  != NULL) || ($user  != '') 
{
echo '<table align="center" border=0 align="center"><tr><td><span style="color:#F44; font-weight:bold">'.$nouserselected.'.</span></td><tr></table>';
}






/*



if (($user  != NULL) && ($user  != ''))
{

echo '<table align="center"><tr><td>'.$loginasuserbutton.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.$deleteuserbutton.'</td></tr></table>';
}
else 
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
}

*/




//</td></tr></table>
?>

</td></tr></table>


<?php
echo "<table width='100%' border=0>";
if ((isset($user)) && ($user!='') && ($user!=NULL))
{
echo '<tr><td><hr></td></tr><tr align="center"><td>';
// echo $user;
include_once('afilelister.php');
echo '';
}


else {echo '<br/><br/>';}


// $listcmd= 'ls -l ustv/'.$user;

// $output = shell_exec($listcmd);

//echo "<tr><td> <pre>$output</pre>
echo "</td></tr></table></td></tr></table></center>";
?>

<br/>
<?php /*

<form name="deleteuser" method="post" action="deluser.php">
 <input type="hidden" name='deluser' value='<?php echo $user;?>'>
  <input type="submit" value="Delete user <?php echo $user;?> ">
 */
?>

<?php
}
if (($_GET['user']!='') || ($_GET['user']!=NULL))
{
include_once('footer.inc.php');
}
?>


<script type="text/javascript">
//check for browser support
if(typeof(EventSource)!=="undefined") {
        //create an object, passing it the name and location of the server side script
        var statusSource = new EventSource("checklogin.php");
        //detect message receipt
        statusSource.onmessage = function(event) {
                //write the received data to the page
                document.getElementById("loginStatus").innerHTML = event.data;
        };
}
else {
        document.getElementById("loginStatus").innerHTML="<?php echo $nosupporttxt;?>";
}
</script>


<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>


</body>
</html>



