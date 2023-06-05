<?php
require_once("fileHandler/CsvMap.php");
class NavigationBar {
  function __construct($currentTitle, $lang="en"){
      $this->currentTitle=$currentTitle;
      $this->lang=$lang;
      $this->csvLocation="siteMap/siteMap.csv";
      $this->initCsv($this->csvLocation);
      $this->setString();
  }
  
  public function initCsv(){
      $this->siteMap=new CsvMap;
      $this->siteMap->initCsv($this->csvLocation, ",");
      $this->siteMap->loadKeys();
      $this->siteMap->createMap();
  }
     
  public function insertSiteAddress($title, $url){
      $this->siteMap[$title]=$url;
  }
  
  public function getSiteAddress($title){
      $strAddr="";
      $strAddr.=$this->siteMap->getMapItem($title, "filename");
      $strAddr.="." . $this->siteMap->getMapItem($title, "extension");
      return $strAddr;      
  }

  public function getLink($title){
      $curTitle=$this->currentTitle;
      $itemTitle=$this->siteMap->getMapItem($title, $this->lang);
      $hyperlinkUrl=$this->getSiteAddress($title);
      $flag="";
      
      if ($title==$curTitle) {
          $flag="-current";
      }
      
      
      $hyperlink="";
      $hyperlink .= "<a href=\"$hyperlinkUrl?lang=$this->lang\" class=\"navbar-link$flag\">";
      $hyperlink .= "<span class=\"navbar-item$flag\">";
      $hyperlink .= "$itemTitle";
      $hyperlink .= "</a>\n";
      $hyperlink .= "</span>\n";
      
      //$hyperlink .= "<span style=\"width: 20\">==</span>\n";
      $hyperlink .= "\n";
      
      
      return $hyperlink;
  }
  
  
  
  public function setString(){
      $str="\n";
      $str.="<div class=\"navbar\">\n";
      //$str.="<p>navbar - $this->currentTitle</p>\n";
      //$str.=$this->getLink("index");
      //$str.=$this->getLink("about");
      //$str.=var_dump($this->siteMap->getRowNames());
      foreach($this->siteMap->getRowNames() as $name){
          $str.=$this->getLink($name);
      }
      $str.="</div>\n";
      $this->navbarString=$str;
      
  }
  
  public function getString(){
      return $this->navbarString;
  }

  public function getSiteMap(){
      return $this->siteMap;
  }

  protected $siteMap;
  protected $currentTitle;
  protected $navbarString;
  protected $csvLocation;
  protected $lang;
}

?>
