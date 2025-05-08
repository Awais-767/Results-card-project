<?php
$host = "localhost";
$dbname = "resultsdb";
$username = "root";
$password = "awais123"; // change if needed

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>