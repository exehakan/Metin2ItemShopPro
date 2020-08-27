<?php
$database = new Connect("global", "localhost", "root", "");
$GelenKeygen = $_POST["keygen"];
$kontrol = $database->db->prepare("SELECT * FROM serverayar WHERE ServerKeygen = ?");
$kontrol->execute([$GelenKeygen]);
$KontrolSayi = $kontrol->rowCount();
$KontrolKayit = $kontrol->fetch(PDO::FETCH_ASSOC);
if($KontrolSayi>0){
   $SuankiZamanDamgasi  = time();
   $BitisZamanDamgasi   = $KontrolKayit["BitisZamanDamgasi"];
   if($SuankiZamanDamgasi>$BitisZamanDamgasi){
       echo json_encode("LISANS_SURESI_DOLDU");
   }else{
       echo json_encode($KontrolKayit);
   }
}
$database->db = null;
?>