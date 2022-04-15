<?php
include("navbar.php");
include("htmlMarks.php");

class pageBase {
 public function __construct()
 {
  $this->lang="en";
  $this->title="pageBase";
  $this->description="pageBase";
  $this->charset="utf-8";
  $this->refreshHeadSection();

  $this->contents[$this->lang]=" ";
  $this->setLangInfo();
  if (isset($_GET['lang']) )
  {
  $this->lang=$_GET['lang'];
  $this->refreshNavBar();

  }
  else {$this->lang="en";}
  $this->setLangInfo();
  $this->refreshNavBar();


 }
 public function initPage()
 {
   echo "Init Page\n";
 }

 public function refreshNavBar()
 {
   $navBarArr=getNavBarArray($this->lang);
   $navBar="";
   foreach($navBarArr as $value)
   {
    $navBar.="<a>";
    if ($value == $this->title) {
    $navBar.="<b>$value</b> ";
    }
    else {
    $navBar.="$value ";
    }
    $navBar.="</a>\n";
   }
   $this->navBar=$navBar;
 }

 public function setTitle($title)
 {
    $title = getTitleTranslation($this->lang, $title);
    $this->title=$title;
 }

 public function refreshHeadSection()
 {
 $this->headSection = <<< _END_OF_HEAD
 <head>
 <title>$this->title</title>
 <meta charset="$this->charset">
 <meta description="$this->description">
 <meta keywords="$this->keywords">
 </head>
 _END_OF_HEAD;
 }

 public function setCharset($charset)
 {
  $this->charset=$charset;
 }

 public function setCssLocation($cssLocation)
 {
  $this->cssLocation=$cssLocation;
 }

 public function setDescription($description)
 {
  $this->description=$description;
 }

 public function setContents($contents)
 {
   $this->contents=$contents[$this->lang];
 }

 public function refreshHtmlDocument()
 {
 $this->refreshHeadSection();
 $this->htmlDocument = <<< _END_OF_DOCUMENT
 <html>
 $this->headSection
 <body>
 <!-- NavBar -->
 <p>
 $this->navBar
 </p>
 <!-- Contents -->
 $this->langInfo
 $this->contents

 </body>
 </html>

 _END_OF_DOCUMENT;
 }

 public function displayHtmlDocument()
 {
  echo $this->htmlDocument;
 }

 public function setLangInfo()
 {
  $language['en']=array("Language", "English");
  $language['pl']=array("Język", "Polski");
  $languageChoose=array("en", "pl");

  $this->langInfo="";
  $this->langInfo.=$language[$this->lang][0];
  $this->langInfo.=" : ";
  $this->langInfo.=$language[$this->lang][1];
  $this->langInfo.="<br>\n";
  foreach($languageChoose as $langLink)
  {
      $this->langInfo.="<a href=\"?lang=$langLink\">$langLink</a> ";
  }

 }


 private $title;
 private $contents;
 private $description;
 private $keywords;
 private $charset;
 private $navBar;
 private $cssLocation;
 private $headSection;
 private $htmlDocument;
 private $langInfo;
 private $lang;
}

?>