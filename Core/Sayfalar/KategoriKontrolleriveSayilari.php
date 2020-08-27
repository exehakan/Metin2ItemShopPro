<?php
$database = new Connect("global","localhost","root","");
$GelenKategoriID = $_POST["KategoriID"];
$ServerID = $_POST["ServerID"];


if((isset($GelenKategoriID)!="") && (isset($ServerID)!="")){
    $KategoriDegerleri = $database->db->prepare("SELECT * FROM global.item WHERE KategoriID = ? AND ServerID = ?");
    $KategoriDegerleri->execute([$GelenKategoriID,$ServerID]);
    $KategoriDegerleriKayitlari = $KategoriDegerleri->fetchAll(PDO::FETCH_ASSOC);
    $KategoriDegerleriSayisi = $KategoriDegerleri->rowCount();
    if($KategoriDegerleriSayisi>0){
        echo json_encode($KategoriDegerleriSayisi);
    }else{
        echo json("KATEGORILER_ALINAMADI");
    }
}else{
    echo json_encode("GELEN_KATEGORI_ID_HATALI_VEYA_YOK");
}