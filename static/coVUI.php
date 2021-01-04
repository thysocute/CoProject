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
    <div >
      <iframe class="recIframe" src="http://172.16.16.249:8080" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no"  allowTransparency="true"></iframe>
    </div>
  </div>
</header>

<!-- <iframe class="recIframe" src="http://172.16.16.249:8080" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no"  allowTransparency="true"></iframe> -->

<div class="container">
  <!--  btnGroup  -->
 <!--  <div class="btnGroup">
    <a class="linkBtn active" href="./coVisual.php">实时图像感知</a>
    <a class="linkBtn" href="./coInfo.php">协同场景信息可视化</a>
  </div>  -->
  <!-- class="btnGroup" END -->

  <div class="topPart row">

    <!-- <div class="col-md-12">
      <iframe class="recIframe" src="http://172.16.16.249:8080" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no"  allowTransparency="true"></iframe>
    </div> -->
  </div> <!-- class="topPart row" END -->
 
</div> <!-- class="container" end -->



  <!-- <footer>
    <?php include "../includes/footer.inc.php"; ?>
  </footer> -->
<script type="text/javascript">

  $(function(){
    // 菜单栏点击事件
    $("#mainMenu li, #mobile_menu li").removeClass("active");
    $("#coVUI, #coVUI_m").addClass("active");
  })

</script>
</body>
</html>