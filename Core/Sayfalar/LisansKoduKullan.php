<?php
$GelenLisansKodu  = $_POST["LisansKodu"];
$GelenServerKeygen = $_POST["Keygen"];
$database = new Connect("global","localhost","root","");

$ServerIDYakala = $database->db->prepare("SELECT * FROM serverayar WHERE ServerKeygen = ? LIMIT 1");
$ServerIDYakala->execute([$GelenServerKeygen]);
$ServerIDYakalaSayi = $ServerIDYakala->rowCount();
$ServerIDYakalaKayit = $ServerIDYakala->fetch(PDO::FETCH_ASSOC);
if($ServerIDYakalaSayi>0) {
    $GelenServerID = $ServerIDYakalaKayit["id"];

    $Kontroller = $database->db->prepare("SELECT * FROM lisanskuponlari WHERE LisansKodu = ? AND LisansKoduKullananServerID = ? AND LisansKoduAktifligi = ?");
    $Kontroller->execute([$GelenLisansKodu,$GelenServerID,0]);
    $KontrollerSayi = $Kontroller->rowCount();
    $KontrollKayitlari = $Kontroller->fetch(PDO::FETCH_ASSOC);
    if($KontrollerSayi>0){
        $EslesenLisansIdDegeri = $KontrollKayitlari["id"];
        $GelenSure = $KontrollKayitlari["Suresi"];
        if($GelenSure == 30){
            $UzatilacakZaman = time()+(86400*30);
        }else if($GelenSure == 60){
            $UzatilacakZaman = time()+(86400*60);
        }else if($GelenSure == 90){
            $UzatilacakZaman = time()+(86400*90);
        }else if($GelenSure == 120){
            $UzatilacakZaman = time()+(86400*120);
        }else if($GelenSure == 150){
            $UzatilacakZaman = time()+(86400*150);
        }

        $LisansKuponuGuncelle = $database->db->prepare("UPDATE global.lisanskuponlari SET LisansKoduAktifligi = ? WHERE id = ? LIMIT 1");
        $LisansKuponuGuncelle->execute([1,$EslesenLisansIdDegeri]);
        $LisansKuponuGuncelleSayi = $LisansKuponuGuncelle->rowCount();
        if($LisansKuponuGuncelleSayi>0){
            $LisansSuresiniUzat = $database->db->prepare("UPDATE global.serverayar SET BitisZamanDamgasi = ?,LisansDurumu = ?, LisansIzni = ? WHERE id = ?");
            $LisansSuresiniUzat->execute([$UzatilacakZaman,1,1,$GelenServerID]);
            $LisansSuresiniUzatSayi = $LisansSuresiniUzat->rowCount();
            if($LisansSuresiniUzatSayi>0){
                echo json_encode("LISANS_UZATILDI");
            }else{
                echo json_encode("LISANS_UZATLAMADI");
            }

        }else{
            echo json_encode("BIR_HATA_MEYDANA_GELDI");
        }
    }else{
        echo json_encode("LISANS_KODU_KULLANILMIS_VEYA_HATALI");
    }














}else{

}























?>