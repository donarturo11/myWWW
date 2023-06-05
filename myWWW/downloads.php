<?php
require_once("pageTemplate/PageTemplate.php");
require_once("fileHandler/CsvHandler.php");

if ($_GET && $_GET["lang"]) {
$lang = $_GET["lang"];
} else {
$lang = "en";
}

$noItemTrans["pl"]="Brak opisu";
$noItemTrans["en"]="No description";

$fileInfo = new CsvMap;
$fileInfo->initCsv("downloads/info.csv", ",");

$fileInfo->setNoItemMessage($noItemTrans[$lang]);

function readFileInfo($name) {
        global $lang;
        global $fileInfo;
        $descriptionKey="desc-" . ${lang};
        //print_r($array);
        $infoString .= $fileInfo->getMapItem($name, $descriptionKey);
    return $infoString;
}

function showDir() {
    global $fileInfo;
    $directoryString="";
    $dir="downloads";
    $infoString="";
    $directories=array_diff(scandir($dir), array('..', '.', 'info.csv'));
    if ($fileInfo) {
        $rowNames=$fileInfo->getRowNames();
    }
    $count=0;
    foreach ($directories as $file) {
        $path = "${dir}/${file}";
        if ($rowNames) {
            $colNames = $fileInfo->getCols($file);
            $infoString=readFileInfo($file);
        }
        $directoryString .= <<<ENDDIR

<div class="link-item">
<a href="${path}" id="downloads-hyperlink-${count}" target="_blank">
$file<br>
</a>
$infoString

</div>


ENDDIR;
    $count++;
    }
    return $directoryString;
}


$dirContents=showDir();

$body= <<<END
<div class="contents">
${dirContents}
<br><br>
</div>
END;

$htmlDoc=new PageTemplate("downloads", "pl");
$htmlDoc->appendBodySection($body);
$htmlDoc->show();

//print_r($fileInfo->getCols("brew-monterey-universal.tar.gz"));
//print_r($fileInfo->getCols("log.txt"));

//print_r($fileInfo->getRowNames()[0] . "\n");
//print_r($fileInfo->getMap());

?>
