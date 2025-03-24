<?php
require "../db_connect.php";

$doctor_id = $_SESSION['doctor_id']; // Ensure doctor is logged in

$sql = "SELECT a.date, p.name AS patient_name, a.prescription 
        FROM appointments a
        INNER JOIN patients p ON a.patient_id = p.id
        WHERE a.doctor_id = ? AND a.status = 'completed'
        ORDER BY a.date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];

while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

// Return JSON response
echo json_encode($appointments);
$conn->close();
?>
