AirScan Version 9.0

New in this version, PAM authentication

PAM authentication , simply put means that any user on the system can use his/her login.
The intention of PAM authentication is so that users files write to their own user directory on that server. 
They can then access their files by SMB or NFS network.
The user MUST have a "local" account on that server with a file space like /home/<username> (/home/Joe)
With PAM authenticationyou CANNOT use the File Manager "Filelister.

System MUST be set for PAM or Not PAM


non-PAM (text based) authentication:

Vesion 9 now allows the 'users' folder to be anywhere that the admin sets it.
This keeps u 
PLEASE INSTALL VERS 9.0 WITH USER LOGINS ONLY TO ROOT WEB FOLDER
YOU MIGHT BE ABLE TO RUN FROM A FOLDER ONLY IF RUNNING WITH NO LOGINS.
SORRY BUT I AM WORKING ON IT!





AirScan Version 9.0 is designed to work with:
ION AirCopy
ION AirCopy E-Post Edition
Halo Magic Scanner
Mustek iScan Air / S400W
Century CPS-A4WF
Transcription Patri Kun A4 Wi-Fi Portable Scanner
転写パットリくん A4 Wi-Fiポータブルスキャナー


To use this you will need:
One of the aforementioned scanners
A Linux x86_32 or x86_64 computer as a host
You MAY be able to run on a Raspberry Pi or other Linux based OS if you compile your own binary from http://bastel.dyndns.info/~public/s400w/
A web server with PHP support
I have now included the x86_32 and x86_64 binaries. You need only copy the approproate binary changing the name to "s400w".


AirScan was developed for the following reasons:
Lack of Linux Support for these scanners
Lack of newer 64 bit iOS support
Lack of newer OSX Support??
Lack of newer Android device support???

AirScan, once running on a Linux host,  allows scanning from any device with a modern web browser, even a Smart 
TV that otherwise does not support scanning. tested on Samsung Smart TV with integrated browser. The only thing 
I found that did not work was saving files locally but did not test with a memory stick. Also there was no 
printing as the Smart TV does not support printing. 


Free vs Paid Versions
Please note that many features can be activated or deactivated by editing config.inc.php . 
You may want to look at this file before you try scanning.


Free version
Offers basic color scanning. All files are automatically saved to the host computer. You can right click the image and save to the local device 
or share the folder from the host computer via Samba or NFS


Paid Vesion (items marked with * require a working imagemagick installation.)
Features all of the same as free version plus:
Multi user login support, providing access to only the users scans to each user.
Printing while scanning or immediately after scan.
Black and white (Grayscale) scanning*
LineArt Scanning (high Contrast)*
Rotate, flip, mirror, after scan.*
Autocrop while scanning or immediately after scan (this is very useful for some versions of these scanners that do not crop the image internally)*
Free upgrades
Email support



Host system requirements:
Linux based Apache2 (or other web server)
a workng PHP installation
Imagemagick is recommended for paid version, but not required. 
Two network interfaces are preferred, one wired to your network and one wireless to the scanner. 
You could use two wireless connections but under testing this resulted in slower data transfer rates from the scanner, probably due to close proximity of 2 Wireless adapters.
You might also have a SINGLE wireless connection with no other network connection but then you must disconnect from the internet/LAN to scan only on local host.


Usage notes:
When scanning in anything other than color, you will generate multiple files . First you will always generate the original color image, then maybe a grayscale or Line art version.
The same as above when using the autocrop while scanning, original and cropped images are saved.
If you select say autcrop, lineart and print options before scanning you will generate three files:Original, Autcroped, and Lineart files. The lineart file will then be printed. 
After scanning, paid version will show additional features when the scan is displayed such as mirror, flip, rotate, print. If one of these are selected a new file is generaed, 
saving the old one.


IMPORTANT
If setting up a new or upgraded install and have issues, please get the basics running first , by disabling imagemagick 
and user logins in config.inc.php.
Then you can enable imagemagick features, and later multiple users.



