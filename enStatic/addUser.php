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
		<div  class="col-xs-9 col-sm-9 col-md-10">
			<div class="container">
			    <h5>Add Members</h5>
			    <hr/>
			    <div class='rows'>
			        <form role="form" action="../php/updateTask.php?pro_id=<?php echo $_GET['pro_id'];?>" method="post">
			            <div class="form-group">
			                <label>Number:</label>
			                <input type="text" class="form-control" name="pid" id="pid" 	value="<?php echo $_GET['pro_id'];?>">
			            </div>
			            <div class="form-group">
			                <label>Task Name:</label>
			                <input type="text" class="form-control"  name="pname" 
			                	id="pname" value="<?php echo $_GET['pro_name'];?>">
			            </div>
			            <div class="form-group">
		                    <label class="col-sm-2 control-label">Member Name</label>
	                        <select name ="select" οnchange="fuzhi(this.options[this.selectedIndex].text)">
	                            <option>-Please Select-</option>
	                            <?php
		                            $results = array(); 
									try {
									    // 内联查询
									    $sql = "SELECT account, username FROM users INNER JOIN user_info ON users.user_id=user_info.user_id";
									    $stmt = $pdo->query($sql);
									    while ($rows = $stmt->fetch()) {
									      	$results[] = array(
									            "account"   => $rows['account'],
									            "username"  => $rows['username'],
									      	);
									    }
									} catch (PDOException $e) {
									    echo "Error: $e";
									}
									// 循环输出列表
									if (!empty($results)) {
									  foreach ($results as $value) {
									    echo '<option value="'.$value['account'].'">'.$value['account']."  ".$value['username'].'</option>';
									  }
									}

	                            ?>
	                        </select>
	                        <!-- <input type="hidden" id="username" name="username" /> -->
	                        <script language="javascript">
	                            function fuzhi(a){
	                                document.getElementById("username").value=a;//赋值，咚咚
	                            }
	                        </script>
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