<?php
class Connect{
    public $db;
    public $user;
    public $userpass;
    public $IPHost;
    public $DatabaseName;
    public function __construct($DatabaseName,$IPHost,$user,$userpass)
    {
        try{
           $this->db=$baglanti = new PDO("mysql:dbname=".$DatabaseName.";host=".$IPHost.";charset=utf8",$user,$userpass);
        }catch (PDOException $hatalar){
            echo "Bir hata meydana geldi $hatalar";
            exit("Server Exited.");
        }
    }
}




