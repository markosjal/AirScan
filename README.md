# AirScan

 
  PLEASE NOTE THIS PROJECT IS BEING MOVED TO http://scannershare.com . I DO NOT UNDERSTAND GITHUB AND PROBABLY NEVER WILL, SO I GIVE UP ON GITHUB
  
  THIS PROJECT IS BEING BROKEN INTO 2 PARTS
  
  1) GUI for Scanning from a web browser
  2) eSCL/AirScan interface to scan from Windows 11, MacOS(native scanning), Linux(with SANE-AirScan back-end), Android(Mopria Scan), iOS(AirScanner app) or ChromeOS(Mopria Scan)
  
  Part 1 is under reconstruction. It will take some time.
  
  Part2 is ready for download, and runs on Windows, MacOS or Linux.  You can download at scannershare.com. 
  
  There will be no future "combined" version however they will both be built and maintained in a way that they can be used and run on the same machine.
  
  in short Part 2 makes one of these scanners an eSCL/AirScan compatible Scanner on your network by way of a Mac or Linux computer. You can then make use of whatever scanning app that is in your OS. Linux users will need sane-airscan back-end https://github.com/alexpevzner/sane-airscan. It was tested on OSX10.15 and Ubuntu 10.04. It has not been tested on M1 and may need an M1 specific binary made from bastel source.
  
  
  
  --------------------------END UPDATE-----------------------------------------------
  
  
  
  
   eSCL and SANE support for:

  	Century CPS-A4WF

  	Halo Magic Scanner

  	ION AirCopy

  	ION AirCopy E-Post Edition

  	iScan Fly
	
	Kaiser Baas WiFi Photo & Document Scanner

  	Mustek iScan Air / S400W

  	Transcription Patri Kun A4 Wi-Fi Portable Scanner

  	転写パットリくん A4 Wi-Fiポータブルスキャナー

