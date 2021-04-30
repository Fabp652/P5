<?php
$title = $getDungeun['title'];

ob_start();
?>
    <h1 class="text-center text-3xl md:text-5xl text-white my-12"><?= $getDungeun['title'] ?></h1>
    <div id="dungeun_map">
        <div class="parchment allTable relative mx-auto">
            <table class="z-0 absolute top-0 left-0 p-1 border-collapse">
                <tbody>
                    <tr v-for="floorLine,y in floorMap">
                        <td v-for="col,x in floorLine" class="p-0"><img v-if="floorMap[y][x]!=0" :src="floorTiles[floorMap[y][x]].floor" alt=""></td>
                    </tr>
                </tbody>
            </table>
            <table class="z-1 absolute top-0 left-0 p-1 border-collapse">
                <tbody>
                    <tr v-for="wallLine,y in wallMap">
                        <td v-for="col,x in wallLine" class="p-0"><img v-if="wallMap[y][x]!=0" :src="wallTiles[wallMap[y][x]].wall" alt=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="ml-4 mt-4">
        <a href="index.php?action=change-dungeun&amp;dungeun-id=<?= $getDungeun['id'] ?>&amp;user-id=<?= $getDungeun['user_id'] ?>" class="py-2 px-5 mr-4 text-white rounded-full btn cursor-pointer">Modifier</a>
        <a href="index.php?action=delete-dungeun&amp;dungeun-id=<?= $getDungeun['id'] ?>&amp;user-id=<?= $getDungeun['user_id'] ?>" class="py-2 px-5 text-white rounded-full btn cursor-pointer">Supprimer</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        const dungeunMap = new Vue({
        el: "#dungeun_map",
        data:{
            floorMap: [],
            wallMap: [],
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
            mounted() {
                const data = <?php echo $getDungeun["map"]; ?>;
                this.wallMap = data.walls;
                this.floorMap = data.floors;
            }
        })
    </script>
<?php
$content = ob_get_clean();

require('view/template.php');