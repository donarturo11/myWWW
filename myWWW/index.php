<?php

require_once("pageTemplate/HtmlDocument.php");
require_once("fileHandler/CsvMap.php");
require_once("fileHandler/FileHandler.php");

class IndexPage extends HtmlDocument
{
  function __construct() {
  $this->lang="en";
  $this->name="index";
  $this->pathText="indexContents/";
  $bodyText="";

  $this->initCsv("indexContents/files.csv", ",");
  $this->initText();

  $title=$this->csvMap->getMapItem($this->name, $this->lang);

  $bodyText=$this->bodyTextObject->getFileString();

  $this->setTitle($title);
  $this->setBodySection($bodyText);

  }

  public function initCsv($filename, $separator){
  $this->csvMap=new CsvMap;
  $this->csvMap->readFile($filename);
  $this->csvMap->setColSeparator($separator);
  $this->csvMap->parseCsv();
  $this->csvMap->loadKeys();
  $this->csvMap->createMap();
  }

  public function initText(){

  $path=$this->pathText;
  $basename=$this->name;
  $lang=$this->lang;
  $extension=$this->csvMap->getMapItem($basename, "extension");
  $filename=$basename . "-" . $lang . "." . $extension;
  $this->bodyTextObject = new FileHandler;
  $this->bodyTextObject->readFile($path . $filename);
  }
  protected $csvMap;
  protected $bodyTextObject;
  protected $lang;
  protected $name;
  protected $pathText;

}

$htmlDoc=new IndexPage;
$htmlDoc->printHtmlDocument();

?>
