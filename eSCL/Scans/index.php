<?php 
include $webroot.'/confg.inc.php';
if ($_SERVER['REQUEST_METHOD']== 'DELETE')
{
	if ($saveallesclfiles != 'yes')
	{
	unlink ('XYZ.jpg');
	}
}

//$delete= file_get_contents('php://input');


//$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

//xecho $delete;



?>
