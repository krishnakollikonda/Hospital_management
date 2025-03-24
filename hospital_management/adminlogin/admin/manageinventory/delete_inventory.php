<?php
require "db_connect.php";

$data = json_decode(file_get_contents("php://input"));
$item_id = $data->id;

$sql = "DELETE FROM inventory WHERE id = $item_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Inventory item deleted successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
