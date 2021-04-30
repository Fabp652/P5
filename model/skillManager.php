<?php
require_once('model/manager.php');

class SkillManager extends Manager{
    public function getSkill($skillId){
        $req = $this->db->prepare('SELECT skill_name FROM skills WHERE id = ?');
        $req->execute([$skillId]);
        $skill = $req->fetch();
        return $skill['skill_name'];
    }
}