<?php
include_once 'config.inc.php';
include_once 'lang.php';
session_start();
    class CheckDevice {

        public function myOS(){
            if (strtoupper(substr(PHP_OS, 0, 3)) === (chr(87).chr(73).chr(78)))
                return true;

            return false;
        }

        public function ping($host){
            if ($this->myOS()){
                if (!exec("ping -n 1 -w 1 ".$host." 2>NUL > NUL && (echo 0) || (echo 1)"))
                    return true;
            } else {
                if (!exec("ping -q -c1 -w2 ".$host." >/dev/null 2>&1 ; echo $?"))
                    return true;
            }
            return false;
        }
    }
    if ((new CheckDevice())->ping($host)) {
	$connectstatusmessagetxt=$connectedtxt;
 	$_SESSION['connectstatusmessagetxt']=$connectedtxt;
      	$online='yes';
 	$_SESSION['scanneronline']='yes';
}
    else {
	$connectstatusmessagetxt=$notconnectedtxt;
	$_SESSION['connectstatusmessagetxt']=$notconnectedtxt;
	$online='no';
 	$_SESSION['scanneronline']='no';
}
?>
