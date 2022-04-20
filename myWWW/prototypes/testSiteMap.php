<?php
include("../pageTemplate/SiteMap.php");

$textString="";

$siteMap = new SiteMap;
$siteMap->insertSiteAddress("Home", "index.php");
$siteMap->insertSiteAddress("About", "about.php");

$textString .= $siteMap->getSiteHyperlink("Home") . "\n";
$textString .= $siteMap->getSiteHyperlink("About") . "\n";

echo $textString;

$localSiteMap=$siteMap->getSiteMap();
print_r($localSiteMap);

?>
