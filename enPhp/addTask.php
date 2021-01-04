<?php
session_start();
require_once '../includes/databaseConnection.php';

// 如果提交内容不为空
if (!empty($_POST)) {
  $taskName = $_POST['taskName'];     // 任务名称
  $taskDes  = $_POST['taskDes'];     // 任务描述
  $teamId     = $_POST['partTeam'];     // 参与团队ID
  $isCreator  = 1;     // 创建者

  if (empty($taskName)) {
    echo "Please fill in the task name！";
    exit();

  } else {
    $account = $_SESSION["account"];
    $username = $_SESSION["username"];
    $isCreator = 1;      // 是否为创建者， 1表示是，0表示不是
    
    // 查询表team 获得表名
    $sql = "SELECT team_name FROM team WHERE team_id = $teamId";
    $teamName = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["team_name"];


    try {
      $pdo->beginTransaction();
      // team表
      $sql = "INSERT INTO task(task_name, task_describe) 
              VALUES(:taskName, :taskDes);";

      $statement = $pdo->prepare($sql);

      $statement->bindParam(":taskName", $taskName);
      $statement->bindParam(":taskDes", $taskDes);
      /*$statement->bindParam(":ptId", $ptId);
      $statement->bindParam(":ptName", $ptName);
      $statement->bindParam(":isCreator", $isCreator);*/
      $statement->execute();

      $taskId = $pdo->lastInsertId();

      // team_user表
      $statement = $pdo->prepare("INSERT INTO task_team(task_id, team_id, team_name, account, username, is_creator) 
          VALUES(:taskId, :teamId, :teamName, :account, :username, :isCreator);");
      $statement->bindParam(":taskId", $taskId);
      $statement->bindParam(":teamId", $teamId);
      $statement->bindParam(":teamName", $teamName);
      $statement->bindParam(":account", $account);
      $statement->bindParam(":username", $username);
      $statement->bindParam(":isCreator", $isCreator);
      $statement->execute();

      // 提交事务
      $pdo->commit();


      // header() 函数向客户端发送原始的 HTTP 报头。
      header('Location: ../static/taskList.php');
    } catch (PDOException $e) {
      $pdo->rollback();
      echo "Error $e";
    }
  }
}
?>
