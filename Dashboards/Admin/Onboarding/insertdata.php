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
    $username = pg_escape_string($_POST['username']);
    $email = pg_escape_string($_POST['email']);
    $password = pg_escape_string($_POST['password']);
    $roles = pg_escape_string($_POST['role']);
    $branch = pg_escape_string($_POST['branch']);
    $employeddate = pg_escape_string($_POST['employeddate']);
    $fullname = pg_escape_string($_POST['fullname']);
    $salary = $_POST['salary'];
    $phonenumber = $_POST['phonenumber'];
    // Add additional validation for other fields here...

    // Check for duplicate data based on a unique field (e.g., email)
    $duplicateCheckQuery = "SELECT COUNT(*) FROM employeeslist WHERE email = '$email'";
    $duplicateResult = pg_query($conn, $duplicateCheckQuery);

    // Fetch the count of rows where the email matches
    $duplicateCount = pg_fetch_result($duplicateResult, 0);

    if ($duplicateCount > 0) {
        echo "<script>alert('Employee with this email already exists.')</script>";
    } else {
        // Continue with the registration process


        if ($_FILES["image"]["error"] === 4) {
            echo "<script> alert('Image Does Not Exist'); </script>";
        } else {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script> alert('Invalid Image Extension');</script>";
            } else if ($fileSize > 10000000) {
                echo "<script> alert('Image Size Is Too Large');</script>";
            } else {
                $newImageName = uniqid('', true);
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'img/' . $newImageName);

                // Insert data into the database
                $query1 = "INSERT INTO employeeslist ( username, email, position, organization, date, fullname, salary, phonenumber, image, password) 
                    VALUES ( '$username', '$email', '$roles', '$branch', '$employeddate', '$fullname', $salary, '$phonenumber', '$newImageName', '$password')";
                $result1 = pg_query($conn, $query1);

                if (!$result1) {
                    echo pg_last_error($conn);
                    exit;
                }
                $_SESSION['successAlert'] = true;
                header("Location: addingEmployees.php");
                pg_close($conn);

            }
        }
    }
}
?>
