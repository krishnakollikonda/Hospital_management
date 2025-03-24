<?php
require "db_connect.php";

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
$inventory_list = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inventory_list[] = $row;
    }
}

echo json_encode($inventory_list);
$conn->close();
?>
