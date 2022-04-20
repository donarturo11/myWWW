<?php
include("FileHandler.php");

class CsvHandler extends FileHandler
{
    function __construct(){
	$this->rowSeparator="\n";
	$this->colSeparator=",";
    }

    public function setColSeparator($char){
	$this->colSeparator=$char;
    }
    
    public function isCsvFile(){
	if ($this->getFileExtension()=="csv"){ return true; }
	else { return false; }
    }

    public function parseCsv(){
	
	$rows=str_getcsv($this->getFileString(), "\n");
	$rowIndex=0;
	$colIndex=0;
	foreach($rows as $row){	        
	    $cols=str_getcsv($row, $this->colSeparator);
	    $this->tableArray[$rowIndex]=$cols;
	    $rowIndex+=1;
	    }

    }

    public function getTableArray(){
         if ($this->isCsvFile()){
	     return $this->tableArray;
	 }
	 else {return false;}
    }

    protected $rowSeparator;
    protected $colSeparator;
    protected $tableArray;
}

?>
