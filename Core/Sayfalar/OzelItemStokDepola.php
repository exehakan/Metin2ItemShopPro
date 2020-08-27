<?php
$ServerID                   = (int) $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$AccountID                  = (int) $_POST[0]["ACCOUNT_ID"];
$ItemFiyati                 = (int) $_POST[0]["ItemFiyati"];
$itemVnum                   = (int) $_POST[0]["itemVnum"];

$database = new Connect("global","localhost","root","");
$databaseAccount = new Connect("account",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

$AccountCoinsKontrol = $databaseAccount->db->prepare("SELECT * FROM account.account WHERE id = ?");
$AccountCoinsKontrol->execute([$AccountID]);
$AccountCoinsKontrolSayisi = $AccountCoinsKontrol->rowCount();
$AccountCoinsKontrolKayitlari = $AccountCoinsKontrol->fetchAll(PDO::FETCH_ASSOC);
if($AccountCoinsKontrolSayisi>0){
    $Coins = $AccountCoinsKontrolKayitlari[0]["coins"];
    $AccountIDDB = $AccountCoinsKontrolKayitlari[0]["id"];
    if($Coins>$ItemFiyati){
        $ItemFiyatiniDusur = $databaseAccount->db->prepare("UPDATE account.account SET coins = coins - ?  WHERE id = ?");
        $ItemFiyatiniDusur->execute([$ItemFiyati,$AccountIDDB]);
        $ItemFiyatiniDusurSayisi = $ItemFiyatiniDusur->rowCount();
        if($ItemFiyatiniDusurSayisi>0){
            $ItemVarIse = $database->db->prepare("SELECT * FROM global.ozelitem WHERE itemVnum = ? AND itemFiyat = ? AND ServerID = ? LIMIT 1");
            $ItemVarIse->execute([$itemVnum,$ItemFiyati,$ServerID]);
            $ItemVarIseIslemSayisi = $ItemVarIse->rowCount();
            $ItemVarIseKayitlar = $ItemVarIse->fetchAll(PDO::FETCH_ASSOC);
            if($ItemVarIseIslemSayisi>0){
                $GuncelItemKayitlari = $ItemVarIseKayitlar;
                $BirinciEfsunSecimi         = $ItemVarIseKayitlar["BirinciEfsunSecimi"] ?? 0;
                $IkinciEfsunSecimi          = $ItemVarIseKayitlar["IkinciEfsunSecimi"] ?? 0;
                $UcuncuEfsunSecimi          = $ItemVarIseKayitlar["UcuncuEfsunSecimi"] ?? 0;
                $DorduncuEfsunSecimi        = $ItemVarIseKayitlar["DorduncuEfsunSecimi"] ?? 0;
                $BesinciEfsunSecimi         = $ItemVarIseKayitlar["BesinciEfsunSecimi"] ?? 0;
                $AltinciEfsunSecimi         = $ItemVarIseKayitlar["AltinciEfsunSecimi"] ?? 0;
                $YedinciEfsunSecimi         = $ItemVarIseKayitlar["YedinciEfsunSecimi"] ?? 0;
                $BirinciEfsunOrani          = $ItemVarIseKayitlar["BirinciEfsunOrani"] ?? 0;
                $IkinciEfsunOrani           = $ItemVarIseKayitlar["IkinciEfsunOrani"] ?? 0;
                $UcuncuEfsunOrani           = $ItemVarIseKayitlar["UcuncuEfsunOrani"] ?? 0;
                $DorduncuEfsunOrani         = $ItemVarIseKayitlar["DorduncuEfsunOrani"] ?? 0;
                $BesinciEfsunOrani          = $ItemVarIseKayitlar["BesinciEfsunOrani"] ?? 0;
                $AltinciEfsunOrani          = $ItemVarIseKayitlar["AltinciEfsunOrani"] ?? 0;
                $YedinciEfsunOrani          = $ItemVarIseKayitlar["YedinciEfsunOrani"] ?? 0;
                $BirinciTasSecimi           = $ItemVarIseKayitlar["BirinciTasSecimi"] ?? 0;
                $IkinciTasSecimi            = $ItemVarIseKayitlar["IkinciTasSecimi"]?? 0;
                $UcuncuTasSecimi            = $ItemVarIseKayitlar["UcuncuTasSecimi"]?? 0;
                $DorduncuTasSecimi          = $ItemVarIseKayitlar["DorduncuTasSecimi"]?? 0;
                $ArtiBasmaVarmi             = $ItemVarIseKayitlar["ArtiBasmaVarmi"]?? 0;
                $indirim                    = $ItemVarIseKayitlar["indirim"]?? 0;
                $AccountID                  = (int) $_POST[0]["ACCOUNT_ID"];
                $ItemFiyati                 = (int) $_POST[0]["ItemFiyati"];
                $itemVnum                   = (int) $_POST[0]["itemVnum"];
                $ItemNereyeGonderilecek     = 0;
                $ItemSayisi                 = 1;
                $KostumZamanDamgasi         = 0;

                $ItemDeposunaGonder = $database->db->prepare("INSERT INTO global.itemdepo(
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
                ServerID ) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $ItemDeposunaGonder->execute([
                    $AccountID,
                    $itemVnum,
                    $ArtiBasmaVarmi,
                    $ItemFiyati,
                    $indirim,
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
                    $KostumZamanDamgasi,
                    $ServerID
                ]);
                $ItemDeposunaGonderSayisi = $ItemDeposunaGonder->rowCount();
                if($ItemDeposunaGonderSayisi>0){
                    echo json_encode("ITEMLER_GONDERILDI");
                }else{
                    echo json_encode("ITEMLER_GONDERILEMEDI");
                }

            }else{
                echo json_encode("BOYLE_BIR_ITEM_YOK");
            }
        }else{
            echo json_encode("EJDERHA_PARASI_ALINIRKEN_BIR_HATA_MEYDANA_GELDI_TEKRAR_DENEYIN");
        }
    }else{
        echo json_encode("YETERSIZ_EJDERHA_PARASI");
    }
}else{
    echo json("BOYLE_BIR_KULLANICI_YOK");
}




$database->db = null;
$databaseAccount->db = null;
?>





/*
$KostumZamanDamgasi         = $_POST["KostumZamanDamgasi"];
$HediyeGonderilecekKarakterIDsi  = $_POST["HediyeGonderilecekKarakterIDsi"];
$KostumSuresi = 0;


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
*/



























