<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $host = "host=127.0.0.1";
    $port = "port=5432";
    $dbname = "dbname=emsdb";
    $credentials = "user=postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!$conn) {
        die("Database connection failed");
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
    $phonenumber = pg_escape_string($_POST['phonenumber']);
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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

            if (move_uploaded_file($tmpName, 'img/' . $newImageName)) {
                // Check if a duplicate request exists
                $sqlCheckDuplicate1 =<<<EOF
                    SELECT * FROM adminlists WHERE email='$email' ;
                EOF;

                $duplicateResult1 = pg_query($conn, $sqlCheckDuplicate1);
                if (pg_num_rows($duplicateResult1) > 0 ) {
                    // Set a session variable to indicate a duplicate request
                    $_SESSION['duplicateRequest'] = true;
                    header('Location: adminregistration.php');
                    exit;
                }

                // Insert data into the database
                $query1 = "INSERT INTO adminlists ( username, email, position, organization, date, fullname, salary, phonenumber, image, password) 
                       VALUES ('$username', '$email', '$roles', '$branch', '$employeddate', '$fullname', $salary, '$phonenumber', '$newImageName', '$hashedPassword')";
                $result1 = pg_query($conn, $query1);

                if ($result1) {
                    $_SESSION['successAlert'] = true;
                    header("Location: adminregistration.php");
                    exit;
                } else {
                    $_SESSION['duplicateName'] = true;
                    header('Location: adminregistration.php');
                    echo "Error: " . pg_last_error($conn);
                }
            } else {
                echo "File upload failed.";
            }
        }
    }
    pg_close($conn);
}
?>
