<?php
    session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

    // 颜色数组
    $colorArr = array("#CD5C5C","#8470FF","#1E90FF","#F08080","#48D1CC","#8FBC8F","#DA70D6","#228B22","#9370DB", "#63B8FF", "#90EE90","#9F79EE"."#EE7AE9","#EE799F","#EEA2AD","#7CCD7C","#6495ED");

    $color = $colorArr[$_SESSION["uid"]];

    // 时间串
    $startdate = trim($_POST['sdate']);
    $enddate = trim($_POST['edate']);
    $starttime = trim($_POST['stime']);
    $endtime = trim($_POST['etime']);

    /* 1、根据account从users表中查询user_id
     * 2、根据user_id从calendar_rights表中查询calendar_id
     * 3、查询语句 select calendar_id from calendar_rights where user_id in (select user_id from users where account = "20187189")
     * 
     * */
    
    $sql = "SELECT calendar_id FROM calendar_rights WHERE user_id IN (SELECT user_id FROM users WHERE account= '".$_SESSION["account"]."')";

    $calendarId = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["calendar_id"];
    /*$userId = $pdo->query("SELECT user_id FROM users WHERE  account= '".$_SESSION["account"]."'")->fetch(PDO::FETCH_ASSOC)["user_id"];


    $calendarId = $pdo->query("SELECT calendar_id FROM calendar_rights WHERE user_id = '".$userId."'")->fetch(PDO::FETCH_ASSOC)["calendar_id"];*/
     // echo $calendarId;

    $title		= $_POST["title"];
    $description= $_POST["description"];
    $startDate  = date("Y-m-d",strtotime($startdate)).' '.date("H:i:s",strtotime($starttime));
    $endDate    = date("Y-m-d",strtotime($enddate)).' '.date("H:i:s",strtotime($endtime));
    $allDay		= $_POST["allDay"];
    $remark 	= $_POST["remark"];

    echo json_encode($endDate);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO calendar_events(calendar_id, title, description, start_date, end_date, all_day,  color, remark)
            VALUES(:calendarId, :title, :description, :startDate, :endDate, :allDay, :color, :remark);
            ");

        $stmt->bindParam(":calendarId", $calendarId);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->bindParam(":allDay", $allDay);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":remark", $remark);

        $stmt->execute();
        echo json_encode($stmt);
    } catch (PDOException $e) {
        echo "Erro: $e";
    }
?>
