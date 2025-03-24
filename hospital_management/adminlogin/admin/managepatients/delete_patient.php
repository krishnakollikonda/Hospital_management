<?php
require "db_connect.php";

$data = json_decode(file_get_contents("php://input"));
$patient_id = $data->id;

$sql = "DELETE FROM patients WHERE id = $patient_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Patient deleted successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
