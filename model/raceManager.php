<?php
require_once('model/manager.php');

class RaceManager extends Manager{
    public function getRaces(){
        $req = $this->db->query('SELECT * FROM races');
        return $req;
    }

    public function getRace($raceId){
        $req = $this->db->prepare('SELECT race_name FROM races WHERE id = ?');
        $req->execute([$raceId]);
        $race = $req->fetch();
        return $race['race_name'];
    }
}