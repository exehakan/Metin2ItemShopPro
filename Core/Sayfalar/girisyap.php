<?php
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$KullaniciAdi               = Decrypt($_POST["KullaniciAdi"]);
$EmailAdresi                = Decrypt($_POST["EmailAdresi"]);
$Sifre                      = Decrypt($_POST["Sifre"]);



$database = new Connect("account",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

if ((isset($KullaniciAdi) != "") && (isset($EmailAdresi) != "") && (isset($Sifre) != "")) {
    $UyeKontrol = $database->db->prepare("SELECT * FROM account.account WHERE login = ? and  password = PASSWORD(?) and  email = ?");
    $UyeKontrol->execute([$KullaniciAdi, $Sifre, $EmailAdresi]);
    $UyeKontrolSonuc = $UyeKontrol->rowCount();
    $UyeKontrolKayitlari = $UyeKontrol->fetchAll(PDO::FETCH_ASSOC);
    if ($UyeKontrolSonuc > 0) {
        echo BASARILI_KULLANICI_GIRISI();
    } else {
       echo HATALI_KULLANICI_BILGISI();
    }
} else {
    echo PARAMETRE_HATASI();
}





