<?php

include("pageTemplate/htmlDocument.php");
$htmlDoc=new htmlDocument;
$htmlDoc->setBodySection("<p>Text</p>");
$htmlDoc->setTitle("Test");
$htmlDoc->printHtmlDocument();

?>
