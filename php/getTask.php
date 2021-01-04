<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

/** 
 * 个人参与了哪些团队，这些团队又有什么任务
 * 通过account从team_user表中获得team_id
 * 通过team_id从task_team表获得task_id
 * 
 **/
$account = $_SESSION["account"];

// team_id组 
$sql = "SELECT team_id FROM team_user WHERE account= $account";
$team_stmt = $pdo->query($sql);

if (empty($team_stmt)) {
  echo '<tr>';
  echo   '<td colspan="6" style="text-align:center;">';
  echo     '您暂时还没有参与任何任务，请前往创建任务！';
  echo   '</td>';
  echo '</tr>';
  exit();

} else {
  $results = array(); // 

  while ($teamRows = $team_stmt->fetch()) {

    try {
      // 通过单team_id从表task_team表中获得task_id组
      $sql = "SELECT task_id FROM task_team WHERE team_id = '".$teamRows['team_id']."'";
      $tt_stmt = $pdo->query($sql);

      while ($taskRows = $tt_stmt->fetch()) {
        try { 
          // 用单个task_id从表task中获得任务信息
          $sTaskId = $taskRows['task_id']; // 单个team_id

          // 查询表team_user 获得创建者
          $sql = "SELECT username FROM task_team WHERE task_id = $sTaskId AND is_creator = 1";
          $creator = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["username"];

          // 查询表team_user 获得参与团队
          $sql = "SELECT team_name FROM task_team WHERE task_id = $sTaskId";
          $teamName = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["team_name"];

          // 查询表task获得任务信息
          $sql = "SELECT * FROM task WHERE task_id = $sTaskId";
          $task_stmt = $pdo->query($sql);

          while ($taskRows = $task_stmt->fetch()) {
            try { 
              // 结果集合
              $results[] = array(
                "taskId"    => $taskRows['task_id'],
                "taskName"  => $taskRows['task_name'],
                "taskDesc"  => $taskRows['task_describe'],
                "teamName"  => $teamName,
                "creator"   => $creator,
              );
              

            } catch (PDOException $e) {
                  echo "Error: $e";
            }
          }


        } catch (PDOException $e) {
              echo "Error: $e";
        }
      }

    } catch (PDOException $e) {
        echo "Error: $e";
    }
  }
  // echo json_encode($results);
  

  // 循环输出列表
  if (!empty($results)) {
    $index = 1;
    foreach ($results as $value) {
      echo '<tr>';
      echo '  <td>'.$index.'</td>';
      echo '  <td>'.$value['taskName'].'</td>';
      echo '  <td>'.$value['taskDesc'].'</td>';
      echo '  <td>'.$value['teamName'].'</td>';
      echo '  <td>'.$value['creator'].'</td>';
      echo '  <td>';
      echo '    <a href="../static/updateTaskList.php?task_id='.$value['taskId'].'&task_name='.$value['taskName'].'">修改</a>';
      echo '    <a href="../php/deleteTeam.php?task_id='.$value['taskId'].'&account='.$account.'">删除</a>';
      echo '    <a href="../static/addUser.php?task_id='.$value['taskId'].'&team_name='.$value['taskName'].'">添加成员</a>';
      echo '  </td>';
      echo '</tr>';
      $index++;
    }
  }

}
?>
