<?php
session_start();
require('controller/controller.php');

try{
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'home-page' :
                homePage();
            break;
            case 'sign-up' :
                signUp();
            break;
            case 'check-pseudo' :
                if (isset($_POST['pseudo'])) {
                    checkPseudo(htmlspecialchars($_POST['pseudo']));
                }
            break;
            case 'create-user' :
                if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])){
                    createUser(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['email']));
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'login' :
                login();
            break;
            case 'login-user' :
                if(isset($_POST['pseudo']) && isset($_POST['password'])){
                    loginUser(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'logout' :
                logout();
            break;
            case 'new-character' :
                newCharacter();
            break;
            case 'create-character' :
                if(isset($_SESSION['id']) && isset($_POST['race_id']) && isset($_POST['class_id']) && isset($_POST['character_name']) && isset($_POST['origin']) && isset($_POST['trait']) && isset($_POST['strength']) && isset($_POST['agility']) && isset($_POST['constitution']) && isset($_POST['stealth']) && isset($_POST['intelligence']) && isset($_POST['perception']) && isset($_POST['charisma']) && isset($_POST['intimidation'])){
                    createCharacter($_SESSION['id'], $_POST['race_id'], $_POST['class_id'], $_POST['character_name'], $_POST['origin'], $_POST['trait'], $_POST['strength'], $_POST['agility'], $_POST['constitution'], $_POST['stealth'], $_POST['intelligence'], $_POST['perception'], $_POST['charisma'], $_POST['intimidation']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'profile' :
                if(isset($_SESSION['id'])){
                    profile($_SESSION['id']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'character-sheet' :
                if(isset($_SESSION['id'])){
                    characterSheet($_GET['character-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }                
            break;
            case 'skills-list' :
                if(isset($_SESSION['id']) && isset($_GET['character-id']) && $_SESSION['id'] === $_GET['user-id']){
                    skillsList($_GET['class-id'], $_GET['character-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }               
            break;
            case 'add-skill' :
                if(isset($_GET['character-id']) && isset($_POST['skill'])){
                    $skillsId = $_POST['skill'];
                    addskill($_GET['character-id'], $skillsId);
                }else{
                    header('Location:index.php?action=error-404');
                }                               
            break;
            case 'clear-character' :
                if(isset($_SESSION['id']) && isset($_GET['character-id']) && $_SESSION['id'] === $_GET['user-id']){
                    clearCharacter($_GET['character-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'new-dungeon' :
                newDungeon();
            break;
            case 'create-dungeun' :
                if(isset($_SESSION['id']) && isset($_POST['title']) && isset($_POST['data'])){
                    createDungeun($_SESSION['id'], htmlspecialchars($_POST['title']), $_POST['data']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'dungeun-map' :
                if (isset($_SESSION['id']) && isset($_GET['dungeun-id'])) {
                    dungeunMap($_SESSION['id'], $_GET['dungeun-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'change-dungeun' :
                if (isset($_SESSION['id']) && isset($_GET['dungeun-id']) && $_GET['user-id'] === $_SESSION['id']) {
                    changeDungeun($_GET['dungeun-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'new-dungeun' :
                if (isset($_SESSION['id']) && isset($_GET['dungeun-id']) && isset($_POST['title']) && isset($_POST['data']) && $_GET['user-id'] === $_SESSION['id']) {
                    newDungeun($_GET['dungeun-id'], $_POST['title'], $_POST['data']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'delete-dungeun' :
                if (isset($_SESSION['id']) && isset($_GET['dungeun-id']) && $_SESSION['id'] === $_GET['user-id']) {
                    clearDungeun($_GET['dungeun-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'admin' :
                if (isset($_SESSION['id']) && $_SESSION['is_admin'] == 1) {
                    admin();
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            case 'delete-user' :
                if (isset($_GET['user-id'])) {
                    clearUser($_GET['user-id']);
                }else{
                    header('Location:index.php?action=error-404');
                }
            break;
            default :
                require('view/errorView.php');
        }
    }
    else{
        homePage();
    }
}

catch(Exception $e){
    $errorMessage = $e->getMessage();
    echo 'Erreur :' . $errorMessage . '\n';
}