<?php
  function getAHref($text, $link){
  $aHrefString = <<< _END_A_HREF
  <a href="$link">$text</a>

  _END_A_HREF;
  }
  return $aHrefString;
?>