<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
}else{

    $day='';
    $year='';
    $empid=$_SESSION['employeeid'];
    $username1=$_SESSION['username'];
    $email1=$_SESSION['email'];
    $position1=$_SESSION['position'];
    $organization1=$_SESSION['organization'];
    $salary1=$_SESSION['salary'];
    $image1=$_SESSION['image'];
    $day=$_SESSION['day'];
    $month=$_POST['month'];
    $year=$_SESSION['year'];

    $host = "host = 127.0.0.1";
    $port = "port = 5432";
    $dbname = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }


    // Check if a duplicate request exists
    $sqlCheckDuplicate1 = <<<EOF
    SELECT employeesid FROM public.salaryoverview WHERE employeesid = $empid AND month = '$month'
    UNION 
    SELECT employeesid FROM public.invoice WHERE employeesid = $empid AND month = '$month'
    EOF;

    $duplicateResult1 = pg_query($conn, $sqlCheckDuplicate1);

    if (pg_num_rows($duplicateResult1) > 0 ) {
        // Set a session variable to indicate a duplicate request
        $_SESSION['duplicateRequest'] = true;
        header('Location: salaryrequest.php');

    } else {
        // Insert data into salaryoverview table
        $sqlInsert = <<<EOF
        INSERT INTO public.salaryoverview (employeesid, username, email, position, organization, salary, image, month,day,year)
        VALUES ($empid, '$username1', '$email1', '$position1', '$organization1', $salary1, '$image1', '$month','$day',$year)
EOF;

        $result2 = pg_query($conn, $sqlInsert);
        if (!$result2) {
            echo pg_last_error($conn);
            exit;
        }

        // Data inserted successfully for the first time, set session variable for success alert
        $_SESSION['successAlert'] = true;
        header('Location: salaryrequest.php');
        pg_close($conn);
    }


}


?>