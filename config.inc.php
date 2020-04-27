<?php // NO BLANK LINES IN THIS FILE
// this config file is for both the web GUI and The AirScan/eSCL server interface to the scanner. Some items affect both such as $root, $defaultresolution, etc
include_once 'lang.php';
// some server options. These may depend on your server configuration
//path from admin or default scans folder to webroot (full linux path from root)
//you should now configuure the following in scans/index.php aund usertemplate/index.php BEFORE creating users
// with trailing slash
//full linux path from systemroot to webroot for this installation WITH TRAILING SLASH /
// set this and $webroot in php pagestart to the same for now
$root='/var/www/html/';
// set hostnname below for Bonjour advertising the s400w scanner only to make it AirScan/eSCL compatible
//if your local suffix is not .local, change below
$local='.local';
$hostname=gethostname().$local;
// no trailing . 
// Serial Number If more than one instance of this software  on network set a different Serial number here
$serialnumber='AirScan01234567890';
//If more than one instance of this software  on network set a different UUID here and in the avahi service file.
$uuid='4509a320-00a0-008e-00b6-000507510ecc';
//name for php session
//this was moved to phppagestart.php
//$sessionname='airscan';
// niceness is for making PDFs with "nice" command otherwise CPU goes to 100%
// set niceness value here
$niceness=19;
// $pamauth set to 'yes' means NO FILE MANAGER (filelister) and no text based auth
$pamauth='yes';
// this set of options, are interface options whichdetermine which options show on the scan ansd filelister pages
//if using the free version , leave all at no
//$demomode for use without scanner and for use as the demo on our domain
// Leave at no
$demomode='no';
 //default page title change if you like. When printing from scan interface is overwritten by file name.
