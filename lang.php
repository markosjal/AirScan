<?php 
//include_once 'config.inc.php';
$filemanagerunits='both';
//$filemanagerunits='cm';
//$filemanagerunits='in';
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
//this first setting is only to keep the scan page from jumping left/right depending on language. 
//Only if you add a language (or some broswers may require adjusting it)
//fixes horizontal shifting when selecting yes/no on Multi-Page PDF option. Increase if page shifts changing selection. 
// also depends on browser used. Firefox needs higher setting than Chromium
//$scanrightcolumwidth='317';
//
$waitscanning='Escaneando, espere...';
$scanrightcolumwidths400w='317';
$scanrightcolumwidthescl='356';
$scanrightcolumwidthsane='330';
$charset='UTF-8';
$checkscannerontxt='<span style="color:#f44; font-weight:bold">Checa el escáner.</span>';
$cleancalibratetxt='Para limpiar o calibrar, coloca la<br/>hoja corespondiente antes de seguir.';
$donatetxt = '<p><center>Piensa en hacer un donativo para seguir con el desarollo de este proyecto. Recibimos donativos por PayPal a markosjal@gmail.com, o <a href="http://paypal.me/markosjal" target="_blank">Haz clic aqui para PayPal.Me</a>.</center></p>';
$notconnectedtxt = '<span style="color:#f44; font-weight:bold">El escáner no está conectado.</span>';
$connectedtxt='<span style="color:#484; font-weight:bold">El escáner está conectada.</span>';
$insertpagetxt='<span style="color:#A80; font-weight:bold">Coloca una hoja para escanear.</span>'; 
$pagereadytxt='<span style="color:#484; font-weight:bold">Hoja detectada. Listo para escanear.</span>'; 
$battlowtxt='<span style="color:#F44; font-weight:bold">Batería baja, connecta al cargador.</span>';
$devbusytxt='<span style="color:#A80; font-weight:bold">Está ocupado, Por Favor espere.</span>';
$battlow='<span style="color:#f44; font-weight:bold">La batería está baja.</span>';
$devbusy='<span style="color:#f44; font-weight:bold">El escáner está ocupado.</span>';
$scanready='<span style="color:#484; font-weight:bold">Listo para escanear.<br/></span>';
$processing='<span style="color:#A80; font-weight:bold">Procesando</span>';
$idle='<span style="color:#484; font-weight:bold">Listo</span>';
$stopped='<span style="color:#f44; font-weight:bold">Parado</span>';
$downloadtxt='Se puede bajar un archivo por click derecha y "Guardar como" o en una pantalla tactíl, tocar y sostener';
$filemanagertxt='Administrar archivos';
$homepagetxt='Pagina Principal';
$utilitiestxt='Utilerias';
$scan300txt='Nuevo Escaneo 300 ppp';
$scan600txt='Nuevo Escaneo 600 ppp';
$copy300='Nueva Copia 300 ppp';
$copy600='Nueva Copia 600 ppp';
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
$checkscannerstatustxt='<span style="color:#666; font-weight:bold">Checando el estatus del escáner.</span>';   // we want this to take up two lines
$checkloginstatustxt='<span style="font-size: larger; color:#666; font-weight:bold">Checando vencimiento de su sesión...</span>';
$nosupporttxt='su navegador no soporte javascript';
$dpi= 'ppp';
$dpitxt= 'ppp:';
$pdftxt='Hacer PDF';
//$pdfprefixtxt='Nombre';
$deltmptxt='Borrar Temp:';
$printtxt='Imprimir';
$renametxt='Renombrar';
$deletetxt='Eliminar';
$autocroptxt='Auto-Recortar:';
$inches='pulg ';
$centimeters='cm ';
$pixels='px';
$waitscanningtxt='Espere, recibiendio imágen...';
$waitcroppingtxt='Espere, recortando imágen...';
$waitrotatingtxt='Espere, girando imágen...';
$waitflippingtxt='Espere, girando imágen...';
$waitdeletingtxt='Espere, borrando imágen...';
$waitdeskewingtxt='Espere, desviando imágen...';
$waitrenamingtxt='Espere, renombrando imágen ';
$waitbwingtxt='Espere, haciendo escala de grises...';
$waitnegativiningtxt='Espere, modificando imágen...';
$waitlineartingtxt='Espere, haciendo arte lineal...';
$waitpdfingtxt='Espere, haciendo PDF, se puede tardar minutos...';
$waitconvertingtxt='Espere, convertiendo imágen...';
$waitresizingtxt='Espere, redimendionando imágen...';
$dpierror='ppp no encontrado';
$scannowtxt='Arrancar Escaneo';
$scanningtxt='Escaneando';
$yes='&nbsp;&nbsp;Sí';
$no='No';
$name='Nombre';
$filestxt='Archivos';
$userfilestxt='Imágenes de '.$_SESSION['tempname'];
$userpdfstxt='PDFs de '.$_SESSION['username'];
$jpgfilesintxt='Archivos del usuario ';
$pdffilestxt='Archivos PDF del usuario ';
$printscale='Redimensionar:';
$widthtxt='Anch';
$heighttxt='Alt';
$nocleaningsheet='<span style="color:#f44; font-weight:bold">Coloca la hoja de limpieza</span>';
$nocalibrationsheet='<span style="color:#f44; font-weight:bold">Coloca la hoja de calibracion</span>';
$nopaperscan='<span style="color:#f44; font-weight:bold">La hoja no fue detectada</span>';
$rotatetxt='Girar';
$rotatelefttxt='Girar Izquierda 90 grados';
$rotaterighttxt='Girar Derecha 90 grados';
$rotate180txt='Girar 180 grados';
$croptxt='ARecortar';
$converttxt='Convertir';
$nopaper='<span style="color:#F44; font-weight:bold">Hoja no detectada.</span><br/>';
$mirrortxt='Espejo H';
$flipvtxt='Espejo V';
$fliptxt='Espejo';
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
$userfilesfor='Archivos de '.$_SESSION['username'];
$userpdfsfor='Archivos de '.$_SESSION['username'];
$adminbutton='Admin';
$deleteuser='Eliminar usuario ';
$logout='Cerrar sesión';
$goodbye='Adios...';
$scanpage='Escanear';
$makenewuser='Agregar Nuevo Usuario';
$newusername='Nuevo usuario';
$newuserpass='Nueva contraseña';
$thereare='Hay';
$multipleusers='Usuarios';
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
$alluserfilestxt='Archivos del usuario';
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
$cropping='Recortando';
$resizing='Redimendionando';
$deleting='Eliminando';
$renaming='Renombrando';
$rotating='Girando';
$converting='Convertiendo';
$confirmdelete='¿Seguro que quiere borrar el imágen?';
$logoutadmin='Confirma cerrar sesión como admin y ingresar como ';
$sessionexpiresin='Su sesión se vence en ';
$sessionexpired='Su sesión se ha vencido';
$minutes=' minutos. ';
$minute=' minuto. ';
$increasetime=' <a href="javascript:history.go(0)"><span style="font-size: larger; color:#777AFF; font-weight:bold">Ampliar Sesión</span></a>';
$increasetimephp='<a href="index.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">Ampliar Sesión</span></a>';
$login='Iniciar sesión';
$moveuserfilesto='Mover archivos del usuario a:';
$filemovesuccess='Archivos movidos exitosamente de ';
$suremovefiles='Estas seguro que quiere mover los archivos';
$startquestion='¿';
$endquestion='?';
$startexclamation='¡';
$endexclamation='!';
$noaudioelementsupport='Su navegador no soporte el elemento de audio.';
$manualcrop='ManRecortar';
$printingnodpi='El archivo escogido no fue escaneado directamente,y por eso no tiene datos de ppp.<br/>Mas probable es por una conversion o otro modificación al imágen.<br/>Por favor usa el formulario abajo para fijar un valor de ppp para el erchivo .';
$confirmprintnodpi='Fija un valor y  "'.$confirm.'". Más probable quiere escoger un ppp de 300 o 600 para imprimir el mismo tamaño que el documento original.<br/>Una vez que entra el ppp , la anchura y la altura parecen en sus campos.';
$mcrop='MRecortar';
$mancroptxt='Escoge la area del imágen y "'.$confirm.'" abajo.';
//$mancroptxt3='<p>Tip: Si usted va a hacer mas cambios al mismo archivo, será mejor </span><a href ="convert.php?image=';
$mancroptip1='<p>Tip: Si usted va a hacer mas cambios al mismo archivo, debe guadrdarlo como png ahora</p>.';
// .$image.'&newext=png.
// á, é, í, ó, ú, ü, ñ, ¿, ¡ 
//$mancroptxt4='&newext=png"><span style="color:#777AFF; font-weight:bold">guadrar como png</span></a><span style="color:#A80; font-weight:bold"> ahora.</span></p>';
$mancroptxt2='Escoge la area para recortar y haz clic en '.$confirm.'<br/>El nuevo tamaño se parece abajo.';
$convertnewnametxt='Elige un nuevo nommbre para el acvhivo y tipo/extensión.<br/>Si ya existe un archivo del mismo nombre será sobreescrito.';
$resisingdetailstxt='Elige un nuevo altura o anchura y haz click en el otro para calcular sus dimensiones.<br/>Se puede entrar numeros en los dos campos y el aspeto original estará ignorado.';
$convertingtiptif='';
$convertingtippdf='';
$enterheight='Altura...';
$enterwidth='Anchura...';
$nopreview='Sin<br/>vista<br/>preliminar<br/><br/><br/><br/>';
$filelistertip1='Tip: Al girar, redimensionar o recortar una imágen, un nuevo archivo será creado sin borrar el original.';
$filelistertip2='Tip: Si va a hacer varios cambios a un archivo, sera mejor convertirlo a un PNG primero.';
$filelistertip3='Tip: Se puede bajar un archivo por click derecha y "Guardar como" o en una pantalla tactíl, tocar y sostener';
$filelistertip4='Tip: Con AirScan, debe usar una sola ventana o pestaña a la vez. No debe tener AirScan abierto en dos pestañas ni ventanas del mismo navegador.';
$filelistertip5='Tip: Debe mover los archivos de aqui a otra carpeta. Si no, se afeta el rendimiento del filelister.';


