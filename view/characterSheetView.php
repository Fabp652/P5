<?php
$title = $character['character_name'];

ob_start();
?>
<h1 class="text-center text-3xl md:text-5xl text-white my-12">Fiche de personnage</h1>
<div class="parchment md:w-96 mx-auto mt-12 pb-2">
    <div class="flex justify-around border-b-2 border-black py-2">
        <p><?= $character['character_name'] ?></p>
        <p><?= className($character['class_id']) ?> de niveau <?= $character['character_level'] ?></p>
        <p><?= raceName($character['race_id']); ?></p>
    </div>
    <div class="flex justify-around py-2 border-b-2 border-black">
        <p class="mr-3"><?= $character['life_point'] ?> point de vie</p>
        <p><?= $character['armor'] ?> d'armure</p>
    </div>
    <div class="flex border-b-2 border-black">
        <div class="w-1/2 md:w-40 border-r-2 border-black pb-2">
            <h2 class="text-center border-b-2 border-black">Caractéristiques</h2>
            <ul class="px-4">
                <li class="flex justify-between"><p>Force :</p> <p><?= $character['strength'] ?></p></li>
                <li class="flex justify-between"><p>Agilité :</p> <p><?= $character['agility'] ?></p></li>
                <li class="flex justify-between"><p>Constitution :</p> <p><?= $character['constitution'] ?></p></li>
                <li class="flex justify-between"><p>Discrétion :</p> <p><?= $character['stealth'] ?></p></li>
                <li class="flex justify-between"><p>Intelligence :</p> <p><?= $character['intelligence'] ?></p></li>
                <li class="flex justify-between"><p>Perception :</p> <p><?= $character['perception'] ?></p></li>
                <li class="flex justify-between"><p>Charisme :</p> <p><?= $character['charisma'] ?></p></li>
                <li class="flex justify-between"><p>Intimidation :</p> <p><?= $character['intimidation'] ?></p></li>
            </ul>
        </div>
        <div class="w-1/2 md:w-56">
            <h2 class="border-b-2 border-black text-center">Compétences </h2>
            <ul class="ml-3">
                <?php
                    while($skillId = $characterSkill->fetch()){
                ?>        
                    <li><?= skill($skillId['skill_id']) ?></li>        
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    <h2 class="ml-2">Histoire du personnage :</h2>
    <p class="my-2 mx-4 p-1 border border-black"><?= $character['origin'] ?></p>
    <h2 class="ml-2">Trait de personnalité :</h2>
    <p class="my-2 mx-4 p-1 border border-black"><?= $character['trait'] ?></p>  
</div>
<div class="mt-4">
    <a href="index.php?action=skills-list&amp;character-id=<?= $character['id'] ?>&amp;class-id=<?= $character['class_id'] ?>&amp;user-id=<?= $character['user_id'] ?>" class="py-2 px-5 text-white rounded-full btn cursor-pointer">Ajoutez une compétences</a>
    <a href="index.php?action=clear-character&amp;character-id=<?= $character['id'] ?>&amp;user-id=<?= $character['user_id'] ?>" class="py-2 px-5 text-white rounded-full btn cursor-pointer">Supprimer le personnage</a>
</div>
<?php
$content = ob_get_clean();

require('view/template.php');