<?php
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */
    $tid   = $_GET['team_id'];
    $uid   = $_GET['user_id'];

    try {
        /*$stmt = $pdo->prepare("DELETE FROM team WHERE team_id = :tid");

        $stmt->bindParam(":tid", $tid);

        $stmt->execute();*/
        // 个人删除
        $stmt = $pdo->prepare("DELETE FROM user_team WHERE team_id = :tid  AND user_id = :uid");

        $stmt->bindParam(":tid", $tid);
        $stmt->bindParam(":uid", $uid);

        $stmt->execute();
        // echo json_encode($stmt);
        header('Location: ../static/myTeamList.php');
    } catch (PDOException $e) {
        echo "Erro: $e";
    }
?>