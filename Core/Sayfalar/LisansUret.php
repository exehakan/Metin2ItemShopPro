<?php
$ServerID = 1;
$BelirtilenSure = 30;
$globaldb = new Connect("global","localhost","root","");
$RastgeleKupon = KuponKoduOlustur();

if($BelirtilenSure == 30){
    $Sure = 30;//1ay
}else if($BelirtilenSure == 60){
    $Sure = 60;//2ay
}else if($BelirtilenSure == 90){
    $Sure = 90;//3ay
}else if($BelirtilenSure == 120){
    $Sure = 120;//4ay
}else if($BelirtilenSure == 150){
    $Sure = 150;//5ay
}

$LisansUret = $globaldb->db->prepare("SELECT * FROM global.lisanskuponlari WHERE LisansKodu = ?");
$LisansUret->execute([$RastgeleKupon]);
$LisansUretSayi = $LisansUret->rowCount();
if($LisansUretSayi<1){
    $Uret = $globaldb->db->prepare("INSERT INTO global.lisanskuponlari(LisansKodu, LisansKoduAktifligi, LisansKoduKullananServerID,Suresi) values(?,?,?,?)");
    $Uret->execute([$RastgeleKupon,0,$ServerID,$Sure]);
    $UretimSayisi = $Uret->rowCount();
    if($UretimSayisi>0){
        echo json_encode("LISANS_OLUSTURULDU");
    }
}else{
    echo json_encode("BU_KUPON_DAHA_ONCE_KULLANILDI");
}