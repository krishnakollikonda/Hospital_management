<?php
$host = "localhost"; // Change this if your database is on a different server
$user = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "hospital_db"; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
