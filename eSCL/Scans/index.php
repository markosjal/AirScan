<?php 
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
include_once('../../config.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
        if ($saveallesclfiles != 'yes')
        {
        unlink ('XYZ.jpg');
        }
}


?>

