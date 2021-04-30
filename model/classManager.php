<?php
require_once('model/manager.php');

class ClassManager extends Manager{
    public function getClasses(){
        $req = $this->db->query('SELECT * FROM classes');
        return $req;
    }

    public function getClass($classId){
        $req = $this->db->prepare('SELECT class_name FROM classes WHERE id = ?');
        $req->execute([$classId]);
        $class = $req->fetch();
        return $class['class_name'];
    }
}