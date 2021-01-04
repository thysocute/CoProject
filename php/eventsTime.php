<?php
    session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

    // 时间比较
    function compareTime($asDate, $aeDate, $bsDate, $beDate){
        $astart = strtotime($asDate);//第1个开始
        $aend = strtotime($aeDate);//第1个结束
        $bstart = strtotime($bsDate);//第2个开始
        $bend = strtotime($beDate);//第2个结束
        $isIntersection = false;
        if ($bstart - $astart > 0) {
            if ($bstart - $aend <= 0) {
                $cstart = $bstart;
                $cend = $aend;
                $isIntersection = true;
            }
        } else {
            if ($bend - $astart > 0) {
                $cstart = $astart;
                $cend = $bend;
                $isIntersection = true;
            }
        }

        return $isIntersection;

     }
   
   
    $account = $_SESSION['account'];

     // 时间串
    $startdate = trim($_POST['sdate']);
    $enddate = trim($_POST['edate']);
    $starttime = trim($_POST['stime']);
    $endtime = trim($_POST['etime']);

    $startDate   = date("Y-m-d",strtotime($startdate)).' '.date("H:i:s",strtotime($starttime));
    $endDate     = date("Y-m-d",strtotime($enddate)).' '.date("H:i:s",strtotime($endtime));

    /* 先查询该用户是否有团队，没有的话直接显示该用户的日历事件，若是有
     * 获取用户自己的日历事件和所有组员的日历事件    
     *
     * 通过account从表team_user获得team_id
     * 通过team_id从表team_user获得account组
     * 通过account从表calendar获得calendar_id
     * 通过calendar_id从表calendar_events获得日历事件
     */
    $results = array();
    // 判断团队是否存在
    $teamSql = "SELECT team_id FROM team_user WHERE account= $account";
    $stmt_team = $pdo->query($teamSql);

    // 当前用户的日程
    $sql = "SELECT * FROM calendar_events WHERE calendar_id IN (SELECT calendar_id FROM calendar WHERE account= $account)";
    $allEvents = $pdo->query($sql);

    while ($row = $allEvents->fetch()) {
        // 时间有交集
        $isBetween = compareTime($startDate, $endDate, $row['start_date'], $row['end_date']);
        if($isBetween) {
            $results[] = array(
                    "id"            => $row['event_id'],
                    "title"         => $row['title'],
                    "description"   => $row['description'],
                    "start"         => $row['start_date'],
                    "end"           => $row['end_date'],
                    "allDay"        => $row['all_day'],
                    "color"         => $row['color'],
                    "isPublic"      => $row['is_public']
            );
        }
    }
    if(!empty($stmt_team)) {
        // 若团队不为空
        try {
            // 账号组
            $accSql = "SELECT DISTINCT account FROM team_user WHERE team_id IN (SELECT team_id FROM team_user WHERE account= '".$_SESSION["account"]."')";
            $accStmt = $pdo->query($accSql);

            while ( $rows_acc = $accStmt->fetch()) {
                // 日程组
                if($account !== $rows_acc['account']) {
                    // 如果不是当前用户
                    $eventSql = "SELECT * FROM calendar_events WHERE calendar_id IN (SELECT calendar_id FROM calendar WHERE account = '".$rows_acc['account']."') AND is_public = 1";
                    $eventStmt = $pdo->query($eventSql);

                    while ($row = $eventStmt->fetch()) {
                        // 时间有交集
                        $isBetween = compareTime($startDate, $endDate, $row['start_date'], $row['end_date']);
                        if($isBetween) {
                            $results[] = array(
                                    "id"            => $row['event_id'],
                                    "title"         => $row['title'],
                                    "description"   => $row['description'],
                                    "start"         => $row['start_date'],
                                    "end"           => $row['end_date'],
                                    "allDay"        => $row['all_day'],
                                    "color"         => $row['color'],
                                    "isPublic"      => $row['is_public']
                            );
                        }
                        
                    }
                }
                
            }

        } catch (PDOException $e) {
            echo "Error: $e";
        }
    }
    
    echo json_encode($results);
?>
