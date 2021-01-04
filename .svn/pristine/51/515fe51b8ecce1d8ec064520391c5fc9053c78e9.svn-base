<?php
	require_once('../includes/databaseConnection.php');
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../includes/head-meta-data.inc.php"; ?>
 	<link rel='stylesheet' href='../css/index.css' />
 	<link rel="stylesheet" type="text/css" href="../css/create.css">
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
		</div><!-- 组员 section end -->
		
		<!-- 关系图展示 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
				<!-- 右侧头部 -->
				<ol class="breadcrumb">
				  	<li>所在位置：</li>
				 	<li>团队管理</li>
				  	<li class="active">创建团队</li>
				</ol>

			    <div class='formBox'>
			    	<!-- 标题 -->
			    	<div class="partTitle">
			    		<h4>加入团队</h4>
			    	</div>
			    	<!-- 表单 -->
			        <form role="form" action="../php/joinTeam.php" method="post">
			            <div class="form-group">
			                <label for="teamCode" class="control-label">邀请码：</label>
			                <input type="text" class="form-control" name="teamCode" id="teamCode" 	placeholder="请输入团队加入邀请码">
			            </div>
			            <div class="form-group">
			                <button type="submit" class="btn submitBtn">提交</button>
			            </div>
			        </form>
			    </div>
			</div>
		</div>
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<!-- <script src="../js/view.js"></script> -->
</body>
</html>