<?php
    /*
     * Documentation for getCalendarEvents.php
    */
    session_start();

    require_once('../includes/databaseConnection.php'); //Make the connection to the database
    require_once('../php/fullCalendarUtil.php'); //Includes the Event class and the datetime utilities (provided by FullCalendar.io)

   
    //Short-circuit if the client did not give us a date range.
    if (!isset($_GET['start']) || !isset($_GET['end'])) {
        die("Please provide a date range.");
    }

   
    $range_start = parseDateTime($_GET['start']);
    $range_end = parseDateTime($_GET['end']);


    // Parse the timezone parameter if it is present.
    $timezone = null;
    if (isset($_GET['timezone'])) {
        $timezone = new DateTimeZone($_GET['timezone']);
    }

    $account = $_SESSION['account'];

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

        } catch (PDOException $e) {
            echo "Error: $e";
        }
    }
    
    
    // Accumulate an output array of event data arrays.
    $output_arrays = array();
    foreach ($results as $array) {
        //Convert the input array into a useful Event object
        $event = new Event($array, $timezone);

        $output_arrays[] = $event->toArray();
    }
    /* Step 5:  Send JSON to the client */
    echo json_encode($output_arrays);
?>
