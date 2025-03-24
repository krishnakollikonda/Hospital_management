<?php
require "db_connect.php";

$name = $_POST["name"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$contact = $_POST["contact"];

$sql = "INSERT INTO patients (name, age, gender, contact) VALUES ('$name', '$age', '$gender', '$contact')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Patient added successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
