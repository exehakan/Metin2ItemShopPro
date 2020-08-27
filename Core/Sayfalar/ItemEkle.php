<?php
global $database;
$database = new Connect("global", "localhost", "root", "");
$GelenItemVnum              = $_POST["EklenecekItemVnum"];
$GelenKategoriID            = $_POST["KategoriID"];
$GelenArtiBasmaDurumu       = $_POST["ArtiBasma"];
$GelenItemFiyati            = $_POST["itemFiyati"];
$GelenEfsunIzni             = $_POST["EfsunIzni"];
$ServerID                   = $_POST["ServerID"];
$IzinVerilenEfsunAdedi      = $_POST["IzinVerilenEfsunAdedi"];
$Tur                        = $_POST["Tur"];
$GelenIndirimOrani          = $_POST["Indirim"];
$GelenGlobalSureVarmi       = $_POST["GlobalSureVarmi"];
$EfsunSistemiEkUcret        = $_POST["EfsunSistemiEkUcret"];

if ($GelenArtiBasmaDurumu == false) {
    $GelenArtiBasmaDurumu = 0;
} else if ($GelenArtiBasmaDurumu == true) {
    $GelenArtiBasmaDurumu = 1;
}


if ((isset($GelenItemVnum) != "") && (isset($GelenKategoriID) != "") && (isset($GelenArtiBasmaDurumu) != "") && (isset($GelenItemFiyati) != "") && (isset($GelenEfsunIzni) != "")) {

    $AyniItemKontrolu = $database->db->prepare("SELECT * FROM global.item WHERE itemVnum = ? AND KategoriID = ? AND ServerID = ?");
    $AyniItemKontrolu->execute([$GelenItemVnum, $GelenKategoriID, $ServerID]);
    $AyniItemKontroluSayi = $AyniItemKontrolu->rowCount();
    if ($AyniItemKontroluSayi < 1) {
        $ItemEkle = $database->db->prepare("INSERT INTO global.item(
            KategoriID,
            itemVnum,
            ArtiBasmaVarmi,
            itemFiyati,
            indirim,
            Efsunizni,
            ServerID,
            EklenecekEfsunAdedi,
            KostumZamanDamgasi,
            Tur,
            Sureizni,
            EfsunSistemiFiyati
            ) values (?,?,?,?,?,?,?,?,?,?,?,?)");
        $ItemEkle->execute([
            $GelenKategoriID,
            $GelenItemVnum,
            $GelenArtiBasmaDurumu,
            $GelenItemFiyati,
            $GelenIndirimOrani,
            $GelenEfsunIzni,
            $ServerID,
            $IzinVerilenEfsunAdedi,
            0,
            $Tur,
            $GelenGlobalSureVarmi,
            $EfsunSistemiEkUcret
            ]);
        echo json_encode("ISLEM_BASARILI");
    }else{
        echo json_encode("BOYLE_BIR_ITEM_ZATEN_EKLI");
    }

}else{
    echo json_encode("LUTFEN_BUTUN_PARAMETRELERI_EKSIKSIZ_DOLDURUNUZ");
}