<?php
include("FileHandler.php");

function testFile($filename){
	$fileText=new FileHandler();
	$fileText->readFile($filename);
	echo $fileText->getFileString();
	$fileText->setFileExtension();
	echo "\nFile extension: " . $fileText->getFileExtension() . "\n\n";

}

testFile("fileHandleTest.php");
testFile("textFile.txt");
testFile("csv/siteMap.csv");

?>
