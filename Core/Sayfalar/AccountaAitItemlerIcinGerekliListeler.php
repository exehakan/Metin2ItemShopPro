<?php
$ServerID = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);

$database = new Connect("global","localhost","root","");
$databaseTakviye = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

$GelenAccountID = $_POST["account_id"];
$DepodakiEslesicekVnumlar = $database->db->prepare("SELECT * FROM global.itemDepo WHERE account_id = ? AND ServerID = ?");
$DepodakiEslesicekVnumlar->execute([$GelenAccountID,$ServerID]);
$DepodakiEslesicekVnumlarSayisi = $DepodakiEslesicekVnumlar->rowCount();
$DepodakiEslesicekVnumKayitlari = $DepodakiEslesicekVnumlar->fetchAll(PDO::FETCH_ASSOC);
if($DepodakiEslesicekVnumlarSayisi>0){
    $EslesenItemDegerleri = array();
    foreach ($DepodakiEslesicekVnumKayitlari as $key => $item) {
        $itemKodu = $item["itemVnum"];
        $EslesenKodlarinDegerleriniGetir = $databaseTakviye->db->prepare("SELECT * FROM player.item_proto WHERE vnum = ?");
        $EslesenKodlarinDegerleriniGetir->execute([$itemKodu]);
        $EslesenleriGetir = $EslesenKodlarinDegerleriniGetir->fetchAll(PDO::FETCH_ASSOC);
        $EncodingAlgila = mb_detect_encoding(json_encode($EslesenleriGetir));
        $EncodingUygula = mb_convert_encoding($EslesenleriGetir, "UTF-8", "ISO-8859-9");
        $EslesenItemDegerleri[$key] = $EncodingUygula;
    }
//    $sonuc =  array_unique($EslesenItemDegerleri,SORT_REGULAR);
    echo json_encode($EslesenItemDegerleri);
}