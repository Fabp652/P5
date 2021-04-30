<?php
require_once('model/manager.php');

class CharacterManager extends Manager{
    public function insertCharacter($userId, $raceId, $characterName, $classId, $origin, $trait, $strength, $agility, $constitution, $stealth, $intelligence, $perception, $charisma, $intimidation){
        $req = $this->db->prepare('INSERT INTO characters(user_id, race_id, character_name, class_id, character_level, origin, trait, life_point, armor, strength, agility, constitution, stealth, intelligence, perception, charisma, intimidation) VALUES(:user_id, :race_id, :character_name, :class_id, :character_level, :origin, :trait, :life_point, :armor, :strength, :agility, :constitution, :stealth, :intelligence, :perception, :charisma, :intimidation)');
        $insertCharacter = $req->execute(array(
            ':user_id' => $userId,
            ':race_id' => $raceId,
            ':character_name' => $characterName,
            ':class_id'=> $classId,
            ':character_level'=> 1, 
            ':origin' => $origin, 
            ':trait' => $trait, 
            ':life_point' => 10, 
            ':armor' => 10, 
            ':strength' => $strength, 
            ':agility' => $agility, 
            ':constitution' => $constitution, 
            ':stealth' => $stealth, 
            ':intelligence' => $intelligence, 
            ':perception' => $perception, 
            ':charisma' => $charisma, 
            ':intimidation' => $intimidation, 
        ));
        return $insertCharacter;
    }

    public function getCharacters($userId){
        $req = $this->db->prepare('SELECT * FROM characters WHERE user_id = ?');
        $req->execute([$userId]);
        return $req;
    }

    public function getCharacter($characterId){
        $req = $this->db->prepare('SELECT * FROM characters WHERE id = ?');
        $req->execute([$characterId]);
        $character = $req->fetch();
        return $character;
    }

    public function deleteCharacter($characterId){
        $req = $this->db->prepare('DELETE FROM characters WHERE id = ?');
        $delete = $req->execute([$characterId]);
        return $delete;
    }
}