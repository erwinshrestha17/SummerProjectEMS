<?php

session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
}else {

// Your database connection and SQL query code here
    $host = "host = 127.0.0.1";
    $port = "port = 5432";
    $dbname = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }

    if (isset($_POST['approved'])) {
        $id = $_POST['approved'];
        $updateStatus = "UPDATE leavemanagement SET status = 'Approved' WHERE employeesid = $id";
        $result = pg_query($conn, $updateStatus);
        if (!$result) {
            // Handle the update error
            pg_last_error($conn);
        }
        header('location:leaverequestsoverview.php');

    } elseif (isset($_POST['declined'])) {
        $id = $_POST['declined'];
        $updateStatus = "UPDATE leavemanagement SET status = 'Declined' WHERE employeesid = $id";
        $result = pg_query($conn, $updateStatus);
        if (!$result) {
            // Handle the update error
            pg_last_error($conn);
        }
        header('location:leaverequestsoverview.php');

    }



}

?>
