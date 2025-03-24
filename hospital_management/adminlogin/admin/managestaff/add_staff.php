<?php
require "db_connect.php";

$name = $_POST["name"];
$role = $_POST["role"];
$contact = $_POST["contact"];
$email = $_POST["email"];

$sql = "INSERT INTO staff (name, role, contact, email) VALUES ('$name', '$role', '$contact', '$email')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Staff member added successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
