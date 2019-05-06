<?php
$servername = "10.202.1.155";
$username = "root";
$password = "root";
$port = 8889;
$dbname = "app";
$conn = new mysqli($servername, $username, $password, $dbname,$port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
