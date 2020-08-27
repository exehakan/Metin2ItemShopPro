<?php
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);



$database = new Connect("account",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);
$GelenAdiSoyadi                 = $_POST["AdiSoyadi"];
$GelenKullaniciAdi              = $_POST["KullaniciAdi"];
$GelenKullaniciSifresi          = $_POST["Sifre"];
$GelenKullaniciSifresiTekrar    = $_POST["TekrarSifre"];
$GelenEmailAdresi               = $_POST["EmailAdresi"];
$GelenKarakterSilmeKodu         = $_POST["KarakterSilmeKodu"];
$GelenCepTelefonNumarasi        = $_POST["TelefonNumarasi"];

if(
    (isset($GelenAdiSoyadi)!="") &&
    (isset($GelenKullaniciAdi)!="") &&
    (isset($GelenKullaniciSifresi)!="") &&
    (isset($GelenKullaniciSifresiTekrar)!="") &&
    (isset($GelenEmailAdresi)!="") &&
    (isset($GelenKarakterSilmeKodu)!="") &&
    (isset($GelenCepTelefonNumarasi)!="")

){
    if($GelenKullaniciSifresi == $GelenKullaniciSifresiTekrar){
        $KayitEkle = $database->db->prepare("INSERT INTO account.account(login,password,email,social_id,phone1) values(?,PASSWORD(?),?,?,?)");
        $KayitEkle->execute([$GelenKullaniciAdi,$GelenKullaniciSifresi,$GelenEmailAdresi,$GelenKarakterSilmeKodu,$GelenCepTelefonNumarasi]);
        $KayitEkleSonuc = $KayitEkle->rowCount();
        if($KayitEkleSonuc>0){
            echo KAYIT_BASARILI();
        }else{
            echo BENZER_KULLANICI_BILGILERI_MEVCUT();
        }
    }else{
        echo UYUSMAYAN_SIFRE();
    }
}else{
    echo PARAMETRE_HATASI();
}








