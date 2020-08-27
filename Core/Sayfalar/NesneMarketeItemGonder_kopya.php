<?php
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$globalDB                   = new Connect("global", "localhost", "root", "");
$database                   = new Connect("player", $SERVER_IP_HOST, $SERVER_ROOT, $SERVER_PASSWORD);

$ItemAdi                    = $_POST[0]["itemVnum"];
$ItemID                     = $_POST[0]["id"];
$Yer                        = $_POST[0]["Yer"];
$Vnum                       = $_POST[0]["vnum"];
$Adet                       = $_POST[0]["Adet"];
$Indirim                    = $_POST[0]["Indirim"];
$AccountID                  = $_POST[0]["accountID"];
$ArtiBasmaDegeri            = $_POST[0]["ArtiBasma"];
$Fiyat                      = $_POST[0]["Fiyat"];
$BirinciEfsunSecimi         = $_POST[0]["BirinciEfsunSecimi"];
$IkinciEfsunSecimi          = $_POST[0]["IkinciEfsunSecimi"];
$UcuncuEfsunSecimi          = $_POST[0]["UcuncuEfsunSecimi"];
$DorduncuEfsunSecimi        = $_POST[0]["DorduncuEfsunSecimi"];
$BesinciEfsunSecimi         = $_POST[0]["BesinciEfsunSecimi"];
$AltinciEfsunSecimi         = $_POST[0]["AltinciEfsunSecimi"];
$YedinciEfsunSecimi         = $_POST[0]["YedinciEfsunSecimi"];
$BirinciEfsunOrani          = $_POST[0]["BirinciEfsunOrani"];
$IkinciEfsunOrani           = $_POST[0]["IkinciEfsunOrani"];
$UcuncuEfsunOrani           = $_POST[0]["UcuncuEfsunOrani"];
$DorduncuEfsunOrani         = $_POST[0]["DorduncuEfsunOrani"];
$BesinciEfsunOrani          = $_POST[0]["BesinciEfsunOrani"];
$AltinciEfsunOrani          = $_POST[0]["AltinciEfsunOrani"];
$YedinciEfsunOrani          = $_POST[0]["YedinciEfsunOrani"];
$BirinciTasSecimi           = $_POST[0]["BirinciTasSecimi"];
$IkinciTasSecimi            = $_POST[0]["IkinciTasSecimi"];
$UcuncuTasSecimi            = $_POST[0]["UcuncuTasSecimi"];
$DorduncuTasSecimi          = $_POST[0]["DorduncuTasSecimi"];
$KostumZamanDamgasi         = $_POST[0]["KostumZamanDamgasi"];
$SlotBaslangic = 0;
if ($Yer == 0) {
    $GuncelYer = "MALL";
} else {
    $GuncelYer = "SAFEBOX";
}

if($KostumZamanDamgasi>0){
    $KostumSureIzni = 1;
}else{
    $KostumSureIzni = 0;
}




