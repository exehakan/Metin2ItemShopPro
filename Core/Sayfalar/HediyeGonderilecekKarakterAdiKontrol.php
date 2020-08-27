<?php
$ServerID                           = $_POST["ServerID"];
$SERVER_IP_HOST                     = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD                    = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                        = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$HediyeGonderilecekKarakterAdi      = $_POST["KarakterAdi"];
$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);
$KarakterAdiniKontrolet = $database->db->prepare("SELECT * FROM player.player WHERE name = ? LIMIT 1");
$KarakterAdiniKontrolet->execute([$HediyeGonderilecekKarakterAdi]);
$KarakterAdiniKontroletSayi = $KarakterAdiniKontrolet->rowCount();
$KarakterAdiniKontroletKayitlar = $KarakterAdiniKontrolet->fetch(PDO::FETCH_ASSOC);
if($KarakterAdiniKontroletSayi>0){
    echo json_encode($KarakterAdiniKontroletKayitlar);
}else{
    echo json_encode("BOYLE_BIR_KARAKTER_BULUNAMADI");
}




?>