<?php

class Manager {
    protected $db;
    public function __construct()
    {
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=roleplay;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;
        }
        catch(Exception $errorConnection){
            die('Erreur de connexion :' .$errorConnection->getMessage());
        }
    }
}