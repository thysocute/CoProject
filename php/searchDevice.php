<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */

// $eventId = $_POST["eventId"];

$results = array(); // 设备信息数组
$types = array();
$brands = array();
$models = array();
try {
    // 查询设备类型
    $type_sql = "SELECT DISTINCT device_type FROM device";
    $type_stmt = $pdo->query($type_sql);
    while ($type_rows = $type_stmt->fetch()) {
      $results[] = array(
          "deviceType" => $type_rows['device_type']
      );

    }
    foreach ($types as $value) {
      $type_sql = "SELECT DISTINCT device_brand FROM device WHERE device_type='".$value['deviceType']."'";
      $type_stmt = $pdo->query($type_sql);
      while ($type_rows = $type_stmt->fetch()) {
        $results[] = array(
            "deviceBrand" => $type_rows['device_brand']
        );

      }

    }

    // while ($type_rows = $type_stmt->fetch()) {
    //   $dType = $type_rows['device_type'];
    //   echo $dType;
    //   $types[] = array(
    //       "deviceType" => $type_rows['device_type']
    //   );

    //   // 查询设备品牌 注意连接符
    //   $brand_sql = "SELECT DISTINCT device_brand FROM device WHERE device_type = '".$dType."'";
    //   $brand_stmt = $pdo->query($brand_sql);

    //   while ($brand_rows = $brand_stmt->fetch()) {
    //     $dModel = $brand_rows['device_brand'];
    //     echo $dModel;
    //     $brands[] = array(
    //       "deviceBrand" => $brand_rows['device_brand']
    //     );
    //     // 查询设备型号 注意连接符
    //     $brand_sql = "SELECT DISTINCT device_model FROM device WHERE device_type ='".$dType."' AND device_brand = '".$dModel."'";
    //     $brand_stmt = $pdo->query($brand_sql);

    //     while ($brand_rows = $brand_stmt->fetch()) {
    //       $models[] = array(
    //         "deviceModel" => $brand_rows['device_model']
    //       );
    //     }

    //   }
      // $results[] = $brands;

    // }

    // $results[] = $types;
    // $results[] = $brands;
    // $results[] = $models;
    
} catch (PDOException $e) {
    echo "Error: $e";
}
echo json_encode($results);

// 循环输出列表
/*if (!empty($results)) {
  foreach ($results as $value) {
    echo '<tr>';
    echo '  <td>'.$value['pid'].'</td>';
    echo '  <td>'.$value['pname'].'</td>';
    echo '  <td>';
    echo '    <a href="../static/updateTaskList.php?pro_id='.$value['pid'].'&pro_name='.$value['pname'].'">修改</a>';
    echo '    <a href="../php/deleteTask.php?pro_id='.$value['pid'].'&pro_name='.$value['pname'].'">删除</a>';
    echo '    <a href="../static/addUser.php?pro_id='.$value['pid'].'&pro_name='.$value['pname'].'">添加成员</a>';
    echo '  </td>';
    echo '</tr>';
  }
}

*/

?>
