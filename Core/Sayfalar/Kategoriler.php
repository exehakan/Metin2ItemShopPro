<?php
$ServerID = 1;
$database = new Connect("global","localhost","root","");
$KategorileriCek = $database->db->prepare("SELECT * FROM global.Kategoriler WHERE ServerID = ?");
$KategorileriCek->execute([$ServerID]);
$KategorileriCekSayi = $KategorileriCek->rowCount();
$KategorileriCekKayitlar = $KategorileriCek->fetchAll(PDO::FETCH_ASSOC);
if($KategorileriCekSayi>0){
    echo json_encode($KategorileriCekKayitlar);
}else{
    echo json_encode(array());
}

?>



