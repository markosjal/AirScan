<?php
include_once 'config.inc.php';
include_once 'lang.php';
if ((($requireauth=='yes') && ($_SESSION['loggedin']=='yes')) || ($requireauth!='yes'))
{
// echo $_SESSION['loggedin'];
echo '<div class="header" id="myHeader" style="padding: 2px 0px 6px 0px">';
//echo '<table border=0><tr><td><a data-href="/airscan.php"><span style="font-size: larger; color:#777AFF; font-weight:bold; cursor: pointer; text-decoration: underline;">'.$scanpage.'</span></a></td>';
echo '<table border=0><tr><td><a href="/airscan.php"><span style="font-size: larger; color:#777AFF; font-weight:bold;">'.$scanpage.'</span></a></td>';

	if (($showfilemanager=='yes') && ($_SESSION['txtfilemanager']=='yes')  && ($_SESSION['pamfilemanager']=='no')  && ($requireauth=='yes') && ($_SESSION['password']!='PAM'))
	{

	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/'.$_SESSION['userpath'].'index.php?rand='.$rand.'"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$userfilestxt.'</span></a></td>';
	}

	elseif (($showfilemanager=='yes') && ($_SESSION['pamfilemanager']=='yes') && ($_SESSION['txtfilemanager']=='no') && ($requireauth=='yes') && ($_SESSION['password']=='PAM'))
	{
	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/pamindex.php?rand='.$rand.'"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$userfilestxt.'</span></a></td>';
	}

	elseif (($showfilemanager == 'yes') && ($requireauth != 'yes'))
	{
	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/'.$_SESSION['userpath'].'index.php?rand='.$rand.'"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$alluserfilestxt.'</span></a></td>';
	}

	else
	{
	echo '';
	}



	if (($showpdfmanager=='yes') && ($requireauth='yes'))
	{
	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/'.$_SESSION['userpath'].'PDF/index.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$userpdfstxt.'</span></a></td>';
	}
	
	elseif (($showpdfmanager == 'yes') && ($requireauth != 'yes'))
	{
	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/'.$_SESSION['userpath'].'PDF/index.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$alluserpdfstxt.'</span></a>>/td>';
	}

	else
	{
	echo '';
	}

	if ($_SESSION['username']=='admin')
	{
	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/usermanager.php?rand='.$rand.'"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$adminbutton.'</span></a></td>';
	}




	if ($_SESSION['loggedin']=='yes')
	{
	echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/logout.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">'.$logout.'</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	}

	else echo '';

	if (($requireauth=='yes') && ($_SESSION['loggedin']=='yes') && ($fastload!='yes') && ($showlogintime=='yes') && ($_SESSION['expire'] > $now))
	{
	echo "<td><div id=\"loginStatus\">$checkloginstatustxt</div></td>";
	}
	else
	{
	echo '';
	} 
}
?>
</tr></table>
</div>

<?php /* </div>
	<script>
$("body").on("click", "a[data-href]", function() {
    var href = $(this).data("href");
    if (href) {
        location.href = href;
    }
});
</script>
*/ ?>
			
