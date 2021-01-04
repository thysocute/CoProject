<?php

function dbConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";// Axel password is root.
    $database = "coproject";

    try {
        return new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
        echo "dsdsd";
    } catch (PDOException $e) {
        // handle exceptions accordingly
        echo $e;
    }
}

$pdo = dbConnection();
