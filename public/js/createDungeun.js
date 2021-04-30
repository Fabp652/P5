const createDungeun = new Vue({
    el: "#create_dungeun",
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
        save(){
            const data = {
                walls: this.wallMap,
                floors: this.floorMap
            }
            const JSONdata = JSON.stringify(data);
            this.$refs.data.value = JSONdata;
            if(this.$refs.title.value == ""){
                alert("Veuillez donner un nom à votre donjon.");
            }else{
                this.$refs.form.submit();
            }
        },
        showWallTiles(){
            this.showWalls = true;
            this.showFloors = false;
        },
        showFloorTiles(){
            this.showFloors = true;
            this.showWalls = false;
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
        for (let l = 0; l < 10; l++) {
            let floorLine = [];
            let wallLine = [];
            for (let c = 0; c < 10; c++) {
                floorLine.push(0);
                wallLine.push(0);
            }
            this.floorMap.push(floorLine);
            this.wallMap.push(wallLine);
        }
    }
});