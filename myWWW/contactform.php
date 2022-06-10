<?php
if ($_GET && $_GET["lang"]) {
$lang = $_GET["lang"];
} else {
$lang = "en";    
}

$email = $_POST['email'];
$subject = "[myWWW message] " . $_POST['subject'];
$text = "";
$returnMessage = "";
$sendReturn=true;

if ($email=="") {
    $email="Anonym";
    $sendReturn=false;
}

$text .= "$email wrote:\n";
$text .= $_POST['text'];



$date = date("r");

header('Content-Type: text/html; charset=utf-8');
header( "refresh:3;url=contact.php?lang=$lang" );

mail("arturwrona91@gmail.com", 
      $subject, 
      $text);

$returnMessage = <<<END_RETURN
Dear <b>$email</b><br>
<p>Thank you for send me a message</p>
<p>I will reply You soon as possible</p>
<br><br>
Contents:<br>
Date: $date
E-mail: $email</p> 
<p>Subject: $subject </p>
<p>Contents: <br>$text</p>
<p>Message was <b>sent</b></p>
END_RETURN;

if ($sendReturn) {
mail($email, "Re: $subject", "$returnMessage");
}

printf("$returnMessage <p>Please wait or click: <a href=contact.php?lang=$lang> Get back to last page</a></p>");


?>
