<?php
$database = new Connect("global","localhost","root","");
$GelenAccountID = $_POST["AccountID"];
$ServerID = $_POST["ServerID"];
if(isset($GelenAccountID)!=""){
    $ItemleriListele  = $database->db->prepare("SELECT * FROM global.itemDepo WHERE account_id = ? AND ServerID = ?");
    $ItemleriListele->execute([$GelenAccountID,$ServerID]);
    $ItemleriListeleSayisi = $ItemleriListele->rowCount();
    $ItemleriListeleKayitlar = $ItemleriListele->fetchAll(PDO::FETCH_ASSOC);
    if($ItemleriListeleSayisi>0){
        echo json_encode($ItemleriListeleKayitlar);
    }else{
        echo json_encode("NESNE_MARKET_DEPOSUNA_AIT_ITEM_YOK");
    }
}else{

}