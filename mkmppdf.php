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
$now=time();
$timeremaining=($_SESSION['expire'] - $now);

$ext = strtolower(pathinfo($_GET['image'], PATHINFO_EXTENSION));
$basename = pathinfo($_GET['image'], PATHINFO_FILENAME);
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
unset($params['makeres']);
unset($params['size']);
unset($params['confirm']);
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
if (($_GET['jpgpdf']=='yes') && ($_GET['mppdf']!='yes') && ($_GET['confirm']=='yes'))
{
$url= get_all_get();


list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
unset($params['makeres']);
unset($params['size']);
unset($params['confirm']);
//unset($params['image']);
// change the print param
//$params['image'] = $pdfpage;
$params['image'] = $basename.'.pdf';
$params['rand'] = $rand;
$params['pdfdone'] = 'yes';
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;

echo '<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php'.$urlvars.'">';
}

elseif ((isset($_GET['size'])) && (isset($_GET['pdfname'])) && (isset($_GET['makeres']) && ($_GET['confirm']=='yes')))
{
$url= get_all_get();
list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
unset($params['makeres']);
unset($params['size']);
unset($params['confirm']);
// change the print param
//$params['image'] = $pdfpage;
$params['rand'] = $rand;
$params['pdfdone'] = 'yes';
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;

echo '<meta HTTP-EQUIV="REFRESH" content="'.$autocroprefresh.'; url=airscan.php'.$urlvars.'">';
}

elseif ($_GET['confirm']!='yes')
{
$url= get_all_get();
list($path, $query_string) = explode('?', $url, 2);
// parse the query string
parse_str($query_string, $params);
// delete image param
//unset($params['rand']);
unset($params['makeres']);
unset($params['size']);
unset($params['confirm']);
// change the print param
//$params['image'] = $pdfpage;
$params['rand'] = $rand;
$params['pdfdone'] = 'yes';
// rebuild the query
$query_string = http_build_query($params);
// reassemble the URL
$urlvars = $path . '?' . $query_string;

echo '<meta HTTP-EQUIV="REFRESH" content="'.$timeremaining.'; url=logout.php&sound=yes">';
}


else 
{
echo '';

}
?>



<meta charset="<?php echo $charset;?>"> 
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta name="Expires" content="'.$rfc_1123_date.'">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="root">
<meta name="robots" content="noindex">
<meta http-equiv="content-type" content="text/html; charset=<?php echo $charset;?>">
<title><?php echo $pagetitle;?></title>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<script src="/javascript/jquery.min.js" type="text/javascript"></script>

</head>
<body>

<table id="page_header"><tr><td>
        <a href="airscan.php">
          <img id="logo" src="/images/AirScan.png" alt="AirScan">
        </a></td></tr>
	<tr><td><hr></td></tr><tr><td>


<?php
if ($_GET['confirm']!='yes')
{
include'livemenu.php';
}
//echo $auto;
?>


</td></tr></table>
<?php

if ($_GET['confirm']=='yes')
{

if ($_GET['mppdf']=='yes')
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitpdfingtxt.'...&nbsp;'.$_GET['pdfname'].'.pdf</span></p></center>';
}

elseif ($_GET['mppdf']!='yes')
{
echo '<center><p><span style="color:#666; font-weight:bold">'.$waitpdfingtxt.'...&nbsp;'.$basename.'.pdf</span></p></center>';
}

echo '<center><img src="images/spinner.gif"></center>';
}


// to add

