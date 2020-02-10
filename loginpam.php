<?php

$uname = $_POST['uname'];

$pswd = $_POST['pswd'];

 if ( pam_auth( $uname, $pswd, &$error ) ) 
 {
 echo "You are authenticated!";
 } 

 else 
 {
 echo $error;
 }

$test='hello';
?>
