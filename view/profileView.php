<?php
$title = 'Profil';

ob_start();
?>
    <h1 class="text-3xl md:text-5xl text-center text-white mt-12 mb-4">Votre Espace membre</h1>
    <p class="text-center md:text-lg text-white mb-5">Bienvenue sur votre espace membre retrouvez ci-dessous vos personnages et donjon créés</p>
    <div class="parchment md:w-2/3 lg:w-1/2 mx-auto mt-20">
        <h2 class="text-3xl ml-8 mb-2">Vos personnage :</h2>
        <ul class="ml-20">
            <?php 
                while($characters = $getCharacters->fetch()){
            ?>
                <li><a href="index.php?action=character-sheet&amp;character-id=<?= $characters['id'] ?>" class="link-hover"><?= $characters['character_name'] ?></a></li>
            <?php
                }
            ?>
        </ul>
    </div>
    <div class="parchment md:w-2/3 lg:w-1/2 mx-auto mt-20">
        <h2 class="text-3xl ml-8 mt-10 mb-2">Vos carte de donjon :</h2>
        <ul class="ml-20">
            <?php 
                while($dungeuns = $getDungeuns->fetch()){
            ?>
                <li><a href="index.php?action=dungeun-map&amp;dungeun-id=<?= $dungeuns['id'] ?>" class="link-hover"><?= $dungeuns['title'] ?></a></li>
            <?php
                }
            ?>
        </ul> 
    </div>  
<?php

$content = ob_get_clean();
require('view/template.php');