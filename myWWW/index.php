<?php
 include("template/pageTemplate.php");

 $contents['en'] = <<< _END
 <p>This is my test page</p>
 <p>You can be pleased</p>

 _END;

 $contents['pl'] = <<< _ENDPL
 <p>To jest moja strona testowa</p>
 <p>Możesz być zadowolony</p>

 _ENDPL;

 $homePage = new pageBase;
 $homePage->setTitle("Home");
 $homePage->setDescription("Home Page");
 $homePage->setContents($contents);


 $homePage->refreshNavBar();
 $homePage->refreshHtmlDocument();
 $homePage->displayHtmlDocument();




?>