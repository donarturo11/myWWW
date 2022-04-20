<?php
include("CsvHandler.php");

function testFile($filename, $separator){
	echo "### " . $filename . " ###\n";
	$fileCsv=new CsvHandler();
	$fileCsv->readFile($filename);
	$fileCsv->setColSeparator($separator);
	$fileCsv->parseCsv();
	var_dump($fileCsv->getFileExtension());
	var_dump($fileCsv->getTableArray());
	echo "### END ###\n"; 

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