//US
//Junior Legal	127 x 203 mm	5.0 x 8.0 in	1:1.6000
//Half Letter	140 x 216 mm	5.5 x 8.5 in	1:1.5455
// Folio	8.5 x 13 inches
// 8.5 x 17 inches ???
/*

Executive	184.2 x 266.7	7 x 10
Folio, F4	210 x 330	8 x 13
Foolscap E	203 x 330	8 x 13
Index Card 5 x 8	127 x 203	5 x 8
Ledger, ANSI B	279.4 x 431.8	11 x 17
	4 x 6
Half Letter (Half Sheet)	139.7 x 215.9	5 1/2 x 8 1/2
Tabloid, Ledger, US B, ANSI B	279.4 x 431.8	11 x 17
U.S. Government (before 1980)	203 x 267	8 x 10 1/2



Business card (Japan)	55 x 91	2.2 x 3.6	156 x 258
Business card (UK)	55 x 85	2.2 x 3.3	156 x 241
Business card (US)	51 x 89	2 x 3.5	145 x 252


Photo 4 x 6	102 x 152
Photo 8x10
*/
//ISO
//A4	210 mm 297 mm	8.27 in x 11.69 in	595 pt x 842 pt
//A5	148 mm x 210 mm	5.83 in x 8.27 in	420 pt x 595 pt
//A6	105 mm x 148 mm	4.13 in x 5.83 in	298 pt x 420 pt
//A7	74 mm x 105 mm	2.91 in x 4.13 in	210 pt x 298 pt
//A8	52 mm x 74 mm	2.05 in x 2.91 in	147 pt x 210 pt
//A9	37 mm x 52 mm	1.46 in x 2.05 in	105 pt x 147 pt
//A10	26 mm x 37 mm	1.02 in x 1.46 in	74 pt x 105 pt
//B5	176 mm x 250 mm	6.93 in x 9.84 in	499 pt x 709 pt
//B6	125 mm x 176 mm	4.92 in x 6.93 in	354 pt x 499 pt
//B7	88 mm x 125 mm	3.47 in x 4.92 in	249 pt x 354 pt
//B8	62 mm x 88 mm	2.44 in x 3.47 in	176 pt x 249 pt
//B9	44 mm x 62 mm	1.73 in x 2.44 in	125 pt x 176 pt
//B10	31 mm x 44 mm	1.22 in x 1.73 in	88 pt x 125 pt
//A4 extra	235 mm x 322 mm	9.25 in x 12.67 in
//A4 Super	229 mm x 322 mm	9.25 in x 12.67 in
//Super A4	227 mm x 356 mm	8.93 in x 14.01 in
//A4 Long	210 mm x 348 mm	8.26 in x 13.7 in
//A5 extra	173 mm x 235 mm	8.26 in x 9.25 in
// B5 extra	202 mm x 276 mm	7.95 in x 10.86 in
//JIS
//B5	182 x 257 mm	7.2 x 10.1 in
//B6	128 x 182 mm	5.0 x 7.2 in
//B7	91 x 128 mm	3.6 x 5.0 in
//B8	64 x 91 mm	2.5 x 3.6 in
//B9	45 x 64 mm	1.8 x 2.5 in
//B10	32 x 45 mm	1.3 x 1.8 in
//{ "A4 Portrait", 2480, 3508 },
//{ "A4 Landscape", 3508, 2480 },
//{ "A5 Portrait", 1748, 2480 },
//{ "A5 Landscape", 2480, 1748 },
//{ "A6 Portrait", 1240, 1748 },
//{ "A6 Landscape", 1748, 1240 },



//A4 Long	210 mm x 348 mm	8.26 in x 13.7 in
//A5 extra	173 mm x 235 mm	8.26 in x 9.25 in
//SO B5 extra	202 mm x 276 mm	7.95 in x 10.86 in









//Chinese
//D4	188 x 260 mm	7.400 x 10.200 inches
//D5	130 x 184 mm	5.100 x 7.200 inches
//D6	92 x 126 mm	3.600 x 5.000 inches
//RD4	196 x 273 mm	7.700 x 10.700 inches
//RD5	136 x 196 mm	5.400 x 7.700 inches
//RD6	98 x 136 mm	3.900 x 5.400 inches

//Photos
//Prints	Inches	CM	MM
//2R	2.5 x 3.5	6.35 x 8.89	635 x 889
//3R	3.5 x 5	8.89 x 12.7	889 x 127
//4R	4 x 6	10.2 x 15.2	102 x 152
//5R	5 x 7	12.7 x 17.8	127 x 178
//6R	6 x 8	15.2 x 20.3	152 x 203
//8R	8 x 10	20.3 x 25.4	203 x 254
//S8R	8 x 12	20.3 x 30.5	203 x 305
//10R	10 x 12	25.4 x 30.5	254 x 305


//echo $mancroptxt;
//echo $pdfres;
//echo '<br/>';

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



{ "A4 Portrait", 2480, 3508 },
{ "A4 Landscape", 3508, 2480 },
{ "A5 Portrait", 1748, 2480 },
{ "A5 Landscape", 2480, 1748 },
{ "A6 Portrait", 1240, 1748 },
{ "A6 Landscape", 1748, 1240 },


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

