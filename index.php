<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>canvas</title>
</head>
<style>
    canvas {
        background-color: orange   ;   
    }
</style>
<body background-color="yellow" onload="relog()">
    <canvas id="mycanvas" width="1000" height="800"></canvas>  

    <script type ="text/javascript">
        var cv  =null;
        var ctx  = null;
        var superX=10,superY=10;
        var player=null;
        var hormiguero=null;
        var hormiguero2=null;
        var cronometro;
        var obs=[];
        var coords=[[0,0,10,800],
                    [990,0,10,770],
                    [0,0,1000,10],
                    [850,740,100,10],
                    [940,390,10,110],
                    [950,490,40,10],
                    [0,790,1000,10],
                    [10,100,180,10],
                    [60,10,10,50],
                    [140,50,100,10],
                    [130,50,10,60],
                    [280,0,10,100],
                    [0,790,1000,10],
                    [230,50,10,250],
                    [60,150,10,150],
                    [70,150,110,10],
                    [170,150,10,150],
                    [120,200,10,50],
                    [120,240,50,10],
                    [10,340,50,10],
                    [70,290,50,10],
                    [110,290,10,100],
                    [60,390,160,10],
                    [170,340,120,10],
                    [220,350,10,100],
                    [230,140,100,10],
                    [290,50,150,10],
                    [330,100,50,10],
                    [230,290,50,10],
                    [330,100,10,50],
                    [280,290,10,60],
                    [430,50,10,110],
                    [430,100,50,10],
                    [480,100,10,60],
                    [380,150,50,10],
                    [380,150,10,50],
                    [280,190,110,10],
                    [280,200,10,40],
                    [280,240,110,10],
                    [330,240,10,250],
                    [280,390,50,10],
                    [220,440,50,10],
                    [490,50,50,10],
                    [580,10,10,50],
                    [530,50,10,100],
                    [530,150,100,10],
                    [530,100,100,10],
                    [630,60,10,50]
                    
                    ];
        var min=0;
        var seg=0;
        var direction='left';
        var pause=false;
        var speed=3;           
        var fin= new Image();
        var hUP= new Image();
        var hLEFT= new Image();
        var hDOWN= new Image();
        var hRIGHT= new Image();
        var wall= new Image();
        var win= new Audio();
        var tema= new Audio();

        
        function start(){
             cv  =document.getElementById('mycanvas');
             ctx  = cv.getContext('2d');
             ctx.strokeRect(0,0,1000,1000);
            player =new Cuadraro(superX,superY,35,35,'blue');
            hormiguero =new Cuadraro(960,750,40,40,'red');
            hormiguero2 =new Cuadraro(960,450,40,40,'red');
            

            for (var i = 0; i < 48; i++) {
                var n=new Cuadraro(coords[i][0],coords[i][1],coords[i][2],coords[i][3],"white");
                obs.push(n);
            }
            hUP.src='hUP.jpeg';
            hDOWN.src='hDOWN.jpeg';
            hRIGHT.src='hRIGTH.jpeg';
            hLEFT.src='hLEFT.jpeg';
            fin.src='fin.jpeg';
            wall.src='wall.png';
            win.src='win.mp3';
            tema.src='tema.mp3';
            //tema.play();
            paint();
        }
        function paint(){
            window.requestAnimationFrame(paint);
            ctx.fillStyle ='black';
            ctx.fillRect(0,0,1000,800);
            ctx.font="30px arial";
            ctx.fillStyle="white";                
            ctx.fillText("TIME : "+min+":"+seg,70,45);


            for (var i = 0; i < 48; i++) {
                obs[i].dibujar(ctx);
                ctx.drawImage(wall,obs[i].x,obs[i].y,obs[i].w,obs[i].h);
            }


            ctx.drawImage(fin,hormiguero.x,hormiguero.y,40,40);
            ctx.drawImage(fin,hormiguero2.x,hormiguero2.y,40,40);
            ctx.drawImage(hLEFT,player.x,player.y,35,35);
            
            if(direction=='rigth'){
                ctx.drawImage(hRIGHT,player.x,player.y,35,35);
            }
            if(direction=='down'){
                ctx.drawImage(hDOWN,player.x,player.y,35,35);
            }
            if(direction=='up'){
                ctx.drawImage(hUP,player.x,player.y,35,35);
            }
            if(direction=='left'){
                ctx.drawImage(hLEFT,player.x,player.y,35,35);
            }


            if(pause){
                tema.pause();
                ctx.fillStyle="rgba(0,0,0,0.5)";                
                ctx.fillRect(0,0,1000,800);
                ctx.fillStyle="WHITE";
                ctx.font="50px arial";             
                ctx.fillText("P A U S E",400,380);
            }else{
                //tema.play();
                update();
            }
        }
        function update(){
            if(direction=='rigth'){
                player.x +=speed;
                if(player.x >= 980){
                    player.x -=speed;
                }
            }
            if(direction=='down'){
                player.y +=speed;
                if(player.y >= 780){
                    player.y -=speed;
                }
            }
            if(direction=='up'){
                player.y -=speed;
                if(player.y <= 0){
                    player.y +=speed;
                }
            }
            if(direction=='left'){
                player.x -=speed;
                if(player.x <= 0){
                    player.x+=speed;
                }
            }
            if(player.se_tocan(hormiguero) || player.se_tocan(hormiguero2)){
                clearInterval(cronometro);
                speed=0;
                ctx.fillStyle="rgba(0,0,0,0.5)";                
                ctx.fillRect(0,0,1000,800);
                ctx.fillStyle="WHITE";
                ctx.font="50px arial";             
                ctx.fillText("Y O U  W I N",400,380);
                ctx.font="30px arial";             
                ctx.fillText("YOUR TIME WAS = "+min+" min "+seg+ "segs",300,450);
                //win.play();
            }
            obs.forEach(function(item,index,arr){
                if(item.se_tocan(player)){
                    if(direction=='rigth'){
                    player.x -=speed;
                    if(player.x >= 980){
                        player.x = 0;
                    }
                }
                if(direction=='down'){
                    player.y -=speed;
                    if(player.y >= 780){
                        player.y = 0;
                    }
                }
                if(direction=='up'){
                    player.y +=speed;
                    if(player.y <= 0){
                        player.y = 780;
                    }
                }
                if(direction=='left'){
                    player.x +=speed;
                    if(player.x <= 0){
                        player.x = 980;
                    }
                }
                }
            });

        }
        function Cuadraro(x,y,w,h,c){
            this.x = x;
            this.y = y;
            this.w = w;
            this.h = h;
            this.c = c;
            this.se_tocan = function (target) { 
                if(this.x < target.x + target.w &&
                this.x + this.w > target.x && 
                this.y < target.y + target.h && 
                this.y + this.h > target.y){
                    return true; 
                }  
            };
            this.dibujar = function(ctx){
                ctx.fillStyle=this.c;
                ctx.fillRect(this.x,this.y,this.w,this.h);
                ctx.strokeRect(this.x,this.y,this.w,this.h);
            }
        }

        document.addEventListener('click',function(e){
            console.log(e.offsetX+","+e.offsetY);
        });
        document.addEventListener('keydown',function(e){
        if(e.keyCode == 87 || e.keyCode == 38){
            direction='up';
        }
        //ritgh
        if(e.keyCode == 83 || e.keyCode == 40){
            direction='down';
        }
        //left
        if(e.keyCode == 65 || e.keyCode == 37){
            direction='left';
        }
        //down
        if(e.keyCode == 68 || e.keyCode == 39){
            direction='rigth';
        }
        //down
        if(e.keyCode == 32){
            pause=(pause)?false:true;
        }
        //RESTART
        if(e.keyCode == 114 || e.keyCode == 82 ){
            location.reload();
        }
        })
        function generateRandomInteger(max) {
            return Math.floor(Math.random() * max) + 1;
        }
        window.addEventListener('load',start)
        window.requestAnimationFrame = (function () {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 17);
                };
        }());
        function rbgaRand() {
            var o = Math.round, r = Math.random, s = 255;
            return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
        }

        function relog(){
            cronometro=setInterval(function(){
                if(seg==60){
                    seg=0;
                    min+=1;
                    if(min==60){
                        min=0;
                    }
                }
                seg++;
            },1000);
        }

        
    </script>
</body> 
</html>