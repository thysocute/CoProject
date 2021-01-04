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
  <div class="row">
    <div class="col s12 m6">
      <div class="leftTop">
        <div class="videoBox"></div>
      </div>
      <div class="leftBottom">
        <div class="realData"></div>
      </div>
    </div>
    <div class="col s12 m6">

    </div>
  </div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<script type="text/javascript">

  $(function(){
    // 菜单栏点击事件
    $("#mainMenu li, #mobile_menu li").removeClass("active");
    $("#coVUI, #coVUI_m").addClass("active");
  })

</script>
</body>
</html>