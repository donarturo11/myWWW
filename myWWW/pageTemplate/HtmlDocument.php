<?php

class HtmlDocument {
  public function setHeadSection($headContents) {
     $this->headSection=$headContents;
  }
  
  public function setBodySection($bodyContents) {
     $this->bodySection=$bodyContents;
  }
  
  public function setTitle($title) {
     $this->title=$title;
  }
  
  public function printHtmlDocument() {
     echo <<< _END
       <html>
       <head>
       <title>$this->title</title>
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


?>
