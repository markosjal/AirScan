<?php
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );
/** PWAuth-Driver */
 class PWAuth{
 
    private $pwauthPath = '/usr/sbin/pwauth';
	 
	 /** Performs authentication and returns an array with user data if positive, or false if not
	  * 
	  * @param string $external_uid
	  * @param string $external_passwd
	  */
    public function Authenticate($external_uid, $external_passwd) {
		// Start
		$handle = popen($this->pwauthPath, 'w');
		if($handle === FALSE) {
				die("Errore di apertura pwauth");
				return false;
		}
        
		if(fwrite($handle, "$external_uid\n$external_passwd\n") === FALSE) {
				die("Errore di comunicazione con pwauth");
				return false;
		}
		$result = pclose($handle);
		
		if($result==0) {// Login OK
			$etcPasswd = file('/etc/passwd');
			foreach($etcPasswd as $singleLine) {
				if(substr($singleLine, 0, strlen($external_uid ) + 1) == $external_uid.':') {
					$explodedLine = explode(':', $singleLine);
					
					$return = array();
					$return['user']    = $explodedLine[0];
					$return['uid']     = $explodedLine[2];
					$return['gid']     = $explodedLine[3];
					$return['comment'] = $explodedLine[4];
					$return['dir']     = $explodedLine[5];
					$return['shell']   = $explodedLine[6];
                    
					// GECOS field (comment)
					$userData = explode(',', $return['comment']);
                    
					$name               = $userData[0];
					$building           = $userData[1];
					$phone              = $userData[2];
					$other              = $userData[3];
					$return['name']     = $name;
					$return['building'] = $building;
					$return['phone']    = $phone;
					$return['other']    = $other;
					
                    
					return $return;
				}
			}
		}
		return false;
    }
}

//$pwauth = new PWAuth;
//$login = $pwauth->Authenticate('kodif', 'kodi');
// Test
//$pwauth = new PWAuth;
//$login = $pwauth->Authenticate('user', 'password');
//echo '<pre>';
//print_r($login);
//echo '</pre>';
?>
