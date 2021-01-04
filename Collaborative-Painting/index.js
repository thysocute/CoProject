console.log('socket server is running');
const express = require('express');
const app = express();
const port = process.env.PORT || 3000
const server = app.listen(port);
app.use(express.static('public'));
console.log('listening at ' + port);
var socket = require('socket.io');
var io = socket(server);
io.sockets.on('connection', newConnection);
var userNameArr = [];
var oldNameArr = [];
var currentpaint = [];

var currentMove = []; // 鼠标移动数据集
var emptyArr = [];    // 空的数组 

setInterval(() => {
  currentpaint = [];
}, 60 * 5 * 1000);
setInterval(() => {
  currentMove = [];
}, 60 * 5 * 1000);
var usercount = 0;

var totalClick = 1;  // 所用用户点击次数
var clickArr = [];   // 每个用户点击次数存储





// userInfo = []; // 用户信息

function newConnection(socket) {
  // var userID = parseInt(socket.upgradeReq.url.substr(1), 10)
  // console.log(userID)
  for(cp of currentpaint) {
    // console.log(cp)
    socket.emit('sentpaint', cp);  // 发送
  }
  usercount++;
  var clickAccount = 1;
  clickUserIndex = usercount-1;                 // 当前用户点击次数
  clickArr.push(clickAccount);          // 将当前用户的点击次数到数组中
  var username = "user" + usercount;   // 当前用户名字

  if(!userNameArr.includes(username)) {
    userNameArr.push(username);

  }

  var userInfo = {
    "cName":username,
    "uNameArr": userNameArr
  };


  // 获取用户组信息
  io.emit('userInfoArr', {   // 发送人数
    info: userInfo
  });
  
  // 获取当前用户名
  socket.on('getUser', data => {   // 接收数据
    // console.log(data)
    socket.emit('getUserName', username);
    // currentpaint.push(data);
  });

  // 画画数据
  socket.on('painting', data => {   // 接收数据
    // console.log(data)
    socket.broadcast.emit('sentpaint', data);
    currentpaint.push(data);
  });
  // 鼠标移动数据
  socket.on('move', data => {   // 接收数据
    userData = {"user":username,"data":data}
    io.sockets.emit('sentmove', userData);
    currentMove.push(userData)
  });

  // 分别统计用户点击次数
  socket.on('workClick', data => {   // 接收数据

      clickAccount++; // 当前用户点击次数加一
      totalClick++;  // 点击总次数加一

      clickArr[clickUserIndex] = clickAccount;
      var clickData = {
        "cUserClick": clickArr,
        "totalClick": totalClick
      };

      io.sockets.emit('getClickData', clickData);

  });

  var userClickData = {
    "cUserClick": clickArr,
    "totalClick": totalClick
  };

  // 获取用户组信息
  io.sockets.emit('getUserClickData', {   // 发送人数
      initialData:userClickData
  });
  



 


  socket.on('disconnect', () => {   // 接收数据
    usercount--
    socket.broadcast.emit('usercount', {
      uc: usercount
    });
  })
}