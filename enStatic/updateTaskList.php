<?php
	require_once('../includes/databaseConnection.php');
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../enIncludes/head-meta-data.inc.php"; ?>
 	<link rel='stylesheet' href='../css/index.css' />
 	<link rel="stylesheet" type="text/css" href="../css/createTask.css">
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
		
		<!-- 修改任务 -->
		<div class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
			    <h5>Alter Task</h5>
			    <hr/>
			    <div class='rows'>
			        <form role="form" action="../php/updateTask.php?pro_id=<?php echo $_GET['pro_id'];?>" method="post">
			            <div class="form-group">
			                <label>Serial Number:</label>
			                <input type="text" class="form-control" name="pid" id="pid" 	value="<?php echo $_GET['pro_id'];?>">
			            </div>
			            <div class="form-group">
			                <label>Task Name:</label>
			                <input type="text" class="form-control"  name="pname" 
			                	id="pname" value="<?php echo $_GET['pro_name'];?>">
			            </div>
			            <div class="form-group">
			                <button type="submit" class="btn btn-default">Submit</button>
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