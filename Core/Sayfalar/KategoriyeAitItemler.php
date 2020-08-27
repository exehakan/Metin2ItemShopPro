<?php

$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);

$database = new Connect("global","localhost","root","");
$databasePlayer = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);
$KategoriyeAitItemler = $database->db->prepare("SELECT * FROM global.item WHERE KategoriID = ? AND ServerID = ?");
$KategoriyeAitItemler->execute([$_POST["KategoriID"],$ServerID]);
$KategoriyeAitItemDatalari = $KategoriyeAitItemler->fetchAll(PDO::FETCH_ASSOC);
$KategoriyeAitItemlerCount = $KategoriyeAitItemler->rowCount();
if ($KategoriyeAitItemlerCount>0){
    $DATA = array();
    foreach ($KategoriyeAitItemDatalari as $key=>$item) {
        $itemProtoDatalari = $databasePlayer->db->prepare("SELECT * FROM item_proto WHERE vnum  = ?");
        $itemProtoDatalari->execute([$item["itemVnum"]]);
        $itemProtoDatalariItemler = $itemProtoDatalari->fetch(PDO::FETCH_ASSOC);
        $EncodingAlgila = mb_detect_encoding(json_encode($itemProtoDatalariItemler));
        $EncodingUygula = mb_convert_encoding($itemProtoDatalariItemler,"UTF-8","ISO-8859-9");
        $DATA[$item["id"]] = [$EncodingUygula];
    }
        echo json_encode([$DATA,$KategoriyeAitItemDatalari]);
}
