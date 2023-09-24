<?php
session_start();

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
    $roles = pg_escape_string($_POST['role']);
    $branch = pg_escape_string($_POST['branch']);
    $employeddate = pg_escape_string($_POST['employeddate']);
    $fullname = pg_escape_string($_POST['fullname']);
    $salary = $_POST['salary'];
    $phonenumber = $_POST['phonenumber'];
    $password = pg_escape_string($_POST['password']);
    $skills=pg_escape_string($_POST['skills']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if a duplicate record exists
    $sqlCheckDuplicate1 =<<<EOF
        SELECT * FROM employeeslist WHERE email='$email';
    EOF;

    $duplicateResult1 = pg_query($conn, $sqlCheckDuplicate1);
    if (pg_num_rows($duplicateResult1) > 0 ) {
        // Set a session variable to indicate a duplicate request
        $_SESSION['duplicateRequest'] = true;
    } else {
        // Continue with the registration process

        if ($_FILES["image"]["error"] === 4) {
            $_SESSION['imageError'] = "Image Does Not Exist";
        } else {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if (!in_array($imageExtension, $validImageExtension)) {
                $_SESSION['imageError'] = "Invalid Image Extension";
            } else if ($fileSize > 1000000) {
                $_SESSION['imageError'] = "Image Size Is Too Large";
            } else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'img/' . $newImageName);

                // Insert data into the database
                $query1 = "INSERT INTO employeeslist (username, email, position, organization, date, fullname, salary, phonenumber, image, password,skills) 
                    VALUES ('$username', '$email', '$roles', '$branch', '$employeddate', '$fullname', $salary, '$phonenumber', '$newImageName', '$hashedPassword','$skills')";
                $result1 = pg_query($conn, $query1);

                if ($result1) {
                    $_SESSION['successAlert'] = true;
                } else {
                    $_SESSION['insertError'] = "Error: " . pg_last_error($conn);
                }
            }
        }
    }

    pg_close($conn);
    header("Location: addingEmployees.php");
}
?>
