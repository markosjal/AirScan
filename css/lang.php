<?php 
$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
// below offers a way to work with multiple languages on localhost only
// must add to hosts file

if ($_SERVER['HTTP_HOST']=='airscan.tecnologiadeleon.com')
{
$lang='es';
}
elseif ($_SERVER['HTTP_HOST']=='airscan.teknogeekz.com')
{
$lang='en';
}
else
{
	if ($browserlang == 'en') 
	{
	$lang='en';
	}
	elseif ($browserlang == 'es') 	
	{
	$lang='es';
	}
	else
	{
	$lang='en';
	}
}
if ($lang=='es'){
$charset='UTF-8';
$checkscannerontxt='<span style="color:#f44; font-weight:bold">Checa el escáner.</span>';
$cleancalibratetxt='Para limpiar o calibrar, inserta la<br/>hoja corespondiente antes de seguir.';
$donatetxt = '<p><center>Piensa en hacer un donativo para seguir con el desarollo de este proyecto. Recibimos donativos por PayPal a markosjal@gmail.com, o <a href="http://paypal.me/markosjal" target="_blank">Haz clic aqui para PayPal.Me</a>.</center></p>';
$notconnectedtxt = '<span style="color:#f44; font-weight:bold">El escáner no está conectado.</span>';
$connectedtxt='<span style="color:#484; font-weight:bold">El escáner está conectada.</span>';
$insertpagetxt='<span style="color:#A80; font-weight:bold">Coloca una hoja y haz clic en Arrancar escanear.</span>'; // we want this to take up two lines
$pagereadytxt='<span style="color:#484; font-weight:bold">Hoja detectada. Listo para escanear.</span>'; //queremos que ocupa dos lineas
$battlowtxt='<span style="color:#A80; font-weight:bold">La bateria esta baja.</span><br/><span style="color:#A80; font-weight:bold">Connecta al cargador.</span>';
$devbusytxt='<span style="color:#A80; font-weight:bold">La escáner esta ocupada.</span><br/><span style="color:#A80; font-weight:bold">Por Favor espere hasta que esta disponible.</span>';
$battlow='<span style="color:#f44; font-weight:bold">La bateria esta baja.</span>';
$devbusy='<span style="color:#f44; font-weight:bold">El escáner esta ocupado.</span>';
$scanready='<span style="color:#484; font-weight:bold">Listo para escanear.<br/></span>';
$downloadtxt='Se puede bajar el archivo por click derecha y escoger Guadar como';
$filemanagertxt='Administrar archivos';
$homepagetxt='Pagina Principal';
$utilitiestxt='Utilerias';
$scan300txt='Nuevo Escaneo 300 PPP';
$scan600txt='Nuevo Escaneo 600 PPP';
$copy300='Nueva Copia 300 PPP';
$copy600='Nueva Copia 600 PPP';
$stattxt='Estatus:';
$scandonetxt='Hecho';
$pagesizetxt='Tamaño: ';
$autodetectedtxt='Auto-detectar';
$modetxt='Modo:';
$colortxt='Color';
$maintenancetxt='Mantanamiento: ';
$statustxt='Estatus';
$cleantxt='Limpiar';
$calibratetxt='Calibrar';
$scantxt='Escanear:';
$copytxt='Copiar:';
$cleansuccesstxt='<span style="color:#484; font-weight:bold">Limpieza completa</span>';
$calibratesuccesstxt='<span style="color:#484; font-weight:bold">Calibración completa</span>';
$errortxt='<span style="color:#F44; font-weight:bold">Error, intenta de nuevo</span>'; 
$turnonscannertxt = '<span style="color:#f44; font-weight:bold">Prende el escáner y espere<br/>hasta que conecta por wifi.</span>';  //we want this on 2 lines
$returntoscanpagetxt='<span style="color:#777AFF; font-weight:bold">Volver a la página de escanear</span>';
$twolinestxt='&nbsp;<br/>&nbsp;';
$checkscannerpingtxt='<span style="color:#666; font-weight:bold">Checando la conección a el escáner.</span>';

$checkscannerstatustxt='<span style="color:#666; font-weight:bold">Checando el estatus de la hoja.</span>';   // we want this to take up two lines
$checkloginstatustxt='<span style="color:#666; font-weight:bold">Checando vencimiento de su sesión...</span>';
$nosupporttxt='su navegador no soporte javascript';
$dpi= 'PPP';
$dpitxt= 'PPP:';
$pdftxt='Hacer PDF';
$pdfprefixtxt='Nombre';

$printtxt='Imprimir';
$renametxt='Renombrar';
$deletetxt='Eliminar';
$autocroptxt='Auto-Recortar:';
$inches='pulg ';
$centimeters='cm ';
$pixels='px';
$waitscanningtxt='Espere, recibiendio imágen...';
$waitcroppingtxt='Espere, recortando imágen...';
$waitrotatingtxt='Espere, volteando imágen...';
$waitflippingtxt='Espere, volteando imágen...';
$waitdeletingtxt='Espere, borrando imágen...';
$waitdeskewingtxt='Espere, desviando imágen...';
$waitrenamingtxt='Espere, renombrando imágen ';
$waitbwingtxt='Espere, haciendo escala de grises...';
$waitnegativiningtxt='Espere, modificando imágen...';
$waitlineartingtxt='Espere, haciendo arte lineal...';
$waitpdfingtxt='Espere, haciendo PDF...';
$waitconvertingtxt='Espere, convertiendo imágen...';
$waitresizingtxt='Espere, redimendionando imágen...';

$dpierror='PPP no encontrado';

$scannowtxt='Arrancar Escaneo';

$yes='Sí';
$no='No';
$filestxt='Archivos';
$userfilestxt='Imágenes de '.$_SESSION['tempname'];


$userpdfstxt='PDFs de '.$username;
$jpgfilesintxt='Archivos JPG del usuario ';
$pdffilestxt='Archivos PDF del usuario ';
$printscale='Redimensionar<br/>impression:';
$widthtxt='Anch';
$heighttxt='Alt';
$nocleaningsheet='<span style="color:#f44; font-weight:bold">Coloca la hoja de limpieza</span>';
$nocalibrationsheet='<span style="color:#f44; font-weight:bold">Coloca la hoja de calibracion</span>';
$nopaperscan='<span style="color:#f44; font-weight:bold">La hoja no fue detectada</span>';
$rotatelefttxt='Girar Izquierda';
$rotaterighttxt='Girar Derecha';
$rotate180txt='Girar 180';
$croptxt='Auto Recortar';
$converttxt='Convertir';
$nopaper='<span style="color:#F44; font-weight:bold">Hoja no detectada.</span><br/>';
$mirrortxt='Espejo H';
$flipvtxt='Espejo V';
$deskewtxt='Desviarse';
$resizetxt='Redimensionar';

$fileprefix='Escan';

// cropped file with imagemagick will be appended with this before extension
$crop='Arec';
// rotated file with imagemagick will be appended with this before extension
$rotate='Gir';
//vertically flipped file with imagemagick will be appended with this before extension
$flipname='Vol';
//horizontally flipped file with imagemagick will be appended with this before extension
$flopname='Esp';
//Negaive file with imagemagick will be appended with this before extension
$negative='Neg';
//BW file with imagemagick will be appended with this before extension
$blackwhite='BN';
//LineArt file with imagemagick will be appended with this before extension
$lineart='Lin';
$deskewed='Viar';
//manual crop
$mcrop='Mrec';

//
$resizename='Dim';


// á, é, í, ó, ú, ü, ñ, ¿, ¡

$upgradetxt='Actualiza y recibe soporte tecnico y mas caracteristicas del software. Solo $29.99 USD<br/>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="TC63CB9ZDE5V4">
<input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
</form>';

$annontracking='Reservamos el derecho de rastrear el uso del software en una forma anónima. No incluye ningún dato personal.';


$colorselecttxt='Colores';
$grayselecttxt='Escala de Grises';
$lineartselecttxt='Arte Lineal';
$edgedetectselecttxt='Detect Edges';
$charcoalselecttxt='Charcoal';
$sketchselecttxt='Sketch';

//login page
$loginmessage='Iniciar sesión para escanear';
$usertxt='Usuario:';
$passtxt='Contraseña:';
$submittxt='Enviar';
$showpassword='Mostrar contraseña';

$userfilesfor='Archivos de '.$username;
$userpdfsfor='Archivos de '.$username;

$adminbutton='Admin';

$deleteuser='Eliminar usuario ';

$logout='Cerrar sesión';

$goodbye='Adios...';
$scanpage='Escanear';


$makenewuser='Agregar Nuevo Usuario';
$newusername='Nuevo usuario';
$newuserpass='Nueva contraseña';
$thereare='Hay';
$multipleusers='usuarios';
$thereis='Hay';
$singleuser='usuario';
$in='en';

$selecteduseris='Usuario escogido es';
$passwordforuser='Contraseña del usuario';
$is='es';
$scannedimagesarein='Imágenes escaneados están en';

$incorrectpassword='Contraseña incorrecta';


$suredeleteuser='¿Está seguro que quiere borrar el usuario';

$thiswilldeletscans='Todos los imágenes escaneados serán borrados también.';


$confirm='Confirmar';
$cancel='Cancelar';

$userdeletesuccess='Usuario ha sido borrado exitosamente.';

$loginasuser='Inciar sesión como '; 
$nouserselected='Ningún usuario escogido';

$alluserfilestxt='Archivos de usuarios';
$alluserpdfstxt='Archivos PDFs de usuarios';

$sorryerror='Lo sentimos, un error ha ocurrido al hacer el nuevo usuario.';

$sorrymustlogin='Lo sentimos, tiene que ingresar.';

$goback='Volver';

// á, é, í, ó, ú, ü, ñ, ¿, ¡
$createdsuccessfully = 'creado exitosamente...';
$newfilename='Nuevo nombre del archivo';
$from='de';
$to='a';
$filenameext='Nuevo nombre (archivo.ext, sin espacios)';
$filenamenoext='Nuevo nombre (sin extensión)<br/>Si ya existe un archivo del mismo nombre será sobreescrito.';

$resizing='Redimendionando';
$deleting='Eliminando';
$renaming='Renombrando';
$converting='Convertiendo';
$confirmdelete='¿Seguro que quiere borrar el imágen?';
$logoutadmin='Confirma cerrar sesión como admin y ingresar como ';
$sessionexpiresin='Su sesión se vence en ';
$sessionexpired='Su sesión se ha vencido';
$minutes=' minutos. ';
$minute=' minuto. ';
$increasetime=' <a href="javascript:history.go(0)"><span style="color:#777AFF; font-weight:bold">Ampliar sesión</span></a>';
$increasetimephp='<a href="index.php"><span style="color:#777AFF; font-weight:bold">Ampliar sesión</span></a>';
$login='Iniciar sesión';
$moveuserfilesto='Mover archivos del usuario a:';
$filemovesuccess='Archivos movidos exitosamente al usuario ';
$suremovefiles='Estas seguro que quiere mover los archivos';
$startquestion='¿';
$endquestion='?';
$startexclamation='¡';
$endexclamation='!';
$noaudioelementsupport='Su navegador no soporte el elemento de audio.';
$manualcrop='Recortar a Mano';




$printingnodpi='El archivo escogido no fue escaneado directamente,y por eso no tiene datos de PPP.<br/>Mas probable es por una conversion o otro modificación al imágen.<br/>Por favor usa el formulario abajo para fijar un valor de PPP para el erchivo .';
$confirmprintnodpi='Fija un valor y  "'.$confirm.'". Más probable quiere escoger un PPP de 300 o 600 para imprimir el mismo tamaño que el documento original.<br/>Una vez que entra el PPP , la anchura y la altura parecen en sus campos.';
$mancroptxt='Escoge la area del imágen y "'.$confirm.'" abajo.';
$mancroptxt3='<p>Tip: Si usted va a hacer mas cambios al mismo archivo, será mejor </span><a href ="convert.php?image=';


// .$image.'&newext=png.
// á, é, í, ó, ú, ü, ñ, ¿, ¡ 
$mancroptxt4='&newext=png"><span style="color:#777AFF; font-weight:bold">convert to png</span></a><span style="color:#A80; font-weight:bold"> or other lossless format first.</span></p>';
$mancroptxt2='Escoge la area para recortar y haz clic en '.$confirm.'<br/>El nuevo tamaño se parece abajo.';
$convertnewnametxt='Elige un nuevo nommbre para el acvhivo y tipo/extensión.<br/>Si ya existe un archivo del mismo nombre será sobreescrito.';
$resisingdetailstxt='Elige un nuevo altura o anchura y haz click en el otro para calcular sus dimensiones.<br/>Se puede entrar numeros en los dos campos y el aspeto original estará ignorado.';
$convertingtiptif='';
$convertingtippdf='';
$enterheight='Altura...';
$enterwidth='Anchura...';
$nopreview='Sin<br/>vista<br/>preliminar<br/><br/><br/><br/>';


$filelistertip1='Tip: Cuando recortando, convertiendo o volteando una imágen, un nuevo archivo será creado sin borrar el original.';
$filelistertip2='Tip: Archivos PDF pueden tener varios opciones como voltear, imprimir y bajar, dependiendo de su navegador.';
$filelistertip3='Tip: Se puede bajar un archivo por click derecha y Guardar como o en una pantalla tactíl, tocar y sostener';
$scantip1='Tip: Si esta escaneando en succesión, evita los opciones debajo del imágen y sus adjustes se quedan para escanear el siguiente imágen.';



$letter='Carta 8.5x11 Pulgadas';
$legal='Legal 8.5x14 Pulgadas';
$A4='A4';
$ISOB5='ISO B6';
$JISB5='JIS B5';
$AB='AB';
$auto='Auto';



}



