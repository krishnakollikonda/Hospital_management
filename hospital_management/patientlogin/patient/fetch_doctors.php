<?php
include 'db.php';

$specialty = $_GET['specialty'];
$sql = "SELECT id, name FROM doctors WHERE specialty = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $specialty);
$stmt->execute();
$result = $stmt->get_result();

$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

echo json_encode($doctors);
?>
