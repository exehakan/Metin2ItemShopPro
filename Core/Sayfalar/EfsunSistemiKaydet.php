<?php
$globalDB = new Connect("global","localhost","root","");
$ServerID                           = $_POST["ServerID"];
$KullaniciAdi                       = Decrypt($_POST["KullaniciAdi"],$ServerID);
$EmailAdresi                        = Decrypt($_POST["EmailAdresi"],$ServerID);
$Sifre                              = Decrypt($_POST["Sifre"],$ServerID);
$SERVER_IP_HOST                     = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD                    = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                        = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$SecilenKategoriTuru                = $_POST["SecilenKategoriTuru"];
$SecilenEfsunDegeri                 = $_POST["SecilenEfsunDegeri"];
$SecilenEfsununMaxLimiti            = $_POST["SecilenEfsununMaxLimiti"];
$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

if((isset($ServerID)!="") && (isset($KullaniciAdi)!="") && (isset($EmailAdresi)!="") && (isset($Sifre)!="") && (isset($SecilenKategoriTuru)!="") && (isset($SecilenEfsunDegeri)!="") && (isset($SecilenEfsununMaxLimiti)!="")){
    $UyeKontrol = $database->db->prepare("SELECT * FROM account.account WHERE login = ? and  password = PASSWORD(?) and  email = ?");
    $UyeKontrol->execute([$KullaniciAdi, $Sifre, $EmailAdresi]);
    $UyeKontrolSonuc = $UyeKontrol->rowCount();
    $UyeKontrolKayitlari = $UyeKontrol->fetch(PDO::FETCH_ASSOC);
    if ($UyeKontrolSonuc > 0) {
        if($UyeKontrolKayitlari["web_admin"] == 1){
           $EfsunYakala = $globalDB->db->prepare("SELECT * FROM global.efsunsistemi WHERE EfsunKodu = ? ");
           $EfsunYakala->execute([$SecilenEfsunDegeri]);
           $EfsunYakalaSayi = $EfsunYakala->rowCount();
           $EfsunKaydi = $EfsunYakala->fetch(PDO::FETCH_ASSOC);
           if($EfsunYakalaSayi>0){
              $YakalananEfsunAdi = $EfsunKaydi["EfsunAdi"];

              $EfsunKontrolleri = $globalDB->db->prepare("SELECT * FROM global.serverefsunlari WHERE ServerID = ? AND EfsunKodu = ? AND ItemKategorisi = ? AND EfsunAdi = ?");
              $EfsunKontrolleri->execute([$ServerID,$SecilenEfsunDegeri,$SecilenKategoriTuru,$YakalananEfsunAdi]);
              $EfsunKontrolleriSayi = $EfsunKontrolleri->rowCount();
              if($EfsunKontrolleriSayi<1){
            $ServerEfsunEkle = $globalDB->db->prepare("INSERT INTO global.serverefsunlari(ServerID, EfsunAdi, EfsunKodu, ItemKategorisi, MaxEfsunDegeri) VALUES(?,?,?,?,?)");
              $ServerEfsunEkle->execute([$ServerID,$YakalananEfsunAdi,$SecilenEfsunDegeri,$SecilenKategoriTuru,$SecilenEfsununMaxLimiti]);
              $ServerEfsunEkleSayi = $ServerEfsunEkle->rowCount();
              if($ServerEfsunEkleSayi>0){
                  echo json_encode("EFSUN_BASARIYLA_KAYDEDILDI");
              }else{
                  echo json_encode("EFSUN_KAYDEDILEMEDI");
              }
              }else{
                   echo json_encode("BOYLE_BIR_EFSUN_SISTEMI_MEVCUT");
              }


















           }else{
               echo json_encode("ISLEM_BASARISIZ_OLDU");
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