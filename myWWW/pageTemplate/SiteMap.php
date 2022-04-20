<?php
class SiteMap {
  public function insertSiteAddress($title, $url){
      $this->siteMap[$title]=$url;
  }

  public function getSiteAddress($title){
      return $this->siteMap[$title];      
  }

  public function getSiteHyperlink($title){
      $hyperlinkUrl=$this->getSiteAddress($title);
      $hyperlink = "<a href=\"$hyperlinkUrl\">$title</a>";
      return $hyperlink;
  }

  public function getSiteMap(){
      return $this->siteMap;
  }

  protected $siteMap;
}

?>
