<?php
$lines=file('/home/kodi/users/Lenny.php');
// To check the number of lines 
echo count($lines).'<br>';
foreach($lines as $line)
{
   echo $line.'<br>';

  $str=$line;
//$str = 'before-str-after';

//preg_match('/$userpath = '(.*?)'; /', $str, $match);
preg_match('us(.*?)h/', $str, $match);
echo $match[1];
}


?>
