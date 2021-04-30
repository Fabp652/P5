<?php
require_once('model/manager.php');

class CharacterSkillManager extends Manager{
    public function insertCharacterSkill($characterId, $skillId){
        $req = $this->db->prepare('INSERT INTO characters_skills(character_id, skill_id) VALUE(:character_id, :skill_id)');
        $insert = $req->execute(array(
            ':character_id' => $characterId,
            ':skill_id' => $skillId
        ));
        return $insert;
    }

    public function getCharacterSkill($characterId){
        $req = $this->db->prepare('SELECT * FROM characters_skills WHERE character_id = ?');
        $req->execute([$characterId]);
        return $req;
    }

    public function deleteCharacterSKills($characterId){
        $req = $this->db->prepare('DELETE FROM characters_skills WHERE character_id = ?');
        $delete = $req->execute([$characterId]);
        return $delete;
    }
}