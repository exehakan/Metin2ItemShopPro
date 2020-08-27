<?php

$ServerID = $_POST["ServerID"];
$IndexKey = $_POST["IndexKey"];
$ID = $_POST["id"];
$database = new Connect("global","localhost","root","");

$Kontrol = $database->db->prepare("SELECT * FROM global.item WHERE ServerID = ? AND IndexKey = ? AND id = ? LIMIT 1");
$Kontrol->execute([$ServerID,$IndexKey,$ID]);
$Kayitlar = $Kontrol->fetchAll(PDO::FETCH_ASSOC);
$Sayi = $Kontrol->rowCount();
if($Sayi>0){
    echo json($Kayitlar);
}else{
    echo json("hayir");
}







?>