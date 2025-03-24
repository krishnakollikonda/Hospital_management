<?php
require "db_connect.php";

$data = json_decode(file_get_contents("php://input"));
$staff_id = $data->id;

$sql = "DELETE FROM staff WHERE id = $staff_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Staff member deleted successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
