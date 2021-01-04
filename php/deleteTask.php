<?php
    require_once('../includes/databaseConnection.php'); //Make the connection to the database

/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */
    $pid   = $_GET['pro_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM project WHERE pro_id = :pid");

        $stmt->bindParam(":pid", $pid);

        $stmt->execute();
        // echo json_encode($stmt);
        header('Location: ../static/taskList.php');
    } catch (PDOException $e) {
        echo "Erro: $e";
    }
?>