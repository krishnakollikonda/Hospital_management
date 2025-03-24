<?php
session_start(); // Start session at the very top
require "../db_connect.php"; // Ensure database connection is included

// Check if doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    die("Error: Doctor not logged in.");
}

$doctor_id = $_SESSION['doctor_id'];

// Validate form inputs
if (!isset($_POST['availableDate']) || !isset($_POST['availableTime'])) {
    die("Error: Missing form data.");
}

$date = $_POST['availableDate'];
$time = $_POST['availableTime'];

// Prepare SQL query
$sql = "INSERT INTO doctor_availability (doctor_id, available_date, available_time) 
        VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE available_time = VALUES(available_time)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in SQL statement: " . $conn->error);
}

$stmt->bind_param("iss", $doctor_id, $date, $time);

if ($stmt->execute()) {
    echo "Availability updated successfully.";
} else {
    echo "Error updating availability: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
