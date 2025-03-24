<?php
require "db_connect.php";

$name = $_POST["name"];
$specialization = $_POST["specialization"];
$contact = $_POST["contact"];
$email = $_POST["email"];

$sql = "INSERT INTO doctors (name, specialization, contact, email) VALUES ('$name', '$specialization', '$contact', '$email')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Doctor added successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
