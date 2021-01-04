<?php

session_start();
require_once '../includes/databaseConnection.php';

// 获取随机数字的函数 
function getRandChar($length){
    $str = null;
    // $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";//大小写字母以及数字
    $strPol = "0123456789";//数字组合有1 000 000 种
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];
    }
    return $str;
}

// 如果提交内容不为空
if (!empty($_POST)) {
    $tname = $_POST['tname'];     // 团队名称
    $tdes = $_POST['tdes'];     // 团队描述

   
    if (empty($tname)) {
        echo "请填写团队名称！";
        exit();
    } else {
        $account = $_SESSION["account"];
        $username = $_SESSION["username"];
        $isCreator = 1;      // 是否为创建者， 1表示是，0表示不是

        /* 邀请码
         * 随机生成一个六位数的字符串
         * 将该字符串与数据库中对比是否存在
         * 若存在，重新生成另一个字符串
         * 若不存在，则采用
         */
        $teamCode = "";
        while (1) {
            $ranCode = getRandChar(6); // 随机生成一个6位的字符串
            $stm = $pdo->prepare("SELECT * FROM team WHERE team_code = :ranCode");
            $stm->bindParam(":ranCode", $ranCode);
            $stm->execute();
            // 若查询为空，则数据库中不存在该字符串
            if (empty($stm->fetch(PDO::FETCH_ASSOC))) {
                $teamCode = $ranCode;
                break;
            } 
        }
        // 插入数据
        try {
            $pdo->beginTransaction();
            // team表
            $sql = "INSERT INTO team(team_name, team_describe, team_code) 
                    VALUES(:tname, :tdes, :teamCode);";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":tname", $tname);
            $statement->bindParam(":tdes", $tdes);
            $statement->bindParam(":teamCode", $teamCode);
            $statement->execute();

            $teamId = $pdo->lastInsertId();

            // team_user表
            $statement = $pdo->prepare("INSERT INTO team_user(team_id, account, username, is_creator) 
                VALUES(:teamId, :account, :username, :isCreator);");
            $statement->bindParam(":teamId", $teamId);
            $statement->bindParam(":account", $account);
            $statement->bindParam(":username", $username);
            $statement->bindParam(":isCreator", $isCreator);
            $statement->execute();

            // 提交事务
            $pdo->commit();

            // header() 函数向客户端发送原始的 HTTP 报头。
            // header('Location: ../static/myTeamList.php');
            print "<script language=\"JavaScript\">\r\n";
            print " alert(\"团队加入邀请码为：$teamCode\");\r\n";
            print " location.replace(\"../static/myTeamList.php\");\r\n"; // 自己修改网址
            print "</script>";

            exit();
            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error $e";
            }

    }
}
?>