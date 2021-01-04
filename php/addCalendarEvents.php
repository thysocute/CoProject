<?php
    session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

    $account = $_SESSION['account'];

    // 颜色数组
    $colorArr = array("#CD5C5C","#8470FF","#1E90FF","#F08080","#48D1CC","#8FBC8F","#DA70D6","#228B22","#9370DB", "#63B8FF", "#90EE90","#9F79EE"."#EE7AE9","#EE799F","#EEA2AD","#7CCD7C","#6495ED");
    

    // 时间串
    $startdate = trim($_POST['sdate']);
    $enddate = trim($_POST['edate']);
    $starttime = trim($_POST['stime']);
    $endtime = trim($_POST['etime']);

    /* 1、根据account从calendar表中查询calendar_id
     * 
     * 
     * */
    
    $sql = "SELECT calendar_id FROM calendar WHERE account = $account";
    $calendarId  = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["calendar_id"];
    
    $title		 = $_POST["title"];
    $description = $_POST["description"];
    $isPublic    = $_POST["remark"];
    $startDate   = date("Y-m-d",strtotime($startdate)).' '.date("H:i:s",strtotime($starttime));
    $endDate     = date("Y-m-d",strtotime($enddate)).' '.date("H:i:s",strtotime($endtime));
    $allDay		 = $_POST["allDay"];
    $color       = $colorArr[$calendarId];

    // echo json_encode($endDate);
   try {
        $stmt = $pdo->prepare("
			INSERT INTO calendar_events(calendar_id, title, description, is_public, start_date, end_date, all_day, color)
			VALUES(:calendarId, :title, :description, :isPublic, :startDate, :endDate, :allDay, :color);
			");


        $stmt->bindParam(":calendarId", $calendarId);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":isPublic", $isPublic);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->bindParam(":allDay", $allDay);
        $stmt->bindParam(":color", $color);
        
        $stmt->execute();
        // echo $calendarId.$title.$startDate.$endDate.$allDay.$remark;
        echo json_encode($stmt);
   } catch (PDOException $e) {
       echo "Erro: $e";
   }
?>
