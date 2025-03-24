<?php
require "db_connect.php";

$sql = "SELECT * FROM staff";
$result = $conn->query($sql);
$staff_list = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $staff_list[] = $row;
    }
}

echo json_encode($staff_list);
$conn->close();
?>
