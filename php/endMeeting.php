<?php
session_start();
require_once '../includes/databaseConnection.php';

// 如果提交内容不为空
if (!empty($_POST)) {
  $mID      = $_POST['mID'];  // 会议ID
  $mTask    = $_POST['mTask'];     // 会议主题
  $mTime    = $_POST['mTime'];     // 会议时间
  $mLocal   = $_POST['mLocal'];    // 会议地点
  $mMember  = (string)$_POST['mMember'];   // 会议成员
  

  if (empty($mMember)) {  // 如果mMember为空
    echo "先进行会议";
    exit();

  } else {
    $isHasDone = 1;      // 是否已完成， 1表示是，0表示不是

    try {
      $stmt = $pdo->prepare("
        UPDATE meeting
        SET meeting_member = :mMember,hasDone = :isHasDone
        WHERE meeting_id = (:mID);
      ");

      $stmt->bindParam(":mMember", $mMember);
      $stmt->bindParam(":isHasDone", $isHasDone);
      $stmt->bindParam(":mID", $mID);

      $stmt->execute();


      // 提交事务
      // $pdo->commit();
      // echo $mMember;
      echo $mID;
      // header('Location: ../static/coInfo.php?meeting_id='.$mID);
    } catch (PDOException $e) {
      $pdo->rollback();
      echo "Error $e";
    }
  }
}
?>