$scantip1='Tip: Si está escaneando en succesión, evita los opciones debajo del imágen y sus adjustes se quedan para escanear el siguiente imágen.';
$scantip2='Tip: Cuandio se usa la opción de desviarse,no es necesario usar la opción deskew option de auto-recortar. La opción de desviar, recorta el imagen tambien.';
$scantip3='Tip: Cuando se escoge escala de grises, arte lineal, auto-recortar y desviar, la imagen original, está guardado y tambien una imagen en cada paso.';
$scantip4='Tip: Con AirScan, debe usar una sola ventana o pestaña a la vez. No debe tener AirScan abierto en dos pestañas ni ventanas del mismo navegador.';
$pdfscantip1='Tip: Cuando hace un PDF de multi-página, es muy recomendable usar el mismo PPP para todas las hojas.';
$pdfscantip2='Tip: Cuando hace un PDF de multi-página, debe escanear los documentos en el orden deseado en el PDF final.';
$pdfscantip3='Tip: Al terminar de esanear hojas para un PDF multi-página, y despues de ver el PDF final, debe borrar los archivs escaneados para PDF.';
$usermanagertip1='Tip: Para manejar usuarios PAM, tiene que hacerlo del servidor que corre AirScan.';
$usermanagertip2='Tip: Cuando se borre un usuario, los archivos del usuario estan borrados también.';
//$usermanagertip3='Tip: Con authenticacion por texto, se puede editar los archivos en el directorio "users", para permitir que varios usuarios comparten los mismos archivos.';
$usermanagertip3='Tip: Usuarios de texto deben ser nombres unicamente. No debe hacer un usuario numerico por texto. ';
$usermanagertip4='Tip: Con usar "softlinks", dos o mas usuarios por texto pueden compartir el mismo espacio y archivos. Lo mismo, dos usuarios de PAM pueden compartir también';


