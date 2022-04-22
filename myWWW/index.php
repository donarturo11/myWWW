<?php

require_once("pageTemplate/PageTemplate.php");
$htmlDoc=new PageTemplate("index", "pl");

$files=array_diff(scandir("indexContents/"), array(".", ".."));


?>
