<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
}else {

    $username = $_SESSION['username'];
    $fullname= $_SESSION['fullname'];
    $image = $_SESSION['image'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    $organization = $_SESSION['organization'];
    $date = $_SESSION['date'];
    $localtime = $_POST['localTime'];
    $id = $_SESSION['employeesid'];

    $host = "host = 127.0.0.1";
    $port = "port = 5432";
    $dbname = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }
    $sqlcheck = <<<EOF
        Select * from checkin where employeesid=$id;
EOF;
    $resultcheck = pg_query($conn, $sqlcheck);
    if (!$resultcheck) {
        echo "Error in checking the database: " . pg_last_error($conn);
        exit;
    }
    if (pg_num_rows($resultcheck) > 0) {
        $_SESSION['Checked-In'] = true;
        header('location:checkin.php');
    } else {
        $sql = <<<EOF
        Insert into checkin ( employeesid, image, username, email, position, organizaion, date, checkintime,fullname) 
        values ($id,'$image','$username','$email','$position','$organization','$date','$localtime','$fullname');
EOF;

        $result = pg_query($conn, $sql);
        if (!$result) {
            echo pg_last_error($conn);
            exit;
        }
        $_SESSION["Checked-In-Success"]=true;
        header('location:checkin.php');

    }
    pg_close($conn);


}
?>