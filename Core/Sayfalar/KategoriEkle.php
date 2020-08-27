<?php
$database = new Connect("global","localhost","root","");
$GelenKategoriAdi   = $_POST["KategoriAdi"];
$ServerID           = $_POST["ServerID"];
if(isset($GelenKategoriAdi)!=""){
    $Kontroller = $database->db->prepare("SELECT * FROM global.Kategoriler WHERE KategoriAdi = ? AND ServerID");
    $Kontroller->execute([$GelenKategoriAdi,$ServerID]);
    $KontrolSayisi = $Kontroller->rowCount();
    if($KontrolSayisi<1){
        $KategoriEkle = $database->db->prepare("INSERT INTO global.Kategoriler(KategoriAdi,ServerID) values(?,?)");
        $KategoriEkle->execute([$GelenKategoriAdi,$ServerID]);
        $KategoriEkleSayi = $KategoriEkle->rowCount();
        if($KategoriEkleSayi>0){
            echo json("KATEGORI_BASARIYLA_EKLENDI");
        }
    }else{
        echo json("BOYLE_BIR_KATEGORI_ADI_MEVCUT");
    }

}else{
    echo json("KATEGORI_ADI_BOS_OLAMAZ");
}






























?>