$pagetitle='AirScan; Ion AirCopy, Halo Magic Scanner, Mustek IscanAir, Century CPS-A4WF';
// if this is the free version set to yes
// Free version support is being eliminated as of Version 10 LEAVE AT NO
$freeversion='no';
// if using logins the default redirect should go to /login.php. If not should go to /airscan.php
// this redirects index.php only so when tyou load http://localhost or http://IPADDRESS it takes you to the right place
$defaultredirecturl='/login.php';
//sound played at auto logout
$soundfile='jetson5.wav';  // Jetsons car sound
// $soundfile='jetsndb.wav';  //"here's geroge jetson" dorbell sound
// or use your own file in webroot and change the name here.
// show filemaneger links. You do not NEED to have a file manager . 
//PAM users may mount their folders on their local machine
//You can always share the folder where the scanned files are saved via smb or NFS
// all files saved automatically once scanned
$showfilemanager='yes';
//whether or not tips are shown n various pages
$showtips='yes';
//filelister image previews and modals
// The max width for images in filelister list affects css
// also affects (fixed) size of PDFs in filelister. Chrome may not display all options (rotate, download & print) if set to under 500
// vh/vw , % or px
$filelistmaxwidth='500px';
// The max height for images in filelister list affects css
// vh/vw , % or px
$filelistmaxheight='500px';
// affects CSS filelister if not 'auto' images may distort
$filelistwidth='auto';
// affects CSS filelister if not 'auto' images may distort
$filelistheight='auto';
// the following are similar to above but when image is clicked in filelister
$filelistzoommaxwidth='90vw';
$filelistzoommaxheight='90vh';
$filelistzoomwidth='auto';
$filelistzoomheight='auto';
// PDF zoom in file lister (featherlight)
$filelistzoompdfmaxwidth='89vw';
$filelistzoompdfmaxheight='90vh';
$filelistzoompdfwidth='89vw';
$filelistzoompdfheight='90vh';
//scan page modals only
// like the group above but on scan page (image on scan page is fixed in size, sorry)
$scanzoommaxwidth='90vw';
$scanzoommaxheight='90vh';
$scanzoomwidth='auto';
$scanzoomheight='auto';
//rename and delete previews and modals.
// like the group above but on rename and delete pages for image on page and zoomed image
$fileopmaxwidth='500px';
$fileopmaxheight='500px';
$fileopwidth='auto';
$fileopheight='auto';
$fileopzoommaxwidth='90vw';
$fileopzoommaxheight='90vh';
$fileopzoomwidth='auto';
$fileopzoomheight='auto';
//Crop dialog max box size in pixels
$boxwidth=800;
$boxheight=800;
// set to yes toshow PDFs 
//NOT USED IN THIS VERSION LEAVE AT NO
$showpdfmanager='no';
//NOT USED IN THIS VERSION LEAVE AT NO
$showpdf='no';
// the following affect only what appears on scan page. More settings realted to what appears on scan page in imagemagick settings
//default image on scan page
$defaultimage='/images/scan.jpg';
// show multi page pdfoptions - leaveat yes for now
$showmppdf='yes';
// vertical distance between group[ed items on scan page  Line-height
$scangrouplineheight='250%';
//tweak for Scan and DPI selection speacing
$dpilineheight='90%'; 
$dpiverticalalign='65%';
$scanbuttonverticalalign='-100%';
//$scangrouplineheightcolordpi='200%';
//this affects Line spacing between scan mode color/grayscale/lineart & DPI
// just fine tunes the layout 
//$modemultiplier='0.70'; // line height $scangrouplineheight x $modemultiplier in % in css
//This affects the height of the scan 'mode' text
// just fine tunes the layout 
//$modeheight='1'; //affects CSS in %
// because we adjust the 'mode' text. 
//$dpiheight='1.0'; //affects CSS in %
// Show Copy-print function before scan?  
// leave at no for free version
$showprint='yes';
//show copy-print scaling function before scan? 
// leave at no for free version
$showprintscale='yes';
//show delete  on scan page after scan?   
$showdeleteafterscan='yes';
$showrenameafterscan='yes';
//show copy-print and scaling functions after scan on scan page?  
//Above print and scale options must be activated 
// leave at no for free version
$showprintafterscan='yes';
//show resolution selection? 600 DPI may not be supported on older firmware.
// if set to "no" then all scanning done at $defaultresolution set below
// setting to "no" will result in $defaultresolution always displayed in interface, but not allow it to be changed
$showresolution='yes';
//default resolution can be 300 or 600 only . changes radio button . Leave at 300 for scanners with firmware that do not support 600DPI
$defaultresolution='300';
// Default width and height adjustments which show in scan page
// see also printscaletrim functions below. The trim function does the same without changing the 100% default in the interface.
$widthadj='100';    //100 means 1 to 1 or 100%
$heightadj='100';
//default print setting that shows in scan page. If set to 'yes' it will initiate a print job 
// on completed scan on devices that support printing unless changed in GUI when scanning.
$defaultprint='no';
// If authentication is required to access scanner for multiple users
// use no for free version
// as of version 9 you must now enable/disble text auth and/or PAM auth in phppagestart.php
$requireauth='yes';
//admin interface options:
//set here whether you want confirmation to login as a user from the admin panel
// setting to 'yes' will display additional page that it will logout admin and login as user
$confirmuserlogin='yes';
// whether in admin panel there is an option to copy user files to admin
// this is copy TO NOT FROM admin
$showcopytoadmin='yes';
// whether in admin panel there is an option to copy user files to admin
// NOT YET READY ,DO NOT USE! LEAVE AT NO!
$showcopyfromadmin='no';
//for when admin is looking at users files in modals (PAM Users only) files 
// vh/vw , % or px
// jpg/gif/png
//$adminfilelistzoommaxwidth='70vw';
//$adminfilelistzoommaxheight='87vh';
//$adminfilelistzoomwidth='auto';
//$adminfilelistzoomheight='auto';
//$adminfilelistzoomwidth='auto';
//$adminfilelistzoomheight='auto';
//pdf
//$adminfilelistzoompdfmaxwidth='70vw';
//$adminfilelistzoompdfmaxheight='89vh';
//$adminfilelistzoompdfwidth='auto';
//$adminfilelistzoompdfheight='auto';
//Tiff CURRENTLY UNUSED
//$adminfilelistzoomtifmaxwidth='70vw';
//$adminfilelistzoomtifmaxheight='87vh';
//$adminfilelistzoomtifwidth='auto';
//$adminfilelistzoomtifheight='auto';
// jpg/gif/png
$adminfilelistzoommaxwidth='90vw';
$adminfilelistzoommaxheight='90vh';
//$adminfilelistzoomwidth='80vw';
//$adminfilelistzoomheight='87vh';
$adminfilelistzoomwidth='auto';
$adminfilelistzoomheight='auto';
//pdf
$adminfilelistzoompdfmaxwidth='89vw';
$adminfilelistzoompdfmaxheight='90vh';
$adminfilelistzoompdfwidth='89vw';
$adminfilelistzoompdfheight='90vh';
//Tiff CURRENTLY UNUSED
$adminfilelistzoomtifmaxwidth='87vw';
$adminfilelistzoomtifmaxheight='87vh';
$adminfilelistzoomtifwidth='auto';
$adminfilelistzoomtifheight='auto';
// end interface options
// login Session options
//amount of initial ;ogin session time in minutes before login expires 
// additional time is added as pages loaded based on rules below
//if ($logintineout * 60) is less than $addtime initial login time will be ($logintimeout *60) + $addtime
$logintimeout=45;  // this is minutes ,  if less than $addtime/60 total session time at login will be $logintimeout + $buytime/60 min
// $logintimeout=1;  // this is minutes ,  if less than $addtime/60 total session time at login will be $logintimeout + $buytime/60 min
// the remining session time (or less) at which a page refresh adds additional time (as indicated with $buytime below)
// $addtime=1;  //600 = 10 min
$addtime=1200;
// $addtime above, or less , session will be extended this amount when scan , file 
// lister or admin page is loaded or a file operation performed
// at $addtime or less the amount of time here will be added when page is loaded
$buytime=400; //seconds
// $buytime=30;
// show login time and "Extend Time" link
$showlogintime='yes';
// time between checking login expiration when shown on page with Showlogintime='yes'
$loginjsrefresh=60000;//60000 = 1 minute in ms
// displays in, cm or both in file manager;
// also set in lang.php for multi page pdf creation
$filemanagerunits='both';
//$filemanagerunits='cm';
//$filemanagerunits='in';
//where available use php commands over shell_exec commands
//if you have issues renaming or deleting you can try to change this 
// option yes uses php commands, option no uses shell_exec
//leave at no for v10+
$preferphpcommands='no';
//scanner and general config
//Scanner selector, one or the other depending on scanner, not both
//$scanner='SANE';
//$scanner='eSCL'; 
// Leave as-is for now soon new options coming
$scanner='s400w'; 
//Start Options for s400w
//if your host IP and port are different, set them below
// this is IP and port of scanner once  wifi connection is made
$host='192.168.18.33';
$port='23';
// full path and filename of s400w
$s400w='/var/www/html/s400w';
//to establish the frequency at which the scanner is pinged to determine conecctivity  "the scanner is connected"
// this seems to be the optomal setting as seting much lower may seem to cause problems
// may interact with other embedded settings. best not to change.
$ping=4000; //miliseconds
//this is the frequency that the scanner will be queried , once online to see if it has a page inserted "Page inserted, 
// ready to scan", once the ping determines it it online. You need not wait for this update interval you can scan without 
//the interface recognizing there is a page inserted, so you can set it high if you like
// this seems to be the optimal setting as seting much lower may seem to cause problems
// may interact with other embedded settings. best not to change.
$refresh =8000; //6000 miliseconds 6 seconds


