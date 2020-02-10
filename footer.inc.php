<center><table width='100%' border=0><tr><td><hr></td></tr><tr><td><center>
<span style='color:#666; font-weight:bold'>
<?php

include_once 'lang.php';
include_once 'config.inc.php';
//echo $upgradetxt;
/*
echo $_SESSION['username'].' ';

echo $_SESSION['password'].' ';

echo ($_SESSION['expire'] - $now).' ';
echo $randlogin.' ';
echo $pamuid.':';
echo $pamgid.' ';
*/
if ($freeversion== 'no')
{
echo'</span>';
}
else
{
echo $upgradetxt.'</span>';
}

echo '<span style="color:#666; font-weight:bold"><br/>'.$annontracking.'</span><br/><br/>';
/*echo 'page '.$_SESSION['page'].'<br/>';
echo 'pageurl '.$_SESSION['pageurl'];
*/
// echo $_SESSION['scanneronline'];
/*
echo '  Require auth?  '.$requireauth;
echo '<br>  logged in? '.$_SESSION['loggedin'];
echo '<br>  expires at  '.$_SESSION['expire'];
echo '<br>  NOW is  '.$now;
echo '<br>  expires in '.($_SESSION['expire']-$now);
echo '<br>  SessionID '.session_id();
*/
///echo 'xxx'.$_SESSION['modulerunning'];
/*
echo $_SESSION['test'];
echo 'XXXX';
echo $_SESSION['username'];
echo $_SESSION['password'];
// echo '<br/>';
echo $_SESSION['userpath'];



</center>
</td></tr></table></center>
<!-- Default Statcounter code for * http://* -->
<script type="text/javascript">
var sc_project=11823564; 
var sc_invisible=1; 
var sc_security="390d81f2"; 
</script>
<script type="text/javascript"
src="https://www.statcounter.com/counter/counter.js"
async></script>
<noscript><div class="statcounter"><a title="Web Analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="//c.statcounter.com/11823564/0/390d81f2/1/" alt="Web
Analytics"></a></div></noscript>
<!-- End of Statcounter Code -->

*/ ?>

