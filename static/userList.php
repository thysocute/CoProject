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
				 	<li>用户管理</li>
				  	<li class="active">用户列表</li>
				</ol>
				<!-- 用户列表 -->
			    <table class="table table-striped">
		            <thead>
			            <tr>
			                <th>序号</th>
			                <th>账号</th>
			                <th>用户名</th>
			                <th>电子邮箱</th>
			                <th>电话号码</th>
			            </tr>
		            </thead>
		            <tbody>
		            	<?php include '../php/getUser.php'; ?>
		        	</tbody>
	        	</table>
	        </div><!-- class="container" end -->
		</div> <!-- class="col" end -->
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<!-- <script src="../js/view.js"></script> -->
<script type="text/javascript">
	// 删除按钮
	/*$("table tbody").on("click",".delBtn",function(event){
		var globalClickedTask = $(this).attr("data-id");
		// console.log($(this).attr("data-id"))
		$.ajax({
			url:'../php/deleteTask.php',
			data:{id: globalClickedTask},
			type:'POST',
			dataType:'json',
			success:function(data){
				console.log(data)

				location.reload();
			},
			error:function(){
				alert("Failed");
			}
				
		});
 	});*/
 	/*$("table tbody").on("click",".updateBtn",function(event){
		var globalClickedTask = $(this).attr("data-id");
		
		$.ajax({
			url:'./updateTaskList.php',
			data:{id: globalClickedTask},
			type:'POST',
			dataType:'json',
			success:function(data){
				console.log(data)
				window.location.href = "./updateTaskList.php";
				// location.reload();
			},
			error:function(){
				alert("Failed");
			}
				
		});
 	});*/
</script>
</body>
</html>