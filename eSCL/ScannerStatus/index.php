<?php header("Content-type: text/xml"); ?>
<?xml version="1.0" encoding="UTF-8"?>
<scan:ScannerStatus xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03" xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.hp.com/imaging/escl/2011/05/03 ../../schemas/eSCL-1_90.xsd">
<pwg:Version>2.0</pwg:Version>
<?php include_once '../../checkstatusescl.php';?>
<pwg:State><?php echo $pwgstate?></pwg:State>
</scan:ScannerStatus>
