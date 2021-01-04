var snackbar;
var socket;

function makesnack(msg) {
	snackbar.innerHTML = msg;
	snackbar.className = 'show';
	setTimeout(function() {
		snackbar.className = snackbar.className.replace('show', '');
	}, 3000);
}
var thickness, fillcolor, mycanvas, onlinecountdisplay, pos;
var thicknessbar,
	thicknessindicator,
	lock,
	activecol,
	colorspot,
	eraser,
	colorPallete;
var cUserName;
	cPoints = [];

var userArr = [];         // 用户组

var points = [];         // 热力图数据存储数组
var userName = "";

var maxVal = 20;        // 热力图参数
var val = 10;           // 热力图参数


var indexArr = [];
var dataPointArr = []; 


var userInfo; // 用户组信息

// 热力图颜色组
var gradientStr = [
	{'.5': 'blue', '.8': 'pink', '.95': 'mistyRose'},
	{'.5': 'red', '.8': 'yellow', '.95': 'mistyRose'},
	{'.5': 'yellow','.8': 'purple','.95': 'mistyRose'},
	{'.5': 'Green','.8': 'Orange','.95': 'mistyRose'},
	{'.5': 'purple','.8': 'Turquoise','.95': 'mistyRose'}
];
var heatmapInstance;	
var allHeatmapNameArr = [];  // 整合热力图对象集合
var heatmapNameArr =[];  // 单个热力图对象集合

var timeHeatmapArr = [];  // 时间热力图集

var dataSet = [];  // 数据集

var myChart;  // 协作关系图
var uChartData = [];

var LisaArr = ["Lisa", "Neary", "user2"];


// 页面初始化加载
(function() {
	// 创建时间轴页面
	var	timeStr = '<input type="range" name="timeArr" class="size timeRange" id="timeArr" style="z-index: 99;" step="1" value="2" min="0" max="3"></div>'
				+ '<span id="timeVal">1</span>';
	$("#timeHeatmapPage").empty().append(timeStr);

	$("#timeHeatmapPage").css("width", window.screen.availWidth);
    $("#timeHeatmapPage").css("height", window.screen.availHeight);
   

	// 在创建热力图之前设置好热力图的宽度
    $("#allHeatmapPage").css("width", window.screen.availWidth);
    $("#allHeatmapPage").css("height", window.screen.availHeight);

    // 协作关系图
    // 创建关系图容器
	var echartHtml = '<div id="echartMain" class="echartMain" style="width: 900px;height:700px;"></div>';
	$("#coLevelPage").empty().append(echartHtml);

	myChart = echarts.init(document.getElementById('echartMain'));


	var localHtml = '<div id="GLMap"></div>';
	$("#localPage").empty().append(localHtml);
	$("#GLMap").css("width", window.screen.availWidth);
    $("#GLMap").css("height", window.screen.availHeight);
	// var location = ["113.303505, 23.097692"]
	setDistance(113.303505, 23.097692, 106.116225, 38.501568);

	// window.removeEventListener('resize', resizeCanvas, false);
	// function resizeCanvas() {
	//     coLevelCanvas.width = window.innerWidth;
 //        coLevelCanvas.height = window.innerHeight;
	// }
	// resizeCanvas();

	// ctx.clearRect(0,0,coLevelCanvas.width,coLevelCanvas.height);
})();




