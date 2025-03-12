<?php

$serverName="localhost";
$userName="root";
$password="";
$dbName="php_capstone_project_db";


$conn=mysqli_connect($serverName,$userName,$password,$dbName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

//  echo "Connected successfully";

?>