if (($_GET['jpgpdf']=='yes') && ($_GET['mppdf']!='yes') && (!isset($_GET['pdfname'])))
{
$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['image'].'  -background White -gravity center +write info: '.$_SESSION['userpath'].$basename.'.pdf';
$chmod= 'chmod 777 '.$_SESSION['userpath'].$basename.'.pdf';	
	if ($_GET['deltmp']=='yes')
	{
	$deltmp='rm '.$_SESSION['userpath'].$_GET['image'];
	}
	else
	{
	}
}
elseif ((isset($_GET['size'])) && ($_GET['mppdf']=='yes') && (isset($_GET['pdfname'])) && (isset($_GET['makeres'])))
{
$pagedpi=$_GET['size'];
	if (($_GET['makeres']!='auto') && ($_GET['size']!='auto'))
	{
	$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['pdfname'].'_* -density '.$_GET['makeres'].' -units pixelsperinch -background White -gravity center -extent '.$pagedpi.' +write info: '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';
	$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';
		if ($_GET['deltmp']=='yes')
		{
		$deltmp='rm '.$_SESSION['userpath'].$_GET['pdfname'].'_*';
		}
		else
		{
		}
	}
/*
else
{
$mkpdfcmd=$imagemagicklocation.' '.$_SESSION['userpath'].$_GET['pdfname'].'_*  -background White -gravity center +write info: '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';
$chmod= 'chmod 777 '.$_SESSION['userpath'].$_GET['pdfname'].'.pdf';
		if ($_GET['deltmp']=='yes')
		{
		$deltmp='rm '.$_SESSION['userpath'].$_GET['pdfname'].'_*';
		}
		else
		{
		}
}*/
}


if ($_GET['confirm']=='yes')
{
//echo '<center><p><span style="color:#666; font-weight:bold">'.$waitrotatingtxt.'...&nbsp;'.$rotatedfile.'</span></p></center>';
//echo '<center><img src="images/spinner.gif"></center>';
//echo 'XXX'.$mkpdfcmd;
//echo 'nice -n 19 '.$mkpdfcmd;
ob_flush();
flush();
file_put_contents('mkmppdfcmd.txt',$mkpdfcmd );
shell_exec('nice -n '.$niceness.' '.$mkpdfcmd);
		if ($_SESSION['password']=='PAM')
		{
		sleep("2");	
		shell_exec("$chmod");
		}
		else
		{
		}
		if ($_GET['deltmp']=='yes')
		{
		shell_exec("$deltmp");
		}
		else
		{
		}
}
// if ((!isset($_GET['pagedpi'])) || ($_GET['confirm']!='yes'))

