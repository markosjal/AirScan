<?php
include_once 'phppagestart.php';
echo '<!DOCTYPE html>'; 
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );

include_once 'config.inc.php';
include_once 'lang.php';
//sleep(6);
$resolution=$_GET['resolution'];
$deskew=$_GET['deskew'];
$autocrop=$_GET['autocrop'];
$print=$_GET['print'];
$mode=$_GET['mode'];
$currentpage=$_GET['currentpage'];
$printscaleheight=$_GET['printscaleheight'];
$printscalewidth=$_GET['printscalewidth'];
$mppdf=$_GET['mppdf'];
$jpgpdf=$_GET['jpgpdf'];
$pdfres=$_GET['pdfres'];
$timeremaining=($_SESSION['expire'] - $now);
$now=time();
function get_all_get()
{
        $output = "?"; 
        $firstRun = true; 
        foreach($_GET as $key=>$val) { 
        if($key != $parameter) { 
            if(!$firstRun) { 
                $output .= "&"; 
            } else { 
                $firstRun = false; 
            } 
            $output .= $key."=".$val;
         } 
    } 

    return $output;
}   
$url= get_all_get();


list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
// change the print param
//$params['image'] = $pdfpage;
$params['rand'] = $rand;
$params['pdfdone'] = 'yes';
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;




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
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>

<?php
if ((isset($_GET['size'])) && (isset($_GET['pdfname'])) && (isset($_GET['makeres'])))
{
echo '<meta HTTP-EQUIV="REFRESH" content="10; url=/airscan.php'.$urlvars.'">';
}
else 
{
echo '';

}
?>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css">
	<script src="main.js"></script>
</head>
<body>
<?php
//echo $pdfres;
echo '<br/>';

/*
8.5x 11
2550 px @ 300 dpi
3300 

5100px x 6600 PX @600 dpi


A4        210   × 297   mm  8.26772x11.69291  at 300 dpi     2480 x 3508 Pixels 
 Letter    215.9 × 279.4 mm   at 300 dpi     2550 x 3300 Pixels

jis b5
182 x 257 mm	7.2 x 10.1 in 2160 x 3030 @300 dpi

iso b5
 B5 digital size in 300 dpi is 2079 x 2953 pixels. B5 size ...250 x 176 mm or 9.84 x 6.93 inches
B5 digital size in 300 dpi is 2079 x 2953 pixels.

AB paper 200x303mm 

executive 7 x 10 inches

/This sets the page size used in the css for printing and for pdf creation USE ONLY 'A4', 'letter', 'legal', 'AB', 'ISOB5' or 'JISB5'- CASE SENSITIVE!
*/








/*
else{}
8.5x 11
2550 px @ 300 dpi
3300 

5100px x 6600 PX @600 dpi


A4        210   × 297   mm   at 300 dpi     2480 x 3508 Pixels 
 Letter    215.9 × 279.4 mm   at 300 dpi     2550 x 3300 Pixels

jis b5
182 x 257 mm	7.2 x 10.1 in 2160 x 3030 @300 dpi

iso b5
 B5 digital size in 300 dpi is 2079 x 2953 pixels. B5 size ...250 x 176 mm or 9.84 x 6.93 inches
B5 digital size in 300 dpi is 2079 x 2953 pixels.

AB paper 200x303mm 

executive 7 x 10 inches

*/
$showX='style="display: block;"';
$hideX='style="display: none;"';
//$hideshowY='style="display: block;">';
//$showhideY='style="display: none;">';

if ($_GET['pdfres']=='300')
{
	$showhideA='style="display: block;"';
	$showhideB='style="display: none;"';
	$showhideC='style="display: none;"';




//echo '<div id="field1" '.$showhideX.'Field1</div>';
//echo '<div id="field2" '.$hideshowX.'Field2</div>';
//echo '<div id="field3" '.$hideshowX.'Field3</div>';
}

elseif ($_GET['pdfres']=='600')
{

	$showhideA='style="display: none;"';
	$showhideB='style="display: block;"';
	$showhideC='style="display: none;"';
//echo '<div id="field1" '.$hideshowX.'Field1</div>';
//echo '<div id="field2" '.$showhideX.'Field2</div>';
//echo '<div id="field3" '.$hideshowX.'Field3</div>';
}

else
{
	$showhideA='style="display: none;"';
	$showhideB='style="display: none;"';
	$showhideC='style="display: block;"';	

//echo '<div id="field1" '.$showhideA.'Field1</div>';
//echo '<div id="field2" '.$showhideB.'Field2</div>';
//echo '<div id="field3" '.$showhideC.'Field3</div>';
} 

//cho '<div id="field1" '.$showhideA.'>Field1</div>';
//echo '<div id="field2" '.$showhideB.'>Field2</div>';
//echo '<div id="field3" '.$showhideC.'>Field3</div>';


if ((isset($_GET['size'])) && (isset($_GET['pdfname'])) && (isset($_GET['makeres'])))
{
$pagedpi=$_GET['size'];
//$mkpdfcmd=$imagemagicklocation.' -page Letter '.$_SESSION['userpath'].$_GET['pdfname'].'_*.jpg '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';
/*
if ($pagedpi != $pdfres)
{*/


if (($_GET['makeres']!='auto') && ($_GET['size']!='auto'))
{
$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['pdfname'].'_* -density '.$_GET['makeres'].' -units pixelsperinch -background White -gravity center -extent '.$pagedpi.' +write info: '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';

}

else
{
$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['pdfname'].'_*  -background White -gravity center +write info: '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';

}


//$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['pdfname'].'_*.jpg '.$resize.' '.$pagedpi.' -density '.$pdfres.' -units pixelsperinch -background Blue -gravity center -extent '.$pagedpi.' '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';

/*}
elseif ($pagedpi != $pdfres)
{
$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['pdfname'].'_*.jpg -density '.$pdfres.' -units pixelsperinch -background Blue -gravity center -extent '.$pagedpi.' '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';
}

*/
//if ($confirm=='yes')
//{
//echo 'nice -n 19 '.$mkpdfcmd;
shell_exec('nice -n 19 '.$mkpdfcmd);
}
// if ((!isset($_GET['pagedpi'])) || ($_GET['confirm']!='yes'))

