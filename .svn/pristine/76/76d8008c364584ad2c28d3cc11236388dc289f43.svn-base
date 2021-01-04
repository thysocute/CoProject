<?php
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

    // 时间串
    $startdate = trim($_POST['sdate']);
    $enddate = trim($_POST['edate']);
    $starttime = trim($_POST['stime']);
    $endtime = trim($_POST['etime']);

    $eventId     = $_POST["eventId"];
    $title       = $_POST["title"];
    $description = $_POST["description"];
    $isPublic    = $_POST["remark"];
    $startDate   = date("Y-m-d",strtotime($startdate)).' '.date("H:i:s",strtotime($starttime));
    $endDate     = date("Y-m-d",strtotime($enddate)).' '.date("H:i:s",strtotime($endtime));
    $allDay      = $_POST["allDay"];

    try {
        // $stmt->beginTransaction();
        $stmt = $pdo->prepare("
			UPDATE calendar_events
			SET title = :title, description = :description, start_date = :startDate, end_date = :endDate, all_day = :allDay, is_public = :isPublic
			WHERE event_id = (:eventId);
			");

        $stmt->bindParam(":eventId", $eventId);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->bindParam(":allDay", $allDay);
        $stmt->bindParam(":isPublic", $isPublic);

        $stmt->execute();
        echo $allDay;
        // $stmt->commit();
    } catch (PDOException $e) {
        // $stmt->rollback();
        echo "Erro: $e";
    }
    ?>
