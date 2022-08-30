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
    <canvas id="mycanvas" width="1030" height="990"></canvas>  

    <script type ="text/javascript">
        var cv  =null;
        var ctx  = null;
        var player=null;
        var hormiguero=null;
        var hormiguero2=null;
        var oso=null;
        var oso2=null;
        var cronometro;
        var obs=[];
        var dirr=['left','rigth','up','down','left','rigth','up','down','left','rigth','up','down','left','rigth','up','down','left','rigth','up','down'];
        var coords=[[0,0,10,1200],
                    [1190,0,10,1200],
                    [0,0,1200,10],
                    [0,1190,1200,10],
                    [10,100,180,10],
                    [60,10,10,50],
                    [140,50,100,10],
                    [130,50,10,60],
                    [280,0,10,100],
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
                    [630,60,10,50],
                    [160,490,180,10],
                    [60,440,100,10],
                    [160,440,10,50],
                    [60,450,10,50],
                    [60,490,50,10],
                    [10,540,50,10],
                    [60,540,10,50],
                    [110,490,10,200],
                    [160,540,180,10],
                    [160,540,10,100],
                    [170,630,50,10],
                    [10,880,50,10],
                    [60,640,10,200],
                    [60,880,10,50],
                    [60,640,50,10],
                    [60,830,100,10],
                    [160,830,10,50],
                    [110,830,10,100],
                    [110,920,50,10],
                    [110,740,10,50],
                    [110,730,50,10],
                    [160,690,10,100],
                    [160,780,50,10],
                    [210,780,10,150],
                    [160,680,270,10],
                    [210,730,50,10],
                    [260,730,10,250],
                    [270,590,10,90],
                    [330,550,10,80],
                    [330,590,50,10],
                    [380,500,10,100],
                    [330,680,10,250],
                    [330,920,100,10],
                    [380,870,10,50],
                    [340,730,90,10],
                    [380,780,10,50],
                    [380,820,50,10],
                    [430,820,10,50],
                    [430,870,50,10],
                    [480,870,10,110],
                    [430,730,10,50],
                    [430,770,50,10],
                    [480,680,10,140],
                    [380,640,110,10],
                    [430,560,10,80],
                    [380,500,50,10],
                    [330,440,50,10],
                    [380,340,10,110],
                    [430,200,10,310],
                    [380,290,50,10],
                    [480,590,50,10],
                    [480,600,10,40],
                    [430,550,160,10],
                    [480,680,50,10],
                    [530,640,10,50],
                    [530,640,60,10],
                    [580,550,10,100],
                    [480,820,160,10],
                    [580,770,10,50],
                    [530,730,10,50],
                    [480,700,10,40],
                    [530,730,100,10],
                    [580,680,10,50],
                    [630,500,10,280],
                    [480,500,10,50],
                    [430,440,100,10],
                    [530,390,10,110],
                    [530,500,100,10],
                    [480,290,10,100],
                    [480,390,50,10],
                    [430,240,100,10],
                    [530,240,10,50],
                    [530,290,50,10],
                    [530,340,50,10],
                    [580,290,10,160],
                    [580,390,60,10],
                    [530,830,10,50],
                    [480,920,160,10],
                    [580,870,10,50],
                    [630,820,10,60],
                    [630,870,50,10],
                    [680,870,10,60],
                    [580,210,10,50],
                    [630,210,10,140],
                    [630,50,160,10],
                    [480,200,200,10],
                    [680,100,10,110],
                    [730,60,10,50],
                    [680,150,100,10],
                    [730,150,10,60],
                    [780,60,10,50],
                    [780,100,100,10],
                    [830,10,10,50],
                    [880,50,10,60],
                    [880,50,100,10],
                    [980,50,10,60],
                    [830,100,10,100],
                    [780,200,150,10],
                    [880,150,100,10],
                    [930,100,10,50],
                    [980,150,10,50],
                    [980,200,50,10],
                    [630,290,100,10],
                    [730,290,10,60],
                    [680,350,10,240],
                    [680,350,60,10],
                    [630,440,50,10],
                    [630,640,50,10],
                    [680,590,50,10],
                    [720,600,10,80],
                    [640,680,90,10],
                    [680,500,60,10],
                    [630,770,140,10],
                    [680,725,200,10],
                    [820,730,10,100],
                    [690,820,140,10],
                    [730,830,10,50],
                    [730,870,50,10],
                    [680,920,300,10],
                    [820,870,10,50],
                    [820,870,50,10],
                    [870,770,10,110],
                    [730,440,50,10],
                    [730,390,50,10],
                    [730,390,10,60],
                    [770,440,10,290],
                    [870,500,10,225],
                    [830,640,50,10],
                    [830,640,50,10],
                    [820,640,10,40],
                    [770,590,50,10],
                    [730,540,50,10],
                    [820,540,50,10],
                    [780,390,50,10],
                    [780,200,10,190],
                    [680,250,100,10],
                    [830,250,10,150],
                    [830,250,50,10],
                    [820,440,10,50],
                    [820,440,150,10],
                    [880,300,10,150],
                    [930,200,10,50],
                    [930,250,50,10],
                    [980,250,10,100],
                    [880,300,100,10],
                    [930,350,10,50],
                    [930,390,100,10],
                    [970,440,10,200],
                    [920,500,10,420],
                    [920,540,50,10],
                    [920,680,50,10],
                    [970,720,10,150],
                    [970,640,50,10],
                    [970,870,50,10],
                    [0,980,1030,10],
                    [1020,10,10,980]
                    ];
        var min=0;
        var seg=0;
        var direction='left';
        var dir01='left';
        var dir02='rigth';
        var pause=false;
        var speed=3;
        var life=3;           
        var fin= new Image();
        var hUP= new Image();
        var hLEFT= new Image();
        var hDOWN= new Image();
        var hRIGHT= new Image();
        var osoI= new Image();
        var wall= new Image();
        var win= new Audio();
        var tema= new Audio();

        
        function start(){
            hUP.src='hUP.png';
            hDOWN.src='hDOWN.png';
            hRIGHT.src='hRIGTH.png';
            hLEFT.src='hLEFT.png';
            fin.src='fin.png';
            wall.src='wall.png';
            win.src='win.mp3';
            tema.src='tema.mp3';
            osoI.src='osoI.png';
            tema.play();
            
             cv  =document.getElementById('mycanvas');
             ctx  = cv.getContext('2d');
             ctx.strokeRect(0,0,1030,990);
            player =new Cuadraro(10,10,25,25,'blue');
            hormiguero =new Cuadraro(980,940,40,40,'red');
            hormiguero2 =new Cuadraro(980,600,40,40,'red');
            oso =new Cuadraro(160,880,25,25,'red');
            oso2 =new Cuadraro(700,560,25,25,'red');
            

            for (var i = 0; i < 200; i++) {
                var n=new Cuadraro(coords[i][0],coords[i][1],coords[i][2],coords[i][3],"white");
                obs.push(n);
            }
            
            paint();
        }
        function paint(){
            window.requestAnimationFrame(paint);
            ctx.fillStyle ='black';
            ctx.fillRect(0,0,1030,990);
            ctx.font="30px arial";
            ctx.fillStyle="white";                
            ctx.fillText("TIME : "+min+":"+seg+"          LIVES : "+life,70,45);


            for (var i = 0; i < 200; i++) {
                obs[i].dibujar(ctx);
                ctx.drawImage(wall,obs[i].x,obs[i].y,obs[i].w,obs[i].h);
            }


            ctx.drawImage(fin,hormiguero.x,hormiguero.y,40,40);
            ctx.drawImage(fin,hormiguero2.x,hormiguero2.y,40,40);
            ctx.drawImage(osoI,oso.x,oso.y,25,25);
            ctx.drawImage(osoI,oso2.x,oso2.y,25,25);
        
            if(direction=='rigth'){
                ctx.drawImage(hRIGHT,player.x,player.y,25,25);
            }
            if(direction=='down'){
                ctx.drawImage(hDOWN,player.x,player.y,25,25);
            }
            if(direction=='up'){
                ctx.drawImage(hUP,player.x,player.y,25,25);
            }
            if(direction=='left'){
                ctx.drawImage(hLEFT,player.x,player.y,25,25);
            }


            if(pause){
                tema.pause();
                ctx.fillStyle="rgba(0,0,0,0.5)";                
                ctx.fillRect(0,0,1030,990);
                ctx.fillStyle="WHITE";
                ctx.font="50px arial";             
                ctx.fillText("P A U S E",400,380);
            }else{
                tema.play();
                update();
            }
        }
        function update(){
            if(direction=='rigth'){
                player.x +=speed;
            }
            if(direction=='down'){
                player.y +=speed;
            }
            if(direction=='up'){
                player.y -=speed;
            }
            if(direction=='left'){
                player.x -=speed;
            }
            if(dir01=='rigth'){
                oso.x +=speed;
            }
            if(dir01=='down'){
                oso.y +=speed;
            }
            if(dir01=='up'){
                oso.y -=speed;
            }
            if(dir01=='left'){
                oso.x -=speed;
            }
            if(dir02=='rigth'){
                oso2.x +=speed;
            }
            if(dir02=='down'){
                oso2.y +=speed;
            }
            if(dir02=='up'){
                oso2.y -=speed;
            }
            if(dir02=='left'){
                oso2.x -=speed;
            }
            if(player.se_tocan(hormiguero) || player.se_tocan(hormiguero2)){
                clearInterval(cronometro);
                speed=0;
                ctx.fillStyle="rgba(0,0,0,0.5)";                
                ctx.fillRect(0,0,1030,990);
                ctx.fillStyle="WHITE";
                ctx.font="50px arial";             
                ctx.fillText("Y O U  W I N",400,380);
                ctx.font="30px arial";             
                ctx.fillText("YOUR TIME WAS = "+min+" min "+seg+ "segs",300,450);
                ctx.fillText("Press R to restart",430,490);
                win.play();
            }
            if(player.se_tocan(oso) || player.se_tocan(oso2)){
                player.x=10;
                player.y=10;
                if(life<1){
                    clearInterval(cronometro);
                    speed=0;
                    ctx.fillStyle="rgba(0,0,0,0.5)";                
                    ctx.fillRect(0,0,1030,990);
                    ctx.fillStyle="red";
                    ctx.font="50px arial";             
                    ctx.fillText("G A M E  O V E R",330,380);
                    ctx.font="30px arial";             
                    ctx.fillText("YOUR TIME WAS = "+min+" min "+seg+ "segs",300,450);
                    ctx.fillText("Press R to restart",400,490);
                }else{
                    life-=1;
                }
            }
            obs.forEach(function(item,index,arr){
                if(item.se_tocan(player)){
                    if(direction=='rigth'){
                        player.x -=speed;
                    }
                    if(direction=='down'){
                        player.y -=speed;
                    }
                    if(direction=='up'){
                        player.y +=speed;
                    }
                    if(direction=='left'){
                        player.x +=speed;
                    }
                }
            });

            obs.forEach(function(item,index,arr){
                if(item.se_tocan(oso)){
                    if(dir01=='rigth'){
                        oso.x -=speed;
                    }
                    if(dir01=='down'){
                        oso.y -=speed;
                    }
                    if(dir01=='up'){
                        oso.y +=speed;
                    }
                    if(dir01=='left'){
                        oso.x +=speed;
                    }
                    dir01=dirr[generateRandomInteger(12)];
                }
                if(item.se_tocan(oso2)){
                    if(dir02=='rigth'){
                        oso2.x -=speed;
                    }
                    if(dir02=='down'){
                        oso2.y -=speed;
                    }
                    if(dir02=='up'){
                        oso2.y +=speed;
                    }
                    if(dir02=='left'){
                        oso2.x +=speed;
                    }
                    dir02=dirr[generateRandomInteger(12)];
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
            player.x=e.offsetX;
            player.y=e.offsetY;
            
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
            return Math.floor(Math.random() * max);
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