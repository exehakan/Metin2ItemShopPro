<?php
require_once("Core/Header.php");
require_once("Core/config.php");
require_once("Core/function.php");
require_once("Core/Algoritmalar/base64Decode.php");
require_once("Page.php");

if(isset($_GET["SK"])!=""){
    $GelenSayfalamaDegeri = $_GET["SK"];
}else{
    $GelenSayfalamaDegeri = 0;
}

if((!$GelenSayfalamaDegeri) && ($GelenSayfalamaDegeri==0) && ($GelenSayfalamaDegeri<1)){
    include($Sayfa[$GelenSayfalamaDegeri]);
}else{
    if(count($Sayfa)>1) {
        include($Sayfa[$GelenSayfalamaDegeri]);
    }else{
        include($Sayfa[0]);
    }
}




?>
