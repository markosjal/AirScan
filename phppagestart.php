<?php
header('Pragma: public');
header('Expires: '.gmdate('D, d M Y H:i:s T', time()).' GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s T', time()).' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);
header ("Pragma: no-cache");
header("Expires: 0", false);
session_name('airscan');
session_start();
//The Order of things above is VERY IMPORTANT & no blank lines above

//above lines must be first

// session_set_cookie_params needed only if using a real domain name only and not 'localhost'
// nor accessing over LAN, but on your own with this!
//if you need this it needs to be ABOVE,  and between session_name and session_start.
// session_set_cookie_params(0, '/', $_SERVER['HTTP_HOST'], false, true);
// this line also needs to be added in the same order to showpdf.php and showimage.php if you use PAM authenticationz

//full linux path from systemroot to webroot for this installation WITH TRAILING SLASH /
//$root='/var/www/html/';

//path to user files after initial set up for security when using text authentication, change to path outside of web access
// copying all contents
// do not forget permissions!
// with trailing slash
//$usersfilespath='/home/pi/users/';
//$usersfilespath=$root.'users/';
$usersfilespath='/var/www/html/users/';
//$usersfilespath='home/Jim/users/';





// path where files are stored for scanning app when no logins are used or text based authentication. 
// Is required if you will be viewing scans via http . otherwise you need another method like SMB or NFS to View scans
// TRAILING SLASH REQUITED! NOTE this is default location which means ALL scans if no authentication or admin path for authentication 
// It also means base path for users 
// any text based users will have a folder created in this path
// DO NOT CHANGE
// do not forget permissions same as web server main html files
$filepath='scans/';





//for headers
$rfc_1123_date = gmdate('D, d M Y H:i:s T', time()); 

// $gettime=time()


//if ($gettime < 0 )
//$now=0

//if not using text authentication set to 'no'
$usetxtauth='yes';

// PAM options .


//PAM Module pwauth installed?
// sudo apt-get install pwauth
// if installed and want to disable , set to 'no'
// if not installed set to 'no'
$pwauthinstalled='yes';
//confirm the following:
//that pwauth (or a link to it) is at /usr/sbin/pwauth';
//that passwd (or a link to it) is at /etc/passwd


// amount of time after writing file, before chmod is done for PAM users
//ensures file is fully written before running chmod
// ONLY affects PAM users
$chmodsleep=2;


//where under user folder to put users scans
// must use  "user private groups" where group name matches username
//TRAILING AND LEADING slashes although leading slash does not mean root in this case
// '/home/joe' (user folder) then becomes '/home/joe/Pictures/scans/'
//THIS PATH MUST ALRADY EXIST AND MUST HAVE 777 PERMISSIONS!
//This way sharing users' folders by NFS or SMB means they have direct access to their scans
$pamscansdir='/Pictures/scans/';

//which PAM users (by ID number) can log in to scan
//Linux distros can use a different range than those set here for standard users
// these two fields set a range
$lowuid=1000;
$highuid=2000;

//random login delay to thwart repeated brute force login attempts
$randlogin=(rand(0, 5)); // will take between 0 to 5 seconds before acknowledging your login
// $randlogin=(rand(0, 0)); //use this to set to zero for faster logins if not worried about hack attempts

//just a random number generator to avoid stale data from browser cache!
//do not remove
$rand=(rand(10000, 99999));
?>


