<?php
/*$db = mysqli_connect("localhost", "root", "", "todo")
    or
    die("Connection failed: " . mysqli_connect_error());*/

    // PHP Data Objects(PDO) Sample Code:
   try {
        $conn = new PDO("sqlsrv:server = tcp:jptodo.database.windows.net,1433; Database = todoapp", "jp", "myphpserver@1234");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    // SQL Server Extension Sample Code:
    /*$connectionInfo = array("UID" => "jp", "pwd" => "{your_password_here}", "Database" => "todoapp", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:jptodo.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);*/
?>
