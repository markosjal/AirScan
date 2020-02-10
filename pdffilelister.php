<!DOCTYPE html>
<?php
// error_reporting( -1 );
// ini_set( 'display_errors', 1 );
include_once('config.inc.php');
include_once('lang.php');
// session_start();
$now=time();
$_SESSION['frompdffilelister']='yes';

if ($requireauth=='yes')
{
$upath=$_SESSION["userpath"];
}
else
{
$upath=$filepath;
}



if (($requireauth=='yes') && (isset($_SESSION['username'])) && (isset($_SESSION['password'])) && (($_SESSION['expire']-$now)>0) && ($_SESSION['loggedin']== 'yes'))
{
$refreshurl='';
}
else
{
$refreshurl='<meta HTTP-EQUIV="REFRESH" content="0; url=/login.php">';
}


echo '<html lang="'.$lang.'"><head>';

$pagehead=$refreshurl.'<meta charset="UTF-8">  
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>'.$pagetitle.'</title>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="/javascript/jquery.min.js" type="text/javascript"></script>
<style>
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
</style>
</head>
<body>
<table id="page_header"><tr><td>
        <a href="airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td class="ruler"></td></tr><td>';
?>

<?php

echo $pagehead;
//echo '1';

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




if ($requireauth=='yes') 
{
	if (($_SESSION['expire'] <= $now) || ($_SESSION['loggedin'] != 'yes'))
	{
	echo '</table><br/><p><center>'.$goodbye.'</center><br/></p>';
	session_unset($_SESSION["loggedin"]);
	session_unset($_SESSION["expire"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["userpath"]);
        session_destroy();
	exit();		
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



echo '<table border=0><tr><td><a href="/airscan.php"><span style="color:#777AFF; font-weight:bold">'.$scanpage.'</span></a></td>';

if (($showfilemanager=='yes') && ($requireauth=='yes'))
{
echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href="/'.$upath.'index.php"><span style="color:#777AFF; font-weight:bold">'.$userfilestxt.'</span></a></td>';
}

elseif (($showfilemanager == 'yes') && ($requireauth != 'yes'))
{
echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/'.$upath.'index.php"><span style="color:#777AFF; font-weight:bold">'.$alluserfilestxt.'</span></a>>/td>';
}

else
{
echo '';
}







if (($showpdfmanager=='yes') && ($requireauth=='yes'))
{
echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href="/'.$upath.'PDF/index.php"><span style="color:#777AFF; font-weight:bold">'.$userpdfstxt.'</span></a></td>';
}

elseif (($showpdfmanager == 'yes') && ($requireauth != 'yes'))
{
echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/'.$upath.'PDF/index.php"><span style="color:#777AFF; font-weight:bold">'.$alluserpdfstxt.'</span></a>>/td>';
}

else
{
echo '';
}









if ($_SESSION['username']=='admin')
{
echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href="/usermanager.php"><span style="color:#777AFF; font-weight:bold">'.$adminbutton.'</span></a></td>';
}




if ($_SESSION['loggedin']=='yes')
{
echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href="/logout.php"><span style="color:#777AFF; font-weight:bold">'.$logout.'</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
}

else echo '';

if ($requireauth=='yes')
{
echo "<td><div id=\"loginStatus\">$checkloginstatustxt</div></td>";
}
else
{
echo '';
}


?>
</tr></table></td></tr></table>
<center>
<?php 
// $userfilemanagerbutton='<a href="../usermanager.php"><span style="color:#777AFF; font-weight:bold">'.$adminbutton.' '.$_SESSION['username'].'</a></span>';


// $upath=$_SESSION['userpath'];
echo'<br/>';

if ($requireauth=='yes')
{
echo $userpdfsfor;
// echo $_SESSION['username'];
// $upath=$_SESSION["userpath"];
// echo ($_SESSION['expire'] - $now);
}

// if ($requireauth!='yes')
else
{
echo $alluserfilestxt;
// $upath=$filepath;
}
// echo $upath;
echo'<br/>';
echo'<br/>';

//if ($requireauth=='yes')

//{
$dh = opendir($upath.'PDF/');

/*
}

else
{
$dh = opendir($filepath);
}
*/
// echo $upath;
echo '<table border=0 cellpadding=3 cellspacing=3 valign-"center" align="center"><tr><td colspan="3"><hr></td></tr>';

$i=1;




while (($file = readdir($dh)) !== false) {
    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin") 
    	{


	$imagemagickmenus1="<p><a href='../../rotate.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$rotatelefttxt</span></a></p>
        <p><a href='../../autocrop.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$croptxt</span></a></p>
        <p><a href='../../bw.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$grayselecttxt</span></a></p>
	<p><a href='../../flip.php?image=$file&flip=flip'><span style='color:#777AFF; font-weight:bold'>$flipvtxt</span></a></p>
        <p><a href='../../deskew.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$deskewtxt</span></a></p>
	</td>";
		
         $imagemagickmenus2="<p><a href='../../rotate.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$rotaterighttxt</span></a></p>
         <p><a href='../../rotate.php?image=$file&degrees=180'><span style='color:#777AFF; font-weight:bold'>$rotate180txt</span></a></p>
	 <p><a href='../../lineart.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$lineartselecttxt</span></span></a></p>
         <p><a href='../../flip.php?image=$file&flip=flop'><span style='color:#777AFF; font-weight:bold'>$mirrortxt</span></a></p>
         ";
	
	$printmenu="<td><p><a href='../../airscan.php?image=$file&print=yes&returntofiles=yes'><span style='color:#777AFF; font-weight:bold'>$printtxt</span></a></p>";
	$renamemenu="<p><a href='../../rename.php?image=$file'><span style='color:#777AFF; font-weight:bold'>$renametxt</span></a></p></tr><tr><td colspan='3'><hr></td></tr>";


/*


		$imagemagickmenus="<p><a href='../../rotate.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$rotatelefttxt</span></a></p>
                <p><a href='../../autocrop.php?image=$file&print=yes'><span style='color:#777AFF; font-weight:bold'>$croptxt</span></a></p>
                <p><a href='../../bw.php?image=$file&degrees=-90'><span style='color:#777AFF; font-weight:bold'>$grayselecttxt</span></a></p>
		<p><a href='../../flip.php?image=$file&flip=flip'><span style='color:#777AFF; font-weight:bold'>$flipvtxt</span></a></p></td>
		


                <td><p><a href='../../airscan.php?image=$file&print=yes'><span style='color:#777AFF; font-weight:bold'>$printtxt</span></a></p>
                <p><a href='../../rotate.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$rotaterighttxt</span></a></p>
                <p><a href='../../rotate.php?image=$file&degrees=180'><span style='color:#777AFF; font-weight:bold'>$rotate180txt</span></a></p>
		<p><a href='../../lineart.php?image=$file&degrees=90'><span style='color:#777AFF; font-weight:bold'>$lineartselecttxt</span></span></a></p>
                <p><a href='../../flip.php?image=$file&flip=flop'><span style='color:#777AFF; font-weight:bold'>$mirrortxt</span></a></p></tr>
                <tr><td colspan='3'><hr></td></tr>
";
*/

// begin auth NOT required

	if ($requireauth  !='yes')    // ($_SESSION['fromuserfolder'] != 'yes') 
	{
	// echo 'NO auth';
        	
/*
if ($file == 'PDF')
		{
		echo '<tr><td><a name="'.$file.'"></a><a href="/'.$upath.'PDF/index.php"><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="width:auto;max-width:350px;height:auto;max-height:350px"/></a><p><a href="/'.$upath.'PDF/index.php"><span style="color:#777AFF; font-weight:bold">'.$file.'</a></p></span></td><td><p><a href="/nodelete.php"><span style="color:#FF0000; font-weight:bold">'.$deletetxt.'</span></a></p>';
		}
		else
		{
*/
        	echo "<tr><td><a name='.$file.'></a><img id='myImg' class='js-img' src='$file' alt='$file' style='width:auto;max-width:500px;height:auto;max-height:500px'/><p><a href='$file' target='_blank'><span style='color:#777AFF; font-weight:bold'>000$file</a></p></span></td><td><p><a href='/delete.php?image=$file'><span style='color:#FF0000; font-weight:bold'>$deletetxt</span></a></p>";
		$i++;
//		}
	}

// begin auth required 2

// this one is for user files 
	elseif (($requireauth == 'yes') && ($_SESSION['expire'] > $now) && ($_SESSION['loggedin'] == 'yes') && $_SESSION['username'] !='admin')  // jjj
	{
	//echo 'user';
/*        	if ($file == 'PDF')
		{
		echo '<tr><td><a name="'.$file.'"></a><a href="/'.$upath.'PDF/index.php"><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="width:auto;max-width:350px;height:auto;max-height:350px"/></a><p><a href="/'.$upath.'PDF/index.php"><span style="color:#777AFF; font-weight:bold">'.$file.'</a></p></span></td><td><p><a href="/nodelete.php"><span style="color:#FF0000; font-weight:bold">'.$deletetxt.'</span></a></p>';
		}
		else
		{
*/
		echo '<tr><td><a name="'.$file.'"></a><a href="/'.$upath.'PDF/'.$file.'"><embed src="/'.$upath.'PDF/'.$file.'" type="application/pdf" width="500px" height="500px" /></a><p><a href="'.$file.'" target=><span style="color:#777AFF; font-weight:bold">'.$file.'</a></p></span></td><td><p><a href="/delete.php?image='.$file.'"><span style="color:#FF0000; font-weight:bold">'.$deletetxt.'</span></a></p>';
		// echo "<tr><td><a name='$file'></a><img id='myImg' class='js-img' src='$file' alt='$file' style='width:auto;max-width:350px;height:auto;max-height:350px'/><p><a href='$file' target='_blank'><span style='color:#777AFF; font-weight:bold'>$file</a></p></span></td><td><p><a href='/delete.php?image=$file'><span style='color:#FF0000; font-weight:bold'>$deletetxt</span></a></p>";
		$i++;
//		}
	}

// this one is for admin files 
	elseif (($requireauth == 'yes') && ($_SESSION['expire'] > $now) && ($_SESSION['loggedin'] == 'yes') && $_SESSION['username'] =='admin')  // jjj
	{
	// echo 'admin';
 /*       	if ($file == 'PDF')
		{
		echo '<tr><td><a name="'.$file.'"></a><a href="/'.$upath.'PDF/index.php"><img id="pdfImg" src="/images/PDF.png" alt="'.$file.'" style="width:auto;max-width:350px;height:auto;max-height:350px"/></a><p><a href="/'.$upath.'PDF/index.php"><span style="color:#777AFF; font-weight:bold">'.$file.'</a></p></span></td><td><p><a href="/nodelete.php"><span style="color:#FF0000; font-weight:bold">'.$deletetxt.'</span></a></p>';
		}
		else 
		{
*/
		echo "<tr><td><a name='$file'></a><img id='myImg' class='js-img' src='$file' alt='$file' style='width:auto;max-width:500px;height:auto;max-height:500px'/><p><a href='$file' target='_blank'><span style='color:#777AFF; font-weight:bold'>$file</a></p></span></td><td><p><a href='/delete.php?image=$file'><span style='color:#FF0000; font-weight:bold'>$deletetxt</span></a></p>";
		$i++;
// 		}
	}
	else
	{
	echo '';
	}



	if (($imagemagick !='yes') && ($freeversion == 'yes'))
	{
	echo "</tr><tr><td colspan='3'><hr></td></tr>";
	// echo 'imagemagick1';		
	// echo $imagemagickmenus;
	//echo $printmenu;
	$sub1='Auth required, logged in , not expired, imagemagick installed.';
	}

	elseif (($imagemagick !='yes') && ($freeversion != 'yes'))
	{
	// echo 'imagemagick1';		
	// echo $imagemagickmenus;
	echo $printmenu;
	echo $renamemenu;
	$sub1='Auth required, logged in , not expired, imagemagick installed.';
	}

	elseif ($imagemagick == 'yes' )
	{
	// echo 'imagemagick2';	
	echo $imagemagickmenus1;
	echo $printmenu;
	echo $imagemagickmenus2;
	echo $renamemenu;
	$sub1='Auth NOT required, imagemagick installed.';
	}

	      
	elseif (($imagemagick !='yes') || ($_SESSION['expire'] <= $now) || ($_SESSION['loggedin'] != 'yes'))
	{
	echo '';
	session_unset($_SESSION["expire"]);
	session_destroy();
	}

	else
	{
	echo '';
	}
    }
}
closedir($dh);

echo '</table>';
// echo $sub1.'<br/>';
// echo $sub2;

?>
<?php /*
else
{
echo '';
}
*/
?>
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01" />
      <div id="caption"></div>
    </div>



<script>
// Get the modal
var modal = document.getElementById("myModal");
console.log(modal);

// Get the image and insert it inside the modal - use its "alt" text as a caption
var imgs = document.getElementsByClassName("js-img")
console.log(Array.from(imgs))
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
// Array.from is necessary because document.getElementsByClassName
// do not return an array but a HTMLCollection : https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByClassName
// you can use querySelectorAll (which is a more recent function), see here : https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelectorAll
Array.from(imgs).forEach(function(img) {
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  };
})

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};


</script>

</center>
<script type="text/javascript">
//check for browser support
if(typeof(EventSource)!=="undefined") {
        //create an object, passing it the name and location of the server side script
        var statusSource = new EventSource("/checklogin.php");
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
</body>
</html>
