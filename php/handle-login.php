<?php
/* Called by login.php
 * Summary: This file queries the database for the user and username.
 * If the query is successful, the page is redirected to calendar.php.
 * Otherwise the page is redirected to login.php.
 */
session_start();
require_once '../includes/databaseConnection.php';

// 如果提交内容不为空
if (!empty($_POST)) {
    $id = '';
    $account = $_POST['account'];
    $password = $_POST['password'];
    $error;

    if (empty($account)) {
        $error = '账号';
    }

    if (empty($password)) {
        if (empty($error)) {
            $error = '密码';
        } else {
            $error .= '、密码';
        }
    }

    if (!empty($error)) {
        $error .= '不能为空，请重新填写！';
        echo $error;
        // header('Location: ./login.php?'.$error.'');
        exit();
    } else {
        $statement = $pdo->prepare("SELECT * FROM user WHERE account = :account AND password = :password");
		$statement->bindParam(":account", $account);
		$statement->bindParam(":password", $password);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['account']    = $row['account'];
			$_SESSION['username'] 	= $row['username'];
			$_SESSION['email'] 		= $row['email'];
			


			header('Location: ../static/relationship.php?success=1');
		} else {
            echo "登录失败，请重新登录！";
			// header('Location: ../static/login.php?usernotfound=1');
			exit();
		}

    }
}
?>
