<?php

require_once("HtmlDocument.php");
require_once("fileHandler/CsvMap.php");
require_once("fileHandler/FileHandler.php");

class PageTemplate extends HtmlDocument
{
  function __construct($name, $lang="en") {

  $this->setLang($lang);
  $this->setName($name);
  $nameSuffix="Contents";
  $this->pathContents=$this->name . $nameSuffix . "/";
  //$csvLocation=$this->pathContents . "files.csv";
  $csvLocation="siteMap/siteMap.csv";
  $bodyText="";

  $this->initCsv($csvLocation, ",");
  $this->initText();

  $title=$this->csvMap->getMapItem($this->name, $this->lang);
  $bodyText=$this->bodyTextObject->getFileString();
  $bodyText.=$this->getAllTextFiles();

  $this->setTitle($title);
  $this->setBodySection($bodyText);
  $this->printHtmlDocument();

  }

  public function initCsv($filename, $separator){
  $this->csvMap=new CsvMap;
  $this->csvMap->initCsv($filename, $separator);

  $this->csvMap->loadKeys();
  $this->csvMap->createMap();
  }

  public function initText(){
  $path=$this->pathContents;
  $basename=$this->name;
  $lang=$this->lang;
  //$extension=$this->csvMap->getMapItem($basename, "extension");
  $extension="txt";
  $filename=$basename . "-" . $lang . "." . $extension;
  $this->bodyTextObject = new FileHandler;
  $this->bodyTextObject->readFile($path . $filename);
  }

  public function getAllTextFiles(){
   $path=$this->pathContents;
   $textString="";
   $textFiles=array_diff(scandir($path), array(".", ".."));
   var_dump($textFiles);
   foreach($textFiles as $file){
      if ($file=="files.csv"){continue;}
      $textString.= "\n=== begin $path/$file ===\n";
      $textString.= "<b>$file</b>\n";
      $textString.= "<p>";
      $this->bodyTextObject->readFile($path . $file);
      $textString.= $this->bodyTextObject->getFileString();
      $textString.= "</p>\n";
   }
   return $textString;
  }

  public function setLang($lang){
  $this->lang=$lang;
  }

  public function setName($name){
  $this->name=$name;
  }

  protected $csvMap;
  protected $bodyTextObject;
  protected $lang;
  protected $name;
  protected $pathContents;
  //protected $textFiles;

}


?>
