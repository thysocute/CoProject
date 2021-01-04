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
      <?php include "../enIncludes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->
    </div>
</header>
<div class="container">
	<div class="row">
		<!-- 侧边栏 section-->
		<div class="col-xs-3 col-sm-3 col-md-2">
			<?php include "../enIncludes/index-left-menu.inc.php"; ?>
		</div><!-- 组员 section end -->
		
		<!-- 关系图展示 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
				<!-- 右侧头部 -->
				<ol class="breadcrumb">
				  	<li>Location：</li>
				 	<li>Task Management</li>
				  	<li class="active">New Task</li>
				</ol>
			    
			    <div class='formBox'>
			    	<!-- 标题 -->
			    	<div class="partTitle">
			    		<h4>New Task</h4>
			    	</div>
			        <form role="form" action="../enPhp/addTask.php" method="post"  name="taskForm">
			            <div class="form-group">
			              	<label for="taskName" class="control-label">Task Name:</label>
			              	<input type="text" class="form-control"  name="taskName" 
			                	id="taskName" placeholder="Please enter the task name">
			            </div>
			            <div class="form-group">
			              	<label for="taskDes" class="control-label">Task Description:</label>
			              	<input type="text" class="form-control"  name="taskDes" 
			              	id="taskDes" placeholder="Please enter the task description">
			          	</div>
			            <div class="form-group">
			            	<!-- <input type="hidden" value="" name="partTeamVal" id="partTeamVal"> -->
			              	<label for="partTeam" class="control-label">Participate in the team:</label>
			              	<select id="partTeam" class="selectStyle" size="1" name="partTeam">
			              		<?php include '../enPhp/getPartTeam.php'; ?>
											<!-- <option value="">未进行</option> -->
						  	</select>
										
			            </div>
			            <div class="form-group">
			              	<button type="submit" class="btn submitBtn">Submit</button>
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