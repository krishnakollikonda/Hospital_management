<?php
require "db_connect.php";

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
$patients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}

echo json_encode($patients);
$conn->close();
?>