function setup() {
	

	// socket = io.connect('127.0.0.1:3000');
	socket = io.connect('172.16.16.249:3000');
	// $("#allHeatmapBtn")
	// socket = io.connect('https://collaborate-on-a-paint.herokuapp.com/');
	socket.on('sentpaint', setpainting);
	socket.on('sentmove', setmove);      		// 鼠标移动数据
	socket.on('getClickData', setClickChart);      		// 鼠标点击次数
	onlinecountdisplay = $('#onlinecount')[0];  // 在线用户
	thicknessbar = $('#size');
	thicknessindicator = $('#sizeval')[0];
	colorPallete = $('.color-pallete');
	activecol = $('.col');
	eraser = $('#eraser');
	
	pos = $('#pos')[0];
	pos.innerHTML = "";
	mycanvas = createCanvas(1000, 500);
	mycanvas.parent($('.canvascontainer')[0]);
	background(255);
	// $("#heatmap").css("position","absolute");
	fillcolor = color(activecol[0].jscolor.rgb);
	thickness = Number(thicknessbar.val());
	thicknessbar.change(() => {
		thickness = Number(thicknessbar.val());
		thicknessindicator.innerHTML = thickness;
	});
	activecol.click(e => {
		if (eraser.hasClass('fa-eraser')) {
			eraser.addClass('fa-paint-brush');
			eraser.removeClass('fa-eraser');
		}
		fillcolor = color(e.target.jscolor.rgb);
	});
	activecol.focusin(e => {
		colorPallete.addClass('put-space');
	});
	activecol.focusout(e => {
		colorPallete.removeClass('put-space');
	});
	eraser.click(() => {
		if (eraser.hasClass('fa-eraser')) {
			eraser.addClass('fa-paint-brush');
			eraser.removeClass('fa-eraser');
			fillcolor = color(activecol[0].jscolor.rgb);
		} else {
			eraser.addClass('fa-eraser');
			eraser.removeClass('fa-paint-brush');
			fillcolor = color(255);
		}
	});
	$('.canvascontainer canvas').bind('touchmove', e => {
		e.preventDefault();
	});
	snackbar = $('#snackbar')[0];

	setDistance(10.);

	
	// 接受用户组信息
	socket.on('userInfoArr', function(data) { // 每一次用户加入均执行这一步
		// console.log(data.info) 
		userInfo = data.info; // 用户数据集
		cUserName = userInfo.cName;   // 当前用户名
		userArr = userInfo.uNameArr;  // 用户组名

		var cIndex = $.inArray(cUserName, userArr)

		var btnStr="", pageStr=""; // 动态添加按钮和页面

		// 添加按钮和页面
		// 判断有多少个以“user"开头的按钮
		var userNum = $('#visualMenu li[id^="user"]').length;
		
		// console.log(userNum)
		for(var i=userNum; i<userArr.length; i++) {
			// --------------添加相应用户按钮和页面--------------
			btnStr  = '<li id="' + userArr[i] + 'HeatmapBtn">' + LisaArr[i] + ' Heatmap</li> ';
			pageStr = '<div id="'+ userArr[i] + 'HeatmapPage" style="display: none;"></div>';

			$("#coLevelBtn").before(btnStr);
			$("#coLevelPage").before(pageStr);


			// ----------------创建热力图 start-----------------------
			var pageId ='#' + userArr[i] + 'HeatmapPage';

			// 在创建热力图之前设置好热力图的宽度
		    $(pageId).css("width", window.screen.availWidth);
		    $(pageId).css("height", window.screen.availHeight);

		    // ----------------整体热力图-----------------------------
		    var allHeatmapName = "heatmapInstance" + i;
			// console.log(heatmapName);
			allHeatmapName = h337.create({
		    	container: document.querySelector('#allHeatmapPage'),		// heatmap载体
		    	gradient: gradientStr[i]
	 		});
	 		allHeatmapNameArr.push(allHeatmapName);

		    // ----------------创建热力图对象（单个用户）----------------
			var heatmapName = userArr[i] + 'hmInstance';
			heatmapName = h337.create({
		    	container: document.querySelector(pageId),		// heatmap载体
		    	gradient: gradientStr[i]
		 	});
		 	heatmapNameArr.push(heatmapName)

		 	// ----------------时间热力图----------------
		 	var timeHeatmapName = userArr[i] + 'TimeHeatmap';
			timeHeatmapName = h337.create({
		    	container: document.querySelector("#timeHeatmapPage"),		// heatmap载体
		    	gradient: gradientStr[i]
		 	});
		 	timeHeatmapArr.push(timeHeatmapName)

		 	// ----------------创建热力图  END----------------

			// ----------------创建协作关系图----------------
		 	
		 	var midData = {"name":LisaArr[i],"target":"Lisa"};
		
		 	uChartData.push(midData);
		 	// console.log(uChartData);
		 	setRelationship(uChartData);
		 	socket.on('getUserClickData', function(data) {
		 		var options = myChart.getOption();
				var proportion = 0;
				// 按比例修改形状大小
				console.log(data.initialData.cUserClick)
				for(var j=0; j<data.initialData.cUserClick.length; j++) {
					proportion = Math.round((data.initialData.cUserClick[j]/data.initialData.totalClick)*10);
					// console.log(proportion)
					options.series[0].data[j].category = proportion;
				}
			    myChart.setOption(options);
		 	})
		 	


		 	// ----------------创建数据集----------------
		 	var dataArr = userArr[i] +"Arr";
		 	dataArr = new Array();
		 	dataSet.push(dataArr);

		}  // for END

		

		
		// 显示用户组
		onlinecountdisplay.innerHTML = userInfo.uNameArr; 
		onlinecountdisplay.innerHTML = "Lisa, Neary"; 

		// 创建单人热力图
		 


	});

	// 请求用户名
	socket.emit("getUser","请求用户名");
	socket.on("getUserName", function(data) {
		console.log(data)

		if(data == "user1") {
			$("#currentUser")[0].innerHTML = "Lisa";
		} else if (data == "user2") {
			$("#currentUser")[0].innerHTML = "Neary";
		} else {
			$("#currentUser")[0].innerHTML = data;
		}
		

	} )

	// 菜单按钮点击事件
	$("#visualMenu").on("click", "li", function(e) {
		// 根据按钮Id确定目标页面Id
		var thisId = $(this).attr("id");
		var publicStr = thisId.substr(0, thisId.length-3);
		var thisPageId = publicStr + "Page";

		// 隐藏其他页面，显示目标页面
		$("#" + thisPageId).siblings().hide();
		$("#" + thisPageId).show();
		$(this).addClass("active").siblings().removeClass("active");
	})
	
	
}


