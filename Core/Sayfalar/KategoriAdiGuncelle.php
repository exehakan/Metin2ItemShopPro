<?php
$database = new Connect("global","localhost","root","");
$GelenKategoriID = $_POST["KategoriID"];
$GelenKategoriAdi = $_POST["YeniKategoriAdi"];
$ServerID = $_POST["ServerID"];



if(isset($GelenKategoriID)!=""){
   $Kontrol = $database->db->prepare("SELECT * FROM global.Kategoriler WHERE KategoriID = ? AND ServerID = ?");
   $Kontrol->execute([$GelenKategoriID,$ServerID]);
   $KontrolSayi = $Kontrol->rowCount();
   if($KontrolSayi>0){
       $KategoriyiGuncelle = $database->db->prepare("UPDATE global.Kategoriler SET global.Kategoriler.KategoriAdi = ? WHERE global.Kategoriler.KategoriID = ? AND ServerID = ?");
       $KategoriyiGuncelle->execute([$GelenKategoriAdi,$GelenKategoriID,$ServerID]);
       $KategoriyiGuncelleSayi = $KategoriyiGuncelle->rowCount();
       if($KategoriyiGuncelleSayi>0){
           echo json_encode("BELIRTILEN_KATEGORI_GUNCELLENDI");
       }else{
           echo json_encode("BELIRTILEN_KATEGORI_GUNCELLENEMEDI");
       }
   }else{
       echo json_encode("BOYLE_BIR_KATEGORI_YOK");
   }
}else{
    echo json_encode("KATEGORI_ID_BULUNAMADI");
}