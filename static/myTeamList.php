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
	<div class="row">
		<!-- 侧边栏 section-->
		<div class="col-xs-3 col-sm-3 col-md-2">
			<?php include "../includes/index-left-menu.inc.php"; ?>
		</div><!-- 侧边栏 section end -->
		
		<!-- 任务列表展示 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
				<!-- 右侧头部 -->
				<ol class="breadcrumb">
				  	<li>所在位置：</li>
				 	<li>团队管理</li>
				  	<li class="active">我的团队</li>
				</ol>
			    <table class="table table-striped">
		            <thead>
			            <tr>
			                <th>序号</th>
			                <th>团队名称</th>
			                <th>团队描述</th>
			                <th>团队邀请码</th>
			                <th>创建者</th>
			                <th>成员</th>
			                <th>管理</th>
			            </tr>
		            </thead>
		            <tbody>
		            	<!-- <div class="emptyTips" style="display: none; text-align: center;padding-top: 50px;">	
		            		您暂时还没有加入任何团队，请前往创建团队或者加入团队！
		            	</div> -->
		            	<?php include '../php/getTeam.php'; ?>
		        	</tbody>
	        	</table>
	        </div><!-- class="container" end -->
		</div> <!-- class="col" end -->
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
</body>
</html>