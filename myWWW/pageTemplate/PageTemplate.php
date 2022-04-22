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

  $csvLocation="siteMap/siteMap.csv"; // Move siteMap handling to seperate class

  $bodyText="";

  $this->initCsv($csvLocation, ",");  // SiteMap class
  $this->initText();

  $title=$this->csvMap->getMapItem($this->name, $this->lang); // SiteMap class
  $bodyText=$this->bodyTextObject->getFileString();
  $bodyText.=$this->getAllTextFiles();

  $this->setTitle($title);
  $this->setBodySection($bodyText);
  $this->printHtmlDocument();

  }

  // Move below method to SiteMap class
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
  $extension="txt";
  $filename=$basename . "-" . $lang . "." . $extension;
  $this->bodyTextObject = new FileHandler;
  $this->bodyTextObject->readFile($path . $filename);
  }

  public function getAllTextFiles(){
   $path=$this->pathContents;
   $lang=$this->lang;
   $textString="";
   $textFiles=array_diff(scandir($path), array(".", ".."));
   foreach($textFiles as $file){
      if ($file=="files.csv"){continue;}
      if (!stripos($file, "$lang")) {continue;}

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

  protected $csvMap; // move to SiteMap class and rename
  protected $bodyTextObject;
  protected $lang;
  protected $name;
  protected $pathContents;

}


?>
