


<?php
if(isset($_POST['submit'])){
    if(!empty($_POST['adminid'])) {
        $adminid = $_POST['adminid'];
        echo $adminid;
    }
    echo "<br>";
    if(!empty($_POST['username'])) {
        $username = $_POST['username'];
        echo $username;
    }
    echo "<br>";
    if(!empty($_POST['email'])) {
        $email = $_POST['email'];
        echo $email;
    }
    echo "<br>";
    if(!empty($_POST['password'])) {
        $password = $_POST['password'];
        echo $password;
    }
    echo "<br>";
    if(!empty($_POST['role'])) {
        $roles = $_POST['role'];
        echo $roles;
    }
    echo "<br>";
    if(!empty($_POST['branch'])) {
        $branch = $_POST['branch'];
        echo $branch;
    }
    echo "<br>";

    echo "<br>";
    if(!empty($_POST['employeddate'])) {
        $employeddate = $_POST['employeddate'];
        echo $employeddate;
    }
    echo "<br>";
    if(!empty($_POST['fullname'])) {
        $fullname = $_POST['fullname'];
        echo $fullname;
    }
    echo "<br>";
    if(!empty($_POST['salary'])) {
        $salary = $_POST['salary'];
        echo $salary;
    }
    echo "<br>";
    if(!empty($_POST['phonenumber'])) {
        $phonenumber = $_POST['phonenumber'];
        echo $phonenumber;
        echo gettype($phonenumber);
    }
    echo "<br>";

}

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $query1 = "INSERT INTO adminlists (id, username, email, position, organization) VALUES ($adminid,'$username ', '$email','$roles','$branch')";
    $result1 = pg_query($conn, $query1);
    $query2 = "INSERT INTO adminlogin (id, email, password) VALUES ($adminid, '$email','$password')";
    $result2 = pg_query($conn, $query2);

    if ($result1 && $result2) {
        echo "Data inserted successfully.";
        header("Location: adminregistration.php");
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

?>





