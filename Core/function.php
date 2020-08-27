<?php
    function JsonEncode($JsonParametre){
        return json_encode($JsonParametre);
    }
    function json($parametre){
        return json_encode($parametre);
    }
    function HATALI_KULLANICI_BILGISI($TIP=["HATALI_KULLANICI_BILGISI"]){
        return JsonEncode($TIP);
    }
    function BASARILI_KULLANICI_GIRISI($TIP=["BASARILI_KULLANICI_GIRISI"]){
        return JsonEncode($TIP);
    }
    function BILINMEYEN_HATA($TIP=["BILINMEYEN_HATA"]){
        return JsonEncode($TIP);
    }
    function  KAYIT_BASARILI($TIP=["KAYIT_BASARILI"]){
        return JsonEncode($TIP);
    }
    function  KAYIT_BASARISIZ($TIP=["KAYIT_BASARISIZ"]){
        return JsonEncode($TIP);
    }
    function  UYUSMAYAN_SIFRE($TIP=["UYUSMAYAN_SIFRE"]){
        return JsonEncode($TIP);
    }
    function  PARAMETRE_HATASI($TIP=["PARAMETRE_HATASI"]){
        return JsonEncode($TIP);
    }
    function  BENZER_KULLANICI_BILGILERI_MEVCUT($TIP=["BENZER_KULLANICI_BILGILERI_MEVCUT"]){
        return JsonEncode($TIP);
    }
    function KuponKoduOlustur(){
        $bir = substr(sha1(mt_rand()),17,6);
        $iki = substr(sha1(mt_rand()),17,6);
        $uc =substr(sha1(mt_rand()),17,6);
        $dort = substr(sha1(mt_rand()),17,6);
        $bes = substr(sha1(mt_rand()),17,6);
        $toplam =$bir."-".$iki."-".$uc."-".$dort."-".$bes;
        return $toplam;
    }

    function ex(){
        exit();
        die();
    }


    function unix_time_convert($week = 0,$day = 0,$hour = 0,$minute = 0,$second = 0,$before_time = 'now'){
    $fields_string = '';
    $fields = array(
        'time' => $before_time,
        'week' => $week,
        'minute' => $minute,
        'day' => $day,
        'hour' => $hour,
        'second' => $second,
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.onlinepvpservers.com/tr/api/unixtime');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    $komut = json_decode($result,true);

    if(@$komut['return'] == 'ok'){
        return $komut['time'];
    }else{
      return $komut['error'];
    }
}


    //lisans alani doğru çalışmıyor geldiğimde insallah bakılacak.


?>