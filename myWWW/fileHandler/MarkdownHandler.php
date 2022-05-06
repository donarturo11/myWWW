<?php
require_once("FileHandler.php");

class MarkdownHandler extends FileHandler
{
    function __construct() {
        $this->toHtml();
    }
    
    
    
    public function getHtmlString() {
        $this->toHtml();
        return $this->htmlContents;
    }
    
    
    private function toHtml() {
    $this->htmlContents="";
    $str=$this->fileString;
    
    $str=preg_replace('/\n/', "<br>\n", $str);
    $str=preg_replace('/\*(.*?)\*/', '<b>$1</b>', $str);
    $str=preg_replace('/\_(.*?)\_/', '<i>$1</i>', $str);
    $str=preg_replace('/\[(.*?)\]\((.*?)\)/','<a href="$2">$1</a>',$str);
    
    $this->htmlContents=$str;
    
    }
    
    protected $htmlContents;
}
?>
