<?php
session_start();
include 'db.php';

$patient_id = $_SESSION['patient_id'];
$sql = "SELECT a.appointment_date AS date, d.name AS doctor, d.specialty 
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        WHERE a.patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);
?>
