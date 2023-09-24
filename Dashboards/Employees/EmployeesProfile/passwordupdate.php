<?php

session_start();
$host = "host=127.0.0.1";
$port = "port=5432";
$dbname = "dbname=emsdb";
$credentials = "user=postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!$conn) {
    echo die("Database connection failed");
}

$id=$_SESSION['id'];
$oldpassword = pg_escape_string($_POST['oldpassword']);
$newpassword = pg_escape_string($_POST['newpassword']);
$newpassword_hash =password_hash($newpassword,PASSWORD_DEFAULT);

$selectsql=<<<eof
        select password from employeeslist Where employeeslist.employeesid =$id
eof;
$result = pg_query($conn, $selectsql);
$rows=pg_fetch_assoc($result);
$dbpassword=$rows['password'];
$passworddecoded=password_verify($oldpassword,$dbpassword);
if ($passworddecoded){
    $updatepassword = <<<EOF
        UPDATE employeeslist SET password= '$newpassword_hash' where employeeslist.employeesid =$id;
        EOF;

    $result = pg_query($conn,$updatepassword);
    if ($result){
        $_SESSION['passwordchanged']= true;
        header('location:changepassword.php');
        exit();
    }

}else{
    $_SESSION['oldpasswordwrong']= "Error: " . pg_last_error($conn);
    header('location: changepassword.php');

}

pg_close($conn);

?>