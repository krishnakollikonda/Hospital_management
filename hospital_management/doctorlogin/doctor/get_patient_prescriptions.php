<?php
require "../db_connect.php";

$patient_id = $_GET['patient'];

$sql = "SELECT date, prescription FROM appointments 
        WHERE patient_id = ? AND status = 'completed' 
        ORDER BY date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$prescriptions = [];

while ($row = $result->fetch_assoc()) {
    $prescriptions[] = $row;
}

echo json_encode($prescriptions);
$conn->close();
?>
