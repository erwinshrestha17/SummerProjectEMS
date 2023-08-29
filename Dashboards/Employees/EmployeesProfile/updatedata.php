<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $host = "host=127.0.0.1";
    $port = "port=5432";
    $dbname = "dbname=emsdb";
    $credentials = "user=postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!$conn) {
        echo die("Database connection failed");
    }

    // Validate and sanitize user inputs
    $id = $_POST['employeesid'];
    $username = pg_escape_string($_POST['username']);
    $email = pg_escape_string($_POST['email']);
    $password = pg_escape_string($_POST['password']);
    $roles = pg_escape_string($_POST['role']);
    $branch = pg_escape_string($_POST['branch']);
    $employeddate = pg_escape_string($_POST['employeddate']);
    $fullname = pg_escape_string($_POST['fullname']);
    $salary = $_POST['salary'];
    $phonenumber = pg_escape_string($_POST['phonenumber']);
    // Add additional validation for other fields here...

    // Construct the SQL update query
    $query1 = "UPDATE employeeslist SET
            username = '$username',
            email = '$email',
            password = '$password',
            position = '$roles',
            organization = '$branch',
            date = '$employeddate',
            fullname = '$fullname',
            salary = $salary,
            phonenumber = '$phonenumber'
          WHERE employeesid = $id";

    $result1 = pg_query($conn, $query1);

    if ($result1) {
        echo "<script>alert('Data updated successfully.')</script>";
        pg_close($conn);
        header("Location: employeesprofile.php");
    } else {
        echo "<script>alert('Error: " . pg_last_error($conn) . "')</script>";
    }



}
?>
