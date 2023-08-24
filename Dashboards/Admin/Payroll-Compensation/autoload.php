<?php

$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}

// Check if a record with the same salaryoverviewid exists
$sqlCheckExistence = "SELECT COUNT(*) FROM public.salaryoverview WHERE salaryoverviewid = $uniqueId";
$resultCheckExistence = pg_query($conn, $sqlCheckExistence);

if ($resultCheckExistence && pg_fetch_row($resultCheckExistence)[0] > 0) {
    // Handle the case where the record already exists
} else {
    // Insert the new record
}

?>