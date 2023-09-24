<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
} else {
    $localtime = $_POST['localTime'];
    $id = $_SESSION['employeesid'];
    $date = $_SESSION['date'];

    $host = "host = 127.0.0.1";
    $port = "port = 5432";
    $dbname = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }
    $sqlcheck = <<<EOF
        Select * from checkout where employeesid=$id;
EOF;
    $resultcheck = pg_query($conn, $sqlcheck);

    if (!$resultcheck) {
        echo "Error in checking the database: " . pg_last_error($conn);
        exit;
    }
    if (pg_num_rows($resultcheck) > 0) {
        $_SESSION['Checked-Out'] = true;
        header('location:checkout.php');
    }else{
        $sql = <<<EOF
    INSERT INTO checkout (employeesid, checkouttime,date)
    VALUES ($id, '$localtime','$date');
EOF;

        $result = pg_query($conn, $sql);

        if (!$result) {
            echo pg_last_error($conn);
            exit;
        }
        header('location:../Login-Logout/logout.php');
    }




}


?>