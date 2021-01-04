<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database
    
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/11
 * Time: 上午8:20
 */

$account = $_SESSION['account'];

/* 日程管理模块的所有团队用户
 *
 * 根据account从team_user表中获取team_id
 * 不为空时，从根据team_id从表team中获取team名
 * 同时将该team_id对应的team_user下的所有username返回
 * 
 */

$teamGroup = array(); // 团队组
$nameGroup = array(); // 团队组
try {
    $sql = "SELECT team_id FROM team_user WHERE account= $account";
    $stmt_1 = $pdo->query($sql);

    // 查询团队不为空
    if (!empty($stmt_1)) {
      echo '<div class="col s12" ><div class="sideMenu" style="margin: 15px 0;">';
      echo '  <h5 style="margin:0 auto 35px;">所在团队</h5>';

      while ($row = $stmt_1->fetch()) {
        // 获取组名
        $sqlName = "SELECT team_name FROM team WHERE team_id= '".$row["team_id"]."'";
        $teamName = $pdo->query($sqlName)->fetch();

        echo '<h3 class="firstBar">'.$teamName['team_name'].'</h3>';
        echo '<ul class="secondBar" style="display: block;">';
        // echo '  <ul class="secondBar">';

        // 每个team_id --> $row['team_id']
        $sql = "SELECT username FROM team_user WHERE team_id= '".$row["team_id"]."'";
        $stmt_2 = $pdo->query($sql);

        while ($userName = $stmt_2->fetch()) {
          // 循环输出名字
          echo  '<li>'.$userName['username'].'</li>';
        }
        echo '</ul>';
        
      }
      echo " </div></div>";
    }
    
} catch (PDOException $e) {
    echo "Error: $e";
}

?>
