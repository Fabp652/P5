<?php
$title = 'RolePlay';

ob_start();
?>
<h1 class="text-center text-3xl md:text-5xl text-white my-12">RolePlay</h1>
<div class="parchment md:w-1/2 mx-auto mt-20 px-1 py-3">    
    <p class="text-center text-lg md:text-2xl lg:text-5xl mb-12">Bienvenue sur le site RolePlay</p>
    <p class="m-auto md:text-lg w-5/6 pb-3">
        Bonjour et bienvenue sur RolePlay, sur ce site vous pourrez créer des fiches de personnages, mais aussi des cartes de donjons pour vos futurs aventures que vous soyez un joueur ou maitre du jeu.
        Pour commencé veuillez vous connecter ou créer un compte, si vous n'êtes pas inscrit, pour pouvoir créer votre personnage ou votre donjon.
    </p>
</div>
<?php
$content = ob_get_clean();

require('view/template.php');