// this is the delay while scanning(spinning disc). 
// In some cases this needs to be set higher when using autocrop or scanning with BW or Lineart options 
// as the file needs to be completely written before reading by imagemagick'
$scanrefresh='1'; // no longer used as originally used. Leave here

//This is the delay while doing an image processing feature like autocropping, rotating, or making BW image (spinning disc). 
// In some cases this needs to be set higher when using autocrop or scanning with BW or Lineart options 
// as the file needs to be completely written before reading by imagemagick'
$autocroprefresh='1';// no longer used as originally used. Leave here

// refresh when deletng or renaming
// "user deleted..." or "file deleted" message time affected
$deleterefresh='1';// no longer used as originally used. Leave here


// this determins the amount of time for a page refresh when taking you back to login page, or the amout of time that 
// "goodbye" or "invalid password", or "timed out" is  displayed before login page in some cases
$loginrefresh=1; 
//code  is in flux and evolving! added below variable that determines "goodbye..." message, specifically for auto-logout
//goodbye message displayed here when logged out automatically. Needs time to play sound file at auto logout
$logoutrefresh=3; // leave at 3 for sound to play

//when enabled shows scan command text results at scan time. with escl clients connecting to s400w, 
//produces files of received exml in eSCL/Scans.
// s400w scanner only saves debug files in /eSCL/Scans and on screen display while scanning
$scandebug='yes';
// end s400w scanner config
// Start uptions for SANE Scanner
$sanename='test:0';  //Use scanimage -L to get this 
//activate up to three resolutions that are compatible with your scanner for SANE ONLY
$sane72dpi='no';
$sane75dpi='no';
$sane100dpi='no';
$sane150dpi='no';
$sane200dpi='no';
$sane300dpi='yes';
$sane600dpi='yes';
$sane900dpi='yes';
$sane1200dpi='yes';
$sane2400dpi='no';
$sane3600dpi='no';
$sane4800dpi='no';
// end SANE scanner options
//Start Options for eSCL Scanner
// use only IPv4 , no ip v6 set to yes otherwise no for ip v6 and v4
$esclipv4only='no';
$esclipoverride=''; // put a fixed IP here if you have more than one eSCL Scanner on your network.
// put the port here if you have more than one eSCL Scanner on your network.
// use avahi-browse -t -r _uscan._tcp in linux to get the port
$esclportoverride='';
 //if setting manual IP port above yo can set name here. 
