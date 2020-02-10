<?php
/*
$xml = "<Stations>
    <Station>
        <Code>HT</Code>
        <Type>knooppuntIntercitystation</Type>
        <Namen>
            <Kort>H'bosch</Kort>
            <Middel>'s-Hertogenbosch</Middel>
            <Lang>'s-Hertogenbosch</Lang>
        </Namen>
        <Land>NL</Land>
        <UICCode>8400319</UICCode>
        <Lat>51.69048</Lat>
        <Lon>5.29362</Lon>
        <Synoniemen>
            <Synoniem>Hertogenbosch ('s)</Synoniem>
            <Synoniem>Den Bosch</Synoniem>
        </Synoniemen>
    </Station>
</Stations>";
*/

<?xml version="1.0" encoding="UTF-8"?>
<scan:ScanSettings xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03">
  <pwg:Version>2.0</pwg:Version>
  <pwg:ScanRegions>
    <pwg:ScanRegion>
      <pwg:Height>3300</pwg:Height>
      <pwg:ContentRegionUnits>escl:ThreeHundredthsOfInches</pwg:ContentRegionUnits>
      <pwg:Width>2550</pwg:Width>
      <pwg:XOffset>0</pwg:XOffset>
      <pwg:YOffset>0</pwg:YOffset>
    </pwg:ScanRegion>
  </pwg:ScanRegions>
  <pwg:InputSource>Feeder</pwg:InputSource>
  <!-- <scan:AdfOption>DetectPaperLoaded</scan:AdfOption> -->
  <scan:ColorMode>Grayscale8</scan:ColorMode>
</scan:ScanSettings>


<?xml version="1.0" encoding="UTF-8"?>
<scan:ScanSettings xmlns:pwg="http://www.pwg.org/schemas/2010/12/sm" xmlns:scan="http://schemas.hp.com/imaging/escl/2011/05/03">
<pwg:Version>2.0</pwg:Version>
<pwg:ScanRegions><pwg:ScanRegion>
<pwg:Height>3300</pwg:Height>
<pwg:ContentRegionUnits>escl:ThreeHundredthsOfInches</pwg:ContentRegionUnits>
<pwg:Width>2550</pwg:Width><pwg:XOffset>0</pwg:XOffset>
<pwg:YOffset>0</pwg:YOffset></pwg:ScanRegion>
</pwg:ScanRegions>
<pwg:InputSource>Feeder</pwg:InputSource>
<!-- <scan:AdfOption>DetectPaperLoaded</scan:AdfOption> -->
<scan:ColorMode>Grayscale8</scan:ColorMode>
</scan:ScanSettings>

/*

$data = simplexml_load_string($xml);

foreach($data->children() as $station => $value){
    echo $value->Lat . "\n";
    echo $value->Lon;
}*/
?>
