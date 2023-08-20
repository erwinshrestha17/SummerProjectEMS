<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
</head>
<body>
<h1>Upload an Image</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="number" name="id">
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
    <input type="submit" value="Upload Image" name="submit">
</form>
</body>
</html>