elseif ($lang=='en'){
$charset='UTF-8';
$checkscannerontxt='<span style="color:#f44; font-weight:bold">Check scanner.</span>';

$cleancalibratetxt='To clean or calibrate, insert the corresponding<br/>sheet before clicking below.';


$donatetxt = '<p><center>Consider donating for ongoing development of this project. Donate via PayPal to markosjal@gmail.com or <a href="http://paypal.me/markosjal" target="_blank">Click here to PayPal.Me</a>.</center></p>';

$notconnectedtxt = '<span style="color:#f44; font-weight:bold">The scanner is not connected.</span>';
$connectedtxt='<span style="color:#484; font-weight:bold">The scanner is connected.</span>';
$insertpagetxt='<span style="color:#A80; font-weight:bold"><span style="color:#A80; font-weight:bold">Insert a page, then click Start Scan.</span>';// we want this to take up two lines
$pagereadytxt='<span style="color:#484; font-weight:bold">Page detected. Ready to scan.</span>'; // we want this to take up two lines
$battlowtxt='<span style="color:#A80; font-weight:bold">The battery is low.</span><br/><span style="color:#A80; font-weight:bold">Connect the charger.</span>';
$devbusytxt='<span style="color:#A80; font-weight:bold">The scanner is busy.</span><br/><span style="color:#A80; font-weight:bold">Please wait until it is available.</span>';
$battlow='<span style="color:#f44; font-weight:bold">The battery is low.</span>';
$devbusy='<span style="color:#f44; font-weight:bold">The scanner is busy.</span>';
$scanready='<span style="color:#484; font-weight:bold">Ready to scan.<br/></span>';


$downloadtxt='You can download the file by right clicking and selecting Save as or on a touch sceen select and hold.';
$filemanagertxt='File Manager';
$homepagetxt='Main Page';
$utilitiestxt='Utilities';
$scan300txt='New 300 DPI Scan';
$scan600txt='New 600 DPI Scan';
$copy300txt='New 300 DPI Copy';
$copy600txt='New 600 DPI Copy';
$stattxt='Status:';
$scandonetxt='The scan is done';
$pagesizetxt='Page Size:';
$autodetectedtxt='Auto-detected';
$modetxt='Mode:';
$colortxt='Color';
$maintenancetxt='Maintenance: ';
$statustxt='Status';
$cleantxt='Clean';
$calibratetxt='Calibrate';
$scantxt='Scan:';
$copytxt='Copy:';
$cleansuccesstxt='<span style="color:#484; font-weight:bold">Cleaning complete</span>';
$calibratesuccesstxt='<span style="color:#484; font-weight:bold">Calibration complete</span>';
$errortxt='<span style="color:#F44; font-weight:bold">Error, try again</span>'; 
$turnonscannertxt = '<span style="color:#f44;">Turn on the scanner and wait<br/>until it connects by wifi.</span>';  //we want this on 2 lines
$returntoscanpagetxt='<span style="color:#777AFF; font-weight:bold">Return to scan page</span>';
$twolinestxt='&nbsp;<br/>&nbsp;';
$checkscannerpingtxt='<span style="color:#666; font-weight:bold">Checking connection to the scanner.</span>';
$checkscannerstatustxt='<span style="color:#666; font-weight:bold">Checking page status.</span>';
$checkloginstatustxt='<span style="color:#666; font-weight:bold">Checking login expiration...</span>';
$nosupporttxt='Your browser does not support javascript.';
$dpi= 'DPI';
$dpitxt= 'DPI:';
$pdftxt='Make PDF';
$pdfprefixtxt='Name';

$printtxt='Print File';
$renametxt='Rename';
$deletetxt='Delete File';
$autocroptxt='Auto-Crop:';
$inches='in ';
$centimeters='cm ';
$pixels='px';
$waitscanningtxt='Please wait, acquiring image...';
$waitcroppingtxt='Please wait, cropping image...';
$waitrotatingtxt='Please wait, rotating image...';
$waitflippingtxt='Please wait, flipping image...';
$waitdeletingtxt='Please wait, deleting image...';
$waitdeskewingtxt='Please wait, deskewing image...';
$waitrenamingtxt='Please wait, renaming image ';
$waitbwingtxt='Please wait, making BW  image...';
$waitnegativiningtxt='Please wait, making negative image...';
$waitlineartingtxt='Please wait, making lineart image...';
$waitpdfingtxt='Please wait, converting to PDF...';
$waitconvertingtxt='Please wait, converting image...';
$waitresizingtxt='Please wait resizing image...';

$dpierror='No DPI found';
$scannowtxt='Start Scan';
$yes='Yes';
$no='No';
$filestxt='Files';
$userfilestxt=$_SESSION['tempname'].'\'s Scans';
$userpdfstxt=$username.'\'s PDFs';
$jpgfilesintxt='JPG files for user ';
$pdffilestxt='PDF files for user ';
$printscale='Print Scale:';
$widthtxt='W';
$heighttxt='H';
$nocleaningsheet='<span style="color:#f44; font-weight:bold">Load the cleaning sheet</span>';
$nocalibrationsheet='<span style="color:#f44; font-weight:bold">Load the calibration sheet</span>';
$nopaperscan='<span style="color:#f44; font-weight:bold">No Page detected.</span>';
$rotatelefttxt='Rotate Left';
$rotaterighttxt='Rotate Right';
$rotate180txt='Rotate 180';
$croptxt='Auto Crop';
$converttxt='Convert';
$nopaper='<span style="color:#F44; font-weight:bold">Page not detected.<br/></span>';
$mirrortxt='Mirror';
$flipvtxt='Flip';
$deskewtxt='Deskew';
$resizetxt='Resize';

$fileprefix='Scan';

// cropped file with imagemagick will be appended with this before extension
$crop='Crop';
// rotated file with imagemagick will be appended with this before extension
$rotate='Rotate';
//vertically flipped file with imagemagick will be appended with this before extension
$flipname='Flip';
//horizontally flipped file with imagemagick will be appended with this before extension
$flopname='Mirror';
//Negaive file with imagemagick will be appended with this before extension
$negative='Neg';
//BW file with imagemagick will be appended with this before extension
$blackwhite='BW';
//LineArt file with imagemagick will be appended with this before extension
$lineart='Line';
$deskewed='Skew';
$mcrop='Mcrop';
$resizename='Resiz';

$upgradetxt='Upgrade and get technical support and enhanced software features. Only $29.99 USD.<br/><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GMJFCBNYFSEGA">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>';
$annontracking='We reserve the right to track the use of this software. No personal data is collected in this tracking.';


$colorselecttxt='Color';
$grayselecttxt='Grayscale';
$lineartselecttxt='Line Art';
$edgedetectselecttxt='Detect Edges';
$charcoalselecttxt='Charcoal';
$sketchselecttxt='Sketch';

//login page
$loginmessage='Login to scan.';
$usertxt='Username:';
$passtxt='Password:';
$submittxt='Submit';
$showpassword='Show password';


$userfilesfor=$username.'\'s Files';
$userpdfsfor=$username.'\'s Files';


$adminbutton='User Manager';

$deleteuser='Delete user ';

$logout='Logout';
$goodbye='Goodbye...';
$scanpage='Scan';

$makenewuser='Make New User';
$newusername='New username';
$newuserpass='New password';
$thereare='There are currently';
$multipleusers='users';
$thereis='There is currently';
$singleuser='user';
$in='in';




$selecteduseris='Selected user is';
$passwordforuser='Password for user';
$is='is';
$scannedimagesarein='Scanned images are in';


$incorrectpassword='Password incorrect';


$suredeleteuser='Are you sure you want to delete the user';

$thiswilldeletscans='This will also delete all scans from this user.';

$confirm='Confirm';
$cancel='Cancel';

$userdeletesuccess='User deleted successfully.';

$loginasuser='Login as user '; 

$nouserselected='No user selected';

$alluserfilestxt='Users files';
$alluserpdfstxt='Users PDF files';

$sorryerror='Sorry, an error has occured creating user.';

$sorrymustlogin='Sorry you must log in to do that.';
$goback='Go back';

$createdsuccessfully = 'created successfully...';
$newfilename='New file name';
$from='from';
$to='to';


$filenameext='New name (filename.ext, no spaces)';
$filenamenoext='If there is a file by the same name it will be overwritten.<br/>New name (without extension)';

$resizing='Resizing';

$deleting='Deleting';
$renaming='Renaming';
$converting='Converting';
$confirmdelete='Are you sure you want to delete this file?';
$logoutadmin='This will logout admin and log you in as ';
$sessionexpiresin='Your session expires in ';
$sessionexpired='Your session has expired';
$minutes=' minutes. ';
$minute=' minute. ';
$increasetime='<a href="javascript:history.go(0)"><span style="color:#777AFF; font-weight:bold">Extend login</span></a>';
$increasetimephp='<a href="index.php"><span style="color:#777AFF; font-weight:bold">Extend login</span></a>';

$login='Log in';
$moveuserfilesto='Move user files to:';
$filemovesuccess='Files moved successfully to user ';
$suremovefiles='Are you sure you want to move files';
$startquestion='';
$endquestion='?';
$startexclamation='';
$endexclamation='!';
$noaudioelementsupport='Your browser does not support the audio element.';
$manualcrop='Manual Crop';
$printingnodpi='The file selected for printing was not directly scanned and therefore has no DPI data embedded.<br/>This may be due to a conversion or other modification of the image.<br/>To attain a printed copy the same size as the original, please select the original DPI.<br/>Please use the form below to set a resolution for printing of ';
$confirmprintnodpi='Set a DPI value then click "'.$confirm.'".<br/>You probably want to enter 300 or 600 to match the size of the original scan.<br/>When you enter the DPI, the height and width fields will display the size of the printed image.';
//$mancroptxt='Make your selection by dragging over the desired portion, then click "Confirm" below.<br/>If you will be making more file operations on this image, it may be best to convert to png or other lossless format first.';
$mancroptxt2='Select the desired crop area then click "confirm".<br/>The selected size is displayed below.';

$mancroptxt='Make your selection by dragging over the desired portion, then click "Confirm" below.';
$mancroptxt3='<p>Tip: If you will be making more operations on this image, it may be best to </span><a href ="convert.php?image=';

// .$image.'&newext=png.

$mancroptxt4='&newext=png"><span style="color:#777AFF; font-weight:bold">convert to png</span></a><span style="color:#A80; font-weight:bold"> or other lossless format first.</span></p>';
$mancroptxt2='Select the desired crop area then click "confirm".<br/>The selected size is displayed below.';
$convertnewnametxt='Enter a new file name and select the type/extension<br/>If there is a file by the same name it will be overwritten.';
$resisingdetailstxt='Enter a new width or height and click on the remaining field to calculate it.<br/>If you enter both fields manually, the aspect ratio will be ignored.';
$convertingtiptif='';
$convertingtippdf='';
$enterheight='Enter height...';
$enterwidth='Enter width...';
$nopreview='No<br/>preview<br/>available<br/><br/><br/><br/>';


$filelistertip1='Tip: When converting, rotating or cropping a file, a new file is created and the original remains intact';
$filelistertip2='Tip: Depending on your browser, PDFs may have different features available like print, rotate, download.';
$filelistertip3='Tip: You can download a file by right clicking and selecting Save as or on a touch sceen select and hold.';
$scantip1='Tip: If doing successive scans, avoid the use of the buttons below image after scan. Settings will then be retained between scans';

$letter='Carta 8.5x11 in';
$legal='Legal 8.5x14 in';
$A4='A4';
$ISOB5='ISO B6';
$JISB5='JIS B5';
$AB='AB';
$auto='Auto';

}



?>





