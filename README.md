# AirScan

eSCL and SANE support for:

Century CPS-A4WF

Halo Magic Scanner

ION AirCopy

ION AirCopy E-Post Edition

iScan Fly

Mustek iScan Air / S400W

Transcription Patri Kun A4 Wi-Fi Portable Scanner

転写パットリくん A4 Wi-Fiポータブルスキャナー

This software , I felt was not ready for release then I discoverd sane-airscan (https://github.com/alexpevzner/sane-airscan) and found the two to be fully compatible. I felt Linux users may need this. Now despite the eSCL/AirScan not being fully functonal from OSX and Mopria I decided to release it for the benefit of Linux SANE users.

This software stand-alone:

eSCL/AirPrnt functionality for OSX and Mopria is incomplete, however it will get you a scanner GUI from which you can scan with a web browser. 


This software with sane-airscan:

This software combined with sane-airscan (https://github.com/alexpevzner/sane-airscan) as described below will give you SANE support for this scanner.


SANE support is a 2 part process. You will need:

This version of AirScan

and

https://github.com/alexpevzner/sane-airscan
AirScan is a web GUI and eSCL interface for these scanners. It will advertise the scanner as an eSCL scanner on the network and process requests. It was tested entirely under Apache 2.6 and PHP 7 on Ubuntu 16.04 x86_64 and Debian on Raspberry Pi 3 .  It can run on any Linux machine on your local network.  It will provide a web GUI with Scanning to JPG or PDF , even multi-page PDF via the web GUI is available. It will also allow the scanner to be accessed via the second software package listed below, which is a SANE back-end. The files are easily installable either to local machine or server. Most files are simply copied to web root directory, with a few exceptons.
You will need on host machine: apache2 , PHP7, avahi-daemon , mod_dir, mod_rewrite, A wired or wireless interface to your LAN (wired recomended) , and an available wireless connection dedicated to connect to the scanner.


The second part of the software is the sane-airscan back-end. You will need to install it on the client machine (there are some repos for easy installaton) . Although this was created for accessing eSCL/AirScan protocol scanners, it has been tested as working with the AirScan listed above.


UNTESTED:

Running parts 1 and 2 on same machine with LOCALHOST connecton

Runnng on other web servers


Scanner Supported features/limitations:

Connect only via Wifi.

Mini USB is for charging only.

Should have only one WiFi client connected at a time.

Support jpg scannng only as the output format.

Support only 300 and 600 dpi resolutions

Single sheet feed scanners and there is no real "preview" available.

Micro SD slot on some models is not supported.


Using with SANE:

One can choose 300 or 600 dpi resolutons, the only two supported by the scanner.

Conversions to PDF in XSane were somewhat sketchy. This I believe is because XSane uses the size/resolution of the selected platen area and not the actual image.


Using with included Web GUI:

If imagemagick is installed the Web GUI can create single or Multi page PDFs, image format conversion, rotate, auto-crop, etc. These functions can be slow on Raspberry Pi 2 or 3.

Users have access only to their own scans. There are two authentication methods for the web GUI


  Text based usernames and passwords generated from the admin login menu

  PAM authentication usng PAM accounts installed on the host machine


eSCL/AirPrint:

support is not complete. There seem to be some remainng issues scanning from OSX and Mopria Scan. Also there is some tweaking needed still to get PDFs to eSCL/AirScan clients directly.

It seems SimpleScan and XSane give good support for these scanners in SANE with this configuration. The limitations come from the scanner.


Installing this software:

Copy all files in webroot to the web root of your web server.

rename htaccess .htaccess

rename the appropriate binary file to s400w,. Binaries included for Raspberry Pi 2/3 , x86_32, and x86_64. You could also 
compile a binary for OSX or other architecture more than likely.

Check config.inc.php to ensure the settings match your needs and installation.

Install the lines in config/apache2.conf to your apache2.conf

Confirm the paths are the same as yours n apache2.conf

install the config/uscan.service to /etc/avahi/service 

edit /etc/avahi/service to reflect your host name where it is now raspberrypi.local.

for any PAM authenticated users create ~/Pictures/scans in the users home folder

run a2enmod dir (you may need to run this with sudo)

run a2enmod rewrite (you may need to run this with sudo)

reboot the host machine

Turn on scanner

Set the host machine to always connect to scanner's wifi with a dedicated wifi adapter. This procedure may vary depending on distro.

Install Imagemagic if you want conversion features in web GUI.


Testing:

turn on scanner

open in a web browser: http://<IPADDRESS of host>:80

at the login secreen username/password is admin/Teknogeekz

You should land on the user administrator page where you can create text based users, and see users scans.

The software should also allow login with any user credentials on the host system using PAM authentication. You need not use the admin user at all.  

Click on Scan in upper left corner of frame. 

Check that scanner is shoowing as connected in the scan page of web GUI

Insert a page and within several seconds the page should show ready to scan. 

Click scan.


If all above tests well and you want SANE support, proceed to:

https://github.com/alexpevzner/sane-airscan  

and install the package found there