// function creatECharts() {
	

// 	// 创建关系图对象
	

	

// }

function setRelationship(jsonData) {
    // console.log(jsonData);
    var jsonDataStr, jsonLinkStr;
    var dataStr = '[';
    var linkStr = '[';

    for(var i=0; i<jsonData.length; i++) {
        if(i == 0) {
            dataStr += '{"name":"' + jsonData[i].name + '", "category":' +i+ '}';
            linkStr += '{"source":"' + jsonData[i].name + '", "target":"' + jsonData[i].target + '"}';
        } else {
            dataStr += ',{"name":"' + jsonData[i].name + '", "category":' +i+ '}';
            linkStr += ',{"source":"' + jsonData[i].name + '", "target":"' + jsonData[i].target + '"}';
        }
    }

    dataStr = dataStr + ']';
    linkStr = linkStr + ']';

    // 转化为json格式数据
    jsonDataStr = $.parseJSON(dataStr); 
    jsonLinkStr = $.parseJSON(linkStr); 

    // // var dataStr 
   // 指定图表的配置项和数据
    var option = {
        series: [{
            type: 'graph',
            layout: 'force',
            label: {
                normal: {
                    show: true,
                    position: 'top',//设置label显示的位置
                    textStyle: {
                    fontSize: '12rem'
                    },
                }
            },
            symbolSize: (value, params) => {
                // 根据数据params中的data来判定数据大小
                switch (params.data.category) {
                    case 0:return 100;break;
                    case 1:return 90;break;
                    case 2:return 80;break;
                    case 3:return 70;break;
                    case 4:return 60;break;
                    case 5:return 50;break;
                    case 6:return 40;break;
                    case 7:return 30;break;
                    case 8:return 20;break;
                    case 9:return 10;break;
                    default:return 5;
                };
            },
            draggable: true,
            data: jsonDataStr,
            force: {
                edgeLength: 400,
                repulsion: 500,
                gravity: 0.1
            },
            links: jsonLinkStr,
        }]
    };

    myChart.setOption(option);
    // return option;
}



$("#coPaintPage")[0].onclick = function(event) {
	// 点击一次发送一次数据
	socket.emit('workClick', "我参与工作了");

}

