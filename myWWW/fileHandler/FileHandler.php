<?php

class FileHandler
{
    public function readFile($fileName){
	$_fileExists=file_exists($fileName);
        $this->fileString="";
	if ($_fileExists ) { 
	    $file = fopen($fileName,"r");
	    
	    $this->fileSize=filesize($fileName);
	    $this->fileString.=fread($file, $this->fileSize);    
	    $this->fileName=$fileName;

	    fclose($file);

	    $this->setFileExtension();
	}

	else {
	    $this->fileString="File reading failed!";
	}

	$this->fileString.="\n";
    }

    public function getFileString(){
        return $this->fileString;
    }

    public function getSize(){
	return $this->fileSize;
    }

    public function printText(){
        echo $this->fileString;
    }
    
    public function setFileExtension(){
	$fileNameArr=explode(".", $this->fileName);
	$this->fileExtension=end($fileNameArr);
    }

    public function getFileExtension(){
	return $this->fileExtension;
    }
    
    protected $fileString;
    protected $fileName;
    protected $fileSize;
    protected $fileExtension;
}