This software , I felt was not ready for release then I discoverd sane-airscan (https://github.com/alexpevzner/sane-airscan) and found the two to be fully compatible. I felt Linux users may need this. Now despite the eSCL/AirScan not being fully functonal from OSX and Mopria I decided to release it for the benefit of Linux SANE users. There remains some sloppy code and test files, etc. Hopefully over time it will get cleaned up.

This software stand-alone for a web GUI and limited eSCL support:

  	eSCL/AirPrnt functionality for OSX and Mopria is incomplete, however it will get you a scanner GUI from which you can scan with a web browser. 
	

This software with sane-airscan to scan from most any Linux application:

  	This software combined with sane-airscan (https://github.com/alexpevzner/sane-airscan) as described below will give you SANE support for this scanner.


This software with your command line scanner under linux:

	I am interested in anyone who may have created a command line scanner for any scanner not otherwise supported in SANE. As I can fairly easily modify this software to accommodate your comand line scanner.



SANE support is a 2 part process. You will need:

	This version of AirScan

	and

	https://github.com/alexpevzner/sane-airscan


AirScan is a web GUI and eSCL interface for these scanners. The host will advertise the scanner as an eSCL scanner on the network and process requests for it , translating scan comands to the scanner. It was tested entirely under Apache 2.4 and PHP 7 on Ubuntu 16.04 x86_64 and Debian on Raspberry Pi 3 .  It can run on any Linux machine on your local network.  It will provides a web GUI with Scanning to JPG or PDF , even multi-page PDF via the web GUI is available. It will also allow the scanner to be accessed via the software package listed below, which is a SANE back-end. The files are easily installable either to local machine or server. Most files are simply copied to web root directory, with a few exceptons.
You will need on host machine: apache2 , PHP7, avahi-daemon , mod_dir, mod_rewrite, A wired or wireless interface to your LAN (wired recomended) , and an available wireless connection dedicated to connect to the scanner.


The second part of the software is the sane-airscan back-end. (Option A) You will need to install sane-airscan on all of the client machines   (there are some repos for easy installaton), or (Option B) install sane-airscan on the same machine hosting the scanner and AirScan only . (Option C) is that the Scanner Host and user workstation may be the same linux machine already and sane-airsccan is also installed there.. Although sane-airscan was created for accessing eSCL/AirScan protocol scanners, it has been tested as working with the AirScan listed above.

Option A would share the scanner from the main host machine to other computers using the eSCL protocol. This is probably the preferred method in a multi-computer environment, unless you already have other SANE shared scanners.

Option B would share the scanner from the primary client machine to other client machines by way of SANE protocol.

Option C is recommended for a single computer, or sharing exclusively over SANE protocol.

As you can see there are various options for how to make it all work. Fear not, it is easy. I think option A or C are suitable for most environments. On other platforms, Vuescan for Windows, OSX, and Linux can use the scanner installed with option A , B or C becuase in any case the scanner will still advertise as eSCL.

NOTE:
	It is highly recommended that the host computer (running this software) have a Wirwed LAN connection to the network, and an available Wifi connection to connect to the scanner. 
	
	You can run this software with only a single LAN connection (Wifi), however you will not be able to share the scanner and must connect to either your LAN or the scanner. 




UNTESTED:

	Runnng on web servers other than Apache 2.4
	
	PHP versins other than 7.0




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
	
	Web GUI in Spanish or english depending on browser language preference. 
	
	language file available for adding your own translation.
	
	Toast UI mage editor included
	
	Copy function

	Users have access only to their own scans. There are two authentication methods for the web GUI


  		Text based usernames and passwords generated from the admin login menu

  		PAM authentication usng PAM accounts installed on the host machine


eSCL/AirPrint:

	support is not complete. There seem to be some remainng issues scanning from OSX and Mopria Scan. Also there is some tweaking needed still to get PDFs to eSCL/AirScan clients directly.

	It seems SimpleScan and XSane give good support for these scanners in SANE with this configuration. The limitations come from the scanner.




Installing this software:

	Copy all files to the web root of your web server.

	rename htaccess .htaccess

	rename the appropriate binary file to s400w, and make it executable. Binaries included for Raspberry Pi 2/3 , x86_32, and x86_64. You could also compile a binary for OSX or other architecture more than likely.

	Check config.inc.php to ensure the settings match your needs and installation.

	Install the lines in config/apache2.conf to your apache2.conf

	Confirm the paths are the same as yours n apache2.conf

	install the config/uscan.service to /etc/avahi/service 

	edit /etc/avahi/service to reflect your host name where it is now raspberrypi.local.

	for any PAM authenticated users create ~/Pictures/scans in the users home folder

	run a2enmod dir (you may need to run this with sudo)

	run a2enmod rewrite (you may need to run this with sudo)

   	Set appropriate permissins on all files for the web server . In debian/ubuntu you probably want to run sudo chown -r www-data:www-data *
	
	delete config folder fromweb server
	
	reboot the host machine

	Turn on scanner

	Set the host machine to always connect to scanner's wifi with a dedicated wifi adapter. This procedure may vary depending on distro.

	Install Imagemagic if you want conversion features in web GUI, scan to Grayscale or PDF, etc.
	
	If using Ubuntu with ImageMagick 6.8.9-9 be aware of this: https://askubuntu.com/questions/1081695/error-during-converting-jpg-to-pdf




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


Normal Use

	This web GUI will slow down horriby if too many fles are in the users folders. For this reason, this space should be seen a a temporary area and files should be copied away from these folders. 
	
This software was spawned from the code here 
http://bastel.dyndns.info/~public/s400w/
http://bastel.duckduckdns.com/~public/s400w/
now available only as an archive here:
https://web.archive.org/web/20190125153443/http://bastel.dyndns.info/~public/s400w/

There are three vesions of the binary included. with this code. x86-32, x86-64 and Raspberry Pi 2/3

GitHub is warning about security issues in the Toast UI image editor. Because this is a LAN App and not run over the Internet , I do not see it as a high priority but will hopefully get the Toast UI image eitor updated, although I can not guarantee this will fix the vulnerabilities. If you are worried about it, you can always delete the Toast UI files.