$("#coPaintPage")[0].onmousemove = function(event) {
	var e = event || window.event;//为了兼容ie和火狐
	mmouseX = e.clientX;//鼠标所在的x坐标
	mmouseY = e.clientY;//鼠标所在的y坐标
	
	let data = {
		mmx: mmouseX,
		mmy: mmouseY
	}

	// console.log("x:" + mmouseX +",y" + mmouseY)
	// setHeapMapData(mmouseX, mmouseY);
	
	socket.emit('move', data);

};

function setClickChart(data) {
	// console.log(data)
	// 获取chart的option
	var options = myChart.getOption();
	var proportion = 0;
	// 按比例修改形状大小
	for(var j=0; j<data.cUserClick.length; j++) {
		proportion = Math.round((data.cUserClick[j]/data.totalClick)*10);
		// console.log(proportion)
		options.series[0].data[j].category = proportion;
	}
    

    myChart.setOption(options);

}


function draw() {
	if (mouseIsPressed) {
		stroke(fillcolor);
		strokeWeight(thickness);

		let data = {
			mx: mouseX,
			my: mouseY,
			pmx: pmouseX,
			pmy: pmouseY,
			sw: thickness,
			fc: fillcolor.levels
		};
		// console.log(data)
		socket.emit('painting', data);  // 发送
		line(mouseX, mouseY, pmouseX, pmouseY);
	}
}

function setpainting(data) {
	// console.log("data")
	stroke(data.fc[0], data.fc[1], data.fc[2], data.fc[3]);
	strokeWeight(data.sw);
	line(data.mx, data.my, data.pmx, data.pmy);
}

function setuc(data) {
	// console.log(data)
	namm = data.uc
	onlinecountdisplay.innerHTML = data.uc;
}

// 处理接收的数据
function setmove(data) {
	// 这里指收到对方的数据，不能收到当前点击用户的数据

	// var str= '<p>'+ data.user + "--" +  data.data.mmx + ":"  + data.data.mmy +'</p>';
	// pos.append(str);

	var userName = data.user;        // 当前用户名
	var newOffsetX = data.data.mmx;	 // 横坐标
	var newOffsetY = data.data.mmy;  // 纵坐标
	// console.log("move" + userName)
	var cIndex = $.inArray(userName, userArr);


	setHeapMapData(cIndex, newOffsetX, newOffsetY);

	// setSubHeapMapData(cIndex, newOffsetX, newOffsetY);
	
}





const updateColor = picker => {
	if (eraser.hasClass('fa-eraser')) {
		eraser.addClass('fa-paint-brush');
		eraser.removeClass('fa-eraser');
	}
	const col = picker.rgb;
	fillcolor = color(col);
};

// 创建热力图方法
// function heatmapCreatFun(cUserIndex,gradientArr) {
	
// 	var heatmapName = "heatmapInstance" + cUserIndex;
// 	// console.log(heatmapName);

// 	heatmapName = h337.create({
//     	container: document.querySelector('#heatmap'),		// heatmap载体
//     	gradient: gradientArr,
// 		});
// 	return heatmapName;
// }

// 传递参数，显示热力图
function setAllHeapMapData(cIndex, mouseX, mouseY) {

	var point = {
		x: mouseX,
		y: mouseY,
		value: val
	};

	points.push(point);   // 热力点坐标
	// console.log("points[cUserIndex]")
	// console.log(points[cUserIndex])
	var dataArr = {
		max: maxVal,
		// min: minVal,
		data: points
	};

	heatmapInstance.setData(dataArr);
	// heatmapInstance1.setData(dataArr1);
}



