<?php
$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}
// Assuming you have an image ID (replace 1 with the actual ID)
$image_id = 1;

$sql = "SELECT filename, image FROM images WHERE id = $image_id";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Error: " . pg_last_error($conn));
}

$row = pg_fetch_assoc($result);
$filename = $row['filename'];
$image_data = $row['image'];
// Display the image
echo base64_decode($image_data); // Convert the bytea data to binary data

pg_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Display</title>
    <style>
        /* Add your CSS styles here */


        img {
            max-width: 100%;
            height: auto;
            margin: 20px;
            border: 2px solid #333;
        }
    </style>
</head>
<body>
<h1>Image Display</h1>
<h2><?php echo $filename; ?></h2>
<img src="data:image/jpeg;base64,<?php echo base64_encode($image_data); ?>" alt="<?php echo $filename; ?>" >
</body>
</html>
