<?php
$globalDB = new Connect("global","localhost","root","");
    $DilleriGetir = $globalDB->db->prepare("SELECT * FROM global.diller");
    $DilleriGetir->execute();
    $DilleriGetirSayi = $DilleriGetir->rowCount();
    $DilleriGetirKayitlar = $DilleriGetir->fetchAll(PDO::FETCH_ASSOC);
    if($DilleriGetirSayi>0){
        echo json_encode($DilleriGetirKayitlar);
    }else{
        echo json_encode("DIL_KAYITLARI_YOK");
    }
?>