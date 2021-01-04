<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

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
  echo '<option>';
  echo   '<a href="../static/createTeam.php">';
  echo     '暂时没有可选择的团队，请前往创建团队或者加入团队！';
  echo   '</a>';
  echo '</option>';
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
                    "tname"   => $rows['team_name']
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
      if ($index == 1) {
        echo ' <option selected value="'.$value['tid'].'">'.$value['tname'].'</option>';
      } else {
        echo '  <option value="'.$value['tid'].'">'.$value['tname'].'</option>';
      }
      $index++;
      
    }
  }

}
?>
