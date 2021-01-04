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
  <?php include "../enIncludes/head-meta-data.inc.php"; ?>
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
    <?php include "../enIncludes/navigation-bar.inc.php"; ?>
    <!-- End of Navigation Bar -->
  </div>
</header>
<div class="container">
  <!--  btnGroup  -->
  <div class="btnGroup">
    <a class="linkBtn active" href="./coVisual.php">Real-time image perception</a>
    <a class="linkBtn" href="./coInfo.php">Collaborative scene information visualization</a>
  </div> <!-- class="btnGroup" END -->

  <div class="topPart row">
    <div class="col-md-6">
      <div class="videoBox">Video-streamming</div>
    </div> <!-- class="col-md-6" END -->
    <div class="col-md-6">
      <div class="videoBox">Result video-streamming</div>
    </div> <!-- class="col-md-6" END -->
  </div> <!-- class="topPart row" END -->
 
  <div class="bottomPart row">
    <div class="col-md-6">
      <div class="padding_18">
        <ul class="imglistBox">
          <li>
            <img src="../img/qianxi.jpg">
            <p class="nameInfo">yiyangqianxi</p>
          </li>
          <li>
            <img src="../img/zjz.jpg">
            <p class="nameInfo">yiyangqianxi</p>
          </li>
          <li>
            <img src="../img/ni.jpg">
            <p class="nameInfo">yiyangqianxi</p>
          </li>
          <li>
            <img src="../img/qianxi.jpg">
            <p class="nameInfo">yiyangqianxi</p>
          </li>
          <li>
            <img src="../img/qianxi.jpg">
            <p class="nameInfo">yiyangqianxi</p>
          </li>
        </ul>
      </div><!--  class="padding_18" END -->
    </div> <!-- class="col-md-6" END -->
    <div class="col-md-6">
      <div class="padding_18">
        <ul class="deviceBox">
          <li>
            <img src="../img/pc.png">
            <p>Desktop Computer</p>
            <p>
              <span class="deviceNum">0</span>
            </p>
          </li>
          <li>
            <img src="../img/laptop.png">
            <p class="nameInfo">Laptop Computer</p>
            <p>
              <span class="deviceNum">0</span>
            </p>
          </li>
          <li>
            <img src="../img/tablet.png">
            <p class="nameInfo">Tablet Computer</p>
            <p>
              <span class="deviceNum">0</span>
            </p>
          </li>
          <li>
            <img src="../img/phone.png">
            <p class="nameInfo">Mobile Phone</p>
            <p>
              <span class="deviceNum">0</span>
            </p>
          </li>
        </ul>
      </div><!-- class="padding_18" END -->
    </div> <!-- class="col-md-6" END -->
  </div><!--  class="bottomPart row" END -->


</div> <!-- class="container" end -->

<script type="text/javascript">

  $(function(){
    // 菜单栏点击事件
    $("#mainMenu li, #mobile_menu li").removeClass("active");
    $("#coVisual").addClass("active");
  })

</script>
</body>
</html>