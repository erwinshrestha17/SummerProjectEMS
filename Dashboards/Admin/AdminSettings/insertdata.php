<?php

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])){
        if(!empty($_POST['id'])) {
            $id = $_POST['id'];
            echo $id;
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
            $password =$_POST['password'];
            //$password =password_hash( $_POST['password'],PASSWORD_DEFAULT ); // Password has been encrypted by hashing
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



        //Image Uploading
        if(($_FILES["image"]) || $_FILES["image"]["error"] == 4){
            echo "<script> alert('Image Does Not Exist'); </script>";
            return;
        }else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!in_array($imageExtension, $validImageExtension))
            {
                echo "<script> alert('Invalid Image Extension'); </script>";
            }else if($fileSize > 1000000)
            {
                echo "<script> alert('Image Size Is Too Large'); </script>";
            } else{
                // add uniqid() to the file name to avoid filename duplications
                $newImageName = uniqid('', true) ;
                // the new image path
                $newImageName.='.'.$imageExtension;
                // moves the uploaded image to the new path
                move_uploaded_file($tmpName, 'img/'.$newImageName);
            }
        }








    }

    $query1 = "INSERT INTO adminlists (id, username, email, position, organization, date,fullname,salary,phonenumber,image) VALUES ($id,'$username ', '$email','$roles','$branch','$employeddate','$fullname',$salary,'$phonenumber','$newImageName)";
    $query2 = "INSERT INTO adminlogin (id, email, password) VALUES ($id, '$email','$password')";
    $result1 = pg_query($conn, $query1);
    $result2 = pg_query($conn, $query2);

    if ($result1 || $result2) {
        echo "Data inserted successfully.";
        header("Location: adminregistration.php");
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

?>





