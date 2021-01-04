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
        <div id="main" style="height:500px; z-index: 10000" >关系可视化</div>
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
            <li>A408</li>
            <li>A410</li>
            <li class="active">C408</li>
          </ul>
        </div><!-- class="y-coordinate" END -->

        <div class="x-coordinate">
          <div class="col-sm-8 col-md-9">
            <input class="timeInput" type="range" id="timeInput" step="1" min="0" max="100" value="50"/>
          </div>
          <div class="col-sm-4 col-md-3">
            <div class="timeGroup">
              <span id="year">2020</span>
              <span id="month">09</span>
              <span id="day">05</span>
            </div>
            <span id="timeValue">50</span>
          </div>
          
          
        </div><!-- class="x-coordinate" END -->

      </div><!-- class="coordinate"> END -->
    </div> <!-- class="visualBox"  END -->
    <!-- 时空坐标轴 END-->

  </div> <!-- class="mainContent" end -->
</div> <!-- class="container" end -->
<script type="text/javascript">
  $(function() {
    // 菜单栏点击事件
    $("#mainMenu li, #mobile_menu li").removeClass("active");
    $("#coVisual").addClass("active");

    $("#timeInput").change(function() {
      $("#timeValue").text($(this).val());
    });

    
   /* location button click event*/
    $(".js_locationList li").each(function(i){
      $(this).click(function() {
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
      })
    });


  })
</script>
<script type="text/javascript">
  // 基于准备好的dom，初始化echarts实例
  var myChart = echarts.init(document.getElementById('main'));

  var jsonData = {"data":[
  {"category":0,"name":"task", "msg":"图像感知会议"},
  {"category":1,"name":"用户1","msg":"在线"}, 
  {"category":1,"name":"用户2","msg":"在线"}, 
  {"category":1,"name":"用户3","msg":"在线"},
  {"category":2,"name":"phone huawei p10","msg":"不在线"}, 
  {"category":2,"name":"labtop HUAWEI MateBook X","msg":"在线"}
],
"links":[ 
  {"source":"task"},
  {"source":"task","target":"用户1","value":"成员"}, 
  {"source":"task","target":"用户2","value":"成员"}, 
  {"source":"用户1","target":"phone huawei p10","value":"设备"}, 
  {"source":"用户2","target":"labtop HUAWEI MateBook X","value":"设备"}


]}

console.log(jsonData.links)
 // function(jsonData) 

  $.getJSON('../data/data.json', function (json) {
    var option = {
      title:{
        text:'协同工作环境',
        x:'right',
                y:'bottom'
      },
      legend: {
          x: 'left',
          data:['任务','人物','设备']
      },
      //鼠标移动元素到人物及设备上显示
      //tooltip{},
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
          layout:'force',//力布局
          symboSize:30,//节点大小
          roam:'move',//鼠标漫游
          force:{
            repulsion: 400,//节点之间的斥力因子
            edgeLength: [10, 50]//边的两个节点的距离
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

  
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    myChart.on('click', function (params) {
        window.open('https://www.baidu.com/s?wd=' + encodeURIComponent(params.data.name));
    });
  });
</script>
</body>
</html>