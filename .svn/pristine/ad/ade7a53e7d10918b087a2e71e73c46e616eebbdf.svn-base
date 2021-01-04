<?php
    require_once('../includes/databaseConnection.php'); //Make the connection to the database
    
/**
 * Created by Qian.
 * User: 
 * Date: 2020/4/3
 * Time: 上午8:20
 */

    $pid   = $_GET['pro_id'];
    $pname = $_POST['pname'];

    try {
        // $stmt->beginTransaction();
        $stmt = $pdo->prepare("
            UPDATE project
            SET pro_name = :pname
            WHERE pro_id = (:pid);
            ");

        $stmt->bindParam(":pid", $pid);
        $stmt->bindParam(":pname", $pname);
        $stmt->execute();
        // echo $pname;
        header('Location: ../static/taskList.php');
        // $stmt->commit();
    } catch (PDOException $e) {
        // $stmt->rollback();
        echo "Erro: $e";
    }
?>
