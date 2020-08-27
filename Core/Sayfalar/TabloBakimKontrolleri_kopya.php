<?php
set_time_limit(1000);
$OnarilacakDBler            = ["account","common",""];
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$globaldb = new Connect("global", "localhost", "root", "");
if((isset($SERVER_IP_HOST)!="") && (isset($SERVER_PASSWORD)!="") && (isset($SERVER_ROOT)!="")){

    $database = new Connect("player", $SERVER_IP_HOST, $SERVER_ROOT, $SERVER_PASSWORD);
    $SuankiZamanDamgasi = time();
    $Bakim = $globaldb->db->prepare("SELECT * FROM global.serverbakim WHERE ServerID = ?");
    $Bakim->execute([$ServerID]);
    $BakimSayisi = $Bakim->rowCount();
    $BakimKayitlari = $Bakim->fetch(PDO::FETCH_ASSOC);


  if ($BakimSayisi > 0) {
        if ($SuankiZamanDamgasi > $BakimKayitlari["ServerEnSonBakimTarihi"]) {
            $ServerPrimaryID = $BakimKayitlari["id"];
            $sorgu = $database->db->query("SHOW TABLES");
            if ($sorgu) {
                $SorguSonucu = [];
                foreach ($sorgu as $item) {
                    if($item[0] == "item"){
                        $SorguA = $database->db->query("CHECK TABLE " . $item[0]);
                        $SorguB = $database->db->query("ANALYZE TABLE " . $item[0]);
                        $SorguC = $database->db->query("REPAIR TABLE " . $item[0]);
                        $SorguD = $database->db->query("OPTIMIZE TABLE " . $item[0]);
                        if (($SorguA == true) and ($SorguB == true) and ($SorguC == true) and ($SorguD == true)) {
                            $SorguSonucu[0] = "YES";
                        } else {
                            echo "Sorgu Hatası.";
                        }
                    }

                }
                if ($SorguSonucu[0] == "YES") {
                    $Guncelle = $globaldb->db->prepare("UPDATE global.serverbakim SET ServerEnSonBakimTarihi = ? WHERE id = ? AND ServerID = ?");
                    $Guncelle->execute([$SuankiZamanDamgasi + 86400*2, $ServerPrimaryID, $ServerID]);
                    $GuncelleSayi = $Guncelle->rowCount();
                    if ($GuncelleSayi > 0) {
                        echo json_encode("BAKIMLAR_YAPILDI_TEKRARDAN_GUNCELLEMELER_BASARILI");
                    }
                }
            }


        } else {
            echo json_encode("TABLOLAR_ZATEN_GUNCELLENMIS");
        }

    } else {
        $sorgu = $database->db->query("SHOW TABLES");
        if ($sorgu) {
            $SorguSonucu = [];
            foreach ($sorgu as $item) {
                if($item[0] == "item"){
                $SorguA = $database->db->query("CHECK TABLE " . $item[0]);
                $SorguB = $database->db->query("ANALYZE TABLE " . $item[0]);
                $SorguC = $database->db->query("REPAIR TABLE " . $item[0]);
                $SorguD = $database->db->query("OPTIMIZE TABLE " . $item[0]);
                    if (($SorguA == true) and ($SorguB == true) and ($SorguC == true) and ($SorguD == true)) {
                        $SorguSonucu[0] = "YES";
                    } else {
                        echo "Sorgu Hatası.";
                    }
                }
            }

            if ($SorguSonucu[0] == "YES") {
                $BakimEkle = $globaldb->db->prepare("INSERT INTO serverbakim(ServerID, ServerEnSonBakimTarihi) values(?,?)");
                $BakimEkle->execute([$ServerID, $SuankiZamanDamgasi + 86400*2]);
                $BakimEkleSayi = $BakimEkle->rowCount();
                if ($BakimEkleSayi > 0) {
                    echo json_encode("BAKIM_YAPILDI");
                } else {
                    echo json_encode("BAKIM_YAPILAMADI");
                }
            }


        }


    }




























}else{
    echo json_encode("EKSIK_SERVER_BILGILERI");
}


?>






