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

  $cssFile="css/";
  if (isMobile()) {
      $cssFile.="mobile";
  } else {
      $cssFile.="desktop";
  }
  $cssFile.=".css";

  $headText="";
  $headText.="<link rel=\"stylesheet\" href=\"${cssFile}\">";

  $this->initNavbar();
  $this->initTranslations();
  $bodyText="";

  $bodyText.=$this->getNavbar() . "\n";
  $bodyText.=$this->getLangChoose() . "\n";
  $bodyText.="<div class=\"contents\">";
  $bodyText.=$this->printContactForm() . "\n";
  $bodyText.="</div>";
  
  $this->setTitle($title);
  $this->setHeadSection($headText);
  $this->setBodySection($bodyText);
  
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
      <form method="post" action="contactform.php?lang=$lang" id="contact-form-section">
      <p> Email: <input type="text" name="email" id="contact-email" class="form-input"></p>
      <p> {$trans["subject"][$lang]} <input type="text" name="subject" id="contact-subject" class="form-input"></p>
      <p> {$trans["contents"][$lang]}<br>
      <textarea name="text" id="contact-form-text" class="form-textarea"></textarea>
      </p>
      <input type="submit" name="submit" class="form-button" id="contact-submit" value="{$trans["submit"][$lang]}">
      <input type="reset" name="reset" class="form-button" id="contact-reset" value="{$trans["clear"][$lang]}">
      EOF;
    
      return $form;
  }
  
  
  
  protected $trans;
}

//$htmlDoc=new PageTemplate("contact", "pl");
?>
