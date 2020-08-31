<?php 
class Connect extends PDO{
    public function __construct(){
        // https://www.youtube.com/watch?v=yCmnMxKaVCE
        // USE PARENT::CONSTRUCT() to exploit POLYMORPHISM POWERS
        parent::__construct("mysql:host=localhost;dbname=pdo_auth", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}


?>