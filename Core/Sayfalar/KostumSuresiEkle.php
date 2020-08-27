<?php
$globalDB = new Connect("global","localhost","root","");
$ServerID                           = $_POST["ServerID"];
$KullaniciAdi                       = Decrypt($_POST["KullaniciAdi"],$ServerID);
$EmailAdresi                        = Decrypt($_POST["EmailAdresi"],$ServerID);
$Sifre                              = Decrypt($_POST["Sifre"],$ServerID);
$SERVER_IP_HOST                     = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD                    = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                        = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$BelirtilenKostumGunveAyTipi        = $_POST["BelirtilenKostumGunveAyTipi"];
$BelirtilenKostumZamani             = $_POST["BelirtilenKostumZamani"];
$KostumIcinEkUcret                  = $_POST["KostumIcinEkUcret"];
$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

if((isset($KullaniciAdi)!="") && (isset($EmailAdresi)!="") && (isset($Sifre)!="") && (isset($ServerID)!="") && (isset($BelirtilenKostumGunveAyTipi)!="") &&
 (isset($BelirtilenKostumZamani)!="") && (isset($KostumIcinEkUcret)!="")){
    $UyeKontrol = $database->db->prepare("SELECT * FROM account.account WHERE login = ? and  password = PASSWORD(?) and  email = ?");
    $UyeKontrol->execute([$KullaniciAdi, $Sifre, $EmailAdresi]);
    $UyeKontrolSonuc = $UyeKontrol->rowCount();
    $UyeKontrolKayitlari = $UyeKontrol->fetch(PDO::FETCH_ASSOC);
    if ($UyeKontrolSonuc > 0) {
        if($UyeKontrolKayitlari["web_admin"] == 1){
            $KostumSureKontrolleri = $globalDB->db->prepare("SELECT * FROM global.serverkostumsuresi WHERE ServerID = ? AND KostumSuresi = ? AND KostumBicimi = ? ");
            $KostumSureKontrolleri->execute([$ServerID,$BelirtilenKostumZamani,$BelirtilenKostumGunveAyTipi]);
            $KostumSureKontrolleriSayi = $KostumSureKontrolleri->rowCount();
            if($KostumSureKontrolleriSayi<1){
                $KostumSuresiEkle = $globalDB->db->prepare("INSERT INTO global.serverkostumsuresi(ServerID, KostumSuresi, KostumBicimi,BelirlenenEkFiyat) VALUES(?,?,?,?)");
                $KostumSuresiEkle->execute([$ServerID,$BelirtilenKostumZamani,$BelirtilenKostumGunveAyTipi,$KostumIcinEkUcret]);
                $KostumSuresiEkleSayi = $KostumSuresiEkle->rowCount();
                if($KostumSuresiEkleSayi>0){
                    echo json_encode("KOSTUM_SURESI_BASARIYLA_EKLENDI");
                }else{
                    echo json_encode("KOSTUM_SURESI_EKLENIRKEN_HATA_OLUSTU");
                }
            }else{
                echo json("BOYLE_BIR_KOSTUM_SURESI_VAR");
            }
        }else{
            echo json("YONETICI_DEGILSINIZ");
        }
    } else {
       echo HATALI_KULLANICI_BILGISI();
    }
}else{
    echo json_encode("BILINMEYEN_BIR_HATA_MEYDANA_GELDI");
}






?>