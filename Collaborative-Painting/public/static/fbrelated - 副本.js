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
var newArr  = [];         // 用于添加一个空数组
var heatmapNameArr =[];  // 热力图对象名称组
var heatmapObject = "";  // 返回的热力图对象名称
var points = [];         // 热力图数据存储数组
var userName = "";
var cUserIndex = 0;

var maxVal = 20;        // 热力图参数
var val = 10;           // 热力图参数

var namm = [];

var userInfo; // 用户组信息
var ccuser;
// 热力图颜色组
var gradientStr = [
	{'.5': 'blue', '.8': 'green', '.95': 'white'},
	{'.5': 'red', '.8': 'pink', '.95': 'white'},
	{'.5': 'yellow','.8': 'green','.95': 'white'}
];
var heatmapInstance;
var allHeatmapInstance;

var btnStr="", pageStr=""; // 动态添加按钮和页面


function setup() {
	heatmapInstance = h337.create({
    	container: document.querySelector('#allHeatmapPage'),		// heatmap载体
 	});
 	// allHeatmapInstance = h337.create({
  //   	container: document.querySelector('#heatmap_1'),		// heatmap载体
 	// });
	// socket = io.connect('127.0.0.1:3000');
	socket = io.connect('10.130.161.26:3000');
	// $("#allHeatmapBtn")
	// socket = io.connect('https://collaborate-on-a-paint.herokuapp.com/');
	socket.on('sentpaint', setpainting);
	socket.on('sentmove', setmove);      		// 鼠标移动数据
	// socket.on('setHeatmapData', setHeatmap);    // 接收整体热力图数据，并画热力图 
	onlinecountdisplay = $('#onlinecount')[0];
	
	socket.on('userInfoArr', function(data) { // 每一次用户加入均执行这一步
		console.log(data.info) 

		userInfo = data.info; // 用户数据集
		cUserName = userInfo.cName;   // 当前用户名
		userArr = userInfo.uNameArr;  // 用户组名
		
		// 添加按钮和页面
		for(var i=0; i<userArr.length; i++) {
			btnStr  += '<li id="' + userArr[i] + 'HeatmapBtn">' + userArr[i] + '热力图</li> ';
			pageStr += '<div id="'+ userArr[i] + 'HeatmapPage" style="display: none;">1111</div>';
		}
		$("#allHeatmapBtn").after(btnStr);
		$("#allHeatmapPage").after(pageStr);
		// 显示用户组
		onlinecountdisplay.innerHTML = userInfo.uNameArr; 

		// 创建单人热力图
		 


	});

	// 菜单按钮点击事件
	$("#visualMenu").on("click", "li", function(e) {
		// 根据按钮Id确定目标页面Id
		var thisId = $(this).attr("id");
		var publicStr = thisId.substr(0, thisId.length-3);
		var thisPageId = publicStr + "Page";

		// 隐藏其他页面，显示目标页面
		$("#" + thisPageId).siblings().hide();
		$("#" + thisPageId).show();

		// socket.send()


	})
	
	thicknessbar = $('#size');
	thicknessindicator = $('#sizeval')[0];
	colorPallete = $('.color-pallete');
	activecol = $('.col');
	eraser = $('#eraser');
	
	pos = $('#pos')[0];
	pos.innerHTML = "";
	mycanvas = createCanvas(800, 400);
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
}

// document.onclick = function(event) {
$("#coPaintPage")[0].onmousemove = function(event) {
	var e = event || window.event;//为了兼容ie和火狐
	mmouseX = e.clientX;//鼠标所在的x坐标
	mmouseY = e.clientY;//鼠标所在的y坐标
	
	let data = {
		mmx: mmouseX,
		mmy: mmouseY
	}

	// console.log("x:" + mmouseX +",y" + mmouseY)


	setHeapMapData(mmouseX, mmouseY);
	
	socket.emit('move', data);

};

document.onclick = function() {
	console.log("ddd")
	socket.emit("getUser","请求用户名");
	socket.on("getUserName", function(data) {
		console.log(data)
		pos.innerHTML = data.username;

	} )
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

	var userName = data.user;
	var newOffsetX = data.data.mmx;
	var newOffsetY = data.data.mmy;
	// console.log("move" + userName)

	setHeapMapData(newOffsetX, newOffsetY);
	
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
function setHeapMapData(mouseX, mouseY) {

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
