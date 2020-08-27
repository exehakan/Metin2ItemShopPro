<?php

function Decrypt($GelenSifre,$ServerID=null){

    if($ServerID != null){
        /*
         * Server Id değerini bu alana gelir ve bu alanda belirtilen algoritma sayisi kadar çözümleme yapar.
         *
         * */
        $GelenServerID = $ServerID;

        $db = new Connect("global","localhost","root","");

        $ServerAlgo = $db->db->prepare("SELECT * FROM serverayar WHERE id = ? LIMIT 1");
        $ServerAlgo->execute([$GelenServerID]);
        $ServerAlgoKayitlar = $ServerAlgo->fetch(PDO::FETCH_ASSOC);
        $ServerAlgoSayi = $ServerAlgo->rowCount();
        if($ServerAlgoSayi>0){
            $AlgoSayisi = $ServerAlgoKayitlar["Alg"];
            $sifre = $GelenSifre;
            $sonuc1 =  substr($sifre,0,10);
            $sonuc2 = substr($sifre,11,strlen($sifre));
            $birlesim = $sonuc1.$sonuc2;
            $sonuc3 = substr($birlesim,0,79);
            $sonuc4 = substr($birlesim,80,strlen($birlesim));
            $toplam = $sonuc3.$sonuc4;

            $sonuc = "";
            $basamak = 0;

            for($key = 0 ; $key<$AlgoSayisi;$key++){
                if($basamak == 0){
                    $sonuc = base64_decode($toplam);
                    $basamak = 1;
                }else{
                    $sonuc = base64_decode($sonuc);
                }
            }

            return $sonuc;
        }


    }else{
        $sifre = $GelenSifre;
        $sonuc1 =  substr($sifre,0,10);
        $sonuc2 = substr($sifre,11,strlen($sifre));
        $birlesim = $sonuc1.$sonuc2;
        $sonuc3 = substr($birlesim,0,79);
        $sonuc4 = substr($birlesim,80,strlen($birlesim));
        $toplam = $sonuc3.$sonuc4;

        $sonuc = "";
        $basamak = 0;

        for($key = 0 ; $key<33;$key++){
            if($basamak == 0){
                $sonuc = base64_decode($toplam);
                $basamak = 1;
            }else{
                $sonuc = base64_decode($sonuc);
            }
        }

        return $sonuc;
    }

}