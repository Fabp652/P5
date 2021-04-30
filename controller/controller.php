<?php
require_once('model/userManager.php');
require_once('model/classManager.php');
require_once('model/raceManager.php');
require_once('model/characterManager.php');
require_once('model/classSkillManager.php');
require_once('model/skillManager.php');
require_once('model/characterSkillManager.php');
require_once('model/dungeunManager.php');

function homePage(){
    require('view/homePageView.php');
}

function signUp(){
    require('view/signUpView.php');
}

function checkPseudo($pseudo)
{
    $userManager = new UserManager;
    $getPseudo = $userManager->getPseudo($pseudo);
    if ($getPseudo == $pseudo && $getPseudo != null) {
        echo 1;
    }else{
        echo 0;
    }
    exit;
}

function createUser($pseudo, $password, $email){
    if(preg_match('#[a-zA-Z0-9.-_]{4,}#', $pseudo) && preg_match('#[a-zA-Z0-9.-_]{4,}#', $password) && preg_match('#^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-_]{2,}\.[a-z]{2,4}$#', $email)){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $userManager = new UserManager;
        $createUser = $userManager->insertUser($pseudo, $passwordHash, $email);
        if($createUser == false){
            header('Location:index.php?action=sign-up');
        }else{
            header('Location:index.php?action=login');
        }
    }
}

function login(){
    require('view/loginView.php');
}

function loginUser($pseudo, $password){
    if(preg_match('#[a-zA-Z0-9.-_]{4,}#', $pseudo) && preg_match('#[a-zA-Z0-9.-_]{4,}#', $password)){
        $getPseudo = $pseudo;
        $userManager = new UserManager;
        $user = $userManager->getUser($getPseudo);
        if($getPseudo == $user['pseudo']){
            $goodPassword = password_verify($password, $user['pass']);
            if($goodPassword == true){
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['password'] = $user['pass'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header('Location:index.php?action=home-page');
            }else{
                header('Location:index.php?action=login');
            }
        }else{
            header('Location:index.php?action=login');
        }
    }else{
        header('Location:index.php?action=login');
    }
}

function logout(){
    session_unset();
    header('Location:index.php?action=home-page');
}

function newCharacter(){
    $classManager = new ClassManager;
    $raceManager = new RaceManager;    
    $getClasses = $classManager->getClasses();
    $getRaces = $raceManager->getRaces();
    require('view/newCharacterView.php');
}

function createCharacter($userId, $raceId, $classId, $characterName, $origin, $trait, $strength, $agility, $constitution, $stealth, $intelligence, $perception, $charisma, $intimidation){
    $characterManager = new CharacterManager;
    $createCharacter = $characterManager->insertCharacter($userId, $raceId, $characterName, $classId, $origin, $trait, $strength, $agility, $constitution, $stealth, $intelligence, $perception, $charisma, $intimidation);
    if($createCharacter == true){
        header('Location:index.php?action=profile');
    }
    else{
        header('Location:index.php?action=new-character');
    }
}

function profile($userId){
    $characterManager = new CharacterManager;
    $dungeunManager = new DungeunManager;
    $getCharacters = $characterManager->getCharacters($userId);
    $getDungeuns = $dungeunManager->getDungeuns();
    require('view/profileView.php');
}

function characterSheet($characterId){
    $characterManager = new CharacterManager;
    $characterSkillManager = new CharacterSkillManager;
    $character = $characterManager->getCharacter($characterId);
    $characterSkill = $characterSkillManager->getCharacterSkill($characterId);
    if($_SESSION['id'] === $character['user_id']){
        require('view/characterSheetView.php');
    }else{
        header('Location:index.php?action=error-404');
    }
}

function raceName($raceId){
    $raceManager = new RaceManager;
    $race = $raceManager->getRace($raceId);
    return $race;
}

function className($classId){
    $classManager = new ClassManager;
    $class = $classManager->getClass($classId);
    return $class;
}

function skillsList($classId, $characterId){
    $classSkillManager = new ClassSkillManager;
    $characterSkillManager = new CharacterSkillManager;
    $skillsIdByClass = $classSkillManager->getSkillsId($classId);
    $skillsIdByCharacter = $characterSkillManager->getCharacterSkill($characterId);
    require('view/skillsListView.php');
}

function skill($skillId){
    $skillManager = new SkillManager;
    $skill = $skillManager->getSkill($skillId);
    return $skill;
}

function addSkill($characterId, $skillsId){
    $characterSkillManager = new CharacterSkillManager;
    $clearCharacterSkill = $characterSkillManager->deleteCharacterSKills($characterId);
    if($clearCharacterSkill == true){
        foreach($skillsId as $skillId){
            $addSkill = $characterSkillManager->insertCharacterSkill($characterId, $skillId);
            if($addSkill == true){
                header('Location:index.php?action=profile');
            }else{
                header('Location:index.php?action=error-404');
            }
        }
    }
}

function clearCharacter($characterId){
    $characterManager = new CharacterManager;
    $clearCharacter = $characterManager->deleteCharacter($characterId);
    if($clearCharacter == true){
        header('Location:index.php?action=profile');
    }else{
        header('Location:index.php?action=error-404');
    }
}

function newDungeon(){
    require('view/newDungeonView.php');
}

function createDungeun($userId, $title, $map){
    if(preg_match('#[a-zA-Z0-9.-_]#', $title)){
        $dungeunManager = new DungeunManager;
        $createDungeun = $dungeunManager->InsertDungeun($userId, $title, $map);
        if ($createDungeun == true) {
            header('Location:index.php?action=profile');
        }else{
            header('Location:index.php?action=error-404');
        }
    }else{
        header('Location:index.php?action=error-404');
    }    
}

function dungeunMap($userId, $dungeunId){
    $dungeunManager = new DungeunManager;
    $getDungeun = $dungeunManager->getDungeun($dungeunId);
    if ($userId == $getDungeun['user_id']) {
        require('view/dungeunMapView.php');
    }else{
        header('Location:index.php?action=error-404');
    }
}

function changeDungeun($dungeunId){
    $dungeunManager = new DungeunManager;
    $getDungeun = $dungeunManager->getDungeun($dungeunId);
    require('view/updateDungeunView.php');
}

function newDungeun($dungeunId, $title, $map){
    $dungeunManager = new DungeunManager;
    $newDungeun = $dungeunManager->updateDungeun($dungeunId, $title, $map);
    if ($newDungeun == true) {
        header('Location:index.php?action=profile');
    }else{
        header('Location:index.php?action=error-404');
    }
}

function clearDungeun($dungeunId){
    $dungeunManager = new DungeunManager;
    $clearDungeun = $dungeunManager->deleteDungeun($dungeunId);
    if ($clearDungeun == true) {
        header('Location:index.php?action=profile');
    }else{
        header('Location:index.php?action=error-404');
    }    
}

function admin(){
    $userManager = new UserManager;
    $getUsers = $userManager->getUsers();
    require('view/adminView.php');    
}

function clearUser($userId)
{
    $userManager = new UserManager;
    $deleteUser = $userManager->deleteUser($userId);
    if ($deleteUser == true) {
        header('Location:index.php?action=admin');
    }else{
        header('Location:index.php?action=error-404');
    }
}