 <?php 
error_reporting( -1 );
ini_set( 'display_errors', 1 );
/*  require_once("PrintIPP.php");
  $ipp = new PrintIPP();                        
  $ipp->setHost("localhost");
  $ipp->setPrinterURI("/printers/PDF");
$ipp->setMimeMediaType("text/plain");
//  $ipp->setData("http://127.0.0.1/airscan.php?image=Scan20190112165555RotateFlip.jpg"); 
// $ipp->setData("./scans/Scan20190112165555RotateFlip.jpg"); // Path to file.
$ipp->setData("test.txt");

  $ipp->printJob();                                                          
*/



//specify the pdf you'd like to print
// $file = '/var/www/data/myfile.pdf';
 
//Change PrinterName to the name of the printer you set up in CUPS
//$cmd = "lpr -PDF";
//append any files you'd like to print to the end of the command
// $cmd .= $file;
 
//Runs "lpr -PPrinterName  /var/www/data/myfile.pdf" and brings back any output to the console.
 
// $response = shell_exec($cmd);

$filename="http:\/\/127.0.0.1\/airscan.php";
function topdf($filename, $options = "") {
    # Tell HTMLDOC not to run in CGI mode...
    putenv("HTMLDOC_NOCGI=1");

    # Write the content type to the client...
    header("Content-Type: application/pdf");
    flush();

    # Run HTMLDOC to provide the PDF file to the user...
    passthru("htmldoc -t pdf --quiet --jpeg --webpage $options " . escapeshellarg($filename));
}

?>
