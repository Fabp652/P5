<?php
require_once('model/manager.php');

class UserManager extends Manager{
    public function insertUser($pseudo, $password, $email){
        $req = $this->db->prepare('INSERT INTO users(pseudo, pass, email, is_admin, signup_date) VALUES(:pseudo, :pass, :email, :is_admin, NOW())');
        $insertUser = $req->execute(array(
            ':pseudo' => $pseudo,
            ':pass' => $password,
            ':email' => $email,
            ':is_admin' => 0
        ));
        return $insertUser;
    }

    public function getUser($pseudo){
        $req = $this->db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $user = $req->fetch();
        return $user;
    }
    public function getPseudo($pseudo)
    {
        $req = $this->db->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $getPseudo = $req->fetch();
        return $getPseudo['pseudo'];
    }

    public function getUsers()
    {
        $req = $this->db->query('SELECT id, pseudo, DATE_FORMAT(signup_date, \'%d/%m/%Y à %Hh%imin\') AS signup_date_fr FROM users WHERE is_admin = 0');
        return $req;
    }

    public function deleteUser($userId)
    {
        $req = $this->db->prepare('DELETE FROM users WHERE id = ?');
        $deleteUser = $req->execute([$userId]);
        return $deleteUser;
    }
}