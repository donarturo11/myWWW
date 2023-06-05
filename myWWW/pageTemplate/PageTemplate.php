<?php

require_once("HtmlDocument.php");
require_once("NavigationBar.php");
require_once("fileHandler/CsvMap.php");
require_once("fileHandler/FileHandler.php");
require_once("fileHandler/MarkdownHandler.php");

class PageTemplate extends HtmlDocument
{
  function __construct($name, $lang="en") {
  $this->setName($name);
  if ($_GET && $_GET["lang"]) {
      $this->setLang($_GET["lang"]);
  } else {
      $this->setLang($lang);
  }
  
  $nameSuffix="contents";
  $this->pathContents=$nameSuffix . "/" . $this->name . "/" ;

  $csvLocation="siteMap/siteMap.csv"; // Move siteMap handling to seperate class

  $bodyText="";

  $this->initCsv($csvLocation, ",");  // SiteMap class
  $this->initText();

  $title=$this->csvMap->getMapItem($this->name, $this->lang); // SiteMap class
  
  $this->initNavbar();

  $cssFile="css/";
  if (isMobile()) {
      $cssFile.="mobile";
  } else {
      $cssFile.="desktop";
  }
  $cssFile.=".css";

  $headText="";
  $headText.="<link rel=\"stylesheet\" href=\"${cssFile}\">";

  $bodyText="";
  
  $bodyText.=$this->getNavbar() . "\n";
  $bodyText.=$this->getLangChoose() . "\n";
  //$bodyText.="<p>Mobile: " . isMobile() . "</p>\n";
  $bodyText.=$this->bodyTextObject->getFileString();
  $bodyText.=$this->getAllTextFiles();

  $this->setTitle($title);
  $this->setHeadSection($headText);
  $this->setBodySection($bodyText);

//  $this->printHtmlDocument();

  }

  public function initNavbar(){
      $this->navbar=new NavigationBar($this->name, $this->lang);
  }
  
  public function getNavbar(){
      $navbarHtml="";
      $navbarHtml.=$this->navbar->getString();
      
      return $navbarHtml;
  }
  
  
  // Move below method to SiteMap class
  public function initCsv($filename, $separator){
  $this->csvMap=new CsvMap;
  $this->csvMap->initCsv($filename, $separator);
  $this->csvMap->loadKeys();
  $this->csvMap->createMap();
  }

  public function initText(){
  //$path=$this->pathContents;
  //$basename=$this->name;
  //$lang=$this->lang;
  //$extension="txt";
  //$filename=$basename . "-" . $lang . "." . $extension;
  $this->bodyTextObject = new MarkdownHandler;
  //$this->bodyTextObject->readFile($path . $filename);
  }

  public function getAllTextFiles(){
   $path=$this->pathContents;
   $lang=$this->lang;
   $textString="";
   
   $textString.="<div class=\"contents\">";
   
   $id="";
   $textFiles=array_diff(scandir($path), array(".", ".."));
   foreach($textFiles as $file){
      if ($file=="files.csv"){continue;}

      $this->bodyTextObject->readFile($path . $file);
      $id=str_replace(".txt", "", $file);

      if (stripos($file, ".html")) {
          $textString.= "<p id=\"$id\">";
          //$textString.="HTML contents";
          $textString.= $this->bodyTextObject->getFileString();
          $textString.= "</p>";
      }

      if (!stripos($file, "$lang")) {continue;}


      $textString.= "<p id=\"$id\">";
      //$this->bodyTextObject->toHtml();
      //
      $textString.= $this->bodyTextObject->getHtmlString();
      $textString.= "</p>\n";

   }
   
   $textString.="</div>\n";

   return $textString;
  }
  
  public function setLang($lang){
  $this->lang=$lang;
  }

  public function setName($name){
  $this->name=$name;
  }
  
  public function getLangChoose(){
      $languages=array("en", "pl");
      $filename=$this->name . ".php";
      $flag="";
      $langHtml="";
      $langHtml.="<div class=\"langbar\">";
      /*if ($this->lang=="pl"){
          $langHtml.="Wybierz język: ";
      } else {
          $langHtml.="Choose language: ";
      }
      */
      foreach( $languages as $lang){
          if ($this->lang==$lang){
              $flag="-current";
          } else {
              $flag="";
          }
          $langHtml.= "<a href=\"$filename?lang=$lang\" class=\"langbar-link$flag\">";
          $langHtml.= "<span class=\"langbar-item$flag\">";
          $langHtml.= "$lang";
          $langHtml.= "</span>";
          $langHtml.= "</a>";
          $langHtml.= "\n";
          
          
      }
      $langHtml.="</div>";
      return $langHtml;
  }

  protected $csvMap; // move to SiteMap class and rename
  protected $bodyTextObject;
  protected $navbarString;
  protected $lang;
  protected $name;
  protected $pathContents;
  protected $navbar;
  protected $mobileVersion;

}


?>
