<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

/** 
 * 根据会议时间meeting_time查找会议 
 * 根据成员username查找设备device_id
 * 根据device_id查找设备详细信息
 * 
 **/
$selectID  = $_POST['id'];

//  
$sql = "SELECT * FROM meeting WHERE meeting_id = '".$selectID."'";
$meeting_stmt = $pdo->query($sql);

// meeting_id组 
$allSql = "SELECT * FROM meeting WHERE hasDone = 1 ";
$all_stmt = $pdo->query($allSql);

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

  while ($meetingRows = $all_stmt->fetch()) {
    try { 
      // 时间地点集合
      $timeLocalArr[] = array(
        "meetingLocation"  => $meetingRows['meeting_location'],
        "meetingTime"      => $meetingRows['meeting_time'],
      );

    } catch (PDOException $e) {
          echo "Error: $e";
    }
  }

  while ($lastestRows = $meeting_stmt->fetch()) {
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
        // 成员和设备集
        $mAndDArr[] = array(
          "member"  => $usernameStr,
          "device"  => $deviceArr
        );

      }
      
      // 把成员和设备集加入到最后一条数据中
      array_push($lastDataArr,$mAndDArr);
      // array_push($lastDataArr,$timeLocalArr);

    } catch (PDOException $e) {
      echo "Error: $e";
    }
  }

  // 将两个数组加入一个数组中
  $resultArr = array(
    "timeAndLocal" => $timeLocalArr,
    "idSearchData"  =>$lastDataArr
  );


  echo json_encode($resultArr);

}
?>
