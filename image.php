<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="photo">
    <input type="submit" value="Upload">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "File Name: " . $_FILES["photo"]["name"] . "<br>";
    echo "File Type: " . $_FILES["photo"]["type"] . "<br>";
    echo "Temporary File: " . $_FILES["photo"]["tmp_name"] . "<br>";
    echo "File Size: " . $_FILES["photo"]["size"] . " bytes<br>";
    echo "Error: " . $_FILES["photo"]["error"] . "<br>";
}


?>
</body>
</html>