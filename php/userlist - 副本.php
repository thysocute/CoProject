<?php
  //session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database
    
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */


// session_start();
// $username = $_SESSION['username'];
$account = $_SESSION['account'];

/* 从users表中获取user_id
 * 从user_team获得所有所在组user_id -> team_id
 * 然后通过team_id从user_team获得user_id
 * 通过uesr_id从user_info表中获得user_name
 */

/*
* 根据用户名从calendar_rights中找到calendar_id
* 根据calendar_id从calendar表中找到calendar_group
* 把同一个calendar_group的calendar_id
* 根据calendar_id获得username
* */
///// OBTAIN CALENDAR OF TO THE USER GIVEN
///
$userID ; // calendar id
try {
    $sql = "SELECT user_id FROM users WHERE account = '" . $account. "'";
   
    $stmt = $pdo->query($sql);
    $userID = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: $e";
}

$userId = $userID[0];
$calendarID ; // calendar id
try {
    $sql = "SELECT calendar_id FROM calendar_rights WHERE user_id = '" . $userId. "'";
   
    $stmt = $pdo->query($sql);
    $calendarID = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: $e";
}

$calendarId = $calendarID[0];
$calendarGroups; // 日历组
try {
    $sql = "SELECT calendar_group FROM calendar WHERE calendar_id = '" . $calendarId. "'";
   
    $stmt = $pdo->query($sql);
    $calendarGroups = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: $e";
}


$calendarGroup = $calendarGroups[0];
$results = array(); // 日历组的calendar id
try {
    // 日历组
    $sql = "SELECT calendar_id FROM calendar WHERE calendar_group = '" . $calendarGroup. "'";
    
    $stmt = $pdo->query($sql);

    while ($rows = $stmt->fetch()) {
      $sql = "SELECT user_id FROM calendar_rights WHERE calendar_id = '" . $rows['calendar_id'] . "'";

      try {
          $rows2 = $pdo->query($sql);
      } catch (PDOException $e) {
          echo "Error (./getCalendarEvents.php [infile]): $e";
      }
      while ($rows3 = $rows2->fetch()) {
        $sql = "SELECT username FROM user_info WHERE user_id = '" . $rows3['user_id'] . "'";

        try {
            $rows4 = $pdo->query($sql);
        } catch (PDOException $e) {
            echo "Error (./getCalendarEvents.php [infile]): $e";
        }
          while ($rows5 = $rows4->fetch()) {
            // echo json_encode($rows5['username']);
            $results[] = $rows5['username'];
          }
        

      }

    }
} catch (PDOException $e) {
    echo "Error: $e";
}
// echo json_encode($results);

if (!empty($results)) {
  echo '<div class="col s12" >
    <div class="card" style="padding:0;">';//style="font-size:0.9em"


echo '<ul class="collection with-header" id="user-list">';
echo '<li class="collection-header" style="padding:0.4em;">
  <h5 style="font-size:0.9em">';
  echo "Group: ". $calendarGroup ." Calendar's Users:</h5>
</li>";
  foreach ($results as $value) {

    echo '<li class="collection-item">
          <div id="user-name" style="font-size:0.8em;">';

    echo $value;

    echo  '<a href="#!" class="secondary-content delete" >
              <i class="material-icons">close</i>
            </a>
          </div>
        </li>';

  }
  echo "  </ul>
        </div>
      </div>";
}



?>