// 传递参数，显示热力图
function setHeapMapData(cIndex, mouseX, mouseY) {

	var subPoint = {
		x: mouseX,
		y: mouseY,
		value: val
	};
	// console.log(cIndex)
	dataSet[cIndex].push(subPoint);
	// console.log(dataSet.length)
	// console.log(dataSet[cIndex])
	var subDataArr = {
			max: maxVal,
			// min: minVal,
			// data: points[cUserIndex]
			data: dataSet[cIndex]
		};

	// console.log(cIndex)

	indexArr.push(cIndex);
	dataPointArr.push(subDataArr);

	// setTimeBar(indexArr, dataPointArr);

	// console.log(heatmapNameArr[cIndex])
	// console.log(heatmapNameArr[cIndex])
	// heatmapNameArr[cIndex].setData(dataArr);
	allHeatmapNameArr[cIndex].setData(subDataArr);
	heatmapNameArr[cIndex].setData(subDataArr);
	// console.log("ok")

}
var timeArrbar = $("#timeArr");
var timeVal = $('#timeVal')[0];
$("#timeHeatmapBtn")[0].onclick = function(event) {
	// console.log(dataPointArr.length)
	var dian = Math.ceil(indexArr.length/10);
	timeArrbar.attr("max", dian);
	timeArrbar.val(dian);
	
	timeVal.innerHTML = timeArrbar.val();
	// console.log(timeArrbar.val());
	

	for(var i=0;i<indexArr.length; i++) {
		timeHeatmapArr[indexArr[i]].setData(dataPointArr[i]);
	}
	// console.log(indexArr)
	// console.log(dataPointArr)

	timeArrbar.change(() => {
		// console.log(indexArr)
		// console.log(dataPointArr)
		// var cxt=c.getContext("2d");  
    	// cxt.clearRect(0,0,c.width,c.height); 
    	$("#allHeatmapPage .heatmap-canvas").each(function(index) {
    		// console.log(index)
    		var ctx = $("#allHeatmapPage .heatmap-canvas")[index].getContext("2d");
    		ctx.rect(0,0,1440,600);
    		ctx.stroke();
    	})

		// $("#allHeatmapPage .heatmap-canvas").css("width",0);
		// $("#allHeatmapPage .heatmap-canvas").css("height",0);

		// clearRect(0,0,coLevelCanvas.width,coLevelCanvas.height);
		timeDian = Number(timeArrbar.val());
		timeVal.innerHTML = timeDian;
		// $("#allHeatmapPage heatmap-canvas").css("width",window.screen.availWidth);
		// $("#allHeatmapPage heatmap-canvas").css("height",window.screen.availHeight);

		// console.log("value:" + timeDian);
		var newDataSet = dataPointArr[1].data.slice(timeDian*10-1);
		for(var k=0; k<(timeDian*10); k++) {

			var subDataArr = {
				max: maxVal,
				// min: minVal,
				// data: points[cUserIndex]
				data: newDataSet
			};
			// console.log(indexArr[k])
			// console.log(dataPointArr[1])
			// console.log(dataPointArr[1].data)
			timeHeatmapArr[indexArr[k]].setData(subDataArr);
		}
		// console.log("ok")

	});

	
}



function setDistance(longitude1, latitude1, longitude2,latitude2) {
	//初始化地图对象，加载地图
    var map = new AMap.Map('GLMap', {
      resizeEnable: true,
      center: [121.498586, 31.239637],
      lang: "en" //可选值：en，zh_en, zh_cn
    });
    var m1 = new AMap.Marker({
        map: map,
        draggable:true,
        position: new AMap.LngLat(106.116225, 38.501568)
    });
    var m2 = new AMap.Marker({
        map: map,
        draggable:true,
        position:new AMap.LngLat(116.354584, 39.97776)
    });
    map.setFitView();
    
    var line = new AMap.Polyline({
      	strokeColor:'red',
      	isOutline:true,
      	outlineColor:'white'
    });
    line.setMap(map);
    var text = new AMap.Text({
      	text:'',
      	style:{'background-color':'red',
				'border-color':'red',
				'font-size':'18px',
                'padding':"5px",
                'color':'white'}
    });
    text.setMap(map)
    function computeDis(){
        var p1 = m1.getPosition();
        var p2 = m2.getPosition();
        var textPos = p1.divideBy(2).add(p2.divideBy(2));
        var distance = Math.round(p1.distance(p2));
        var path = [p1,p2];
        line.setPath(path);
        text.setText('The  distance of  two points is ' + distance + ' meters')
        text.setPosition(textPos)
    }
    computeDis();
    m1.on('dragging', computeDis)
    m2.on('dragging', computeDis)


}


