<?php
function readText($filename){

  $fileIsGood=file_exists($filename);

  if ($fileIsGood == false) {
   echo "No such file\n";
   exit();
  }
  else {
    $file=fopen($filename, "r");
    $fileSize = filesize($filename);
    $textString=fread($file, $fileSize);
    fclose($file);
  }

  $textString .= "\n";

  return $textString;

  }


echo readText("textFile.txt");

?>