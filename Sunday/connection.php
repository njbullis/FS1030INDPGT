<?php
$servername = "localhost";
$username = "newnodeclient";
$password = "123456";
$database = "demo";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}

$conn->close();
?>