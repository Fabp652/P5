<?php
    $title = 'Connexion';

    ob_start();
?>
<h1 class="text-center text-3xl md:text-5xl text-white my-12">Connexion</h1>
<div class="parchment md:w-2/3 lg:w-1/2 mx-auto mt-20">
    <form action="index.php?action=login-user" method="POST" class="flex flex-col items-start m-auto p-3">
        <label class="py-2 px-10 w-full flex justify-between">Votre pseudo :<input type="text" name="pseudo" class="p-1" required /></label>
        <label class="py-2 px-10 w-full flex justify-between">Votre mot de passe :<input type="password" name="password" class="p-1" required /></label>
        <input type="submit" name="connection" value="Se connecter" class="self-center py-2 px-5 text-white rounded-full btn cursor-pointer transform transition duration-500 ease-in-out hover:scale-105" />
    </form>
</div>

<?php

$content = ob_get_clean();
require('view/template.php');