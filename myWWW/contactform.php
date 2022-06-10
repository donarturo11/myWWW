<?php
if ($_GET && $_GET["lang"]) {
$lang = $_GET["lang"];
} else {
$lang = "en";    
}

$email = $_POST['email'];
$subject = $_POST['subject'];
$text = "";

if ($email=="") {
    $email="Anonym";
}

$text .= "$email wrote:\n";
$text .= $_POST['text'];
$date = date("r");

header('Content-Type: text/html; charset=utf-8');
header( "refresh:5;url=contact.php?lang=$lang" );



mail("arturwrona91@gmail.com", 
      $subject, 
      $text);

printf("<p> %s", $date);
printf("<p> Lang:  %s", $lang);
printf("<p> E-mail: %s </p> <p> Subject: %s </p><p> Contents: <br> %s </p>", $email, $subject, $text);
printf("<p> Message was <b>sent</b>.</p>");
printf("<p>Poczekaj 5 sekund lub kliknij: <a href=contact.php?lang=$lang> Powrót to poprzedniej strony </a></p>");


?>
