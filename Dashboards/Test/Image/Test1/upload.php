
<?php

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}
?>


<?php




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$conn) {
        die("Error: Unable to connect to the database");
    }
    $id=$_POST['id'];
    $filename = $_FILES['fileToUpload']['name'];
    $image_data = pg_escape_bytea(file_get_contents($_FILES['fileToUpload']['tmp_name']));

    $sql = "INSERT INTO images (id,filename, image) VALUES ($id,'$filename', '$image_data')";
    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Image uploaded successfully!";
    } else {
        echo "Error: " . pg_last_error($conn);
    }

    pg_close($conn);
}
?>