<?php
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */
    // $meetingId   = $_GET['meeting_id'];
    $meetingId   = $_POST['id'];
    // echo $meetingId;
    // 
    // 查询最后一条数据
    $meeting_sql = "SELECT * FROM meeting WHERE meeting_id = '".$meetingId."'";
    $meeting_stmt = $pdo->query($meeting_sql);

    $meetingArr = array();

    while ($meetingRows = $meeting_stmt->fetch()) {
      // $task = URLEncoder.encode($meetingRows['meeting_task'], "utf-8");
      try {
        $meetingArr[] = array(
          "meetingId"        => $meetingRows['meeting_id'],
          "meetingTask"      => $meetingRows['meeting_task'],
          "meetingDesc"      => $meetingRows['meeting_describe'],
          "meetingLocation"  => $meetingRows['meeting_location'],
          "meetingTime"      => $meetingRows['meeting_time']
          // "meetingMember"    => $meetingRows['meeting_member']
        );

        $_SESSION['meeting_id'] =  $meetingRows['meeting_id'];
        // echo $_SESSION['meeting_id'];

      } catch (PDOException $e) {
        echo "Error: $e";
      }
    }
    echo json_encode($meetingArr);

    // try {
    //     $stmt = $pdo->prepare("DELETE FROM project WHERE pro_id = :pid");

    //     $stmt->bindParam(":pid", $pid);

    //     $stmt->execute();
    //     // echo json_encode($stmt);
        // header('Location: ../static/coVisual.php?meeting_id='.$meetingArr[0]['meetingId'].'&meeting_task='.$meetingArr[0]['meetingTask'].'&meeting_time='.$meetingArr[0]['meetingTime'].'&meeting_location='.$meetingArr[0]['meetingLocation']);
    // } catch (PDOException $e) {
    //     echo "Erro: $e";
    // }
?>