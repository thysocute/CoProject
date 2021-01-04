(function() {

	// 协作关系图
	// var canvasStr = '<canvas id="coLevelCanvas">您的浏览器不支持canvas标签。</canvas>';
	// $("#coLevelPage").empty().append(canvasStr);
	// var coLevelCanvas = document.getElementById('coLevelCanvas');


	// 时间图
	// var	timeStr = '<input type="range" name="timeArr" class="size timeRange" id="timeArr" step="1" value="2" min="0" max="3"></div>'
	var	timeStr = '<input type="range" name="timeArr" class="size timeRange" id="timeArr" style="z-index: 99;" step="1" value="2" min="0" max="3"></div>'
				+ '<span id="timeVal">1</span>';
	$("#timeHeatmapPage").empty().append(timeStr);

	// timeArrbar = $('#timeArr');
	// timeVal = $('#timeVal')[0];
	// timeDian = Number(timeArrbar.val());
	// timeArrbar.change(() => {
	// 	timeDian = Number(timeArrbar.val());
	// 	timeVal.innerHTML = timeDian;
	// });
	// $("#timeArr").css("width", (window.innerWidth-100)+"px");

	var ctx = coLevelCanvas.getContext("2d");  


    
	          // context = coLevelCanvas.getContext('2d');

	// resize the canvas to fill browser window dynamically
	window.removeEventListener('resize', resizeCanvas, false);

	function resizeCanvas() {
	    coLevelCanvas.width = window.innerWidth;
        coLevelCanvas.height = window.innerHeight;
        // $("#timeArr").css("width", (window.innerWidth-window.innerWidth*0.15)+"px");

	}
	resizeCanvas();

	ctx.clearRect(0,0,coLevelCanvas.width,coLevelCanvas.height);

	//获取Canvas对象(画布)
// var canvas = document.getElementById("myCanvas");
//简单地检测当前浏览器是否支持Canvas对象，以免在一些不支持html5的浏览器中提示语法错误
// if(coLevelCanvas.getContext){  
    //获取对应的CanvasRenderingContext2D对象(画笔)
    
    //开始一个新的绘制路径
    ctx.beginPath();
    //设置弧线的颜色为蓝色
   	//	ctx.strokeStyle = "blue";
	var circle1 = {
		x : 250,    //圆心的x轴坐标值
        y : 100,    //圆心的y轴坐标值
        r : 50,      //圆的半径
        color: "yellow"
	}	
    // var circle = {
        
    // };
	
	var circle2 = {
        x : 450,    //圆心的x轴坐标值
        y : 300,    //圆心的y轴坐标值
        r : 50,      //圆的半径
        color: "blue"
    };
	
    //以canvas中的坐标点(100,100)为圆心，绘制一个半径为50px的圆形
    
    drawCircle(circle1.x,circle1.y, circle1.r, circle1.color);
    // ctx.scale(2,2);
    drawCircle(circle2.x,circle2.y, circle2.r, circle2.color);
    drawLine(circle1.x,circle1.y,circle2.x,circle2.y);
    // ctx.clearRect(0,0,100,50);

    // scaleCircle()
	
	
// }
function scaleCircle(s) {
	ctx.scale(s,s);
}

function drawCircle(x,y,r,color) {
	var circle = {
        x : x,    //圆心的x轴坐标值
        y : y,    //圆心的y轴坐标值
        r : r,      //圆的半径
        color:color
    };

    ctx.beginPath();  // 开始画画
    ctx.arc(circle.x, circle.y, circle.r, 0, Math.PI * 2, true); 
	
    //按照指定的路径绘制弧线
	ctx.fillStyle=color;//设置填充颜色
	ctx.fill();//开始填充
}

function drawLine(x1, y1, x2, y2, color) {
	color = color || "#fcc";
	ctx.beginPath();
	ctx.moveTo(x1,y1);   // 起点
	ctx.lineTo(x2,y2);   // 终点
	ctx.strokeStyle = color;//设置线条颜色
	ctx.stroke();  // 开始绘制线条
}

// function drawStuff() {
        // do your drawing stuff here
// }


 

})();