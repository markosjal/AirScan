<?php
include_once 'phppagestart.php';
include_once 'config.inc.php';
include_once 'lang.php';
$ext = strtolower(pathinfo($_GET['image'], PATHINFO_EXTENSION));
$basename = pathinfo($_GET['image'], PATHINFO_FILENAME);
$now = time();
$randtip=(rand(1, 3));
$editrandom=${'edittip'.$randtip};
$timeremaining=($_SESSION['expire'] - $now);
if ((isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
	if (($_SESSION['expire'] - $now) > 0) // ((($_SESSION['expire'] - $now) <= $addtime) && ()
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
//echo '';
}


if (($_GET['image'] != NULL) && ($requireauth=='yes') && ($_SESSION['password']=='PAM')) //auth with PAM
{


	if (file_exists($_SESSION['userpath'].$_GET['image']))
	{
     	$b64image = base64_encode(file_get_contents($_SESSION['userpath'].$_GET['image']));
	//echo "<img id='myImg' class='js-img' src = 'data:image/jpg;base64,$b64image' alt='$image' style='width:432px;height:auto'/>";
	}
}
else
{
}


if (($requireauth=='yes') && (isset($_SESSION['username'])) && ($_SESSION['loggedin']=='yes') && (isset($_SESSION['password'])) && (isset($_SESSION['expire'])) && ($_SESSION['expire'] >= $now))
{
//$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
}

elseif (($requireauth=='yes') && ((!isset($_SESSION['username'])) || ($_SESSION['loggedin']!='yes') || (!isset($_SESSION['password'])) || (!isset($_SESSION['expire'])) || ($_SESSION['expire'] <= $now)))
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';
		session_unset($_SESSION["loggedin"]);
		session_unset($_SESSION["expire"]);
		session_unset($_SESSION["username"]);
		session_unset($_SESSION["password"]);
		session_unset($_SESSION["userpath"]);
		session_unset($_SESSION['scanneronline']);
		session_unset($_SESSION['fromuserfolder']);
		session_unset($_SESSION['fromuserfilelister']);
		session_unset($_SESSION['tempname']);
		session_unset($_SESSION['txtfilemanager']);
		session_unset($_SESSION['pamfilemanager']);
        	session_destroy();		
        	
//'<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php?sound=yes">';

}
elseif ($requireauth!='yes')
{
$refreshurl='';
}


?>
<!DOCTYPE html>
<html>
    <head>
<?php echo $refreshurl;?>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
	<title><?php echo $pagetitle;?></title>
	<meta charset="<?php echo $charset;?>">
        <link type="text/css" href="css/tui-color-picker.css" rel="stylesheet">
        <link type="text/css" href="css/tui-image-editor.css" rel="stylesheet">
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
        <style>
            @import url(/css/notosans.ttf);
            html, body {
                height: 100%;
                /*margin: 0;*/
            }
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
    </head>
    <body>
<table id="page_header"><tr><td>
        <a href="airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td><hr></td></tr><tr><td>
<?php
include'livemenu.php';
$_SESSION['fromfilelister']='imageedit';
?>
</td></tr></table>
<?php /*
<div style=" float:center; right-margin:auto; left-margin:auto;">Tip: Some dumb tip goes here, so that users find it easier to use.</div>
<div style="float:right; margin-right: 10px;">
*/ ?>

<table style='width:100%;'><tr>
	<td style='width:23%'></td>
	<td style='width: 54%; text-align: center;'><span style="color:#A80; font-weight:bold"><?php echo $editrandom;?></span></td>
	<td style='text-align: right; width:23%'><table><tr><td>	
</td><td>


</td>

	<td><form name="cancel" method="post" action="javascript:history.go(-1)">
        <input style="float: right; " type="submit" value="<?php echo $cancel;?>">

<?php /*


<form method="post" action="airscan.php'.$urlvars.'"><input type="submit" value="'.$cancel.'"></form>
url='.$userpath.'index.php?rand='.$rand.'#'.$_GET['newname'].

*/ ?>
<?php /*
<td><form name="cancel" method="post" action="/<?php echo $userpath.'index.php?rand='.$rand.'#'.$_GET['image']; ?>">
	<input style="float: right; " type="submit" value="<?php echo $cancel;?>">
*/ ?>

	</form></td><td>&nbsp;&nbsp;</td></tr>
	</table>
</td></tr></table>


        <div id="tui-image-editor-container">

        <script type="text/javascript" src="javascript/fabric.js"></script>
        <script type="text/javascript" src="javascript/tui-code-snippet.min.js"></script>
        <script type="text/javascript" src="javascript/FileSaver.min.js"></script>
        <script type="text/javascript" src="javascript/tui-color-picker.js"></script>
        <script type="text/javascript" src="javascript/tui-image-editor.js"></script>
        <script type="text/javascript" src="javascript/white-theme.js"></script>
        <script type="text/javascript" src="javascript/black-theme.js"></script>
        <script>

			<?php if ($lang=='es'){echo $editortranslation;}?>
         // Image editor
         var imageEditor = new tui.ImageEditor('#tui-image-editor-container', {
             includeUI: {
                 loadImage: {


<?php                      

if (($requireauth=='yes') && ($_SESSION['password']!='PAM'))
{
echo 'path: \''.$_SESSION["userpath"].$_GET["image"].'\',';
}

elseif (($requireauth=='yes') && ($_SESSION['password']=='PAM'))
{
echo "path: 'data:image/jpg;base64,$b64image',";
}

elseif ($requireauth!='yes')
{
echo 'path: \''.$filepath.$_GET["image"].'\',';
}

?>
                    name: '<?php echo $basename;?>'
                 },	 
				 <?php if ($lang=='es'){echo 'locale: locale_es_US,';}?>

                 theme: whiteTheme, // or blackTheme
                 initMenu: 'filter',
                 menuBarPosition: 'top'
             },
             cssMaxWidth: 700,
             cssMaxHeight: 500
         });

         window.onresize = function() {
             imageEditor.ui.resizeEditor();
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
<script type="text/javascript">
if(typeof(EventSource)!=="undefined") {
        var statusSource = new EventSource("checklogin.php");
        statusSource.onmessage = function(event) {
                document.getElementById("loginStatus").innerHTML = event.data;
        };
}
else {
        document.getElementById("loginStatus").innerHTML="'.$nosupporttxt.'";
}

</script>


<?php /*
<script type="text/javascript">
function saveCards()
{
var canvas= 
document.getElementsByClassName("upper-canvas ");
var i;
alert("stops");
var theString= canvas.toDataURL();

var postData= "CanvasData="+theString;
var ajax= new XMLHttpRequest();
ajax.open("POST", 'saveCards.php', true);
ajax.setRequestHeader('Content-Type', 

'canvas/upload');

ajax.onreadystatechange=function()
{

if(ajax.readyState == 4)
{
alert("image was saved");
}else{
alert("image was not saved");
}
}

ajax.send(postData);
}
</script>
*/
?> 
   </body>
</html>
