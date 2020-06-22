<?php

require_once 'config.php';

class DB{
    
    public $con;

    public function __construct(){
        try{
            $this->con = new PDO("mysql:host=localhost;dbname=". DBNAME, DBUSER, DBPASS);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'connected';
            return $this->con;

        } catch(PDOException $e){
            // echo $e->getMessage();
            return null;
        }
    }
}