$edittip1='Tip: Hojas completas de 600 PPP pueden hacer el editor mover despaciamente. Piensa en usar herramientas de "Editar Rápido".';
$edittip2='Tip: Una vez que abre un imagen en el editor, esta convertido al formato PNG, y sólo se puede descargarlo.';
$edittip3='Tip: La estructura del editor no se permite el uso del link "Ampliar Sesión". Su sesión siempre esta ampliado al entrar al editor.';
$loadingpleasewait='Cargando, espere por favor...';
$multipage='Multi-Página:';
$pdfjpg='PDF/JPG:';
$page='Página';
$loadproject='Cargar Proyecto';
$deletescans='Borrar Archivos';
$viewpdf='Ver PDF';
$makepdf='Hacer PDF';
$pdfprojectname='Nombre del Proyecto PDF:&nbsp;';
$pdfproject='Proyecto PDF:';
$loadmppdfproject='Volver a un Proyecto de PDF Multi-Página:';
$pdfprojectscans='Páginas en el proyecto PDF';
$pagesizetipescl='Aqui escoge el tamaño de la pagina. Presentamos los tamaños comunes de su escánear y del software. El tamaño de hoja por defecto ha sido escogido, pero se puede cambiar. También afeta el tamaño de hoja si hace un PDF.';
$pagesizetips400w='El escaneár s400w no ofrece escoger el eamaño de hoja, es automatico. ';
$mppdftip='Escoge Sí para empezar un nuevo proyecto de PDF Multi-Pagina o seguir con un proyecto PDF Multi-Página. Al contrario, escoge No.';
$pdfnametip='Escoge un nombre para iniciar un nuevo proyecto de PDF Multi-Página, o seguir con un proyecto existente de PDF Multi-Página. El nombre será el nombre del PDF final, y un prefijo a páginas escaneados para el proyecto. .';
$pdfjpgtip='Escoge el formato del archivo para escanear una sola hoja.';
$modetip='Escoge de Colores, Escala de Grises, o Arte Lineal. Requires Imagemagick.';
$dpitip='Escoge PPP (Píxeles Por Pulgada). Lo más alto el numero, lo más alto la calidad y más grande el archivo.';
$deskewtip='Escoge Sí para corregir una hoja que escanea chueco, y recortar el negro del imágen. Se recomienda dejar Borrar Temp en No, porque no sirve en todos imágenes. Debe funcionar con todos tipos de imagenes.';
$autocroptip='Escoge Sí para recortar el negro del imágen. Se recomienda dejar Borrar Temp en No, porque no sirve en todos imágenes. Sirve mejor con hojas de documentos escaneados de papel blanco.';
$printtip='Escoge Sí para imprimir un imágen al escanear. Si quiere usar lo como copiadora con su impresora, escoge Sí.';
$printscaletip='Por defecto, un documento escaneado se imprime en mas o menos el mismo tamaño que el original. Aquí se puede cambiar el tamaño de la impresión.';
$deltmptip='Al escoger escala de Grises , Arte Lineal , Auto-Recortar o Desviar, hay un archivo generado para cada paso. Aqui se puede borrar los archivos temporales y quedar solo con el ultimo archivo, borrando los demás. Debe escoger No debe usarlo con Desviar o Auto-Recortar.';
$scantip='Haz clic para escanear despues de fijar los opciones.';
$editor='Editar';
$grayscaletxt='Grises';
$linearttxt='ArteLineal';
if ($filemanagerunits=='both')
{
$letter='Carta, 8.5x11pul, 216x279mm';
$legal='Legal, 8.5x14pul, 216x356mm';
$A4='A4, 8.27×11.69pul, 210×297mm';
$ISOB5='ISO B5, 6.9x9.8pul, 176x250mm';
$JISB5='JIS B5, 7.2x10.1pul, 182x257mm';
$AB='AB, 8.27x10.12pul, 210x257mm';
}
elseif ($filemanagerunits=='in')
{
$letter='Carta, 8.5 x 11 pul';
$legal='Legal, 8.5 x 14 pul';
$A4='A4, 8.27 × 11.69 pul';
$ISOB5='ISO B5, 6.9 x 9.8 pul';
$JISB5='JIS B5, 7.2 x 10.1 pul';
$AB='AB, 8.27 x 10.12 pul';
}
elseif ($filemanagerunits=='cm')
{
$letter='Carta, 216 x 279 mm';
$legal='Legal, 216 x 356 mm';
$A4='A4, 210 × 297 mm';
$ISOB5='ISO B5, 176 x 250 mm';
$JISB5='JIS B5, 182 x 257 mm';
$AB='AB, 210 x 257 mm';
}
$auto='Auto';
$setdpi='Adjuste PPP';
$setpagesize= 'Adjuste Tamaño de Hoja';
$nofilesfound='Archivos no encontrado.';
$tryagain='Intentar de nuevo';
//tooltips on filelister
$deletetip='Borrar el archivo';
$printtip='Imprimir archivo';
$edittip='Editar en el editor de imágenes';
$resizetip='Rediminsionar';
$rotatel90tip='Girar izquierda 90 grados';
$rotater90tip='Girar derecha 90 grados';
$rotate180tip='Girar 180 grados';
$deskewtip2='Desviar (si el imagen salio chueco)';
$autocroptip2='Recortar automatico (si tiene bordes negros)';
$mancroptip='Recortar a mano';
$grayscaletip='Conertir a escala de grises (quitar color)';
$linearttip='Convertir a arte lineal (quitar colores y hacer alta contraste)';
$flipvtip='Voltear Vertical (espejo)';
$fliphtip='Voltear Horizontal (espejo)';
$converttip='Convertir a otro formato';
$renametip='Renombrar archivo';
$quickedit= 'Editar Rápido:';
$infotxt="Información";
$lettertxt='Carta';
$legaltxt='Oficio';
$A4txt='ISO A4';
$ISOB5txt='ISO B5';
$JISB5txt='JIS B5';
$ABtxt='AB';
$bonjourstatustxt= 'Estatus Bonjour';
$esclstatustxt='Estatus eSCL';
$esclcapabilitiestxt='Capacidades eSCL';
$sanetesttxt='Sanity Check';
$sanescannerstxt='SANE Scanners';
$sanescannerinfotxt='Scanner Info';
//for TUI Image editor
$nobrowsersupport='Su navegador no soporte el API';
$doubleclick='Doble Clic';
// below is for translation of image editor
$editortranslation="
var locale_es_US = { // override default English locale to your custom
    '3:2': '3:2',
    '4:3': '4:3',
    '5:4': '5:4',
    '7:5': '7:5',
    '16:9': '16:9',
    'Apply': 'Aplcar',
    'Arrow': 'Flecha',
    'Arrow-2': 'Flecha-2',
    'Arrow-3': 'Flecha-3',
    'B': 'N',
    'Blend': 'Mezclar',
    'Blur': 'Desenfoque',
    'Bold': 'Negrita',
    'Brightness': 'Luminosidad', 
    'Bubble': 'Burbuja',
    'Cancel': 'Cancelar',
    'Center': 'Centrar',
    'Circle': 'Circulo',
    'Color': 'Colores',
    'Color Filter': 'Filtrar colores',
    'Crop': 'Recortar',
    'Custom': 'A medida',
    'Custom icon': 'Icono a medida',
    'Delete': 'Borrar',
    'Delete-all': 'Borrar todo',
    'Distance': 'Distancia',
    'Download': 'Descargar',
    'Draw': 'Dibujar',
	'Emboss': 'Realzar',
	'Fill': 'Llenar',
	'Filter': 'Filtrar',
	'Flip': 'Voltear',
	'Flip X': 'Voltear X',
	'Flip Y': 'Voltear Y',
	'Free': 'Libre',
	'Grayscale': 'Esc. de gris',
	'Heart': 'Corazon',
	'Icon': 'Icono',
	'Invert': 'Negativo',
	'Italic': 'Cursiva',
'Double Click': 'Doble Clic',
	'Save & Exit': 'Guardar y Salir'
};
";
/*
Left
Load
Load Mask Image
Location
Mask
Multiply
Noise
Pixelate
Polygon
Range
Rectangle
Redo
Remove White
Reset
Right
Rotate
Sepia
Sepia2
Shape
Sharpen
Square
Star-1
Star-2
Straight
Stroke
Text
Text size
Threshold
Tint
Triangle
Underline
Undo
Value
  */
}

