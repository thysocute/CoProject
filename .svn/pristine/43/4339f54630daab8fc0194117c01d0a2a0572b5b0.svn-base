<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */

$eventId = $_POST["eventId"];

$results = array(); // 日历组的calendar id
try {
    $stmt = $pdo->prepare("SELECT * FROM calendar_events WHERE event_id = :eventId");
    $stmt->bindParam(":eventId", $eventId);
    $stmt->execute();
    // 日历组
    
   /* $sql = "SELECT * FROM calendar_events WHERE event_id = :eventId";
    
    $stmt = $pdo->query($sql);*/

    while ($rows = $stmt->fetch()) {
      $results[] = array(
          "eventId"       => $rows['event_id'],
          "title"         => $rows['title'],
          "description"   => $rows['description'],
          "start"         => $rows['start_date'],
          "end"           => $rows['end_date'],
          "allDay"        => $rows['all_day'],
          "color"         => $rows['color'],
          "isPublic"      => $rows['is_public']
      );
    }
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
