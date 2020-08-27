<?php
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);
$ItemProtoIcinVnumlar       = $_POST["ItemProto_Vnumlar"];
$database = new Connect("global","localhost","root","");
$databasePlayer = new Connect("player",$SERVER_IP_HOST,$SERVER_ROOT,$SERVER_PASSWORD);



    $DATA = null;
    foreach ($ItemProtoIcinVnumlar as $key=>$item) {
        $itemVnumlari = (int) $item;
        $itemProtoDatalari = $databasePlayer->db->prepare("SELECT * FROM item_proto WHERE vnum  = ?");
        $itemProtoDatalari->execute([$itemVnumlari]);
        $itemProtoDatalariItemler = $itemProtoDatalari->fetch(PDO::FETCH_ASSOC);
        $EncodingAlgila = mb_detect_encoding(json_encode($itemProtoDatalariItemler));
        $EncodingUygula = mb_convert_encoding($itemProtoDatalariItemler,"UTF-8","ISO-8859-9");
        $DATA[$key] = $EncodingUygula;
    }
        echo json_encode([$DATA]);