elseif ($lang=='en'){
//this first setting is only to keep the scan page from jumping left/right depending on language. 
//Only if you add a language (or some broswers may require adjusting it)
//fixes horizontal shifting when selecting yes/no on Multi-Page PDF option. Increase if page shifts changing selection. 
// also depends on browser used. Firefox needs higher setting than Chromium
//$scanrightcolumwidth='310'; 
//s400 w vz escl may be different
$waitscanning='Scanning, please wait...';
$scanrightcolumwidths400w='310';
$scanrightcolumwidthescl='346';
$scanrightcolumwidthsane='330';
$charset='UTF-8';
$checkscannerontxt='<span style="color:#f44; font-weight:bold">Check scanner.</span>';
$cleancalibratetxt='To clean or calibrate, insert the corresponding sheet before clicking below.';
$donatetxt = '<p><center>Consider donating for ongoing development of this project. Donate via PayPal to markosjal@gmail.com or <a href="http://paypal.me/markosjal" target="_blank">Click here to PayPal.Me</a>.</center></p>';
$notconnectedtxt = '<span style="color:#f44; font-weight:bold">The scanner is not connected.</span>';
$connectedtxt='<span style="color:#484; font-weight:bold">The scanner is connected.</span>';
$insertpagetxt='<span style="color:#A80; font-weight:bold"><span style="color:#A80; font-weight:bold">Insert a page, then click Start Scan.</span>';// we want this to take up two lines
$pagereadytxt='<span style="color:#484; font-weight:bold">Page detected. Ready to scan.</span>'; // we want this to take up two lines
$battlowtxt='<span style="color:#F44; font-weight:bold">Low battery, connect charger.</span>';
$devbusytxt='<span style="color:#A80; font-weight:bold">Scanner busy. Please wait.</span>';
$battlow='<span style="color:#f44; font-weight:bold">Low Battery.</span>';
$devbusy='<span style="color:#f44; font-weight:bold">The scanner is busy.</span>';
$scanready='<span style="color:#484; font-weight:bold">Ready to scan.<br/></span>';
$processing='<span style="color:#A80; font-weight:bold">Processing</span>';
$idle='<span style="color:#484; font-weight:bold">Idle</span>';
$stopped='<span style="color:#f44; font-weight:bold">Stopped</span>';
$downloadtxt='You can download the file by right clicking and selecting "Save as" or on a touch sceen select and hold.';
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
$checkscannerstatustxt='<span style="color:#666; font-weight:bold">Checking scanner status.</span>';
$checkloginstatustxt='<span style="font-size: larger; color:#666; font-weight:bold">Checking login expiration...</span>';
$nosupporttxt='Your browser does not support javascript.';
$dpi= 'DPI';
$dpitxt= 'DPI:';
$pdftxt='Make PDF';

//$pdfprefixtxt='Name';
$deltmptxt='Delete Temp:';
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
$waitpdfingtxt='Please wait, converting to PDF, this could take several minutes...';
$waitconvertingtxt='Please wait, converting image...';
$waitresizingtxt='Please wait resizing image...';
$dpierror='No DPI found';
$scannowtxt='Start Scan';
$scanningtxt='Scanning';
$yes='Yes';
$no='No';
$name='Name';
$filestxt='Files';
$userfilestxt=$_SESSION['tempname'].'\'s Scans';
$userpdfstxt=$_SESSION['username'].'\'s PDFs';
$jpgfilesintxt='Files for user ';
$pdffilestxt='PDF files for user ';
$printscale='Print Scale:';
$widthtxt='W';
$heighttxt='H';
$nocleaningsheet='<span style="color:#f44; font-weight:bold">Load the cleaning sheet</span>';
$nocalibrationsheet='<span style="color:#f44; font-weight:bold">Load the calibration sheet</span>';
$nopaperscan='<span style="color:#f44; font-weight:bold">No Page detected.</span>';
$rotatetxt='Rotate';
$rotatelefttxt='Rotate left 90 degrees';
$rotaterighttxt='Rotate right 90 degrees';
$rotate180txt='Rotate 180 degrees';
$croptxt='Auto Crop';
$converttxt='Convert';
$nopaper='<span style="color:#F44; font-weight:bold">Page not detected.<br/></span>';
$mirrortxt='Mirror';
$flipvtxt='Flip V';
$fliptxt='Flip';
$deskewtxt='Deskew';
$resizetxt='Resize';
$fileprefix='Scan';
// cropped file with imagemagick will be appended with this before extension
$crop='Acrp';
// rotated file with imagemagick will be appended with this before extension
$rotate='Rot';
//vertically flipped file with imagemagick will be appended with this before extension
$flipname='Flp';
//horizontally flipped file with imagemagick will be appended with this before extension
$flopname='Mir';
//Negaive file with imagemagick will be appended with this before extension
$negative='Neg';
//BW file with imagemagick will be appended with this before extension
$blackwhite='BW';
//LineArt file with imagemagick will be appended with this before extension
$lineart='Lne';
$deskewed='Skw';
$mcrop='Mcrp';
$resizename='Resz';
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
$userfilesfor=$_SESSION['username'].'\'s Files';
$userpdfsfor=$_SESSION['username'].'\'s Files';
$adminbutton='User Manager';
$deleteuser='Delete user ';
$logout='Logout';
$goodbye='Goodbye...';
$scanpage='Scan';
$makenewuser='Make New User';
$newusername='New username';
$newuserpass='New password';
$thereare='There are';
$multipleusers='Users';
$thereis='There is';
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
$alluserfilestxt='User\'s files';
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
$cropping='Cropping';
$resizing='Resizing';
$deleting='Deleting';
$renaming='Renaming';
$rotating='Rotating';
$converting='Converting';
$confirmdelete='Are you sure you want to delete this file?';
$logoutadmin='This will logout admin and log you in as ';
$sessionexpiresin='Your session expires in ';
$sessionexpired='Your session has expired';
$minutes=' minutes. ';
$minute=' minute. ';
//$increasetimescan='<a href="javascript:location.reload();"><span style="font-size: larger; color:#777AFF; font-weight:bold">Extend login</span></a>';
$increasetime='<a href="javascript:history.go(0)"><span style="font-size: larger; color:#777AFF; font-weight:bold">Extend Login</span></a>';
$increasetimephp='<a href="index.php"><span style="font-size: larger; color:#777AFF; font-weight:bold">Extend Login</span></a>';
$login='Log in';
$moveuserfilesto='Move user files to:';
$filemovesuccess='Files moved successfully from ';
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
$mcrop='MCrop';
$mancroptxt2='Select the desired crop area then click "confirm".<br/>The selected size is displayed below.';

$mancroptxt='Make your selection by dragging over the desired portion, then click "Confirm" below.';
//$mancroptxt3='<p>Tip: If you will be making more operations on this image, it may be best to save as png now.';
$mancroptip1='<p>Tip: If you will be making more operations on this image, it may be best to save as png now.</p>';
// .$image.'&newext=png.

//$mancroptxt4='&newext=png"><span style="color:#777AFF; font-weight:bold">save as png</span></a><span style="color:#A80; font-weight:bold"> now.</span></p>';
$mancroptxt2='Select the desired crop area then click "confirm".<br/>The selected size is displayed below.';
$convertnewnametxt='Enter a new file name and select the type/extension<br/>If there is a file by the same name it will be overwritten.';
$resisingdetailstxt='Enter a new width or height and click on the remaining field to calculate it.<br/>If you enter both fields manually, the aspect ratio will be ignored.';
$convertingtiptif='';
$convertingtippdf='';
$enterheight='Enter height...';
$enterwidth='Enter width...';
$nopreview='No<br/>preview<br/>available<br/><br/><br/><br/>';
$filelistertip1='Tip: When resizing, rotating or cropping a file, a new file is created and the original remains intact.';
$filelistertip2='Tip: If making multiple modifications to a file, consider converting it to the lossless PNG format first.';
$filelistertip3='Tip: You can download a file by right clicking and selecting "Save as" or on a touch sceen select and hold.';
$filelistertip4='Tip: With AirScan, you should use only one window or tab at a time. You should not have two pages of AirScan open in the same browser..';
$filelistertip5='Tip: You should move the files from here to another folder. If you do not you can affect the performance of the fileister.';
$scantip1='Tip: If doing successive scans, avoid the use of the buttons below image after scan. The settings will then be retained between scans';
$scantip2='Tip: You can use either deskew or autocrop. Deskew will also autocrop, so Auto-Crop would be disabled.';
$scantip3='Tip: When selecting grayscale, lineart, autrocrop, and deskew, the original file, and one file for each pass are all saved.';
$scantip4='Tip: With AirScan, you should use only one window or tab at a time. You should not have two pages of AirScan open in the same browser..';
$pdfscantip1='Tip: When creating multi-page PDF, it is best to use the same DPI settings for all pages';
$pdfscantip2='Tip: When creating multi-page PDF, it is advisable to scan in the page order desired in the final PDF document.';
$pdfscantip3='Tip: When you have finished scanning for a multi-page PDf files, and after previewing the result, you should delete all scanned project files.';
$usermanagertip1='Tip: To manage PAM users you must use the user management on the host machine where AirScan is running.';
$usermanagertip2='Tip: When deleting a user, all files for that user are deleted too.';
//$usermanagertip3='Tip: With text authentication, you can edit the text files in the "users" directory to allow multiple users to share the same files.';
$usermanagertip3='Tip: Text based users should be names only. You shoukd not create a text based user with a numeric name.';
$usermanagertip4='Tip: If you create softlinks, two or more text users or two or more PAM users can share files. If one is a PAM user, you should use the file space associated with a text user.';
$edittip1='Tip: Full page scans at 600 DPI will probably slow down the editor interface substantially. Consider using the "Quick Edit" tools instead.';
$edittip2='Tip: Once an image is opened tn the Image Editor, it is converted to PNG format, and can only be .';
$edittip3='Tip: The structure of the editor does not allow the use of "Extend Session" link. Your session time is always increased when you enter the editor.';
$loadingpleasewait='Loading, please wait...';
$multipage='Multi-Page:';
$pdfjpg='PDF/JPG';
$page='Page';
$loadproject='Load Project';
$deletescans='Delete Files';
$viewpdf='Preview PDF';
$makepdf='Make PDF';
$pdfprojectname='Project Name:&nbsp;';
$pdfproject='PDF Project:';
$loadmppdfproject='Return to a Multi-Page PDF Project:';
$pdfprojectscans='Pages in PDF project';
$pagesizetipescl='Select a page size. These are the page sizes available from your scanner and the capabilities of this system. Your default page size has been pre-selected. This also affects the page size used for PDF creation.';
$pagesizetips400w='There is no page size selection on the s400w scanners. Page size is automatic.';
$mppdftip='Select Yes if you want to create a PDF file of more than one page, otherwise No.';
$pdfnametip='Select a name for a new Multi-Page PDF scanning project, or continue scanning to an existing PDF Multi-Page project. This name will be the name of the final output PDF, and prefixed to all temp files.';
$pdfjpgtip='Select file format for single page scans.';
$modetip='Select Color, Grayscale or Lineart mode. Requires Imagemagick.';
$dpitip='Select DPI (Dots Per Inch). The higher the number the higher the quality and the larger the file size.';
$deskewtip='Select Yes to attempt to straighten out a potentally crooked scan, then crop any black space around the image. It is recomended you leave Delete Temp option at No as it may not work on all images. This should work on most images, not just printed text pages.';
$autocroptip='This option will attempt to crop any black space around the image. It is recomended you leave Delete Temp at No as it may not work on all images. It works best on pages scanned on white paper. You can also try "deskew", if autocrop does not work on your scans.';
$printtip='Select yes if You want to print an image while scanning. If you want to use the copier function with your printer, set this to Yes.';
$printscaletip='By default, a printed page will print at about the same size as the scanned image. Use this option to make it print larger or smaller.';
$deltmptip='When you scan a page to Grayscale. Lineart or use Auto-crop or deskew. Multiple files will be created, one for each step. Setting this to Yes deletes all but the last file. You should set to no if using Deskew or Auto-Crop.';
$scantip='Click to start the scan after choosing settings above.';
$editor='Edit';
$grayscaletxt='Gryscale';
$linearttxt='LineArt';
if ($filemanagerunits=='both')
{
$letter='Letter, 8.5x11in, 216x279mm';
$legal='Legal, 8.5x14in, 216x356mm';
$A4='A4, 8.27×11.69in, 210×297mm';
$ISOB5='ISO B5, 6.9x9.8in, 176x250mm';
$JISB5='JIS B5, 7.2x10.1in, 182x257mm';
$AB='AB, 8.27x10.12in, 210x257mm';
}

elseif ($filemanagerunits=='in')
{
$letter='Letter, 8.5 x 11 in';
$legal='Legal, 8.5 x 14 in';
$A4='A4, 8.27 × 11.69 in';
$ISOB5='ISO B5, 6.9 x 9.8 in';
$JISB5='JIS B5, 7.2 x 10.1 in';
$AB='AB, 8.27 x 10.12 in';
}
elseif ($filemanagerunits=='cm')
{
$letter='Letter, 216 x 279 mm';
$legal='Legal, 216 x 356 mm';
$A4='A4, 210 × 297 mm';
$ISOB5='ISO B5, 176 x 250 mm';
$JISB5='JIS B5, 182 x 257 mm';
$AB='AB, 210 x 257 mm';
}
$auto='Auto';
$setdpi='Set DPI';
$setpagesize= 'Set Page Size';
$nofilesfound='No files found.';
$tryagain='Try again';

//tooltips on filelister
$deletetip='Delete file';
$printtip='Print file';
$edittip='Edit image in editor';
$resizetip='Resize image';
$rotatel90tip='Rotate CCW 90 degrees';
$rotater90tip='Rotate CW 90 degrees';
$rotate180tip='Rotate 180 degrees';
$deskewtip2='Deskew (straighten and auto-crop image)';
$autocroptip2='Auto-crop image';
$mancroptip='Manually crop image';
$grayscaletip='Conert to Grascale (remove color)';
$linearttip='Convert to Line Art (remove color & make high contrast)';
$flipvtip='Flip Vertically';
$fliphtip='Flip horizontally';
$converttip='Convert to another format';
$renametip='Rename file';
$quickedit= 'Quick Edit:';
$infotxt='Information';
$lettertxt='US Letter';
$legaltxt='US Legal';
$A4txt='ISO A4';
$ISOB5txt='ISO B5';
$JISB5txt='JIS B5';
$ABtxt='AB';
$bonjourstatustxt= 'Bonjour Status';
$esclstatustxt='eSCL Status';
$esclcapabilitiestxt='eSCL Capabilities';
$sanetesttxt='Sanity Check';
$sanescannerstxt='SANE Scanners';
$sanescannerinfotxt='Scanner Info';
//For TUI Image Editor
$nobrowsersupport='Your browser does not support the API';
$doubleclick='Double Click';
}
?>
