<?php
require "db_connect.php";

$item_name = $_POST["item_name"];
$category = $_POST["category"];
$quantity = $_POST["quantity"];
$supplier = $_POST["supplier"];

$sql = "INSERT INTO inventory (item_name, category, quantity, supplier) 
        VALUES ('$item_name', '$category', '$quantity', '$supplier')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Inventory item added successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
