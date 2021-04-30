<?php
require_once('model/manager.php');

class DungeunManager extends Manager {
    public function InsertDungeun($userId, $title, $map)
    {
        $req = $this->db->prepare('INSERT INTO dungeuns(user_id, title, map) VALUE(:user_id, :title, :map)');
        $insertDungeun = $req->execute(array(
            ':user_id' => $userId,
            ':title' => $title,
            ':map' => $map
        ));
        return $insertDungeun;
    }
    public function getDungeuns()
    {
        $req = $this->db->query('SELECT id, title FROM dungeuns');
        return $req;
    }
    
    public function getDungeun($dungeunId)
    {
        $req = $this->db->prepare('SELECT * FROM dungeuns WHERE id = ?');
        $req->execute([$dungeunId]);
        $getDungeun = $req->fetch();
        return $getDungeun;
    }
    public function updateDungeun($dungeunId, $title, $map)
    {
        $req = $this->db->prepare('UPDATE dungeuns SET title = :title, map = :map WHERE id = :id');
        $updateDungeun = $req->execute(array(
            ':id' => $dungeunId,
            ':title' => $title,
            ':map' => $map
        ));
        return $updateDungeun;
    }

    public function deleteDungeun($dungeunId)
    {
        $req = $this->db->prepare('DELETE FROM dungeuns WHERE id = ?');
        $deleteDungeun = $req->execute([$dungeunId]);
        return $deleteDungeun;
    }
}