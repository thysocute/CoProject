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
$sql = "SELECT * FROM meeting";
$meeting_stmt = $pdo->query($sql);

if (empty($meeting_stmt)) {
  echo '<tr>';
  echo   '<td colspan="6" style="text-align:center;">';
  echo     '您暂时还没有参与任何会议，请前往创建会议！';
  echo   '</td>';
  echo '</tr>';
  exit();

} else {
  $results = array(); // 

  while ($meetingRows = $meeting_stmt->fetch()) {
    try { 
      // 结果集合
      $results[] = array(
        "meetingId"        => $meetingRows['meeting_id'],
        "meetingTask"      => $meetingRows['meeting_task'],
        "meetingDesc"      => $meetingRows['meeting_describe'],
        "meetingTime"      => $meetingRows['meeting_time'],
        "meetingLocation"  => $meetingRows['meeting_location'],
        "creator"          => $meetingRows['creator'],
        "state"            => $meetingRows['hasDone'],
      );
      

    } catch (PDOException $e) {
          echo "Error: $e";
    }
  }

  // echo json_encode($results);
  

  // 循环输出列表
  if (!empty($results)) {
    $index = 1;
    $mState = '';
    $aLink = "";
    foreach ($results as $value) {
      if($value['state'] == 0) {
        $mState = "待开启";
        $aLink = "../static/coVisual.php";
      } else {
        $mState = "已完成";
        $aLink = "../static/coInfo.php";
      }
      echo '<tr>';
      echo '  <td>'.$index.'</td>';
      echo '  <td>'.$value['meetingTask'].'</td>';
      echo '  <td>'.$value['meetingDesc'].'</td>';
      echo '  <td>'.$value['meetingTime'].'</td>';
      echo '  <td>'.$value['meetingLocation'].'</td>';
      echo '  <td>'.$value['creator'].'</td>';
      echo '  <td>';
      echo '    <a  class="meetBtn" href='.$aLink.'?meeting_id='.$value['meetingId'].'>'.$mState.'</a>';
      echo '    <a href="../php/deleteMeeting.php?meeting_id='.$value['meetingId'].'">删除</a>';
      echo '  </td>';
      echo '</tr>';
      $index++;
    }
  }

}
?>
