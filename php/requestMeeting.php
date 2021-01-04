<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database


// meeting_id组 
$sql = "SELECT * FROM meeting WHERE hasDone = 1 ";
$meeting_stmt = $pdo->query($sql);

if (empty($meeting_stmt)) {
  echo  '暂时还没有开启任何会议，会议完毕后再来看噢！';
  exit();

} else {

  $resultArr    = array();    // 结果集
  $timeLocalArr = array();    // 时间地点集
  $lastDataArr  = array();    // 最后一条数据集
  $memberArr    = array();
  $deviceArr    = array();
  $mAndDArr     = array();


  while ($meetingRows = $meeting_stmt->fetch()) {
    try { 
      // 结果集合
      $timeLocalArr[] = array(
        // "meetingId"        => $meetingRows['meeting_id'],
        // "meetingTask"      => $meetingRows['meeting_task'],
        // "meetingDesc"      => $meetingRows['meeting_describe'],
        "meetingLocation"  => $meetingRows['meeting_location'],
        "meetingTime"      => $meetingRows['meeting_time'],
        // "meetingMember"    => $meetingRows['meeting_member'],
      );

      // $str = $meetingRows['meeting_member'];
      // $nameArr = explode(",",$str);
      // echo $nameArr[0];
      // print_r ();
      

    } catch (PDOException $e) {
          echo "Error: $e";
    }
  }

  // 查询最后一条数据
  $lastest_sql = "SELECT * FROM meeting WHERE hasDone = 1 ORDER BY meeting_time DESC LIMIT 1";
  $lastest_stmt = $pdo->query($lastest_sql);

  while ($lastestRows = $lastest_stmt->fetch()) {
    try {
      $lastDataArr[] = array(
        "meetingId"        => $lastestRows['meeting_id'],
        "meetingTask"      => $lastestRows['meeting_task'],
        "meetingDesc"      => $lastestRows['meeting_describe'],
        "meetingLocation"  => $lastestRows['meeting_location'],
        "meetingTime"      => $lastestRows['meeting_time']
        // "meetingMember"    => $lastestRows['meeting_member']
      );

      // 通过成员查找设备
      $memberArrStr = $lastestRows['meeting_member'];
      $memberArr = explode(",",$memberArrStr);

      foreach ($memberArr as $usernameStr) {
        $du_sql = "SELECT device_id FROM device_user WHERE username= '".$usernameStr."'";
        $du_stmt = $pdo->query($du_sql);
        $deviceArr = array();
        while ($duRows = $du_stmt->fetch()) {
          try {
              // 获得设备信息
              $device_sql = "SELECT * FROM device WHERE device_id = '".$duRows['device_id']."'";
              $device_stmt = $pdo->query($device_sql);

              while ($rows = $device_stmt->fetch()) {
                // 结果集合
                $deviceArr[]    = array(
                 "deviceId"     => $rows['device_id'],
                 "deviceType"   => $rows['device_type'],
                 "deviceBrand"  => $rows['device_brand'],
                 "deviceModel"  => $rows['device_model']
                );
              }



          } catch (PDOException $e) {
              echo "Error: $e";
          }
        }
        // 成语和设备集
        $mAndDArr[] = array(
          "member"  => $usernameStr,
          "device"  => $deviceArr
        );

      }
      
      // 把成员和设备集加入到最后一条数据中
      array_push($lastDataArr,$mAndDArr);

    } catch (PDOException $e) {
      echo "Error: $e";
    }
  }

  // 将两个数组加入一个数组中
  $resultArr = array(
    "timeAndLocal" => $timeLocalArr,
    "lastestData"  =>$lastDataArr
  );


  echo json_encode($resultArr);
  

  // 循环输出列表
  // if (!empty($results)) {
  //   $index = 1;
  //   $mState = '';
  //   foreach ($results as $value) {
  //     if($value['state'] == 0) {
  //       $mState = "待开启";
  //     } else {
  //       $mState = "已完成";
  //     }
  //     echo '<tr>';
  //     echo '  <td>'.$index.'</td>';
  //     echo '  <td>'.$value['meetingTask'].'</td>';
  //     echo '  <td>'.$value['meetingDesc'].'</td>';
  //     echo '  <td>'.$value['meetingTime'].'</td>';
  //     echo '  <td>'.$value['meetingLocation'].'</td>';
  //     echo '  <td>'.$value['creator'].'</td>';
  //     echo '  <td>';
  //     echo '    <a href="../static/coVisual.php?meeting_id='.$value['meetingId'].'">'.$mState.'</a>';
  //     echo '    <a href="../php/deleteMeeting.php?meeting_id='.$value['meetingId'].'">删除</a>';
  //     echo '  </td>';
  //     echo '</tr>';
  //     $index++;
  //   }
  // }

}
?>
