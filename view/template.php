<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="public/css/tailwind.css" rel="stylesheet" />
        <link href="public/css/style.css" rel="stylesheet" />
        <title><?=$title?></title>
    </head>
    <body>    
        <nav class="content-nav parchment md:h-16 sticky top-0 flex justify-between border-b border-black">
            <img src="public/images/logo.png" alt="logo Roleplay" class="logo ml-5 my-2">
            <ul class="flex justify-end flex-wrap h-full items-center">
                <li><a href="index.php?action=home-page" class="p-4 link-hover">Accueil</a></li>
                <?php if (isset($_SESSION['pseudo'])){
                ?>
                <li><a href="index.php?action=new-character" class="p-4 link-hover">Créer un personnage</a></li>
                <li><a href="index.php?action=new-dungeon" class="p-4 link-hover">Créer un donjon</a></li>
                <li><a href="index.php?action=profile" class="p-4 link-hover">Espace membre</a></li>
                <?php
                    if ($_SESSION['is_admin'] == 1) {
                ?>
                        <li><a href="index.php?action=admin" class="p-4 link-hover">Espace d'administration</a></li>
                <?php
                    }
                ?>
                <li><a href="index.php?action=logout" class="p-4 link-hover">Déconnexion</a></li>
                <?php
                }else{
                ?>
                <li><a href="index.php?action=sign-up" class="p-4 link-hover">Inscription</a></li>
                <li><a href="index.php?action=login" class="p-4 link-hover">Connexion</a></li>
                <?php
                }
                ?>                
            </ul>
        </nav>
        <?=$content?>
    </body>
</html>