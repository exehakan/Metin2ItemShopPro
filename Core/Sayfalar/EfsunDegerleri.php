<?php
$ServerID                   = $_POST["ServerID"];
$KullaniciAdi               = Decrypt($_POST["KullaniciAdi"],$ServerID);
$EmailAdresi                = Decrypt($_POST["EmailAdresi"],$ServerID);
$Sifre                      = Decrypt($_POST["Sifre"],$ServerID);
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);

$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);
$EfsunDegerleriniCek = $database->db->prepare("SELECT * FROM item_attr");
$EfsunDegerleriniCek->execute();
$EfsunKayitDegerleri = $EfsunDegerleriniCek->fetchAll(PDO::FETCH_ASSOC);
$EfsunDegerleriniCekSayi = $EfsunDegerleriniCek->rowCount();
if($EfsunDegerleriniCekSayi>0){
    $datalar = [];
    foreach ($EfsunKayitDegerleri as $key=>$item) {
        $datalar[$key] = $item;
    }
    echo json($datalar);
}else{
    echo json("EFSUN_DEGERLERI_ALINAMADI");
}


?>