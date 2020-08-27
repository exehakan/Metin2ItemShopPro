<?php
$itemShopDB = new Connect("global","localhost","root","");
$AccountID = $_POST["AccountID"];
$ServerID = $_POST["ServerID"];


$Silinecekler = $itemShopDB->db->prepare("SELECT * FROM global.itemDepo WHERE account_id = ? AND ServerID = ?");
$Silinecekler->execute([$AccountID,$ServerID]);
$SilinecekKayitlar = $Silinecekler->fetchAll(PDO::FETCH_ASSOC);
$SilineceklerSayisi = $Silinecekler->rowCount();
if ($SilineceklerSayisi > 0) {
    foreach ($SilinecekKayitlar as $item) {
        $itemSayisi = $item["itemSayisi"];
        $SilinecekSutunID = $item["id"];
        if ($itemSayisi == 0) {
            $Sil = $itemShopDB->db->prepare("DELETE FROM global.itemDepo WHERE id = ? AND ServerID = ?");
            $Sil->execute([$SilinecekSutunID,$ServerID]);
            echo json("TAMAMEN_TEMIZLENDILER");

        }else{
            echo json("ITEMSAYISI_SIFIR_OLANLAR_SILINEMEDI");
        }
    }
}
