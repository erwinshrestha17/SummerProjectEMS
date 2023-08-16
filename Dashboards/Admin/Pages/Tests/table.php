
<html lang="en">
<head>
    <title>
        Table
    </title>
</head>

<body>


<?php


$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}

$sql = <<<EOF
SELECT * FROM employeeslist
EOF;

$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
    exit;
}
?>
<?php

echo "<table>";
echo "<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Organization</th>
            <th>Employeed</th>
     </tr>";

    while ($rows=pg_fetch_assoc($ret)){
        $id=$rows['id'];
        $username=$rows['username'];
        $email=$rows['email'];
        $position=$rows['position'];
        $organization=$rows['organization'];
        $employeeddate=$rows['date'];
        echo "<tr>";
        echo "<td>".$username."</td>";
        echo "<td>".$email."</td>";
        echo "<td>".$position."</td>";
        echo "<td>".$organization."</td>";
        echo "<td>".$employeeddate."</td>";
    }
echo "</tr>";
echo "</table>";


    ?>







</body>
</html>
