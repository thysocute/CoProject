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
 	<link rel="stylesheet" type="text/css" href="../css/create.css">
 	<style type="text/css">
		

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
		</div><!-- 组员 section end -->
		
		<!-- 关系图展示 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
				<!-- 右侧头部 -->
				<ol class="breadcrumb">
				  	<li>Location：</li>
				 	<li>Team Management</li>
				  	<li class="active">Create Team</li>
				</ol>
			    
			    <div class='formBox'>
			    	<!-- 标题 -->
			    	<div class="partTitle">
			    		<h4>Create Team</h4>
			    	</div>
			    	<!-- 表单 -->
			        <form class="form-horizontal" role="form" action="../php/addTeam.php" method="post">
			            <div class="form-group">
			                <label for="tname" class="control-label">Team Name:</label>
			                <input type="text" class="form-control"  name="tname" id="tname" placeholder="Please enter a team name">
			            </div>
			            <div class="form-group">
			                <label for="tdes" class="control-label">Team Description:</label>
			                <input type="text" class="form-control"  name="tdes" id="tdes" placeholder="Please enter a team description">
			            </div>
			            <div class="form-group">
			                <button type="submit" class="btn submitBtn">submit</button>
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