<?php
$title = 'Création de personnage';

ob_start();
?>
<h1 class="text-center text-3xl md:text-5xl text-white my-12">Création de personnage</h1>

<form action="index.php?action=create-character" method="POST" class="parchment relative md:w-2/3 lg:w-1/2 m-auto p-4 shadow-lg flex flex-col">
  <div>
    <fieldset>
      <legend class="text-xl font-bold">La race :</legend>
      <ul class="flex flex-wrap w-4/5 m-auto mb-4 font-semibold">
      <?php
        while($race = $getRaces->fetch()){
      ?>
      <li class="m-3">
        <label><?= $race['race_name'] ?>
          <input type="radio" name="race_id" value="<?= $race['id']?>" />
        </label>
      </li>
      <?php
        }
      ?>
      </ul>
    </fieldset>
  </div>
  <div>
    <fieldset>
      <legend class="text-xl font-bold">La classe :</legend>
      <ul class="flex flex-wrap w-4/5 m-auto mb-2 font-semibold">
        <?php
          while($class = $getClasses->fetch()){
        ?>
        <li class="m-3">
          <label><?= $class['class_name'] ?>
            <input type="radio" name="class_id" value="<?= $class['id'] ?>" />
          </label>
        </li>
        <?php
          }
        ?>
      </ul>
    </fieldset>
  </div>
  <label class="my-2 text-xl font-bold">
    Le nom du personnage : <input type="text" name="character_name" class=" ml-4" required />    
  </label>
  <label for="origin" class="flex flex-col my-2 text-xl font-bold">Origine du personnage :</label>
  <textarea name="origin" id="origin" class=" self-end w-3/5 h-28 p-1 mr-3" required></textarea>
  <label for="trait" class="flex flex-col text-xl font-bold">Trait de personnalité :</label>
  <textarea name="trait" id="trait" class=" self-end w-1/2 h-28 p-1 mr-20" required></textarea>    
  <div>
    <p class="my-2 text-xl font-bold">Caractéristique :</p>
    <div class="h-52 flex flex-col flex-wrap font-semibold">
      <label class="my-2 mx-3 flex justify-between items-center">
        Force : <input type="number" name="strength" class="border border-black w-12 p-1" required />    
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Agilité : <input type="number" name="agility" class="border border-black w-12 p-1" required />    
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Constitution : <input type="number" name="constitution" class="border border-black w-12 p-1" required />    
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Discrétion : <input type="number" name="stealth" class="border border-black w-12 p-1" required />    
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Intelligence : <input type="number" name="intelligence" class="border border-black w-12 p-1" required />    
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Perception : <input type="number" name="perception" class="border border-black w-12 p-1" required />
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Charisme : <input type="number" name="charisma" class="border border-black w-12 p-1" required />
      </label>
      <label class="my-2 mx-3 flex justify-between items-center">
        Intimidation : <input type="number" name="intimidation" class="border border-black w-12 p-1" required />
      </label>
    </div>
  </div>    
  <input type="submit" value="Créer" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer transform transition duration-500 ease-in-out hover:scale-105 self-end" />
</form>
<?php
$content = ob_get_clean();

require('view/template.php');