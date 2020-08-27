<?php
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$database = new Connect("global","localhost","root","");
$databaseAccount = new Connect("account",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);


$AccountID                  = $_POST["AccountID"];
$itemVnum                   = $_POST["itemVnum"];
$ToplamHesapTutari          = $_POST["ToplamHesapTutari"];
$ItemSayisi                 = $_POST["ItemSayisi"];
$ItemNereyeGonderilecek     = $_POST["ItemNereyeGonderilecek"];
$Indirim                    = $_POST["Indirim"];
$AccountEjderhaParasi       = $_POST["EjderhaParasi"] ?? 0;
$BirinciEfsunSecimi         = $_POST["BirinciEfsunSecimi"] ?? 0;
$IkinciEfsunSecimi          = $_POST["IkinciEfsunSecimi"] ?? 0;
$UcuncuEfsunSecimi          = $_POST["UcuncuEfsunSecimi"] ?? 0;
$DorduncuEfsunSecimi        = $_POST["DorduncuEfsunSecimi"] ?? 0;
$BesinciEfsunSecimi         = $_POST["BesinciEfsunSecimi"] ?? 0;
$AltinciEfsunSecimi         = $_POST["AltinciEfsunSecimi"] ?? 0;
$YedinciEfsunSecimi         = $_POST["YedinciEfsunSecimi"] ?? 0;
$BirinciEfsunOrani          = $_POST["BirinciEfsunOrani"] ?? 0;
$IkinciEfsunOrani           = $_POST["IkinciEfsunOrani"] ?? 0;
$UcuncuEfsunOrani           = $_POST["UcuncuEfsunOrani"] ?? 0;
$DorduncuEfsunOrani         = $_POST["DorduncuEfsunOrani"] ?? 0;
$BesinciEfsunOrani          = $_POST["BesinciEfsunOrani"] ?? 0;
$AltinciEfsunOrani          = $_POST["AltinciEfsunOrani"] ?? 0;
$YedinciEfsunOrani          = $_POST["YedinciEfsunOrani"] ?? 0;
$BirinciTasSecimi           = $_POST["BirinciTasSecimi"] ?? 0;
$IkinciTasSecimi            = $_POST["IkinciTasSecimi"]?? 0;
$UcuncuTasSecimi            = $_POST["UcuncuTasSecimi"]?? 0;
$DorduncuTasSecimi          = $_POST["DorduncuTasSecimi"]?? 0;
$KostumZamanDamgasi         = $_POST["KostumZamanDamgasi"];
$Tur                        = $_POST["Tur"];
$KategoriID                 = $_POST["KategoriID"];
$HediyeGonderilecekKarakterIDsi  = $_POST["HediyeGonderilecekKarakterIDsi"];

if($Tur == 9 || $Tur == 10 || $Tur == 11){
        $gun        = date("d");
        $Ay         = date("m");
        $Yil        = date("Y");
        $Saat       = date("h");
        $Dakika     = date("i");
        $Saniye     = date("s");
    $zaman= new DateTime();
    $Parcala = explode(":",$KostumZamanDamgasi);
    if($Parcala[1] == "Gun"){
        $KostumSuresi =  unix_time_convert(0,0,10,0,0);





//        $zaman->setDate($Yil,$Ay,(int) $gun+$Parcala[0]);
//        $zaman->setTime($Saat,$Dakika,$Saniye);
//        $zamanfarki = $zaman->getOffset();
//        $KostumSuresi = $zaman->getTimestamp() + (10800);
    }
    /*Orjinal yapidir yedek amaçli kalıcak*/
//    if($Parcala[1] == "Ay"){
//        $zaman->setDate($Yil,$Ay+$Parcala[0],$gun);
//        $zaman->setTime($Saat,$Dakika,$Saniye);
//        $zamanfarki = $zaman->getOffset();
//        $KostumSuresi = $zaman->getTimestamp() + (10800);
//    }

    if($Parcala[1] == "Ay"){
        $zaman->modify("+".$Parcala[0]." month");
        $zamanfarki = $zaman->getOffset();
        $KostumSuresi = $zaman->getTimestamp() - ($zamanfarki);
    }

    if($Parcala[1] == "Yil"){
        $zaman->modify("+".$Parcala[0]." year");
        $zamanfarki = $zaman->getOffset();
        $KostumSuresi = $zaman->getTimestamp() - ($zamanfarki);
    }
}else{
    $KostumSuresi = 0;
}


