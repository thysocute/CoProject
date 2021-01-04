<?php
    session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

    $account = $_SESSION['account'];


    // 事件优先度对应的颜色
    $eventCArr = array("#CC0000", "#FF0000", "#FF6666", "#FF99CC", "#FF99FF", "#FFCCFF");

    $eventJSON   = $_POST["eventJSON"];

    // 如果不为空
    if (!empty($eventJSON)) {
        // 循环输出事件ID，并更新对应事件的color
        for ($i = 0; $i < sizeof($eventJSON); $i++) {
            $eventId = $eventJSON[$i];
            $eventColor = $eventCArr[$i];
            $updateStmt = $pdo->prepare("UPDATE calendar_events 
                                         SET color = :color
                                         WHERE event_id = (:event_id);
            ");
            $updateStmt->bindParam(":color", $eventColor);
            $updateStmt->bindParam(":event_id", $eventId);
            $updateStmt->execute();
        }
    }

    echo json_encode($eventJSON);
?>
