<?php

function SessionAlgoritmaHash($Password)
{

    $Pass = array();
    for ($index = 0; $index < strlen($Password); $index++) {
        $Karakter = base64_encode($Password[$index]);
        $GelicekOlanStringKarakterler = preg_replace("/=/","",$Karakter);
        $Pass[$index] = $GelicekOlanStringKarakterler;
    }
    return $Pass;
}
function SessionAlgoritmaDecrypt($Algoritma){
    $GelenAlgoritma = $Algoritma;
    $StringDeger = "";
    foreach($Algoritma as $Elemanlar){
        $StringDeger .= base64_decode($Elemanlar."==");
    }
    return $StringDeger;
}


?>