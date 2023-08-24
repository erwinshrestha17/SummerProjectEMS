<?php

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}
$sql =<<<Eof
            SELECT date FROM employeeslist where employeesid=2;
    Eof;
$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
}
$let=pg_fetch_assoc($ret);
$date=$let['date'];

$formattedDate = date("F j, Y", strtotime($date));
echo $formattedDate

?>