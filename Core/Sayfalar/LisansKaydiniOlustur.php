<?php
$database = new Connect("global", "localhost", "root", "");
//echo json($_POST);
$GelenEmail = $_POST["Email"];
$GelenServerName = $_POST["ServerName"];
$GelenServerWebSitesi = $_POST["ServerWebSitesi"];


$ServerKaydi = $database->db->prepare("INSERT INTO serverayar(ServerName, ServerHTTP, ServerFileName, ServerKeygen, ServerEmail, BaslangicZamanDamgasi, BitisZamanDamgasi, DenemeZamanDamgasi, LisansDurumu, LisansIzni) VALUES (?,?,?,?,?,?,?,?,?,?)");
$ServerKaydi->execute([$GelenServerName,$GelenServerWebSitesi,md5(uniqid()),uniqid(),$GelenEmail,time(),time()+86400,time(),0,0]);
$ServerKaydiSayi = $ServerKaydi->rowCount();
if($ServerKaydiSayi>0){
    echo json("LISANS_KAYDI_BASARILI");
}else{
    echo json("BOYLE_BIR_KAYIT_VAR");
}

?>