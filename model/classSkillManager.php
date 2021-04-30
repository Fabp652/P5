<?php
require_once('model/manager.php');

class ClassSkillManager extends Manager{
    public function getSkillsId($classId){
        $req = $this->db->prepare('SELECT skill_id FROM classes_skills WHERE class_id = ?');
        $req->execute(array($classId));
        return $req;
    }
}