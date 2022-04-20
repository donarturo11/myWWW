<?php
include("CsvMap.php");

function testFile($filename, $separator){
	echo "### " . $filename . " ###\n";
	$fileCsv=new CsvMap();
	$fileCsv->readFile($filename);
	$fileCsv->setColSeparator($separator);
	$fileCsv->parseCsv();
	//var_dump($fileCsv->getFileExtension());
	//var_dump($fileCsv->getTableArray());

	$fileCsv->loadKeys();
	//var_dump($fileCsv->getRows());
	//var_dump($fileCsv->getCols("index"));
	//var_dump($fileCsv->loadRowNames());
	$fileCsv->createMap();
//	var_dump($fileCsv->getMap());
	var_dump($fileCsv->getMapItem("about", "es"));
	var_dump($fileCsv->getMapItem("fuck", "pl"));
    var_dump($fileCsv->getMapItem("about", "pl"));

	
	echo "### End ###\n";
}

$testFileList=array(
	"csv/siteMap.csv",
	"csv/map2.csv",
	"csv/map3.csv"
);

foreach($testFileList as $file){
testFile($file, ";");
}

?>
