<?php

session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}

?>



<?php

$adminID=$_POST['deletebtn'];

$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}

$sql =<<<Eof
        DELETE FROM adminlists WHERE adminid = $adminID;
    Eof;
$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
    exit;
}
header('location: adminoverviews.php');


?>
