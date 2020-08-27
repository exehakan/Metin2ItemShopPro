<?php
$ServerID                   = $_POST["ServerID"];
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);

$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);

$TasSlotlarininKontrolu = $database->db->prepare("SELECT * FROM player.item");
$TasSlotlarininKontrolu->execute();
$TasSlotlarininKontroluSayi = $TasSlotlarininKontrolu->rowCount();
$TasSlotlarininKontroluKayit = $TasSlotlarininKontrolu->fetch(PDO::FETCH_ASSOC);
if($TasSlotlarininKontroluSayi>0){
    $AktifSocket = 0;
    $Socket0 = $TasSlotlarininKontroluKayit["socket0"];
    $Socket1 = $TasSlotlarininKontroluKayit["socket1"];
    $Socket2 = $TasSlotlarininKontroluKayit["socket2"];
    $Socket3 = $TasSlotlarininKontroluKayit["socket3"];

    if(($Socket0==1 || $Socket0 ==0) && ($Socket1==1 || $Socket1 ==0) && ($Socket2==1 || $Socket2 ==0) && ($Socket3==1 || $Socket3 ==0)  ){
        $AktifSocket = 4;
    }else{
        $AktifSocket = 3;
    }

    echo json_encode($AktifSocket);


}else{
    echo json_encode("EFSUN_SAYISI_ALINAMADI");
}







?>