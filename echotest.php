
<?php
error_reporting( -1 );
ini_set( 'display_errors', 1 );

file_put_contents('php://memory, 'This is a test');



//echo file_get_contents('php://memory/shit.txt');
//echo stream_get_contents('php://memory', -1, 0)

if ($stream = fopen('php://memory', 'r')) {
    // print the first 5 bytes
    echo stream_get_contents($stream, 25);

    fclose($stream);
}

//echo $var;
?>
hello
