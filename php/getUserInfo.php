<?php
  // session_start();
  require_once('../includes/databaseConnection.php'); //Make the connection to the database

/*
* 查找user表所有的用户信息
* */
$account = $_SESSION["account"];
// $account   = $_GET['account'];
// $username = $_GET['username'];

$results = array(); 
$deviceArr = array();
try {
    // 内联查询
    $sql = "SELECT * FROM user WHERE account= $account";
    
    $stmt = $pdo->query($sql);

    while ($rows = $stmt->fetch()) {
      $results[] = array(
                 "account"   => $rows['account'],
                 "username"  => $rows['username'],
                 "email"     => $rows['email'],
                 "phone"     => $rows['phone']
      );
    }

    // 设备-用户表
    $duSql = "SELECT device_id FROM device_user WHERE account= $account";
    
    $duStmt = $pdo->query($duSql);

    while ($duRows = $duStmt->fetch()) {
      // 设备表
      $deviceSql = "SELECT * FROM device_user WHERE account= $account";
      $deviceStmt = $pdo->query($deviceSql);

      while ($deRows = $deviceStmt->fetch()) {
        $deviceArr[] = array(
                     "deviceId"   => $deRows['device_id'],
                     "deviceName" => $deRows['device_name']
                   
        );
      }
    }

    

} catch (PDOException $e) {
    echo "Error: $e";
}

// echo json_encode($results);


?>
