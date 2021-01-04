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


  

function setup() {
	// socket = io.connect('127.0.0.1:3000');
	socket = io.connect('10.130.161.26:3000');
	// socket = io.connect('https://collaborate-on-a-paint.herokuapp.com/');
	socket.on('sentpaint', setpainting);
	socket.on('sentmove', setmove);
	onlinecountdisplay = $('#onlinecount')[0];
	oCurrentUser = $('#currentUser')[0];

	// socket.on('currentUser', function(data) {
	// 	ccuser = data.cUser;
	// 	console.log(data.cUser)
	// });
	// console.log(namm)
	// console.log(namm.length)
	socket.on('userInfoArr', function(data) { // 每一次用户加入均执行这一步
		console.log(data.info) 

		userInfo = data.info; // 用户数据集
		cUserName = userInfo.cName;   // 当前用户名
		userArr = userInfo.uNameArr;  // 用户组名

		onlinecountdisplay.innerHTML = userInfo.uNameArr; // 输出用户组
		oCurrentUser.innerHTML = cUserName;
		// console.log(data.cName)
		// if()
		
		console.log(userArr)
		
		cUserIndex = $.inArray(cUserName, userArr);  // 当前用户所在用户数组中的位置
		// 创建热力图
		heatmapObject = heatmapCreatFun(cUserIndex,gradientStr[cUserIndex]); 
		// 添加热力图对象名
		heatmapNameArr.push(heatmapObject);
		// 添加新的一维数组
		points.push(newArr);        
		// console.log(cUserIndex)
	});
	
	thicknessbar = $('#size');
	thicknessindicator = $('#sizeval')[0];
	colorPallete = $('.color-pallete');
	activecol = $('.col');
	eraser = $('#eraser');
	
	pos = $('#pos')[0];
	pos.innerHTML = "";
	mycanvas = createCanvas(300, 400);
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

document.onclick = function(event) {
	var e = event || window.event;//为了兼容ie和火狐
	mmouseX = e.offsetX;//鼠标所在的x坐标
	mmouseY = e.offsetY;//鼠标所在的y坐标
	// console.log("move:" + mouseX + " " + mouseY)
	// setHeapMapData(cUserIndex,mouseX, mouseY);
	// alert(cUserName)
	let data = {
		mmx: mmouseX,
		mmy: mmouseY
	}

	thisUserName = oCurrentUser.innerHTML;
	thisIndex = $.inArray(thisUserName, userArr);

	// var str= '<p>'+ data.mmx + ":"  + data.mmy +'</p>';
	// pos.append(str);

	// console.log("click：" +ccuser )
	// console.log(userArr)

	// setHeapMapData(thisIndex, mmouseX, mmouseY);
	
	socket.emit('move', data);

};


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

	console.log(userName)
	console.log(userArr)

	// 用户在数组中的位置
	// 如果该用户不存在该用户数组中，即为新用户，则加入用书数组中，同时创建新的热力图对象
	// 若存在用户数组中，即为旧用户，不用做创建热力图对象操作
	var cIndex = userArr.indexOf(userName);  // 当前用户在用户数组中的位置
	// console.log(userArr)
	// console.log(cUserIndex)
	// if(cUserIndex == -1) {
	// userArr.push(userName);
	// cUserIndex = $.inArray(userName, userArr);
	// 创建热力图
	// heatmapObject = heatmapCreatFun(cIndex,gradientStr[cUserIndex]); 
	// 添加热力图对象名
	// heatmapNameArr.push(heatmapObject);
	// 创建数组存储数据
	// points.push(newArr)  
		// console.log(points.length)
		// console.log(points)
	// }
	
	// console.log(cUserIndex)
	// console.log(points)
	setHeapMapData(cIndex, newOffsetX, newOffsetY);
	
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
function heatmapCreatFun(cUserIndex,gradientArr) {
	
	var heatmapName = "heatmapInstance" + cUserIndex;
	// console.log(heatmapName);

	heatmapName = h337.create({
    	container: document.querySelector('#heatmap'),		// heatmap载体
    	gradient: gradientArr,
		});
	return heatmapName;
}

// 传递参数，显示热力图
function setHeapMapData(cUserIndex, mouseX, mouseY) {

	var point = {
		x: mouseX,
		y: mouseY,
		value: val
	};
	// console.log(pointss[currentUser])
	// console.log(points.length)
	// console.log(cUserIndex)

	// console.log("cUserIndex" + cUserIndex)
	// console.log("heatmapNameArr")
	// console.log(heatmapNameArr)
	// console.log("points")
	// console.log(points)
	// console.log("mouseX" + mouseX)
	// console.log("mouseY" + mouseY)

	points[cUserIndex].push(point);   // 热力点坐标
	// console.log("points[cUserIndex]")
	// console.log(points[cUserIndex])
	var dataArr = {
		max: maxVal,
		// min: minVal,
		data: points[cUserIndex]
	};

	heatmapNameArr[cUserIndex].setData(dataArr);
	// heatmapInstance1.setData(dataArr1);
}
