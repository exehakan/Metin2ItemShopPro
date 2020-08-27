<?php
$globalDB = new Connect("global","localhost","root","");
$ServerID                           = $_POST["ServerID"];
$KullaniciAdi                       = Decrypt($_POST["KullaniciAdi"],$ServerID);
$EmailAdresi                        = Decrypt($_POST["EmailAdresi"],$ServerID);
$Sifre                              = Decrypt($_POST["Sifre"],$ServerID);
$SERVER_IP_HOST                     = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD                    = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                        = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$Tur                                = $_POST["Tur"];
$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

if((isset($ServerID)!="") && (isset($KullaniciAdi)!="") && (isset($EmailAdresi)!="") && (isset($Sifre)!="") && isset($Tur)!=""){
    $UyeKontrol = $database->db->prepare("SELECT * FROM account.account WHERE login = ? and  password = PASSWORD(?) and  email = ?");
    $UyeKontrol->execute([$KullaniciAdi, $Sifre, $EmailAdresi]);
    $UyeKontrolSonuc = $UyeKontrol->rowCount();
    $UyeKontrolKayitlari = $UyeKontrol->fetch(PDO::FETCH_ASSOC);
    if ($UyeKontrolSonuc > 0) {
        if($UyeKontrolKayitlari["web_admin"] == 1){
            $TureGoreEfsunlariGetir = $globalDB->db->prepare("SELECT * FROM global.serverefsunlari WHERE ServerID = ? AND ItemKategorisi = ? ");
            $TureGoreEfsunlariGetir->execute([$ServerID,$Tur]);
            $TureGoreEfsunlariGetirSayi = $TureGoreEfsunlariGetir->rowCount();
            $TureGoreEfsunlariGetirKayitlar = $TureGoreEfsunlariGetir->fetchAll(PDO::FETCH_ASSOC);
            if($TureGoreEfsunlariGetirSayi>0){
                echo json_encode($TureGoreEfsunlariGetirKayitlar);
            }else{
                echo json_encode([]);
            }
        }else{
            echo json_encode("YONETICI_DEGILSINIZ");
        }
    } else {
       echo HATALI_KULLANICI_BILGISI();
    }
}else{
    echo json_encode("BILINMEYEN_BIR_HATA_MEYDANA_GELDI");
}
?>