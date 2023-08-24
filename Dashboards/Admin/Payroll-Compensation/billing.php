<?php
$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}

$sqlSelect = <<<EOF
    SELECT * FROM employeeslist
EOF;
$result = pg_query($conn, $sqlSelect);
if (!$result) {
    echo pg_last_error($conn);
    exit;
}

while ($let = pg_fetch_assoc($result)) {
    $empid1 = $let['employeesid'];
    $username1 = $let['username'];
    $email1 = $let['email'];
    $position1 = $let['position'];
    $organization1 = $let['organization'];
    $salary1 = $let['salary'];
    $image1 = $let['image'];

    // Insert data into salaryoverview table
    $sqlInsert = <<<EOF
        INSERT INTO public.salaryoverview (employeesid, username, email, position, organization, salary, image)
        VALUES ($empid1, '$username1', '$email1', '$position1', '$organization1', $salary1, '$image1')
EOF;

    $result2 = pg_query($conn, $sqlInsert);
    if (!$result2) {
        echo pg_last_error($conn);
        exit;
    }
}
?>