else
{

	
echo 'The following has been automatically selected based on the scanned pages in this project and your default settings. You can override these settings below in the event your PDF is a different paper size, etc. ';
echo'<table border=1><tr><td>Set DPI</td><td>Set Page Size</td></tr><tr><td>';
echo '<form>';
	echo '<input onChange="getValuea(this)" type="radio" name="makeres" value="300" ';
	if ($_GET['pdfres'] == '300')
	{
	echo 'checked />';
	}
	else
	{
	echo '/>';	
	}
	echo '<span style="color:#666; font-weight:bold">300</span>';
	echo '<br/><input onChange="getValuea(this)" type="radio" name="makeres" value="600" ';
	if ($_GET['pdfres']  == '600')
	{
	echo 'checked />';
	}
	else
	{
	echo '/>';	
	}
	echo '<span style="color:#666; font-weight:bold">600</span>';
	
	echo '<br/><input onChange="getValuea(this)" type="radio" name="makeres" value="auto" ';
	if (($_GET['pdfres']  != '300') && ($_GET['pdfres']  != '600'))
	{
	echo 'checked />';
	}
	else
	{
	echo '/>';	
	}
	echo '<span style="color:#666; font-weight:bold">Auto</span>';
	echo '</td><td>';





	/* 300 dpi*/
echo '<div id="field1" '.$showhideA.'>';
echo '<input type="radio" name="size" value="2550x3300" ';


if ($printsize == 'letter')
{


echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">Letter</span>';
echo '<br/><input type="radio" name="size" value="2550x4200" ';
if ($printsize == 'legal')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">Legal</span>';
echo '<br/><input type="radio" name="size" value="2480x3508" ';
if ($printsize == 'A4')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">A4</span>';

echo '<br/><input type="radio" name="size" value="2079x2953" ';
if ($printsize == 'ISOB5')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">ISO B5</span>';
echo '<br/><input type="radio" name="size" value="2160x3030" ';
if ($printsize == 'JISB5')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">JIS B5<span>';
echo '<br/><input type="radio" name="size" value="2362x3579" ';
if ($printsize == 'AB')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">AB</span>';

echo '<br/><input type="radio" name="size" value="auto" ';
if ($printsize == '<span style="color:#666; font-weight:bold">AB</span>')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">Auto</span>';

echo '</div>';










// 600 DPI
echo '<div id="field2" '.$showhideB.'>';
if ($printsize == 'letter')
{
echo '<input type="radio" name="size" value="5100x6600" ';
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">Letter</span>';
echo '<br/><input type="radio" name="size" value="5100x8400" ';
if ($printsize == 'legal')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">Legal</span>';
echo '<br/><input type="radio" name="size" value="4960x7016" ';
if ($printsize == 'A4')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">A4</span>';

echo '<br/><input type="radio" name="size" value="4158x5906" ';
if ($printsize == 'ISOB5')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">ISO B5</span>';
echo '<br/><input type="radio" name="size" value="4320x6060" ';
if ($printsize == 'JISB5')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">JIS B5</span>';
echo '<br/><input type="radio" name="size" value="4724x7158" ';
if ($printsize == 'AB')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">AB</span>';

echo '<br/><input type="radio" name="size" value="auto" ';
if ($printsize == 'AB')
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">Auto</span>';
echo '</div>';




// auto DPI
//echo '<div id="field2" '.$showhideB.'>';
echo '<div id="field3" '.$showhideC.'>';
//echo 'hello';
echo '<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">Letter</span><br/>
<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">Legal</span><br/>
<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">A4</span><br/>
<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">ISO B5</span><br/>
<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">JIS B5</span><br/>
<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">AB</span><br/>
<input type="radio" name="size" value="auto" checked /><span style="color:#666; font-weight:bold">Auto</span>';
echo '<div>';




echo '</td></tr>
<input name="pdfname" type="hidden" value="'.$_GET['pdfname'].'">
<input name="confirm" type="hidden" value="yes">
<input name="mppdf" type="hidden" value="yes">
<input name="resolution" type="hidden" value="'.$_GET['pdfres'].'">
<tr><td></td><td><input type="submit" value="'.$confirm.'"></form>	
</td></tr></table>';

}

?>
<script>
function getValuea(a) {
  if(a.value == "300"){
    document.getElementById("field1").style.display = "block"; // you need a identifier for changes
    document.getElementById("field2").style.display = "none"; // you need a identifier for changes
	document.getElementById("field3").style.display = "none"; // you need a identifier for changes
  }
  else if(a.value == "600"){
    document.getElementById("field1").style.display = "none"; // you need a identifier for changes
    document.getElementById("field2").style.display = "block"; // you need a identifier for changes
	document.getElementById("field3").style.display = "none"; // you need a identifier for changes
  }
  
  else{
    document.getElementById("field1").style.display = "none";  // you need a identifier for changes
    document.getElementById("field2").style.display = "none";  // you need a identifier for changes
    document.getElementById("field3").style.display = "block";  // you need a identifier for changes

  }
}
</script>

</body>
</html>
