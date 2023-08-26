<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}

$adminID = $_SESSION['id'];
$employeesID = $_SESSION['employeesid'];
$salary = $_SESSION['salary'];
$taxdeduction = $_SESSION['taxdeduction'];
$total = $_SESSION['total'];
$month = $_SESSION['month'];
$day=$_SESSION['day'];
$year=$_SESSION['year'];

echo $employeesID;

$fullname = "";
$image = "";
$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}

// Initialize variables to track success
$insertSuccess = false;
$deleteSuccess = false;

// Create prepared statements for insert and delete queries
$sqlInsert = "INSERT INTO invoice (employeesid, month, salary, deduction, total,day,year) VALUES ($1, $2, $3, $4, $5,$6,$7)";
$sqlDelete = "DELETE FROM salaryoverview WHERE employeesid = $1";

// Prepare the insert statement
$resultInsert = pg_prepare($conn, "insert_query", $sqlInsert);

if ($resultInsert) {
    // Execute the insert statement
    $resultInsert = pg_execute($conn, "insert_query", [$employeesID, $month, $salary, $taxdeduction, $total,$day,$year]);

    if ($resultInsert) {
        $insertSuccess = true;
    } else {
        echo pg_last_error($conn);
    }
}

// Only attempt to delete if the insert was successful
if ($insertSuccess) {
    // Prepare the delete statement
    $resultDelete = pg_prepare($conn, "delete_query", $sqlDelete);

    if ($resultDelete) {
        // Execute the delete statement
        $resultDelete = pg_execute($conn, "delete_query", [$employeesID]);

        if ($resultDelete) {
            $deleteSuccess = true;
        } else {
            echo pg_last_error($conn);
        }
    }
}

// Check if both insert and delete were successful
if ($insertSuccess && $deleteSuccess) {
    // Both operations were successful
    header('Location: salaryoverview.php'); // Redirect to a success page
} else {
    // Handle errors accordingly
    echo pg_last_error($conn);
}

pg_close($conn);

