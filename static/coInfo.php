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
    <a class="linkBtn " href="./coVisual.php">实时图像感知</a>
    <a class="linkBtn active" href="./coInfo.php">协同场景信息可视化</a>
  </div> <!-- class="btnGroup" END -->

  <div class="mainContent">
    <div class="visualBox" style="position: relative;">

      <!-- ehcart 关系图 -->
      <div class="relationship">
        <div id="main" style="height:480px; z-index: 10000" >关系可视化</div>
        <div class="addition">
          <span class="colorIcon colorIcon_l"></span>
          <span class="textIcon">地点</span>
          <span class="colorIcon colorIcon_t"></span>
          <span class="textIcon">时间</span>
        </div>
      </div>
      <!-- ehcart 关系图 END--> 

      <!-- 时空坐标轴 -->
      <div class="coordinate">
       
        <div class="y-coordinate">
          <div class="y-zhou"></div>
          <ul class="y-content js_locationList">
          </ul>
        </div><!-- class="y-coordinate" END -->

        <div class="x-coordinate">
          <div class="col-sm-8 col-md-9">
            <input class="timeInput" type="range" id="timeInput" step="1"/>
          </div>
          <div class="col-sm-4 col-md-3" style="margin-top: -10px;">
            <div class="timeGroup">
              <span id="meetingTime" style="display: inline-block;width: 150px;">
              </span>
            </div>
            <span id="timeValue"></span>
            <ul id="hiddenTime" style="display: none;" >
              <li></li>
            </ul>
          </div>
          
          
        </div><!-- class="x-coordinate" END -->

      </div><!-- class="coordinate"> END -->
    </div> <!-- class="visualBox"  END -->
    <!-- 时空坐标轴 END-->

  </div> <!-- class="mainContent" end -->
