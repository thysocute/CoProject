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
 * 通过account从team_user表中获得team_id
 * 通过team_id从team获得teamInfo
 * 
 **/
$account = $_SESSION["account"];

// 查询team_id
$sql = "SELECT team_id FROM team_user WHERE account= $account";
$team_stmt = $pdo->query($sql);

if (empty($team_stmt)) {
  echo '<tr>';
  echo   '<td colspan="7" style="text-align:center;">';
  echo     'You have not joined any team yet, please go to create a team or join a team！';
  echo   '</td>';
  echo '</tr>';
  exit();

} else {
  $results = array(); // 

  while ($teamRows = $team_stmt->fetch()) {

    try {
        // 获得团队信息
        $sql = "SELECT * FROM team WHERE team_id = '".$teamRows['team_id']."'";
        $stmt = $pdo->query($sql);

        while ($rows = $stmt->fetch()) {
          $sTeamId = $rows['team_id']; // 单个team_id

          // 查询表team_user 获得创建者
          $sql = "SELECT username FROM team_user WHERE team_id = $sTeamId AND is_creator = 1";
          $creator = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["username"];

          // 查询表team_user 获得所有成员
          $allMember = '';
          $sql = "SELECT username FROM team_user WHERE team_id = $sTeamId";
          $mbStmt = $pdo->query($sql);

          while ($members = $mbStmt->fetch()) {
            $allMember = $allMember.$members['username']."<br/>";
          }

          // 结果集合
          $results[] = array(
                        "tid"     => $rows['team_id'],
                        "tname"   => $rows['team_name'],
                        "tdes"    => $rows['team_describe'],
                        "tcode"   => $rows['team_code'],
                        "creator" => $creator,
                        "member"  => $allMember
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
      echo '  <td>'.$value['tname'].'</td>';
      echo '  <td>'.$value['tdes'].'</td>';
      echo '  <td>'.$value['tcode'].'</td>';
      echo '  <td>'.$value['creator'].'</td>';
      echo '  <td>'.$value['member'].'</td>';
      echo '  <td>';
      echo '    <a href="../enStatic/updateTaskList.php?team_id='.$value['tid'].'&team_name='.$value['tname'].'">Modify</a>';
      echo '    <a href="../php/deleteTeam.php?team_id='.$value['tid'].'&account='.$account.'">Delete</a>';
      echo '    <a href="../enStatic/addUser.php?team_id='.$value['tid'].'&team_name='.$value['tname'].'">Add member</a>';
      echo '  </td>';
      echo '</tr>';
      $index++;
    }
  }

}
?>
