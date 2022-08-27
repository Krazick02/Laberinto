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
<body onload="relog()">
    <canvas id="mycanvas" width="1000" height="800"></canvas>  

    <script type ="text/javascript">
        var cv  =null;
        var ctx  = null;
        var superX=240,superY=240;
        var player=null;
        var hormiguero=null;
        var cronometro;
        var obs=[];
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
            player =new Cuadraro(superX,superY,40,40,'blue');
            hormiguero =new Cuadraro(960,760,40,40,'red');
            

            for (var i = 0; i < 100; i++) {
                var n=new Cuadraro(generateRandomInteger(920),generateRandomInteger(720),20,100,"white");
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
            tema.play();
            paint();
        }
        function paint(){
            window.requestAnimationFrame(paint);
            ctx.fillStyle ='black';
            ctx.fillRect(0,0,1000,800);
            ctx.font="30px arial";
            ctx.fillStyle="white";                
            ctx.fillText("TIME : "+min+":"+seg,30,60);


            for (var i = 0; i < 100; i++) {
                obs[i].dibujar(ctx);
                ctx.drawImage(wall,obs[i].x,obs[i].y,obs[i].w,obs[i].h);
            }


            ctx.drawImage(fin,hormiguero.x,hormiguero.y,40,40);
            ctx.drawImage(hLEFT,player.x,player.y,40,40);
            
            if(direction=='rigth'){
                ctx.drawImage(hRIGHT,player.x,player.y,40,40);
            }
            if(direction=='down'){
                ctx.drawImage(hDOWN,player.x,player.y,40,40);
            }
            if(direction=='up'){
                ctx.drawImage(hUP,player.x,player.y,40,40);
            }
            if(direction=='left'){
                ctx.drawImage(hLEFT,player.x,player.y,40,40);
            }


            if(pause){
                tema.pause();
                ctx.fillStyle="rgba(0,0,0,0.5)";                
                ctx.fillRect(0,0,1000,800);
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
                if(player.x >= 980){
                    player.x = 0;
                }
            }
            if(direction=='down'){
                player.y +=speed;
                if(player.y >= 780){
                    player.y = 0;
                }
            }
            if(direction=='up'){
                player.y -=speed;
                if(player.y <= 0){
                    player.y = 780;
                }
            }
            if(direction=='left'){
                player.x -=speed;
                if(player.x <= 0){
                    player.x = 980;
                }
            }
            if(player.se_tocan(hormiguero)){
                clearInterval(cronometro);
                speed=0;
                ctx.fillStyle="rgba(0,0,0,0.5)";                
                ctx.fillRect(0,0,1000,800);
                ctx.fillStyle="WHITE";
                ctx.font="50px arial";             
                ctx.fillText("Y O U  W I N",400,380);
                ctx.font="30px arial";             
                ctx.fillText("YOUR TIME WAS = "+min+" min "+seg+ "segs",300,450);
                win.play();
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