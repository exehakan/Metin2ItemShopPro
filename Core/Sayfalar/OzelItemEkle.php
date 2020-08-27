<?php
$globalDB = new Connect("global","localhost","root","");
$ServerID                           = $_POST["ServerID"];
$KullaniciAdi                       = Decrypt($_POST["KullaniciAdi"],$ServerID);
$EmailAdresi                        = Decrypt($_POST["EmailAdresi"],$ServerID);
$Sifre                              = Decrypt($_POST["Sifre"],$ServerID);
$SERVER_IP_HOST                     = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD                    = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                        = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$BirinciEfsunSecimi                 = $_POST["BirinciEfsunSecimi"];
$IkinciEfsunSecimi                  = $_POST["IkinciEfsunSecimi"];
$UcuncuEfsunSecimi                  = $_POST["UcuncuEfsunSecimi"];
$DorduncuEfsunSecimi                = $_POST["DorduncuEfsunSecimi"];
$BesinciEfsunSecimi                 = $_POST["BesinciEfsunSecimi"];
$AltinciEfsunSecimi                 = $_POST["AltinciEfsunSecimi"];
$YedinciEfsunSecimi                 = $_POST["YedinciEfsunSecimi"];
$BirinciEfsunOrani                  = $_POST["BirinciEfsunOrani"];
$IkinciEfsunOrani                   = $_POST["IkinciEfsunOrani"];
$UcuncuEfsunOrani                   = $_POST["UcuncuEfsunOrani"];
$DorduncuEfsunOrani                 = $_POST["DorduncuEfsunOrani"];
$BesinciEfsunOrani                  = $_POST["BesinciEfsunOrani"];
$AltinciEfsunOrani                  = $_POST["AltinciEfsunOrani"];
$YedinciEfsunOrani                  = $_POST["YedinciEfsunOrani"];
$BirinciTasSecimi                   = $_POST["BirinciTasSecimi"];
$IkinciTasSecimi                    = $_POST["IkinciTasSecimi"];
$UcuncuTasSecimi                    = $_POST["UcuncuTasSecimi"];
$DorduncuTasSecimi                  = $_POST["DorduncuTasSecimi"];
$itemVnum                           = $_POST["itemVnum"];
$ArtiBasmaDurumu                    = $_POST["ArtiBasmaDurumu"];
$Indırım                            = $_POST["Indırım"];
$Fiyat                              = $_POST["Fiyat"];
$OzelItemStokAdedi                  = $_POST["OzelItemStokAdedi"];


$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);
if((isset($KullaniciAdi)!="") && (isset($EmailAdresi)!="") && (isset($Sifre)!="") && (isset($ServerID)!="")){
    $UyeKontrol = $database->db->prepare("SELECT * FROM account.account WHERE login = ? and  password = PASSWORD(?) and  email = ?");
    $UyeKontrol->execute([$KullaniciAdi, $Sifre, $EmailAdresi]);
    $UyeKontrolSonuc = $UyeKontrol->rowCount();
    $UyeKontrolKayitlari = $UyeKontrol->fetch(PDO::FETCH_ASSOC);
    if ($UyeKontrolSonuc > 0) {
        if($UyeKontrolKayitlari["web_admin"] == 1){


           $BenzerItemVarmi = $globalDB->db->prepare("SELECT * FROM global.ozelitem WHERE itemVnum = ? AND ServerID = ?");
           $BenzerItemVarmi->execute([$itemVnum,$ServerID]);
           $BenzerItemVarmiSayi = $BenzerItemVarmi->rowCount();
           if($BenzerItemVarmiSayi<1){
               $OzelItemiEkle = $globalDB->db->prepare("INSERT INTO global.ozelitem(
                    ServerID,   
                    itemVnum,
                    ArtiBasmaVarmi,
                    BirinciEfsunSecimi,
                    IkinciEfsunSecimi,
                    UcuncuEfsunSecimi,
                    DorduncuEfsunSecimi,
                    BesinciEfsunSecimi,
                    AltinciEfsunSecimi,
                    YedinciEfsunSecimi,
                    BirinciEfsunOrani,
                    IkinciEfsunOrani,
                    UcuncuEfsunOrani,
                    DorduncuEfsunOrani,
                    BesinciEfsunOrani,
                    AltinciEfsunOrani,
                    YedinciEfsunOrani,
                    itemFiyat,
                    indirim,
                    BirinciTasSecimi,
                    IkinciTasSecimi,
                    UcuncuTasSecimi,
                    DorduncuTasSecimi,
                    StokAdedi) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $OzelItemiEkle->execute([
                    $ServerID,
                    $itemVnum,
                    $ArtiBasmaDurumu,
                    $BirinciEfsunSecimi,
                    $IkinciEfsunSecimi,
                    $UcuncuEfsunSecimi,
                    $DorduncuEfsunSecimi,
                    $BesinciEfsunSecimi,
                    $AltinciEfsunSecimi,
                    $YedinciEfsunSecimi,
                    $BirinciEfsunOrani,
                    $IkinciEfsunOrani,
                    $UcuncuEfsunOrani,
                    $DorduncuEfsunOrani,
                    $BesinciEfsunOrani,
                    $AltinciEfsunOrani,
                    $YedinciEfsunOrani,
                    $Fiyat,
                    $Indırım,
                    $BirinciTasSecimi,
                    $IkinciTasSecimi,
                    $UcuncuTasSecimi,
                    $DorduncuTasSecimi,
                    $OzelItemStokAdedi
                ]);
                $OzelItemiEkleSayi = $OzelItemiEkle->rowCount();
                if($OzelItemiEkleSayi>0){
                    echo json_encode("OZEL_ITEM_BASARIYLA_EKLENDI");
                }else{
                    echo json_encode("OZEL_ITEM_EKLENEMEDI");
                }
           }else{
               echo json_encode("BOYLE_BIR_ITEM_MEVCUT");
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