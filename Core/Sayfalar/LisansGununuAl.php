<?php
$GelenServerKeygen = $_POST["Keygen"];
$GelenLisansKodu = $_POST["LisansKodu"];
$database = new Connect("global","localhost","root","");

if((isset($GelenLisansKodu)!="") && (isset($GelenServerKeygen)!="")){
    $ServerIDYakala = $database->db->prepare("SELECT * FROM serverayar WHERE ServerKeygen = ? LIMIT 1");
    $ServerIDYakala->execute([$GelenServerKeygen]);
    $ServerIDYakalaSayi = $ServerIDYakala->rowCount();
    $ServerIDYakalaKayit = $ServerIDYakala->fetch(PDO::FETCH_ASSOC);
    if($ServerIDYakalaSayi>0){
        $GelenServerID   = $ServerIDYakalaKayit["id"];

        $Kontrol = $database->db->prepare("SELECT * FROM lisanskuponlari WHERE LisansKoduKullananServerID = ? AND LisansKodu = ? AND LisansKoduAktifligi = ?");
        $Kontrol->execute([$GelenServerID,$GelenLisansKodu,0]);
        $KontrolSayi = $Kontrol->rowCount();
        $KontrolKayit = $Kontrol->fetch(PDO::FETCH_ASSOC);
        if($KontrolSayi>0){
            echo json_encode($KontrolKayit["Suresi"]);
        }else{
            echo json_encode("BOYLE_BIR_LISANS_YOK");
        }
    }









}else{
    echo json_encode("GELEN_BOS_PARAMETRE_HATASI");
}



?>