$CoinKontrol = $databaseAccount->db->prepare("SELECT * FROM account.account WHERE id = ? LIMIT 1");
$CoinKontrol->execute([$AccountID]);
$CoinKontrolSayi = $CoinKontrol->rowCount();
$CoinKontrolKayitlar = $CoinKontrol->fetch(PDO::FETCH_ASSOC);
if($CoinKontrolSayi>0){
    $AccountCoins = $CoinKontrolKayitlar["coins"];
    if($AccountCoins>=$ToplamHesapTutari){
        $EjderhaParasiniKes = $databaseAccount->db->prepare("UPDATE account.account SET account.account.coins = account.account.coins - ?  WHERE account.account.id = ?");
        $EjderhaParasiniKes->execute([$ToplamHesapTutari, $AccountID]);
        $EjderhaParasiniKesSayi = $EjderhaParasiniKes->rowCount();
        if ($EjderhaParasiniKesSayi > 0) {
            $ItemleriUstUsteEkleKontrol = $database->db->prepare("SELECT * FROM global.itemdepo WHERE 
             account_id = ? AND ServerID = ? AND itemVnum = ? AND ItemNereyeGidicek = ? AND BirinciEfsunSecimi = ? AND IkinciEfsunSecimi = ? AND UcuncuEfsunSecimi = ? AND                         DorduncuEfsunSecimi = ? AND BesinciEfsunSecimi = ? AND AltinciEfsunSecimi = ? AND YedinciEfsunSecimi = ? AND BirinciTasSecimi = ? AND IkinciTasSecimi = ? AND                         UcuncuTasSecimi = ? AND DorduncuTasSecimi = ? AND KostumZamanDamgasi = ? ");
            $ItemleriUstUsteEkleKontrol->execute([
                $HediyeGonderilecekKarakterIDsi == null ? $AccountID : $HediyeGonderilecekKarakterIDsi,
                $ServerID,
                $itemVnum,
                $ItemNereyeGonderilecek,
                $BirinciEfsunSecimi,
                $IkinciEfsunSecimi,
                $UcuncuEfsunSecimi,
                $DorduncuEfsunSecimi,
                $BesinciEfsunSecimi,
                $AltinciEfsunSecimi,
                $YedinciEfsunSecimi,
                $BirinciTasSecimi,
                $IkinciTasSecimi,
                $UcuncuTasSecimi,
                $DorduncuTasSecimi,
                0
            ]);
            $ItemleriUstUsteEkleKontrolSayi = $ItemleriUstUsteEkleKontrol->rowCount();
            $ItemleriUstUsteEkleKontrolKayitlar = $ItemleriUstUsteEkleKontrol->fetch(PDO::FETCH_ASSOC);
            if($ItemleriUstUsteEkleKontrolSayi>0){
                $GuncellenecekItemServerID  = $ItemleriUstUsteEkleKontrolKayitlar["ServerID"];
                $GuncellenecekItemID        = $ItemleriUstUsteEkleKontrolKayitlar["id"];
                $IteminSayisiniGuncelle     = $database->db->prepare("UPDATE global.itemdepo SET itemSayisi = itemSayisi + ? WHERE ServerID = ? AND id = ? LIMIT 1");
                $IteminSayisiniGuncelle->execute([$ItemSayisi,$GuncellenecekItemServerID,$GuncellenecekItemID]);
                $IteminSayisiniGuncelleSayi = $IteminSayisiniGuncelle->rowCount();
               if ($IteminSayisiniGuncelleSayi > 0) {
                   $EnCokSatilanItemSayisiArttir= $database->db->prepare("SELECT * FROM global.item WHERE ServerID = ? AND itemVnum = ? AND indirim = ?");
                   $EnCokSatilanItemSayisiArttir->execute([$ServerID,$itemVnum,$Indirim]);
                   $EnCokSatilanItemSayisiArttirSayi = $EnCokSatilanItemSayisiArttir->rowCount();
                   $EnCokSatilanItemSayisiArttirKayitlar = $EnCokSatilanItemSayisiArttir->fetch(PDO::FETCH_ASSOC);
                   if($EnCokSatilanItemSayisiArttirSayi>0){
                      $SatinAlmaSayisiArttirilacakIteminIDsi = $EnCokSatilanItemSayisiArttirKayitlar["id"];
                      $SatinAlmaAdediArttir = $database->db->prepare("UPDATE global.item SET ToplamSatilanAdet = ToplamSatilanAdet + ? WHERE id = ? LIMIT 1");
                      $SatinAlmaAdediArttir->execute([$ItemSayisi,$SatinAlmaSayisiArttirilacakIteminIDsi]);
                      $SatinAlmaAdediArttirSayi = $SatinAlmaAdediArttir->rowCount();
                      if($SatinAlmaAdediArttirSayi>0){
                          if($HediyeGonderilecekKarakterIDsi != null){
                              $HediyeGonderilenItemBilgileriniYakala = $database->db->prepare("SELECT * FROM global.item WHERE ServerID = ? AND itemVnum = ? AND indirim = ?");
                              $HediyeGonderilenItemBilgileriniYakala->execute([$ServerID,$itemVnum,$Indirim]);
                              $HediyeGonderilenItemBilgileriniYakalaSayi = $HediyeGonderilenItemBilgileriniYakala->rowCount();
                              $HediyeGonderilenItemBilgileriniYakalaKayit = $HediyeGonderilenItemBilgileriniYakala->fetch(PDO::FETCH_ASSOC);
                              if($HediyeGonderilenItemBilgileriniYakalaSayi>0){
                                  $HediyeGondermeSayisiArttirilacakSutunID = $HediyeGonderilenItemBilgileriniYakalaKayit["id"];
                                  $HediyeAlimAdediniArttir = $database->db->prepare("UPDATE global.item SET HediyeEdilenAdet = HediyeEdilenAdet + ? WHERE id = ? LIMIT 1");
                                  $HediyeAlimAdediniArttir->execute([1,$HediyeGondermeSayisiArttirilacakSutunID]);
                                  $HediyeAlimAdediniArttirSayi = $HediyeAlimAdediniArttir->rowCount();
                                  if($HediyeAlimAdediniArttirSayi>0){
                                      echo json_encode("ITEMLER_GONDERILDI");
                                  }
                              }else{
                                 echo json_encode("ITEMLER_GONDERILDI_SAYI_ARTMADI");
                              }
                          }else{
                            echo json_encode("ITEMLER_GONDERILDI");
                          }
                      }else{
                          echo json_encode("ITEMLER_GONDERILDI_SAYI_ARTMADI");
                      }
                   }else{
                        echo json_encode("ITEMLER_GONDERILDI_SAYI_ARTMADI");
                   }

                } else {
                    echo json_encode("ITEMLER_GONDERILEMEDI");
                }
            }else{
                $GelenItemBilgileriniAl = $database->db->prepare("SELECT * FROM global.item WHERE itemVnum = ? AND ServerID = ? LIMIT 1");
                $GelenItemBilgileriniAl->execute([$itemVnum,$ServerID]);
                $GelenItemBilgileri = $GelenItemBilgileriniAl->fetch(PDO::FETCH_ASSOC);
                $ArtiBasmaVarmi = $GelenItemBilgileri["ArtiBasmaVarmi"];
                if (
                    (isset($AccountID) != "") &&
                    (isset($ToplamHesapTutari) != "") &&
                     (isset($ItemSayisi) != "") &&
                      (isset($ItemNereyeGonderilecek) != "") &&
                       (isset($Indirim) != "") && (isset($itemVnum) != "") &&
                        (isset($AccountEjderhaParasi) != "")) {
                    $DepoyaItemleriGonder = $database->db->prepare("INSERT INTO global.itemDepo(
                        account_id,
                        itemVnum,
                        ArtiBasma,
                        ToplamHesapTutari,
                        indirim,
                        ItemNereyeGidicek,
                        itemSayisi,
                        BirinciEfsunSecimi,
                        BirinciEfsunOrani,
                        IkinciEfsunSecimi,
                        IkinciEfsunOrani,
                        UcuncuEfsunSecimi,
                        UcuncuEfsunOrani,
                        DorduncuEfsunSecimi,
                        DorduncuEfsunOrani,
                        BesinciEfsunSecimi,
                        BesinciEfsunOrani,
                        AltinciEfsunSecimi,
                        AltinciEfsunOrani,
                        YedinciEfsunSecimi,
                        YedinciEfsunOrani,
                        BirinciTasSecimi,
                        IkinciTasSecimi,
                        UcuncuTasSecimi,
                        DorduncuTasSecimi,
                        KostumZamanDamgasi,
                        ServerID
                    ) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $DepoyaItemleriGonder->execute([
                        $HediyeGonderilecekKarakterIDsi == null ? $AccountID : $HediyeGonderilecekKarakterIDsi,
                        $itemVnum,
                        $ArtiBasmaVarmi,
                        $ToplamHesapTutari,
                        $Indirim,
                        $ItemNereyeGonderilecek,
                        $ItemSayisi,
                        $BirinciEfsunSecimi,
                        $BirinciEfsunOrani,
                        $IkinciEfsunSecimi,
                        $IkinciEfsunOrani,
                        $UcuncuEfsunSecimi,
                        $UcuncuEfsunOrani,
                        $DorduncuEfsunSecimi,
                        $DorduncuEfsunOrani,
                        $BesinciEfsunSecimi,
                        $BesinciEfsunOrani,
                        $AltinciEfsunSecimi,
                        $AltinciEfsunOrani,
                        $YedinciEfsunSecimi,
                        $YedinciEfsunOrani,
                        $BirinciTasSecimi,
                        $IkinciTasSecimi,
                        $UcuncuTasSecimi,
                        $DorduncuTasSecimi,
                        $KostumSuresi,
                        $ServerID
                    ]);
                    $DepoyaItemleriGonderSayi = $DepoyaItemleriGonder->rowCount();
                    if ($DepoyaItemleriGonderSayi > 0) {
                           $EnCokSatilanItemSayisiArttir= $database->db->prepare("SELECT * FROM global.item WHERE ServerID = ? AND itemVnum = ? AND indirim = ?");
                           $EnCokSatilanItemSayisiArttir->execute([$ServerID,$itemVnum,$Indirim]);
                           $EnCokSatilanItemSayisiArttirSayi = $EnCokSatilanItemSayisiArttir->rowCount();
                           $EnCokSatilanItemSayisiArttirKayitlar = $EnCokSatilanItemSayisiArttir->fetch(PDO::FETCH_ASSOC);
                           if($EnCokSatilanItemSayisiArttirSayi>0){
                              $SatinAlmaSayisiArttirilacakIteminIDsi = $EnCokSatilanItemSayisiArttirKayitlar["id"];
                              $SatinAlmaAdediArttir = $database->db->prepare("UPDATE global.item SET ToplamSatilanAdet = ToplamSatilanAdet + ? WHERE id = ? LIMIT 1");
                              $SatinAlmaAdediArttir->execute([$ItemSayisi,$SatinAlmaSayisiArttirilacakIteminIDsi]);
                              $SatinAlmaAdediArttirSayi = $SatinAlmaAdediArttir->rowCount();
                              if($SatinAlmaAdediArttirSayi>0){
                                  if($HediyeGonderilecekKarakterIDsi != null){
                                      $HediyeGonderilenItemBilgileriniYakala = $database->db->prepare("SELECT * FROM global.item WHERE ServerID = ? AND itemVnum = ? AND indirim = ?");
                                      $HediyeGonderilenItemBilgileriniYakala->execute([$ServerID,$itemVnum,$Indirim]);
                                      $HediyeGonderilenItemBilgileriniYakalaSayi = $HediyeGonderilenItemBilgileriniYakala->rowCount();
                                      $HediyeGonderilenItemBilgileriniYakalaKayit = $HediyeGonderilenItemBilgileriniYakala->fetch(PDO::FETCH_ASSOC);
                                      if($HediyeGonderilenItemBilgileriniYakalaSayi>0){
                                          $HediyeGondermeSayisiArttirilacakSutunID = $HediyeGonderilenItemBilgileriniYakalaKayit["id"];
                                          $HediyeAlimAdediniArttir = $database->db->prepare("UPDATE global.item SET HediyeEdilenAdet = HediyeEdilenAdet + ? WHERE id = ? LIMIT 1");
                                          $HediyeAlimAdediniArttir->execute([1,$HediyeGondermeSayisiArttirilacakSutunID]);
                                          $HediyeAlimAdediniArttirSayi = $HediyeAlimAdediniArttir->rowCount();
                                          if($HediyeAlimAdediniArttirSayi>0){
                                              echo json_encode("ITEMLER_GONDERILDI");
                                          }
                                      }else{
                                         echo json_encode("ITEMLER_GONDERILDI_SAYI_ARTMADI");
                                      }
                                  }else{
                                    echo json_encode("ITEMLER_GONDERILDI");
                                  }
                              }else{
                                  echo json_encode("ITEMLER_GONDERILDI_SAYI_ARTMADI");
                              }
                           }else{
                                echo json_encode("ITEMLER_GONDERILDI_SAYI_ARTMADI");
                           }
                    } else {
                        echo json_encode("ITEMLER_GONDERILEMEDI");
                    }
                } else {
                    echo json_encode("GELEN_EJDERHA_PARASI_BOS_GORUNUYOR");
                }


            }


























        } else {
            echo json_encode("EJDERHA_PARASI_ALINAMADI");
        }
    }else{
        echo json("YETERSİZ_EJDERHA_PARASI");
    }
}else{

}




