INSTALLATION

If upgradiing from previous version:
Be sure to update ALL FILES to new version as new options are added 
We do offer version upgrades for paid users , including all paid feature upgrades, free of charge.  

Make sure your scanner works with a bundled app first, like iOS or Android. I suggest while testing, download Fing for 
iOS or android. This app will help you to determine the IP address of the scanner.

You will probably want a host computer with two network interfaces. One connects to the scanner (wireless) and the other to your 
network (wired or wireless). This is not required, but recommended as in this way the scanner is available to the whole network. 
With 2 connections you need not disconnect the host from the Internet/network to connect to the scanner
The scanner only connects wirelessly so at least one must be a wireless connection.
A USB dongle is fine for the scanner, but if you want good range you might want a high power wifi dongle.
A Weak WiFi connection may result in longer image acquisition time, especially notable at 600DPI . 
The TP-Link TL-WN722N is low cost wireless adapter that seems to work well , and marked "High Gain", and has external antenna.
Connect your host to the scanner wirelessly. Some Linux distros may need tweaking to reconnect automatically. 
Make sure host reconnects to scanner when scanner is turned off then on again. This should take about a minute. 
Confirm the IP address of your scanner. Most are 192.168.18.33 but some may be different.

Configure your web server with Apache2,  PHP and ImageMagick and make sure you allow your entire LAN to see it. 
Test that you can open pages on the web server from another computer before proceeding.

copy all files from archive to your web server <WEBROOT> folder, however the index.php is not required so you can choose to omit it. 
If you omit index.php you will then need to open the scanner with http://<webserver>/airscan.php or  http://<webserver>/login.php 
if using authentication.
copy the Bastel executable (x86-64 and x86-32 in archive) from http://bastel.dyndns.info/~public/s400w/release/ to the same folder as the files from archive.

confirm that ALL the files/folders have the right owners and permissions for your web server to read and write.
be sure the s400w file is executable  

the default location for scanned images should be writable from the web server. In ubuntu:
sudo chown www-data:www-data /var/www/html/scans

Once all files are copied, edit the config.inc.php and select your default paper size and orientation as seen below.
//This sets the page size used in the css USE ONLY "A4", "letter" OR "legal"- CASE SENSITIVE!
$printsize='letter';
//page orientation must be portrait or landscape for css 
$orientation='portrait';
Have a look at the other options in this file while there. This was set up to be very flexible.There are many options.

The admin password should be set to your preference in users/admin.php

In a web browser open the web server IP address example; http://192.168.1.50 .
If you want to scan from the same machine that the web server runs on, open http://127.0.0.1/
If all is well you should see the PHPScan or login Interface. default login is admin/Teknogeekz
Turn on scanner and you should see a message that the scanner is connected after a minute or so. This time may vary on your system. 
Insert a page in the scanner. In a few moments the page will be detected. Select "Start Scan" button and in a short while you will see your scanned page on screen. 
the file is always saved to <webroot>/scans by default for admin and no logins. users scan files are folders with users name in the 'scans' folder.

If you want to display in another language open the lang.php and add the laguage near the top after the first "if" statement add: 

Default
if ($browserlang == 'en') {
$lang='en';
}
elseif ($browserlang == 'es') {
$lang='es';
}

With "de" added. ---This language designator must conform to the 2 letter ISO language that the browser detects.
if ($browserlang == 'en') {
$lang='en';
}
elseif ($browserlang == 'de') {
$lang='de';
}
elseif ($browserlang == 'es') {
$lang='es';
}

in this example we use "de" but could be most any language. For some languages you may need to edit the text encoding of all pages.

Then copy all lines between "//begin english" and "//end english"
If you choose to translate this from the spanish section you need to change the "if" at beginning to "elesif" and change
the 2 letter language identifier (de).
You then place your translated section BETWEEN the Spanish "es" and English "en" sections!

