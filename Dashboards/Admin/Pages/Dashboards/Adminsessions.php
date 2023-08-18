<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}
$adminID= $_SESSION['id'];

$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}
$sql =<<<Eof
            SELECT * FROM adminlists where id=$adminID;
    Eof;
$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
    exit;
}

while ($let = pg_fetch_assoc($ret)) {
    $id = $let['id'];
    $username = $let['username'];
    $email = $let['email'];
    $position = $let['position'];
    $organization = $let['organization'];
    $employeeddate = $let['date'];
    $salary = $let['salary'];
    $fullname= $let['fullname'];
    $phonenumber = $let['phonenumber'];

}

?>