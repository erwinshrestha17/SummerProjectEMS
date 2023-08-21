<?php
session_start();
$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}

$empID =$_SESSION['id'];
echo $empID;

$sql = <<<EOF
    Delete from employees_leave_requests where id=$empID;
EOF;
$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
    exit;
}
header('location:leaverequestoverview.php');




?>