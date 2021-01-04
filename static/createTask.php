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
				 	<li>任务管理</li>
				  	<li class="active">新建任务</li>
				</ol>
			    
			    <div class='formBox'>
			    	<!-- 标题 -->
			    	<div class="partTitle">
			    		<h4>新建任务</h4>
			    	</div>
			        <form role="form" action="../php/addTask.php" method="post"  name="taskForm">
			            <div class="form-group">
			              	<label for="taskName" class="control-label">任务名称:</label>
			              	<input type="text" class="form-control"  name="taskName" 
			                	id="taskName" placeholder="请输入任务名称">
			            </div>
			            <div class="form-group">
			              	<label for="taskDes" class="control-label">任务描述:</label>
			              	<input type="text" class="form-control"  name="taskDes" 
			              	id="taskDes" placeholder="请输入任务描述">
			          	</div>
			            <div class="form-group">
			            	<!-- <input type="hidden" value="" name="partTeamVal" id="partTeamVal"> -->
			              	<label for="partTeam" class="control-label">参与团队:</label>
			              	<select id="partTeam" class="selectStyle" size="1" name="partTeam">
			              		<?php include '../php/getPartTeam.php'; ?>
											<!-- <option value="">未进行</option> -->
						  	</select>
										
			            </div>
			            <div class="form-group">
			              	<button type="submit" class="btn submitBtn">提 交</button>
			            </div>
	        		</form>
		    	</div>
			</div>
		</div>
	</div> <!-- class="row" end -->
</div> <!-- class="container" end -->
<!-- <script type="text/javascript">
$(function(){
		$("#submit").click(function(){
			var options = $("#select option:selected");
			var selects = document.getElementById("select");
      var indexs = selects.selectedIndex;  //选中项的索引
			//selects.options[indexs].value;
			alert(selects.options[indexs].text);
		});
        
})
</script> -->
</body>
</html>