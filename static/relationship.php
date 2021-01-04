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
 	<script src="../themes/d3js/d3.v5.min.js"></script>
	<script src="../themes/d3js/d3-dsv.v1.min.js"></script>
	<script src="../themes/d3js/d3-fetch.v1.min.js"></script>
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
		<!-- 侧边栏 section-->
		<div class="col-xs-3 col-sm-3 col-md-2">
			<?php include "../includes/index-left-menu.inc.php"; ?>
		</div><!-- 侧边栏 section end -->
		
		<!-- 关系图展示 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="right-content"></div>
		</div>
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<footer>
	<?php include "../includes/footer.inc.php"; ?>
</footer>
<!-- <script src="../js/view.js"></script> -->
<script type="text/javascript">
	 $(function(){
	    // 菜单栏点击事件
	    $("#mainMenu li, #mobile_menu li").removeClass("active");
	    $("#user, #user_m").addClass("active");
	  })
</script>
</body>
</html>