<?php /** @noinspection ALL */

$ServerID = $_POST["ServerID"];
$GelenOnayDurumu = $_POST["OnayDurumu"];
$SilinecekKategoriID = $_POST["SilinecekKategoriID"];


$database = new Connect("global","localhost","root","");
if((isset($GelenOnayDurumu)!="") && (isset($SilinecekKategoriID)!="")){
    if($GelenOnayDurumu == 1){
        $ItemKontrolleri = $database->db->prepare("SELECT * FROM global.item WHERE KategoriID = ? AND ServerID = ? ");
        $ItemKontrolleri->execute([$SilinecekKategoriID,$ServerID]);
        $ItemKontrolleriSayi = $ItemKontrolleri->rowCount();
        $ItemKontrolleriKayitlari = $ItemKontrolleri->fetchAll(PDO::FETCH_ASSOC);
        if($ItemKontrolleriSayi>0){
            foreach ($ItemKontrolleriKayitlari as $Kayitlar) {
                $KategoriyeAitItemlariSil = $database->db->prepare("DELETE FROM global.item WHERE KategoriID = ?");
                $KategoriyeAitItemlariSil->execute([$Kayitlar["KategoriID"]]);
                $KategoriyeAitItemlariSilSayi = $KategoriyeAitItemlariSil->rowCount();
                if($KategoriyeAitItemlariSilSayi>0){
                    echo json_encode("ITEM_VE_KATEGORILER_BASARIYLA_SILINDI");
                }
            }
            $KategoriyiSil = $database->db->prepare("DELETE FROM global.Kategoriler WHERE KategoriID = ?");
            $KategoriyiSil->execute([$SilinecekKategoriID]);
        }else{
            echo json_encode("BU_KATEGORIDE_ITEM_YOK");
        }
    }else{
        $KategoriyiSil = $database->db->prepare("DELETE FROM global.Kategoriler WHERE KategoriID = ?");
        $KategoriyiSil->execute([$SilinecekKategoriID]);
        $KategoriyiSilSayi = $KategoriyiSil->rowCount();
        if($KategoriyiSilSayi>0){
            echo json_encode("KATEGORI_SILINDI");
        }else{
            echo json_encode("KATEGORI_SILINEMEDI");
        }
    }

}else{
    echo json_encode("GELEN_BOS_PARAMETRE_HATASI");
}

