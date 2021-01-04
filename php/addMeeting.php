<?php
session_start();
require_once '../includes/databaseConnection.php';

// 如果提交内容不为空
if (!empty($_POST)) {
  $mTask = $_POST['meetingTask'];     // 会议主题
  $mDes  = $_POST['meetingDes'];     // 会议描述
  $mTime     = $_POST['meetingTime'];     // 会议时间
  $mLocaltion     = $_POST['meetingLocaltion'];     // 会议地点


  if (empty($mTask)) {
    echo "请填写会议主题！";
    exit();

  } else {
    $account = $_SESSION["account"];
    $username = $_SESSION["username"];
    $isCreator = 1;      // 是否为创建者， 1表示是，0表示不是
    $isHasDone = 0;      // 是否已完成， 1表示是，0表示不是

    try {
      $pdo->beginTransaction();
      // team表
      $sql = "INSERT INTO meeting(meeting_task, meeting_describe, meeting_time, meeting_location, creator, hasDone) 
              VALUES(:mTask, :mDes, :mTime, :mLocaltion, :creator, :hasDone);";

      $statement = $pdo->prepare($sql);

      $statement->bindParam(":mTask", $mTask);
      $statement->bindParam(":mDes", $mDes);
      $statement->bindParam(":mTime", $mTime);
      $statement->bindParam(":mLocaltion", $mLocaltion);
      $statement->bindParam(":creator", $username);
      $statement->bindParam(":hasDone", $isHasDone);
      $statement->execute();


      // 提交事务
      $pdo->commit();

      // echo $isHasDone;
      header('Location: ../static/MeetingList.php');
    } catch (PDOException $e) {
      $pdo->rollback();
      echo "Error $e";
    }
  }
}
?>
