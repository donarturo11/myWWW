<?php
  function getNavBarArray($lang)
  {
    if ($lang=="pl") { return array("Strona domowa", "O mnie" ); }
    else {return array("Home", "About" );}
  }

  function getTitleTranslation($lang, $title)
  {

    $titles["pl"]=array(
    "Home" => "Strona domowa",
    "About" => "O mnie"
    );

    //$titles["pl"]["Home"] = "Strona domowa";
    //$titles["pl"]["About"]= "O mnie";


    $translatedTitle=$titles[$lang][$title];

    return $translatedTitle;
  }

?>