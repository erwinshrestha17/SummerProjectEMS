<?php
echo $name = pg_escape_string($_POST['name']); // Properly escape the string
echo $entitled = (int)$_POST['entitled']; // Cast to an integer

    $host = "host=127.0.0.1";
    $port = "port=5432";
    $dbname = "dbname=emsdb";
    $credentials = "user=postgres password=admin";
    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }


    // Use single quotes to enclose string values
    $query = "UPDATE leavetypes SET entitled = $entitled WHERE name = '$name'";

    $result = pg_query($conn, $query);

    if (!$result) {
        echo "Update failed: " . pg_last_error($conn);
    } else {
        echo "Update successful!";
        header('location:leavetype.php');
    }

    pg_close($conn);

?>
