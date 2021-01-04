<?php
	require_once('../includes/databaseConnection.php');
	session_start();
	require_once("../includes/checkLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../includes/head-meta-data.inc.php"; ?>
 	<link rel='stylesheet' href='../css/index.css' />
 	<!-- <link rel="stylesheet" type="text/css" href="../css/taskList.css"> -->
 	<style type="text/css">
		.updateBtn, .delBtn, .addBtn {
			color: #2bbbad;
			cursor: pointer;
		}
		.updateBtn:hover, .delBtn:hover, .addBtn:hover {
			color: blue;
		}
		iframe {
			width: 100%;
			position: relative;
			top: -10px;
		}
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
	<iframe style="z-index:99"  src="http://49.233.193.226:8000/" id="emailIframe" name="emailIframe" frameborder="0" scrolling="no" allowTransparency="true"  ></iframe>
</div>
<script type="text/javascript">

	$(function(){
	    // 菜单栏点击事件
	    $("#mainMenu li, #mobile_menu li").removeClass("active");
	    $("#coChat, #coChat_m").addClass("active");
	})

	var window_height = $(window).height();
	var minHeight = 500; 

	// 初始化
	if(window_height > minHeight) {
		$("iframe").height (window_height - 100);
	} else {
		$("iframe").height(window_height);
	}
	
	//当浏览器大小变化时
	$(window).resize(function () {      
		if(window_height > minHeight) {
			$("iframe").height (window_height - 100);
		} else {
			$("iframe").height(window_height);
		}
	});
	
</script>
</body>
</html>