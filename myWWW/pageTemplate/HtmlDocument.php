<?php

class HtmlDocument {
  public function setHeadSection($headContents) {
     $this->headSection=$headContents;
  }
  
  public function setBodySection($bodyContents) {
     $this->bodySection=$bodyContents;
  }

  public function appendBodySection($newString) {
     $this->bodySection.=$newString;
  }

  public function setTitle($title) {
     $this->title=$title;
  }

  public function show() {
     echo <<< _END
       <!DOCTYPE html>
       <html>
       <head>
       <title>$this->title</title>
       <link rel="icon" type="image/x-icon" href="favicon.ico">
       $this->headSection
       </head>
       <body>
       $this->bodySection
       </body>
       </html>

       _END;
  }
  

  protected $title;
  protected $headSection;
  protected $bodySection;

}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
  }


?>
