<?php
$title = "Espace d'administration";

ob_start();
?>
    <h1 class="text-3xl md:text-5xl text-center text-white mt-12 mb-4">Votre Espace d'administration</h1>
    <section class="parchment md:w-2/3 lg:w-1/2 mx-auto mt-20 p-2">
        <h2 class="text-3xl ml-8 mb-2">Liste des utilisateurs</h2>
        <ul>
            <?php
                while($users = $getUsers->fetch()){
            ?>
                <li class="flex justify-around my-2"><p><?= $users['pseudo'] ?> inscrit depuis le <?= $users['signup_date_fr'] ?></p><a href='index.php?action=delete-user&amp;user-id=<?= $users['id'] ?>' class="self-center py-2 px-5 text-white font-semibold rounded-full btn cursor-pointer transform transition duration-500 ease-in-out hover:scale-105" >Supprimer</a></li>
            <?php
                }
            ?>
        </ul>
    </section>
<?php
$content = ob_get_clean();

require('view/template.php');