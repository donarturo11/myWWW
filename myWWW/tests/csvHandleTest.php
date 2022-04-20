<?php
include("CsvHandler.php");

function testFile($filename, $separator){
	$fileCsv=new CsvHandler();
	$fileCsv->readFile($filename);
	$fileCsv->setColSeparator($separator);
	$fileCsv->parseCsv();
	var_dump($fileCsv->getFileExtension());
	var_dump($fileCsv->getTableArray());

}

testFile("csv/siteMap.csv", ";");

?>