elseif ($_GET['confirm'] !='yes')
{

	
echo '<span style="color:#666; font-weight:bold"><center>The following has been automatically selected based on the scanned pages in this project and your default settings.<br/>
You can override these settings below in the event your PDF is a different paper size, etc.<br>
If you are looking to have all pages appear as seen in the original document, select the same paper size and DPI that they were scanned at. <br/>
If you have a mix of page sizes, or a size not listed here, try selecting auto page size, however you may need to select Auto DPI as well.</span>';
echo'<br/><br/><table style="border: 1px solid #aaa; border-collapse: collapse; border-spacing: 0px;"><tr><th style="padding: 0px; vertical-align: bottom"><span style="color:#666; font-weight:bold text-align: bottom;">&nbsp;'.$setdpi.'&nbsp;</span></th><th style="padding: 0px; border-left: solid 1px #aaa"; vertical-align: bottom><span style="color:#666; font-weight:bold text-align: bottom;">&nbsp;'.$setpagesize.'&nbsp;</span></th></tr><tr><td style="padding: 0px;" colspan=2><hr></td></tr><tr><td style="padding: 0px;">';
echo '<form>';
	echo '&nbsp;<input onChange="getValuea(this)" type="radio" name="makeres" value="300" ';
	if ($_GET['pdfres'] == '300')
	{
	echo 'checked />';
	}
	else
	{
	echo '/>';	
	}
	echo '<span style="color:#666; font-weight:bold">300&nbsp;</span>';
	echo '<br/>&nbsp;<input onChange="getValuea(this)" type="radio" name="makeres" value="600" ';
	if ($_GET['pdfres']  == '600')
	{
	echo 'checked />';
	}
	else
	{
	echo '/>';	
	}
	echo '<span style="color:#666; font-weight:bold">600&nbsp;</span>';
	
	echo '<br/>&nbsp;<input onChange="getValuea(this)" type="radio" name="makeres" value="auto" ';
	if (($_GET['pdfres']  != '300') && ($_GET['pdfres']  != '600'))
	{
	echo 'checked />';
	}
	else
	{
	echo '/>';	
	}
	echo '<span style="color:#666; font-weight:bold">'.$auto.'&nbsp;</span>';
	echo '</td><td style="padding: 0px; border-left: solid 1px #aaa";>';





	/* 300 dpi*/
echo '<div id="field1" '.$showhideA.'>';
echo '&nbsp;<input type="radio" name="size" value="2550x3300" ';


if (($printsize == 'letter') && ($pdfres=='300'))
{


echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$letter.'&nbsp;</span>';
echo '<br/>&nbsp;<input type="radio" name="size" value="2550x4200" ';
if (($printsize == 'legal') && ($pdfres=='300'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$legal.'&nbsp;</span>';
echo '<br/>&nbsp;<input type="radio" name="size" value="2480x3508" ';
if (($printsize == 'A4') && ($pdfres=='300'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$A4.'&nbsp;</span>';

echo '<br/>&nbsp;<input type="radio" name="size" value="2079x2953" ';
if (($printsize == 'ISOB5') && ($pdfres=='300'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$ISOB5.'&nbsp;</span>';
echo '<br/>&nbsp;<input type="radio" name="size" value="2160x3030" ';
if (($printsize == 'JISB5') && ($pdfres=='300'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$JISB5.'&nbsp;<span>';
echo '<br/>&nbsp;<input type="radio" name="size" value="2362x3579" ';
if (($printsize == 'AB') && ($pdfres=='300'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$AB.'&nbsp;</span>';

echo '<br/>&nbsp;<input type="radio" name="size" value="auto" ';
if (($printsize == 'auto') && ($pdfres=='300'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$auto.'&nbsp;</span>';

echo '</div>';










// 600 DPI
echo '<div id="field2" '.$showhideB.'>';
echo '&nbsp;<input type="radio" name="size" value="5100x6600" ';
if (($printsize == 'letter') && ($pdfres=='600'))
{

echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$letter.'&nbsp;</span>';

echo '<br/>&nbsp;<input type="radio" name="size" value="5100x8400" ';
if (($printsize == 'legal') && ($pdfres=='600'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$legal.'&nbsp;</span>';

echo '<br/>&nbsp;<input type="radio" name="size" value="4960x7016" ';
if (($printsize == 'A4')  && ($pdfres=='600'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$A4.'&nbsp;</span>';

echo '<br/>&nbsp;<input type="radio" name="size" value="4158x5906" ';
if (($printsize == 'ISOB5') && ($pdfres=='600'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$ISOB5.'&nbsp;</span>';
echo '<br/>&nbsp;<input type="radio" name="size" value="4320x6060" ';
if (($printsize == 'JISB5') && ($pdfres=='600'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$JISB5.'&nbsp;</span>';
echo '<br/>&nbsp;<input type="radio" name="size" value="4724x7158" ';
if (($printsize == 'AB') && ($pdfres=='600'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$AB.'&nbsp;</span>';

echo '<br/>&nbsp;<input type="radio" name="size" value="auto" ';
if (($printsize == 'auto') && ($pdfres=='600'))
{
echo 'checked />';
}
else
{
echo '/>';	
}
echo '<span style="color:#666; font-weight:bold">'.$auto.'&nbsp;</span>';
echo '</div>';




// auto DPI
//echo '<div id="field2" '.$showhideB.'>';
echo '<div id="field3" '.$showhideC.'>';
//echo 'hello';
echo '&nbsp;<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">'.$letter.'&nbsp;</span><br/>
&nbsp;<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">'.$legal.'&nbsp;</span><br/>
&nbsp;<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">'.$A4.'&nbsp;</span><br/>
&nbsp;<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">'.$ISOB5.'&nbsp;</span><br/>
&nbsp;<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">'.$JISB5.'&nbsp;</span><br/>
&nbsp;<input type="radio" name="size" value="" disabled/><span style="color:#bbb; font-weight:bold">'.$AB.'&nbsp;</span><br/>
&nbsp;<input type="radio" name="size" value="auto" ';
if (($_GET["pdfres"]!="600") && ($_GET["pdfres"]!="300"))
{
echo 'checked';
}
else 
{
}
echo '/><span style="color:#666; font-weight:bold"/>'.$auto.'</span>';
echo '<div>';




echo '</td></tr><tr><td style= "padding: 0px;" colspan=2><hr></td></tr>
<input name="pdfname" type="hidden" value="'.$_GET['pdfname'].'">
<input name="confirm" type="hidden" value="yes">
<input name="mppdf" type="hidden" value="yes">
<input name="resolution" type="hidden" value="'.$_GET['pdfres'].'">
<tr><td colspan=2 style= "padding: 0px;"><table border=0 style="width: 100%;"><tr><td style= "padding: 0px;">
	<span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td style= "padding: 0px;"><input type="submit" value="'.$confirm.'"></form>
</td><td style= "padding: 0px;">
	<span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td style= "padding: 0px;">
	<form name="cancel" method="post" action="'.$userpath.'index.php?rand='.$rand.'#'.$image.'">
	<input type="submit" value="'.$cancel.'">
	</form>
	</td><td style= "padding: 0px;">
	<span style="color:#666; font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td></tr></table>	
</td></tr></table></center><br/><br/>';

include 'footer.inc.php';
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
<?php
if ($_GET['confirm']!='yes')
{
include'livemenujs.php';
}
?>
</body>
</html>
