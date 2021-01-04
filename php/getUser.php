<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */

/*
* 查找user表所有的用户信息
* */


$results = array(); 
try {
    // 内联查询
    $sql = "SELECT * FROM user";
    
    $stmt = $pdo->query($sql);

    while ($rows = $stmt->fetch()) {
      $results[] = array(
                    "account"   => $rows['account'],
                    "username"  => $rows['username'],
                    "email"     => $rows['email'],
                    "phone"     => $rows['phone']
      );
    }
} catch (PDOException $e) {
    echo "Error: $e";
}
// echo json_encode($results);

// 循环输出列表
if (!empty($results)) {
  $index = 1;
  foreach ($results as $value) {
    echo '<tr>';
    echo '  <td>'.$index.'</td>';
    echo '  <td>'.$value['account'].'</td>';
    echo '  <td>'.$value['username'].'</td>';
    echo '  <td>'.$value['email'].'</td>';
    echo '  <td>'.$value['phone'].'</td>';
    echo '</tr>';
    $index++;
  }
}

?>