$ItemVarmiKontrolu = $globalDB->db->prepare("SELECT * FROM global.itemDepo WHERE account_id = ? AND  itemVnum =? AND ToplamHesapTutari = ? AND indirim = ? AND ItemNereyeGidicek = ? AND ServerID = ?");
$ItemVarmiKontrolu->execute([$AccountID, $Vnum, $Fiyat, $Indirim, $Yer, $ServerID]);
$ItemVarmiKontroluKayitlari = $ItemVarmiKontrolu->fetch(PDO::FETCH_ASSOC);
$ItemVarmiKontroluSayisi = $ItemVarmiKontrolu->rowCount();
if ($ItemVarmiKontroluSayisi > 0) {
    $IteminToplamAdedi = $ItemVarmiKontroluKayitlari["itemSayisi"];
    if ($IteminToplamAdedi > 0 && $IteminToplamAdedi != "" && $IteminToplamAdedi != 0) {


        $NesneMarketSlotKontrolleri = $database->db->prepare("SELECT * FROM player.item WHERE owner_id = ? AND window = 'MALL'");
        $NesneMarketSlotKontrolleri->execute([$AccountID]);
        $NesneMarketSlotKontrolleriSayisi = $NesneMarketSlotKontrolleri->rowCount();
        $NesneMarketSlotKontrolleriKayitlari = $NesneMarketSlotKontrolleri->fetchAll(PDO::FETCH_ASSOC);
        $PosSonuclari = [];
        $PosIndexSiralamasi = [0, 1, 2, 3, 4, 15, 16, 17, 18, 19, 30, 31, 32, 33, 34];
        foreach ($NesneMarketSlotKontrolleriKayitlari as $key => $item) {
            $PosSonuclari[$key] = $item["pos"];
        }


        if ($NesneMarketSlotKontrolleriSayisi > 0) {
            if (count($PosSonuclari) < 15) {
                for ($i = 0; $i < count($PosIndexSiralamasi); $i++) {
                    if (!in_array($PosIndexSiralamasi[$i], $PosSonuclari)) {
                        $posSlot = $PosIndexSiralamasi[$i];
                        $ItemAdediniBirDusur = $globalDB->db->prepare("UPDATE global.itemDepo SET itemSayisi = itemSayisi - ? WHERE account_id = ? AND itemVnum = ? AND itemSayisi = ? AND id = ? AND ServerID = ? ");
                        $ItemAdediniBirDusur->execute([1, $AccountID, $Vnum, $Adet, $ItemID, $ServerID]);
                        $ItemAdediniBirDusurSayi = $ItemAdediniBirDusur->rowCount();
                        if ($ItemAdediniBirDusurSayi > 0) {
                            $ItemiGonder = $database->db->prepare("INSERT INTO player.item(
                                owner_id,
                                window,
                                pos,
                                count,
                                vnum,
                                socket0,
                                socket1,
                                socket2,
                                socket3,
                                attrtype0,
                                attrvalue0,
                                attrtype1,
                                attrvalue1,
                                attrtype2,
                                attrvalue2,
                                attrtype3,
                                attrvalue3,
                                attrtype4,
                                attrvalue4,
                                attrtype5,
                                attrvalue5,
                                attrtype6,
                                attrvalue6
                                ) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            $ItemiGonder->execute([
                                $AccountID,
                                $GuncelYer,
                                $posSlot,
                                1,
                                $Vnum,
                                $KostumSureIzni == 1 ? $KostumZamanDamgasi:$BirinciTasSecimi,
                                $IkinciTasSecimi,
                                $UcuncuTasSecimi,
                                $DorduncuTasSecimi,
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
                                $YedinciEfsunOrani]);
                            $ItemiGonderSonucSayisi = $ItemiGonder->rowCount();
                            if ($ItemiGonderSonucSayisi > 0) {
                                echo json("ITEM_BASARIYLA_GONDERILDI");
                            } else {
                                echo json("ITEM_GONDERILEMEDI_kod_11");
                            }
                        } else {
                            echo json("ITEM_GONDERILEMEDI_kod_10");
                        }

                        break;
                    }
                }
            } else {
                echo json_encode("NESNE_MARKET_DEPOSU_DOLU");
            }
        } else {
            $posSlot = 0;
            $ItemiGonder = $database->db->prepare("INSERT INTO player.item(owner_id,window,pos,count,vnum,socket0,socket1,socket2,socket3,attrtype0,attrvalue0,attrtype1,attrvalue1,attrtype2,attrvalue2,attrtype3,attrvalue3,attrtype4,attrvalue4,attrtype5,attrvalue5,attrtype6,attrvalue6) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $ItemiGonder->execute([$AccountID, $GuncelYer, $posSlot, 1, $Vnum,$KostumSureIzni == 1 ? $KostumZamanDamgasi:$BirinciTasSecimi,$IkinciTasSecimi,$UcuncuTasSecimi,$DorduncuTasSecimi, $BirinciEfsunSecimi, $BirinciEfsunOrani, $IkinciEfsunSecimi, $IkinciEfsunOrani, $UcuncuEfsunSecimi, $UcuncuEfsunOrani, $DorduncuEfsunSecimi, $DorduncuEfsunOrani, $BesinciEfsunSecimi, $BesinciEfsunOrani, $AltinciEfsunSecimi, $AltinciEfsunOrani, $YedinciEfsunSecimi, $YedinciEfsunOrani]);
            $ItemiGonderSonucSayisi = $ItemiGonder->rowCount();
            if ($ItemiGonderSonucSayisi > 0) {
                $ItemAdediniBirDusur = $globalDB->db->prepare("UPDATE global.itemDepo SET itemSayisi = itemSayisi - ? WHERE account_id = ? AND itemVnum = ? AND itemSayisi = ? AND id = ? AND ServerID = ? ");
                $ItemAdediniBirDusur->execute([1, $AccountID, $Vnum, 1, $ItemID, $ServerID]);
                $ItemAdediniBirDusurSayi = $ItemAdediniBirDusur->rowCount();
                if ($ItemAdediniBirDusurSayi > 0) {
                    echo json("ITEM_BASARIYLA_GONDERILDI");
                } else {
                    echo json("ITEM_GONDERILEMEDI_2");
                }
            } else {
                echo json("ITEM_GONDERILEMEDI_kod_12");
            }
        }
    }
} else {
    echo json_encode("BOYLE_BIR_ITEM_BULUNAMADI");
}


?>