<?php
include_once 'phppagestart.php';
header('Content-type: application/pdf');
header('Content-disposition: inline; filename="'.$_GET['image'].'"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

include_once'config.inc.php';


if (($requireauth=='yes') && ($_SESSION ['loggedin']=='yes') && ($_SESSION ['username']=='admin'))
{
@readfile($_SESSION['viewpath'].$_GET['image']);
}
elseif (($requireauth=='yes') && ($_SESSION ['loggedin']=='yes')&& ($_SESSION ['username']!='admin'))
{
@readfile($_SESSION['userpath'].$_GET['image']);
}
elseif ($requireauth!='yes')
{
@readfile($_SESSION['userpath'].$_GET['image']);
}

else
{
}

//echo 'lkjlj';
//echo $_SESSION['viewpath'].$_GET['image'];
//echo $_SESSION['viewpath'].$_GET['image'];
?>

