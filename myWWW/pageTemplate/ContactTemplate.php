<?php
require_once("PageTemplate.php");
class ContactTemplate extends PageTemplate
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

  $csvLocation="siteMap/siteMap.csv"; 
  $this->initCsv($csvLocation, ",");  
  
  $bodyText="";

  $title=$this->csvMap->getMapItem($this->name, $this->lang); 
  
  $this->initNavbar();
  $this->initTranslations();
  $bodyText="Contact";

  $bodyText.=$this->getNavbar() . "\n";
  $bodyText.=$this->getLangChoose() . "\n";
  $bodyText.=$this->printContactForm() . "\n";
  
  $this->setTitle($title);
  $this->setBodySection($bodyText);
  $this->printHtmlDocument();
  
  }
  
  public function initTranslations(){
      $trans["clear"]["en"]="Clear";
      $trans["clear"]["pl"]="Wyczyść";
      $trans["contents"]["en"]="Contents";
      $trans["contents"]["pl"]="Treść";
      $trans["subject"]["en"]="Subject";
      $trans["subject"]["pl"]="Temat";
      $trans["submit"]["en"]="Submit";
      $trans["submit"]["pl"]="Wyślij";
      
      $this->trans=$trans;
      
  } 
  
  public function printContactForm(){
      $trans = $this->trans;
      $lang = $this->lang;
      
      $form = <<<EOF
      <form method="post" action="contactform.php?lang=$lang">
      <p> Email: <input type="text" name="email" id="email"></p>
      <p> {$trans["subject"][$lang]} <input type="text" name="subject" id="subject"></p>
      <p> {$trans["contents"][$lang]}<br>
      <textarea name="text" id="text"></textarea>
      </p>
      <input type="submit" name="submit" id="submit" value="{$trans["submit"][$lang]}">
      <input type="reset" name="reset" id="reset" value="{$trans["clear"][$lang]}">
      EOF;
    
      return $form;
  }
  
  
  
  protected $trans;
}

//$htmlDoc=new PageTemplate("contact", "pl");
?>
