<?php
require_once("../includes/databaseConnection.php");
session_start();

// 邮箱正则表达式
$emailReg = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

// 如果提交内容不为空
if (!empty($_POST)) {
    /*获取用户页面注册传来的用户名和密码数据*/
    $account = $_POST['account'];
    $username = $_POST['username'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $conpwd = $_POST['conpwd'];
    $phone = $_POST['phone'];
    // $calendar_group = "1";

    $error;

    /*注册时的处理*/
    if($password!=$conpwd){
        echo "The passwords entered before and after are inconsistent";
        exit;
    }

    if (empty($account)) {
        $error = 'Account Number';
    } 

    if (empty($username)) {
       if (empty($error)) {
            $error = 'User Name';
        } else {
            $error .= '、User Name';
        }
    }

    if (empty($password)) {
        if (empty($error)) {
            $error = 'Password';
        } else {
            $error .= '、Password';
        }
    }

    if (empty($email)) {
        if (empty($error)) {
            $error = 'Email Address';
        } else {
            $error .= '、Email Address';
        }
    } elseif (!preg_match($emailReg, $email)) {
        if (empty($error)) {
            $error = 'Email address format is wrong, please fill in again';
        } else {
            $error .= '\Email address format is wrong, please fill in again';
        }
    } 

    if (empty($phone)) {
        if (empty($error)) {
            $error = 'Phone Number';
        } else {
            $error .= '、Phone Number';
        }
    }

    if (!empty($error)) {
        $error .= 'Cannot be empty！';
        // 若为空，则输出为空提醒
        echo $error;
        // header('Location: ./signup.php?'.$error.'');
        exit();
    } else {
        
        $sql = "SELECT COUNT(*) FROM user WHERE email = $email";
        $result = $pdo->prepare($sql);
        $result->execute();
        $emailExists = $result->fetchColumn();

        $sql = "SELECT COUNT(*) FROM user WHERE account = $account";
        $result = $pdo->prepare($sql);
        $result->execute();
        $accountExists = $result->fetchColumn();

        // 账号验证
       /* if ($accountExists > 0) {
            echo "该账号已存在！请前往登录";
            if (!empty($error)) {
                $error = '该账号已存在！';
            } else {
                $error = 'usernametaken=1';
            }
        } */

        // 电子邮箱验证
       /* if (!preg_match($emailReg, $email)) {
            $error .= '电子邮箱格式错误，请重新填写';
        } elseif ($emailExists > 0) {
            $error = '该电子邮箱已经存在！';
        }*/

        

        if ($accountExists > 0) {
            echo "This account already exists! Please go to sign in";
            // header('Location: ./signup.php?'.$error.'');
            exit();
        } else {
            try {
                $pdo->beginTransaction();
                // user表 账号、密码、用户名、邮箱、电话
                $sql = "INSERT INTO user(account, password, username, email, phone) VALUES(:account, :password, :username, :email, :phone);";
                $statement = $pdo->prepare($sql);
                $statement->bindParam(":account", $account);
                $statement->bindParam(":password", $password);
                $statement->bindParam(":username", $username);
                $statement->bindParam(":email", $email);
                $statement->bindParam(":phone", $phone);
                $statement->execute();

               /* $uid = $pdo->lastInsertId();

                // user_info表
                $sql = "INSERT INTO user_info(user_id, username, email, phone) VALUES(:uid, :username, :email, :phone);";
                $statement = $pdo->prepare($sql);
                // $statement->bindParam(":uid", $uid);
                $statement->bindParam(":username", $username);
                $statement->bindParam(":email", $email);
                $statement->bindParam(":phone", $phone);
                $statement->execute();*/

                // calendar表 calendar_id account username
                $statement = $pdo->prepare("INSERT INTO calendar(account, username) VALUES(:account, :username);");
                $statement->bindParam(":account", $account);
                $statement->bindParam(":username", $username);
                $statement->execute();

               /* $cid = $pdo->lastInsertId();

                // calendar_rights表
                $statement = $pdo->prepare("INSERT INTO calendar_rights(calendar_id, user_id, permission) VALUES(:cid, :uid, 1);");
                $statement->bindParam(":uid", $uid);
                $statement->bindParam(":cid", $cid);
                $statement->execute();*/

                // 提交事务
                $pdo->commit();

                // header() 函数向客户端发送原始的 HTTP 报头。
                // header('Location: ./homepage.php?success=1');
                header('Location: ../static/login.php');
            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error $e";
            }
        }
    }
}
?>
