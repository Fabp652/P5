<?php
$title = 'Liste de compétence';

ob_start();
?>
    <h1 class="text-center text-3xl md:text-5xl text-white my-12">Choix des compétences</h1>
    <form action="index.php?action=add-skill&amp;character-id=<?= $_GET['character-id'] ?>" method="POST" class="parchment w-96 m-auto p-4 shadow-lg flex flex-col">
        <div class="flex justify-around items-center my-2 ">
            <label for="currentSkill">Choisissez une compétence :</label>
            <select name="currentSkill" id="currentSkill" class="p-0.5">
            <?php
            while($skillId = $skillsIdByClass->fetch()){
            ?>
                <option value="<?= $skillId['skill_id'] ?>"><?= skill($skillId['skill_id']) ?></option>
            <?php
            }
            ?>
            </select>
            <button type="button" id="addSkill" class="py-2 px-5 text-white rounded-full btn cursor-pointer">Ajouter</button>
        </div>
        <div class="flex flex-col items-start">
            <p>Compétences sélectionnées :</p>
            <ul id="skillsList" class="border border-black my-2 p-1 self-center w-60">
                <?php
                    while($characterSkill = $skillsIdByCharacter->fetch()){
                        ?>
                        <li><span><?= skill($characterSkill['skill_id']) ?></span><input type="hidden" name="skill[<?= $characterSkill['id'] ?>]" value="<?= $characterSkill['skill_id'] ?>" /></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <input type="submit" value="Valider" class="py-2 px-5 my-2 text-white rounded-full btn cursor-pointer transform transition duration-500 ease-in-out hover:scale-105 self-center" />
    </form>
    <script>
        const btn = document.getElementById('addSkill')
        const currentSkill = document.getElementById('currentSkill')
        const skillsList = document.getElementById('skillsList')
        let index = skillsList.childElementCount
        btn.addEventListener('click', () => {
            const text = currentSkill.options[currentSkill.selectedIndex].innerText;
            const li = document.createElement('li');
            li.innerHTML = '<span>' + text + '</span> <input type="hidden" name="skill[' + ++index + ']" value="'+ currentSkill.value +'" />'
            skillsList.appendChild(li);
        })
    </script>
<?php
$content = ob_get_clean();

require('view/template.php');