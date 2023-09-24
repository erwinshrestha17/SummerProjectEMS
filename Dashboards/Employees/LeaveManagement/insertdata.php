<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
}else {

    $applydate=$_SESSION['currentdate'];
    $leavefrom=$_POST['leavefrom'];
    $leaveto=$_POST['leaveto'];
    $remark=$_POST['remarks'];
    $leavetype=$_POST['leaveType'];
    $status='Pending';
    $image = $_SESSION['image'];
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
        Select * from leavemanagement where employeesid=$id;
EOF;
    $sqlleavetypes=<<<EOF
        Select leavetypeid from leavetypes where name='$leavetype'
EOF;

    $resultcheck = pg_query($conn, $sqlcheck);
    $resultcheck1 = pg_query($conn, $sqlleavetypes);

    if (!$resultcheck && !$resultcheck1) {
        echo "Error in checking the database: " . pg_last_error($conn);
        exit;
    }
    $let=pg_fetch_assoc($resultcheck1);
    $leavetypeid=$let['leavetypeid'];
    if (pg_num_rows($resultcheck) > 0) {
        $_SESSION['error'] =true;
        header('location:leaverequest.php');
    }else{
        $sql = <<<EOF
        Insert into leavemanagement ( employeesid, applydate, status, leavefrom, leaveto, leavetype, remark, image,leavetypeid) 
        values ($id,'$applydate','$status','$leavefrom','$leaveto','$leavetype','$remark','$image',$leavetypeid);
EOF;
        $result = pg_query($conn, $sql);
        if ($result) {
            $_SESSION['Leave-Request-Sent'] = true;
            header('location:leaverequest.php');
            exit;
        }


    }




    pg_close($conn);


}
?>