//This only affects what shows in interface but should not be blank if using fixed IP : Port above
$escltypeoverride='';
// path (if required) and name of python executable
$pythoncmd = 'python';
//$pythoncmd = 'python2';
//$pythoncmd = 'python3';
// if you have more than one escl scanner on the network you can set the IP address of the one you want here
// this overrides Bonjour / Avahi discovery
//uncomment the line below and set IP address
//$ipoverride= '192.168.1.22';   
// end options for eSCL scanner
//imagemagick options the following apply only to paid version with imagemagic installed.
//path and filename to "convert" or "magick" newer versions apparently use "magick"
$imagemagicklocation='/usr/bin/convert';
// is imnagemagick installed? This enables autocrop
// leave at no for free version
// $imagemagick='yes';
// Version 10 and Up leave at 'yes' as this option in the process of being removed. Imagemagick now required.
$imagemagick='yes';
// below are options for imagemagick on scan page only
//default scan mode 'color', 'bw'for grascale  or 'lineart'
// must have $showcolorselect='yes' 
// if free version or no imagemagick installed, use 'color'
//$defaultmode='bw';
// $defaultmode='lineart';
$defaultmode='color';
//Show color/gray/B&W options on scan page before scan
//  note must also have imagemagic installed and configured in order to show and use, $imagemagick='yes'
// leave at no for free version
$showcolorselect='yes';
// show deskew option on scan page
$showdeskew='yes';
//Show Auto-crop options on scan page before scan
// note must also have imagemagic installed and configured below in order to show and use
// leave at no for free version
$showautocrop='yes';
// deskew/autocrop now a single setting
$showdeskewautocrop='yes';
//show rotate and flip functions after scan? 
// this is for scan pageonly
// leave at no for free version
$showrotateflip='yes';
//IMAGEMAGICK SETTING FOR AUTOCROP purely numeric without "%" 
$fuzz='70';
//threshold for lineart conversions . in % without '%'
$threshold='65';
$defaultdeskew='no';
//autocrop is default? Changes radio button - yes or no
$defaultautocrop='no';
// convert to webp options
//
$webpquality=50;
$webplossless='true';
//end imagemagick options
//File options
//fileprefix
//moved to lang.php
// $fileprefix='Scan';
// path where files are stored for scanning app when no logins are used. 
// File paths with logins are stored in users files.
// is also used for initial creation of individual users/
// and is recommended if you will be viewing scans via http . otherwise you need another method like SMB or NFS to View scans
// TRAILING SLASH REQUITED! NOTE this is default location which means ALL scans if no authentication or admin path for authentication 
// It also means base path for users 
// DO NOT CHANGE IN V 8.X, as it may break things.
// do not forget permissions 
// moved to phppagestart.php
//$filepath='scans/';
//user config files, not scans
// no trailing slash here
//Moved to phppagestart.php
//$usersfiles='users';
// $usersfiles='./users';
// below you can set a web based filemanager you need to conform file locations for the PHPscan and your file manager
// can specify a file with a button 
//$filemanagerbutton='<form action="filemanager"><input style="height: 36px; background-image: url(images/btn_files.png); background-repeat: no-repeat; background-position: left; padding-left: 36px;"type="submit" name="" value="'.$filestxt.'"></form>';
//can be a simple link
//obsolete
$filemanagerbutton='<p><center><a href="scans"><span style="color:#777AFF; font-weight:bold">'.$filestxt.'</span></a></center></p>';
//end file options
// copy-print & PDF functions . These settings in no way affect the scan , only copy/print and make PDF functions, only in paid version
// not used 
// server side Printing (currently testing with PDFs only)
// define your CUPS printer name below
// $cupsprinter='Xerox_Phaser-6125';
// not used
//For additional Server side printing options
//we consider accommodating the software located here:
//https://wkhtmltopdf.org/
//https://wkhtmltopdf.org/downloads.html
// $wkhtmltopdf='/usr/local/bin/wkhtmltopdf';
//default page size USE ONLY   >  A4', 'letter', 'legal', 'AB', 'ISOB5' or 'JISB5' CASE SENSITIVE
//does NOT APPLY to s400w scanner so keave at default
$defaultscansize='letter';
// This is a width trim adjustment so you can get 100% page coverage width (or as close as your browser & printer allow)
// on page witdth while leaving the  normal user width at 100%
// some of these scanners seem to resize the image slighty horizontally or vertically or both, and this is where to compensate for that.
// you can scan a business card with print enabled and print scale at 100% to see if it prints at the same size. 
// DO NOT USE A FULL SIZE SHEET FOR THIS TEST. If Horz or vert is different, adjust it here.
// be advised that Chromium adds borders while Firefox does not from my experience
// '1' means 1:1(no adjustment), .99 means 99%, 1.1 means 110% or enlarge 10%. This is a multiplier value.
$printscaletrimw='1';
// This is a height trim adjustment so you can get 100% page coverage height (or as close as your browser & printer allow) 
// on page height while leaving the  normal user height at 100%
// some of these scanners seem to resize the image slighty horizontally or vertically or both, and this is where to compensate for that.
// you can scan a business card with print enabled and print scale at 100% to see if it prints at the same size. 
// DO NOT USE A FULL SIZE SHEET FOR THIS TEST. If Horz or vert is different, adjust it here.
// be advised that Chromium adds borders while Firefox does not from my experience
// '1' means 1:1(no adjustment), .99 means 99%, 1.1 means 110% or enlarge 10%. This is a multiplier value.
$printscaletrimh='1';
//This sets the page size used in the css and for pdf creation 
//USE ONLY 'A4', 'letter', 'legal', 'AB', 'ISOB5' or 'JISB5'- CASE SENSITIVE!
$printsize='letter';
//page orientation must be portrait or landscape for css 
//Since the scanner scans only at portrait mode this setting should be portrait
$orientation='portrait';
// page margin , varies by printer. If image is cut off on end of page set higher
// it seems some versions of Chromium browser and possibly others will always add a page Margin. 
// Firefox seems to not add its own margin
// leave in cm to be sure 
// if you change this you need to change to edit the overrides below. They are not calculated 
$margin='0.66cm';
//padding for printing, probably '0'
$padding='0';
//US Letter and Legal  
//for these settings set based on page in Portrait mode Height is the longest side of the page width is the shortest side of page
// This is a page width override for US Legal, and US Letter in inches, where margins specified above 
// are ignored and set to '0' if image is larger than this value
//this ensures that a full size sheet turns margins off
// Letter and Legal Width override
$letterlegalwidthoverride='8.24';
// This is a page heightoverride for US Letter in inches, where margins specified above are ignored 
// and set to '0' if image is slightly larger than this value
// this ensures that a full size sheet turns margins off
// letter height override
$letterheightoverride='10.74';
// This is a page height override for US Letter in inches, where margins specified above are ignored 
// and set to '0' if image is slightly larger than this value
// this ensures that a full size sheet turns margins off
// legal height override
$legalheightoverride='13.74';
// A4
// This is a page width override IN INCHES, for A4 where margins specified above are ignored and set to '0'
// and set to '0' if image is slightly larger than this value
//this ensures that a full size sheet turns margins off
// A4 width override
$a4widthoverride='8.01';
// This is a page width override IN INCHES, for A4 where margins specified above are ignored and set to '0'
// and set to '0' if image is slightly larger than this value
// this ensures that a full size sheet turns margins off
//A4 height override
$a4heightoverride='11.43';
$jisb5widthoverride='6.905';
$jisb5heightoverride='9.858';
$isob5widthoverride='6.67';
$isob5heightoverride='9.58';
// AB	210 x 257 mm	8.27 x 10.12 (Japan)
$abwidthoverride='8.01';
$abheightoverride='9.32';
// important 2.54 cm = 1 inch, in case you had forgotten.
// end copy-print functions
// options below are not fully implemented
// below is to enable escl/airscan scanning (includng linux escl) 
$allowescl='yes';
//for escl scanning clients if no, all files  deleted immediately , if yes, all saved
$saveallesclfiles='no';
$escllang='es';
?>
