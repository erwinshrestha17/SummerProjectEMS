<?php
session_start();
if(isset($_POST['submit'])){
    $id= $_SESSION['id'];
    $email =$_SESSION['email'];
    $username=$_SESSION['username'];
    $position=$_SESSION['role'];
    $organization=$_SESSION['branch'];
    $image=$_SESSION['image'];

    if(!empty($_POST['startdate'])) {
        $startdate = $_POST['startdate'];
        echo $startdate;
    }
    echo "<br>";
    if(!empty($_POST['enddate'])) {
        $enddate = $_POST['enddate'];
        echo $enddate;
    }
    echo "<br>";

    if(!empty($_POST['reasons'])) {
        $reasons = $_POST['reasons'];
        echo $reasons;
    }
    echo "<br>";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $host        = "host = 127.0.0.1";
        $port        = "port = 5432";
        $dbname      = "dbname = emsdb";
        $credentials = "user = postgres password=admin";

        $conn = pg_connect( "$host $port $dbname $credentials"  );

        if(!isset($conn)){
            echo die("Database connection failed");
        }

        $query = "INSERT INTO employees_leave_requests(id, username, email, position, organization, startdate, enddate, reasons,images) VALUES ($id,'$username ', '$email','$position','$organization','$startdate','$enddate','$reasons','$image')";
        $result = pg_query($conn, $query);

        if ($result) {
            echo "Data inserted successfully.";

            header("Location: leaverequest.php");
        } else {
            echo "Error: " . pg_last_error($conn);
        }
        pg_close($conn);
    }
}
?>





