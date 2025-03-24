<?php
require "db_connect.php";

$data = json_decode(file_get_contents("php://input"));
$doctor_id = $data->id;

$sql = "DELETE FROM doctors WHERE id = $doctor_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Doctor deleted successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
