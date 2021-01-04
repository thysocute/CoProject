<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/11
 * Time: 上午8:20
 */

/** 
 * 通过account从device_user表中获得device_id
 * 若device_id为空则表示没有设备，请完善设备信息
 * 通过device_id从device获得deviceInfo
 * 
 **/
$account = $_SESSION["account"];

// 查询team_id
$du_sql = "SELECT device_id FROM device_user WHERE account= $account";
$du_stmt = $pdo->query($du_sql);

if (empty($du_stmt)) {
  echo '<tr>';
  echo   '<td colspan="5" style="text-align:center;">';
  echo     '您暂时还没有任何设备信息，请前往完善设备信息！';
  echo   '</td>';
  echo '</tr>';
  exit();

} else {
  
  $results = array(); // 

  while ($duRows = $du_stmt->fetch()) {

    try {
        // 获得设备信息
        $device_sql = "SELECT * FROM device WHERE device_id = '".$duRows['device_id']."'";
        $device_stmt = $pdo->query($device_sql);

        while ($rows = $device_stmt->fetch()) {
          
          // 结果集合
          $results[] = array(
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
  // echo json_encode($results);
  

  // 循环输出列表
  if (!empty($results)) {
    $index = 1;
    foreach ($results as $value) {
      echo '<tr>';
      echo '  <td>'.$index.'</td>';
      echo '  <td>'.$value['deviceType'].'</td>';
      echo '  <td>'.$value['deviceBrand'].'</td>';
      echo '  <td>'.$value['deviceModel'].'</td>';
      echo '  <td>';
      echo '  <a href="../php/deleteDevice.php?device_id='.$value['deviceId'].'&account='.$account.'">删除</a>';
      echo '  </td>';
      echo '</tr>';
      $index++;
    }
  }

}
?>
