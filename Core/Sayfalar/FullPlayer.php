<?php
global $database;
$AccountID                  = $_POST["ID"];
$ServerID                   = $_POST["ServerID"];
$SERVER_IP_HOST             = Decrypt($_POST["SERVER_IP_HOST"],$ServerID);
$SERVER_PASSWORD            = Decrypt($_POST["SERVER_PASSWORD"],$ServerID);
$SERVER_ROOT                = Decrypt($_POST["SERVER_ROOT"],$ServerID);




$database = new Connect("player", $SERVER_IP_HOST, $SERVER_ROOT, $SERVER_PASSWORD);
if ((isset($AccountID) != "")) {
    $Player = $database->db->prepare("SELECT * FROM player.player WHERE account_id = ? LIMIT 1");
    $Player->execute([$AccountID]);
    $PlayerSonuclar = $Player->rowCount();
    $PlayerKayitlar = $Player->fetchAll(PDO::FETCH_ASSOC);
    if ($PlayerSonuclar > 0) {
        echo json_encode($PlayerKayitlar);
    } else {
        echo BILINMEYEN_HATA();
    }
} else {
    echo json_encode(["PARAMETRE_DOGRULAMA_HATASI"]);
}





