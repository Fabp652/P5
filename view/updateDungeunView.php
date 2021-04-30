<?php
$title = $getDungeun['title'];

ob_start();
?>
    <h1 class="text-center text-3xl md:text-5xl text-white my-12">Création du donjon</h1>
    <div id="update_dungeun" class="parchment">
        <form action="index.php?action=new-dungeun&amp;dungeun-id=<?= $getDungeun['id'] ?>&amp;user-id=<?= $getDungeun['user_id'] ?>" method="POST" ref="form" class="my-2 pt-2">
            <label class="flex justify-center my-4">
            Nom du donjon : <input type="text" name="title" ref="title" value="<?= $getDungeun['title'] ?>" class="ml-4 p-1" required />
            </label>                
            <input type="hidden" name="data" id="data" ref="data">
        </form>
        <div class="flex justify-around flex-wrap">
            <div class="allTable relative my-2 overflow-auto">
                <table class="z-0 absolute top-0 left-0">
                    <tbody>
                        <tr v-for="floorLine,y in floorMap" class="flex">
                            <td v-for="col,x in floorLine" class="p-0" :class="{'border border-black':grid}"  @click="click(x,y)"><img :src="floorTiles[floorMap[y][x]].floor" alt=""></td>
                        </tr>
                    </tbody>
                </table>
                <table class="z-1 absolute top-0 left-0">
                    <tbody>
                        <tr v-for="wallLine,y in wallMap" class="flex">
                            <td v-for="col,x in wallLine" class="p-0" :class="{'border border-black':grid}" @click="click(x,y)"><img :src="wallTiles[wallMap[y][x]].wall" alt=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col justify-center mr-16">
                <div class="border border-black my-2 selected self-center">
                    <img v-if="floor==true" :src="floorTiles[currentTile].floor" class="block" alt="">
                    <img v-if="wall==true" :src="wallTiles[currentTile].wall" class="block" alt="">
                </div>
                <div>
                        <button @click="showWallTiles" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer">Murs</button>
                        <button @click="showFloorTiles" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer">Sols</button> 
                </div>
                <button @click="toggleGrid" class="my-2 py-2 px-5 text-white rounded-full btn cursor-pointer">grid :{{grid?"on":"off"}}</button>
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
                    <li v-for="wallTile, index in wallTiles"><img :src="wallTile.wall" class="m-2 border border-black" @click="selectWallTile(index)" alt=""></li>
                </ul>
                <ul class="flex justify-center flex-wrap" :class="{'block':showFloors, 'hidden':showFloors==false}">
                    <li v-for="floorTile, index in floorTiles"><img :src="floorTile.floor" class="m-2 border border-black" @click="selectFloorTile(index)" alt=""></li>
                </ul>
            </div> 
        </div>                  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script>
        const updateDungeun = new Vue({

            el: "#update_dungeun",
            data: {
                floorMap: [],
                wallMap: [],
                grid: true,
                currentTile: null,
                floor: false,
                wall: false,
                showWalls: false,
                showFloors: false,
                wallTiles: [
                    {wall: "public/images/blank.gif"},
                    {wall: "public/images/walls/side_wall.gif"},
                    {wall: "public/images/walls/bottom_wall.gif"},
                    {wall: "public/images/walls/left_wall.gif"},
                    {wall: "public/images/walls/top_wall.gif"},
                    {wall: "public/images/walls/right_wall.gif"},
                    {wall: "public/images/walls/bottom_left_top_wall.gif"},
                    {wall: "public/images/walls/bottom_right_wall.gif"},
                    {wall: "public/images/walls/left_bottom_right_wall.gif"},
                    {wall: "public/images/walls/left_bottom_wall.gif"},
                    {wall: "public/images/walls/left_top_right_wall.gif"},
                    {wall: "public/images/walls/left_top_wall.gif"},
                    {wall: "public/images/walls/top_bottom_wall.gif"},
                    {wall: "public/images/walls/top_right_bottom_wall.gif"},
                    {wall: "public/images/walls/top_right_wall.gif"}
                ],
                floorTiles: [
                    {floor: "public/images/blank.gif"},
                    {floor: "public/images/floors/mosaic_floor.gif"},
                    {floor: "public/images/floors/stone_floor.gif"},
                    {floor: "public/images/floors/wooden_floor.gif"}
                ]
            },
            methods: {
                click(x,y) {
                    if (this.floor == true) {
                        this.floorMap[y][x] = this.currentTile;
                    }else if (this.wall == true) {
                        this.wallMap[y][x] = this.currentTile;
                    }
                    this.$forceUpdate();                    
                },
                toggleGrid(){
                    this.grid = !this.grid;
                },
                selectWallTile(tile){
                    this.currentTile = tile;
                    this.wall = true;
                    this.floor = false;
                },
                selectFloorTile(tile){
                    this.currentTile = tile;
                    this.wall = false;
                    this.floor = true;
                },
                showWallTiles(){
                    this.showWalls = true;
                    this.showFloors = false;
                },
                showFloorTiles(){
                    this.showFloors = true;
                    this.showWalls = false;
                },
                save(){
                    const data = {
                        walls: this.wallMap,
                        floors: this.floorMap                        
                    };
                    const JSONdata = JSON.stringify(data);
                    this.$refs.data.value = JSONdata;
                    if(this.$refs.title.value == ""){
                        alert("Veuillez donner un nom à votre donjon.");
                    }else{
                        this.$refs.form.submit();
                    }
                },
                changeGrid(){
                    while(this.floorMap.length > 0 && this.wallMap.length > 0){
                        this.floorMap.shift();
                        this.wallMap.shift();
                    }
                    let ligne = this.$refs.ligne.value;
                    let col = this.$refs.col.value;
                    for(let l = 0; l < ligne; l++){
                        let ligne1 = [];
                        let ligne2 = [];
                        for (let c = 0; c < col; c++){
                            ligne1.push(0);
                            ligne2.push(0);
                        }
                        this.floorMap.push(ligne1);
                        this.wallMap.push(ligne2);
                    }
                }
            },
            mounted() {
                const data = <?php echo $getDungeun["map"]; ?>;
                this.wallMap = data.walls;
                this.floorMap = data.floors;
            }
        });
    </script>
<?php
$content = ob_get_clean();

require('view/template.php');