</div> <!-- class="container" end -->
<script type="text/javascript" src="../js/draggable.js"></script>
<script type="text/javascript">
  $(function() {
    // 菜单栏点击事件
    $("#mainMenu li, #mobile_menu li").removeClass("active");
    $("#coVisual").addClass("active");

    console.log(navigator.onLine)
    console.log(navigator.appName)
    
    var oTimeInput = $("#timeInput");
    var oMeetingTime = $("#meetingTime");

    // 1、定义并初始化ECharts可视化关系图
    var myChart = echarts.init(document.getElementById('main'));
    // 2、 传入json数据，显示可视化
    function funECharts(json){
      console.log(json)
      var option = {
        legend: {
          x: 'left',
          data:['任务','人物','设备']
        },
        //鼠标移动元素到人物及设备上显示
        tooltip: { 
          formatter: function (params) {//连接线上提示文字格式化
            if (params.data.msg) {//注意判断，else是将节点的文字也初始化成想要的格式
              var msg = params.data.name + " : " + params.data.msg;
              return msg;
            } else if (params.data.value) {
              var msg = params.data.source + " --> " + params.data.value;
              return msg;
            } else {
              return "协同工作环境";
            }
          }
        },
        //动画
        animationDurationUpdate: 1500,
        animationEasingUpdate: 'quinticInOut',
        series:[
          {
            type:'graph',
            layout:'force',
            symboSize:30,//节点大小
            roam:'move',
            force:{
              repulsion: 200,//节点之间的斥力因子
              edgeLength: [10, 30]//边的两个节点的距离
            },
            categories : [
              {
                name: '任务',
                symbolSize:45,
              },
              {
                name: '人物',
                symbolSize:20,
              },
              {
                name: '设备',
                symbolSize:35,
                label: {
                  position: ['25%', 50],
                  show: true,
                },
              }
            ],
            draggable:true,
            focusNodeAdjacency:true,//突出显示连接的节点
            data: json.data.map(function (data) {
              return {
                name: data.name,
                category: data.category,
                msg: data.msg,
                value: data.value,
               };
            }),
            edges: json.links.map(function (link) {
              return {
                source: link.source,
                target: link.target,
                value:link.value
              };
            }),
            label: {
              position: ['25%', 50],
            },
            itemStyle: {
              borderColor: '#fff',
              borderWidth: 1,
              shadowBlur: 10,
              shadowColor: 'rgba(0, 0, 0, 0.3)'
            },
            lineStyle: {
              color: 'source',
              type:'solid',
              opacity: 0.9,
              width: 1,
              curveness: 0.25
            },
            emphasis: {
              lineStyle: {
                width: 5
              },
            },
          }
        ]
      };

    console.log("ok")
      // 使用刚指定的配置项和数据显示图表。
      myChart.setOption(option);
      console.log("ook")
      myChart.on('click', function (params) {
          window.open('https://www.baidu.com/s?wd=' + encodeURIComponent(params.data.name));
      });
    }

    // 3、可视化 lastestArr 一条数据的数组，并显示一条数据
    function funVisual(lastestArr) {
      // console.log(lastestArr)
        var location = lastestArr[0].meetingLocation;
        var mTime = lastestArr[0].meetingTime;
        var task = lastestArr[0].meetingTask;
        var mAndDArr = lastestArr[1];
        var deviceArr = [];
        var dataJsonStr = '';
        var dStr = "";
        // var members = lastestArr[1][0].member;
        // console.log(members)
        var dataStr = '{"data":[{"category":0,"name":"task","msg":"' + task + '"}';
        var linkStr = '"links":[{"source":"task"}';

        for(var k=0; k<mAndDArr.length; k++) {
          dataStr += ',{"category":1,"name":"' + mAndDArr[k].member + '","msg":"在线"}';
          linkStr += ',{"source":"task","target":"' + mAndDArr[k].member + '","value":"成员"}';

          deviceArr = mAndDArr[k].device;
          // console.log(deviceArr.length)
          dStr = "";
          for(var s=0; s<deviceArr.length; s++) {
            dStr += ',{"category":2,"name":"' + k*10+s + '","msg":"'+ deviceArr[s].deviceType+ " " + deviceArr[s].deviceModel +'"}';
            linkStr += ',{"source":"'+ mAndDArr[k].member +'","target":"' + k*10+s + '","value":"设备"}';
          }

          dataStr = dataStr + dStr;

        }
        dataStr = dataStr+"],";
        linkStr = linkStr+"]}";

        // JSON字符串
        dataJsonStr = dataStr + linkStr;
        // 字符串转化为JSON
        jsonData = $.parseJSON(dataJsonStr); 
        // console.log(jsonData)
        // 调用可视化显示
        funECharts(jsonData)
        
    }

   
     // console.log($(".js_locationList").html())

    // 通过ID页面载入
    var mID;
    var url = location.search;
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
      var str = url.substr(1); //substr()方法返回从参数值开始到结束的字符串；
      var strs = str.split("&");
      for (var i = 0; i < strs.length; i++) {
          theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
      }

      mID = theRequest.meeting_id;
      // console.log("参数", theRequest.meeting_id);
      //此时的theRequest就是我们需要的参数；
      $.ajax({
        url:'../php/idRequestMeeting.php',
        data:{id: theRequest.meeting_id},
        type:'POST',
        dataType:'json',
        success: function(searchData) {
          // console.log(searchData[0].meetingLocation)
          // console.log(searchData)
          // console.log(searchData.idSearchData)
          var timeLocalArr = searchData.timeAndLocal;   // 时间地点数组
          var idSearchDataArr = searchData.idSearchData;   // 一条数据
          var timeArr = [];         // 时间数组
          var locationArr = [];     // 地点数组
          var locationStr = '';     // 地点轴字符串
          var selectTimeStr = '';     // 地点轴字符串

          // 时间轴和地点轴
          for(var i=0; i<timeLocalArr.length; i++) {
            if($.inArray(timeLocalArr[i].meetingLocation, locationArr) < 0) {
              locationArr.push(timeLocalArr[i].meetingLocation);
              if(idSearchDataArr[0].meetingLocation != timeLocalArr[i].meetingLocation) {
                locationStr += '<li>' + timeLocalArr[i].meetingLocation + '</li>';
              } else {
                locationStr += '<li class="active">' + timeLocalArr[i].meetingLocation + '</li>';
              }
            }
            timeArr.push(timeLocalArr[i].meetingTime);
          }
          // 时间排序 从小到大
          timeArr.sort();

          // 将时间点保存在一个隐藏的li里
          $.each(timeArr, function(index, val){
            selectTimeStr += '<li>' + val + '</li>';
          });
          $("#hiddenTime").empty().append(selectTimeStr);


          $(".js_locationList").empty().append(locationStr);  // 设置地点轴
          oTimeInput.attr("max",timeArr.length);              // 设置时间轴input的Max值
          oTimeInput.attr("value",timeArr.length);            // 设置时间轴input的value值
          // console.log("kkk")

          oMeetingTime.text(idSearchDataArr[0].meetingTime);       // 设置时间轴的显示时间，为最新一场会议的时间

          funVisual(idSearchDataArr)
        },
        error:function(){
          alert("Failed");
        }
      });
    }  else {
        // 4、页面初始化，请求所有数据，并显示最后一条数据
      $.ajax({
        type: "GET",
        url: "../php/requestMeeting.php",
        data: {test:"haha"},
        dataType: "json",
        success: function(data){
          // console.log(data)
          var timeLocalArr = data.timeAndLocal;   // 时间地点数组
          var lastestArr   = data.lastestData;    // 最后一条数据数组

          var timeArr = [];         // 时间数组
          var locationArr = [];     // 地点数组
          var locationStr = '';     // 地点轴字符串
          var selectTimeStr = '';     // 地点轴字符串

          // 时间轴和地点轴
          for(var i=0; i<timeLocalArr.length; i++) {
            if($.inArray(timeLocalArr[i].meetingLocation, locationArr) < 0) {
              locationArr.push(timeLocalArr[i].meetingLocation);
              if(lastestArr[0].meetingLocation != timeLocalArr[i].meetingLocation) {
                locationStr += '<li>' + timeLocalArr[i].meetingLocation + '</li>';
              } else {
                locationStr += '<li class="active">' + timeLocalArr[i].meetingLocation + '</li>';
              }
            }
            timeArr.push(timeLocalArr[i].meetingTime);
          }
          // 时间排序 从小到大
          timeArr.sort();

          // 将时间点保存在一个隐藏的li里
          $.each(timeArr, function(index, val){
            selectTimeStr += '<li>' + val + '</li>';
          });
          $("#hiddenTime").empty().append(selectTimeStr);


          $(".js_locationList").empty().append(locationStr);  // 设置地点轴
          oTimeInput.attr("max",timeArr.length);              // 设置时间轴input的Max值
          oTimeInput.attr("value",timeArr.length);            // 设置时间轴input的value值

          oMeetingTime.text(lastestArr[0].meetingTime);       // 设置时间轴的显示时间，为最新一场会议的时间
          funVisual(lastestArr)   // 初始页面可视化
         
           
        },
        error: function(err) {
          console.log(err)
        }
      });

    }

   

    // 5、时间轴变化来显示可视化数据 点击
    var mTimeIndex = 0;     // 会议时间值
    var oTimeValue = $("#timeValue");
    var oTimeInput = $("#timeInput");
    oTimeInput.change(function() {
      mTimeIndex = $(this).val();
      // oTimeValue.text(mTimeIndex);

      if(mTimeIndex > 0) {
        // 根据时间显示可视化图表
        var mTimeValue = $("#hiddenTime li").eq(mTimeIndex-1).text();
        $("#meetingTime").text(mTimeValue);
        // 根据时间请求会议数据
        $.ajax({
          type: "GET",
          url: "../php/timeRequestMeeting.php",
          data: {selectTime: mTimeValue},
          dataType: "json",
          success: function(searchData) {
            // console.log(searchData[0].meetingLocation)
            $(".js_locationList li").removeClass("active");
            $(".js_locationList li").each(function(){
              if($(this).text() == searchData[0].meetingLocation) {
                $(this).addClass("active");
              }
            })

            funVisual(searchData)

          },
          error: function(err) {
            console.log(err);
          }
        });
        
      } // if END
      
    });  // change ENd 
    


   /* location button click event*/
    $(".js_locationList li").each(function(i){
      $(this).on("click", function() {
        console.log($(this).text())
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
      })
    });


  })
</script>
</body>
</html>