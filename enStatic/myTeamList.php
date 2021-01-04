<?php
    require_once('../includes/databaseConnection.php');
  session_start();
  require_once("../includes/checkLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../enIncludes/head-meta-data.inc.php"; ?>
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
      <?php include "../enIncludes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->
    </div>
</header>
<div class="container">
	<div class="row">
		<!-- 侧边栏 section-->
		<div class="col-xs-3 col-sm-3 col-md-2">
			<?php include "../enIncludes/index-left-menu.inc.php"; ?>
		</div><!-- 侧边栏 section end -->
		
		<!-- 任务列表展示 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
				<!-- 右侧头部 -->
				<ol class="breadcrumb">
				  	<li>Location：</li>
				 	<li>Team Management</li>
				  	<li class="active">My Team</li>
				</ol>
			    <table class="table table-striped">
		            <thead>
			            <tr>
			                <th>Serial Number</th>
			                <th>Team Name</th>
			                <th>Team Describe</th>
			                <th>Invitation Code</th>
			                <th>Creator</th>
			                <th>Member</th>
			                <th>Management</th>
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