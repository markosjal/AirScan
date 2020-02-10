<?php
include_once 'config.inc.php';
    class CheckDevice 
	{
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
                if (!exec("ping -q -c1 -w5 ".$host." >/dev/null 2>&1 ; echo $?"))
                    return true;
            }
            return false;
        }
    }
    	if ((new CheckDevice())->ping($host)) 
	{
 	$scanneronline='yes';
	}
	else 
	{
 	$scanneronline='no';
	}
?>
