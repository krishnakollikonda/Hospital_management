<?php
session_start();
include 'db.php';

$patient_id = $_SESSION['patient_id'];
$sql = "SELECT p.created_at AS date, d.name AS doctor, p.prescription AS details 
        FROM prescriptions p
        JOIN doctors d ON p.doctor_id = d.id
        WHERE p.patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$prescriptions = [];
while ($row = $result->fetch_assoc()) {
    $prescriptions[] = $row;
}

echo json_encode($prescriptions);
?>
