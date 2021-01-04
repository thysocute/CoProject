<?php
	require_once('../includes/databaseConnection.php');
	session_start();
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
			<!-- <div class="container"> -->
				<!-- 右侧头部 -->
				<ol class="breadcrumb">
				  	<li>所在位置：</li>
				 	<li>会议管理</li>
				  	<li class="active">会议列表</li>
				</ol>
			    <table class="table table-striped">
		            <thead style="text-align:center;">
			            <tr >
			                <th>序号</th>
			                <th>会议主题</th>
			                <th style="width: 25%;">会议描述</th>
			                <th style="width: 15%;">会议时间</th>
			                <th>会议地点</th>
			                <th>创建者</th>
			                <th>状态</th>
			            </tr>
		            </thead>
		            <tbody>
		            	<?php include '../php/getMeeting.php'; ?>
		        	</tbody>
	        	</table>
	        <!-- </div> --><!-- class="container" end -->
		</div> <!-- class="col" end -->
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<!-- <script src="../js/view.js"></script> -->
<script type="text/javascript">
	// 删除按钮
	// $("table tbody").on("click",".meetBtn",function(event){
	// 	var globalMeeting = $(this).attr("data-id");
	// 	// console.log($(this).attr("data-id"))
	// 	$.ajax({
	// 		url:'../php/.php',
	// 		data:{id: globalClickedTask},
	// 		type:'POST',
	// 		dataType:'json',
	// 		success:function(data){
	// 			console.log(data)

	// 			location.reload();
	// 		},
	// 		error:function(){
	// 			alert("Failed");
	// 		}
				
	// 	});
 // 	});
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