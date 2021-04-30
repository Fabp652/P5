<?php
$title = 'Création de donjon';

ob_start();
?>
    <h1 class="text-center text-3xl md:text-5xl text-white my-12">Création du donjon</h1>
    <div id="create_dungeun" class="parchment">
        <form action="index.php?action=create-dungeun" method="POST" ref="form" class="my-2 pt-2">
            <label class="flex justify-center my-4">
                Nom du donjon : <input type="text" name="title" ref="title" class="ml-4 p-1" required>
            </label>            
            <input type="hidden" name="data" id="data" ref="data">
        </form>
        <div class="flex justify-around flex-wrap">
            <div class="allTable relative my-2 overflow-auto">
                    <table class="z-0 absolute top-0 left-0" :class="{'border-collapse':grid==false}">
                        <tbody>
                            <tr v-for="floorLine,y in floorMap" class="flex">
                                <td v-for="col,x in floorLine" class="p-0" :class="{'border border-black':grid}"  @click="click(x,y)"><img :src="floorTiles[floorMap[y][x]].floor" alt=""></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="z-1 absolute top-0 left-0" :class="{'border-collapse':grid==false}">
                        <tbody>
                            <tr v-for="wallLine,y in wallMap" class="flex">
                                <td v-for="col,x in wallLine" class="p-0" :class="{'border border-black':grid}" @click="click(x,y)"><img :src="wallTiles[wallMap[y][x]].wall" alt=""></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="flex flex-col justify-center">
                    <div class="border border-black my-2 selected self-center">
                        <img v-if="floor==true" :src="floorTiles[currentTile].floor" class="block" alt="">
                        <img v-if="wall==true" :src="wallTiles[currentTile].wall" class="block" alt="">
                    </div>
                    <div>
                        <button @click="showWallTiles" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer">Murs</button>
                        <button @click="showFloorTiles" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer">Sols</button> 
                    </div>
                    <button @click="toggleGrid" class="my-2 py-2 px-5 text-white rounded-full btn">grid :{{grid?"on":"off"}}</button>
                    <div class="my-2 flex flex-col">
                        <label class="my-2">
                            ligne : <input type="number" value="10" name="ligne" ref="ligne" class="border border-black w-11">
                        </label>
                        <label class="my-2">
                            colonne : <input type="number" value="10" name="col" ref="col" class="border border-black w-11">
                        </label>
                        <button @click="changeGrid" class="my-2 py-2 px-5 text-white rounded-full btn">Modifier la grille</button>
                    </div>  
                    <button @click="save" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer transform transition duration-500 ease-in-out hover:scale-105">sauvegarder</button>
            </div>
            <div class="w-80 self-center">  
                <ul class="flex justify-center flex-wrap" :class="{'block':showWalls, 'hidden':showWalls==false}">
                    <li v-for="wallTile, index in wallTiles" class="m-2 border border-black"><img :src="wallTile.wall" @click="selectWallTile(index)" alt=""></li>
                </ul>
                <ul class="flex justify-center flex-wrap" :class="{'block':showFloors, 'hidden':showFloors==false}">
                    <li v-for="floorTile, index in floorTiles" class="m-2 border border-black"><img :src="floorTile.floor" @click="selectFloorTile(index)" alt=""></li>
                </ul>
            </div> 
        </div>            
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script src="public/js/createDungeun.js"></script>
<?php
$content = ob_get_clean();

require('view/template.php');