If you like the free version, you are encouraged to upgrade to the paid version 
We do not offer tech support for the free version, so if you need support upgrade to the paid version first.

For support on paid versions:
http://teknogeekz.com



Advanced settings

Creating users

users files
each user must have a config file inside the 'users' folder. This is auto generted when user is created.
You can edit this file afterwards if you want 2 users to share the same scanned images

There is also an index.php that is placed in each users scans/USERNAME folder.
usertemplate/index.php is a template for that file and is copied to each user scans/<user> directory.
One index.php file is required in each user's folder and is copied when new user is generated. 
usertemplate/index.php is a template for that file and is copied to each userd scans/<user> directory.
This prevents file browsing to other directories.

users files
You can choose NOT to show the users file link in config.inc.php and make those 
files available only by right click > download in the scan interface and/or SAMBA and/or NFS


usage Notes
When selecting all options before a scan the pricess order is as follows:
Resolution (sent to scanner to scan at specified resolution)
Deskew will be the first imagemagic process
Autocrop second imagemagick process
Black and white or Lineart conversion third imagemagick process
Print sent to client local printer
in the absence of any of the above selections the remaining items remain in the same order minus any unselected option(s)

Changelog

New in 5.0
MANY MANY refinements and bug fixes. 
New feature to allow scaling of printed/copied images. 
Better error handling if scanner is turned off, so you will no longer see long delays if you try to use scanner when turned off.

New in 5.1   20180831
I believe I found the bug with imagemagic. If you enable imagemagic and/or autocrop in config.inc.php be sure to test that you actually need it FIRST. 
Doing a small scan like a busness card may result in black on one side of the image. If you do not see large stips of black (some black may be normal is scan is crooked) ,
then you do NOT need autocrop!  Autocrop will be of no benefit and will slow scanning tgime. Halo magic scanner seems to not need it but seems that 
ION Aircopy does need it.
To configure imagemagick be sure to see the full path to imagemagick. as well as enabling it .

New in 5.2   20180901
Fixed Printing bug so that GUI remembers Print scaling setting from page to page when doing multiple consecutive scans. This was already behaviour for other settings.
Fixed Printing bug where blank page was printed if no print size was defined
Fixed "scanning" GUI message to conform to "Cropping" messages

New in 5.3 Not released
Fixed bug with cleaning and calibration utilities
Improved error messages for cleaning and Calibration when no page was inserted
Some HTML errors cleanup - still a work in progress
Some PHP code cleanup and streamlining
Fixed some Spanish language code - still a work in progress may be missing accents and special characters

New in 6.0  20180904
Rename project to AirScan
Cleanup of code 
Addition of “Rotate” and “Auto-Crop” features after image is scanned.
Improvements to scan/calibrate/clean/status if scanner was off-line or no page. Delay is now a maximum of about 10 seconds if scanner not connected.

New in 6.1  NOT RELEASED 
Code Cleanup 
Added Flip and Mirror after scan
Added Print after scan in addition to print while scanning

New in 6.2  20180914
Removed flip, rotate, crop, mirror and print  from free version. These features now available only in paid version, and require Imagemagick.

New in 6.3  NOT RELEASED
Added extraction of image DPI from exif data when no URL variable is passed for resolution. 
Added ability to turn off resolution setting. This is useful for older firmware which may support only 300dpi.
Resolution can now be fixed at either 300dpi or 600dpi. This is useful for older firmware which may support only 300dpi.

New in 7.0  20181006
Added Imagemagic processing for Grayscale and Line Art modes when scanning
Added ISO B5 Page size for printing
Added JIS B5 (Japan) Page size for printing
Added AB (Japan) Page size for printing

New in 7.1  20181201
Added button to delete currently displayed scan

New in 7.1 .1 20181228
Updated documentation to include permissions for scan folder
Updated documentation to include 32 bit binary support on 64 bit OS for default binary , and info on compling your own 64 bit binary


