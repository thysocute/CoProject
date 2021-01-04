<?php session_start();?>
<?php include "../includes/checkLogin.php"; ?>
<?php
  require_once('../includes/databaseConnection.php');
    // session_start();
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../includes/head-meta-data.inc.php"; ?>
  <!-- <link rel='stylesheet' href='../fullcalendar/fullcalendar.css' /> -->
  <link rel='stylesheet' href='../css/index.css' />
  <link rel="stylesheet" href="../css/coVisual.css">
  <script src="https://cdn.staticfile.org/echarts/4.3.0/echarts.min.js"></script>
  <script src="http://libs.baidu.com/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript" src="../data/data.json?callback=dataJson"></script>
  <style type="text/css">

  </style>
</head>
<body>
<header>
  <div>
    <!-- Navigation Bar -->
    <?php include "../includes/navigation-bar.inc.php"; ?>
    <!-- End of Navigation Bar -->
  </div>
</header>
<div class="container">
  <!--  btnGroup  -->
  <div class="btnGroup">
    <a class="linkBtn active" href="./coVisual.php">实时图像感知</a>
    <a class="linkBtn" href="./coInfo.php">协同场景信息可视化</a>
  </div> <!-- class="btnGroup" END -->

  <div class="topPart row">

    <div class="col-md-12">
      <div id="meetContent"  class="row meetContent">
        <div class="col-md-10">
          <ul>
            <li>会议主题: <span id="meetTopic"></span></li>
            <li>会议时间: <span id="meetTime"></span></li>
            <li>会议地点: <span id="meetLocal"></span></li>
          </ul>
        </div>
        <div class="col-md-2"><button id="endMeet">结束会议</button></div>
      </div>
      <iframe id="recIframe" class="recIframe" src="http://172.16.16.249:8981" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no"  allowTransparency="true" ></iframe>
      <!-- <div id="askDiv" class="askDiv">
        <button id="startMeet">点击开启会议</button>
      </div> -->
    </div>
  </div> <!-- class="topPart row" END -->
 
</div> <!-- class="container" end -->

<script type="text/javascript">
  $(function(){
    // 跨域 
    document.domain = "172.16.16.249";
    // document.domain = "192.168.137.82";
    // document.domain = "172.26.235.50";
    // 点击首页的 "开启会议" 按钮,进入该页面，并接收meeting_id参数
    var mID;
    var url = location.search;  // 浏览器中的URL
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
      var str = url.substr(1); //substr()方法返回从参数值开始到结束的字符串；
      var strs = str.split("&");
      for (var i = 0; i < strs.length; i++) {
          theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
      }
      //此时的theRequest就是我们需要的参数；
      mID = theRequest.meeting_id;
      
      // 通过meeting_id获得会议信息，包括会议主题、会议时间、会议地点
      $.ajax({
        url:'../php/startMeeting.php',
        data:{id: theRequest.meeting_id},
        type:'POST',
        dataType:'json',
        success:function(data){
          console.log(data)
          $("#meetTopic").text(data[0].meetingTask);
          $("#meetTime").text(data[0].meetingTime);
          $("#meetLocal").text(data[0].meetingLocation);
        },
        error:function(){
          alert("Failed");
        }
      });
    }

    // 菜单栏点击事件
    $("#mainMenu li, #mobile_menu li").removeClass("active");
    $("#coVisual").addClass("active");
    
    
    // iframe加载后执行操作  跨域获得iframe嵌入页面里的内容
    var newNameArr = []; // 新的名字数组
    document.getElementById("recIframe").onload=function(){
      var childIframe = document.getElementById("recIframe");  //iframe 子元素
      var oPersonStr = $("#recIframe").contents().find("#personStr");
      // 监测oPersonStr的变化，一旦有数据插入，就执行操作
      oPersonStr.on('DOMNodeInserted',function(e){
        var nameStr = $(this).text();     // 获得名字字符串
        var nameArr = nameStr.split(","); // 将名字字符串转化为名字数组
        // 对比名字，如果存在则不加入新的数组中，若不存在，则加入新的数组中
        for(var i=0; i<nameArr.length; i++) {
          if($.inArray(nameArr[i], newNameArr) == -1) {
            newNameArr.push(nameArr[i]); 
          }
        }
        
      });
    };
    
    var oRecIframe = $("#recIframe");
    var oEndMeet = $("#endMeet");
    var mTask  = "";      // 会议主题
    var mTime  = "";      // 会议时间
    var mLocal = "";      // 会议地点
    var mMember = [];     // 与会人员
    var mDevice = [];     // 会议设备

    // 点击“结束会议”按钮切换为div
    oEndMeet.on("click", function() {
      // 会议结束，获取会议主题、会议时间、会议地点、与会人员信息
      oRecIframe.css("display","none")
      mTask = $("#meetTopic").text();
      mTime = $("#meetTime").text();
      mLocal = $("#meetLocal").text();
      mMember = newNameArr.toString()
      
      // 把会议相关信息保存到数据库中
      $.ajax({
        url:'../php/endMeeting.php',
        data:{mID: mID, mTask: mTask, mTime:mTime, mLocal:mLocal,mMember: mMember},
        type:'POST',
        dataType:'json',
        success:function(data){
          window.location.href = "http://172.16.16.249/coProject/static/coInfo.php?meeting_id=" + data;
        },
        error:function(){
          alert("Failed");
        }
      });
    });
  })



</script>
</body>
</html>