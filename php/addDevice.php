<?php
session_start();
require_once '../includes/databaseConnection.php';

// 修：7.19
// 
/* 功能：添加设备信息
 * 将设备信息添加到表中
 * 将设备与用户
 */


// 如果提交内容不为空
if (!empty($_POST)) {
  $deviceType   = $_POST['deviceType'];     // 设备类型
  $deviceBrand  = $_POST['deviceBrand'];    // 设备品牌
  $deviceModel  = $_POST['deviceModel'];    // 设备型号

  $account = $_SESSION["account"]; // 用户账号
  $username = $_SESSION["username"];


  // 插入数据
  try {
    $pdo->beginTransaction();
    // device表
    $sql = "INSERT INTO device(device_type, device_brand, device_model) 
            VALUES(:deviceType, :deviceBrand, :deviceModel);";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":deviceType", $deviceType);
    $statement->bindParam(":deviceBrand", $deviceBrand);
    $statement->bindParam(":deviceModel", $deviceModel);
    $statement->execute();

    $deviceId = $pdo->lastInsertId();

    // device_user表
    $stmt = $pdo->prepare("INSERT INTO device_user(device_id, account, username) 
        VALUES(:deviceId, :account, :username);");
    $stmt->bindParam(":deviceId", $deviceId);
    $stmt->bindParam(":account", $account);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    // 提交事务
    $pdo->commit();

    echo json_encode($stmt);
    
  } catch (PDOException $e) {
        $pdo->rollback();
        echo "Error $e";
  }


}

?>
