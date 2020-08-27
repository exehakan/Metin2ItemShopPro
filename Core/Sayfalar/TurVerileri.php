<?php
$globalDB = new Connect("global","localhost","root","");
$Tur = $globalDB->db->prepare("SELECT * FROM global.tur");
$Tur->execute();
$TurKayitlari = $Tur->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($TurKayitlari);