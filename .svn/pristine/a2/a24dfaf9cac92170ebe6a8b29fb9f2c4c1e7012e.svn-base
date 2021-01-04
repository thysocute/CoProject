<?php
	session_start();
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

	//对颜色的随机选择处理
	// 颜色数组
    $colorArr = array("#CD5C5C","#8470FF","#1E90FF","#F08080","#48D1CC","#8FBC8F","#DA70D6","#228B22","#9370DB", "#63B8FF", "#90EE90","#9F79EE"."#EE7AE9","#EE799F","#EEA2AD","#7CCD7C","#6495ED");
  

	/* 1、根据account从users表中查询user_id
     * 2、根据user_id从calendar_rights表中查询calendar_id
     * 3、查询语句 select calendar_id from calendar_rights where user_id in (select user_id from users where account = "20187189")
     * 
     * */

     // 时间串
    $startdate = trim($_POST['sdate']);
    $enddate = $startdate;
    $starttime = trim("00:00:00");
    $endtime = trim("23:59:59");
    
    
    $sql = "SELECT calendar_id FROM calendar WHERE account = $account";
    $calendarId  = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)["calendar_id"];
    
    $title       = $_POST["title"];
    $description = "";
    $isPublic    = 0;
    $startDate   = date("Y-m-d",strtotime($startdate)).' '.date("H:i:s",strtotime($starttime));
    $endDate     = date("Y-m-d",strtotime($enddate)).' '.date("H:i:s",strtotime($endtime));
    $allDay      = 1;
    $color       = $colorArr[$calendarId];
    // $description= "";

	 try {
        $stmt = $pdo->prepare("
			INSERT INTO calendar_events(calendar_id, title, start_date, all_day,  color, remark)
			VALUES(:calendarId, :title, :startDate, :allDay, :color, :remark);
			");

        $stmt->bindParam(":calendarId", $calendarId);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":allDay", $allDay);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":remark", $remark);

        $stmt->execute();
        echo json_encode($stmt);
    } catch (PDOException $e) {
        echo "Erro: $e";
    }
?>
