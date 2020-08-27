<?php
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);



$database = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);
$SQLSorgusu = iconv("UTF-8","ISO-8859-9",$_POST["itemAdi"]);
$ArananItem = $database->db->prepare("SELECT * FROM player.item_proto WHERE locale_name LIKE '$SQLSorgusu%' LIMIT 100");
$ArananItem->execute();
$ArananItemSayisi = $ArananItem->rowCount();
$ArananItemSonuclari = $ArananItem->fetchAll(PDO::FETCH_ASSOC);

if ($ArananItemSayisi > 0) {
    $EncodingAlgila = mb_detect_encoding(json_encode($ArananItemSonuclari));
    $EncodingUygula = mb_convert_encoding($ArananItemSonuclari, "UTF-8", "ISO-8859-9");
    echo json_encode($EncodingUygula);
} else {
    echo json_encode("SONUC_YOK");
}


//
//    $Datalar = [];
//    foreach ($EncodingUygula as $item) {
//        $Datalar = $item;
//    }
//    echo json_encode($Datalar);
//
//}else{

//}
?>