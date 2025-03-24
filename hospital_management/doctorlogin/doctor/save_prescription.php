<?php
require "../db_connect.php";

$doctor_id = $_SESSION['doctor_id']; // Ensure doctor is logged in
$patient_id = $_POST['patientId'];
$prescription = $_POST['prescription'];
$date = date("Y-m-d");

// Insert prescription into appointments table
$sql = "UPDATE appointments 
        SET prescription = ?, status = 'completed', date = ?
        WHERE patient_id = ? AND doctor_id = ? AND status = 'pending'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $prescription, $date, $patient_id, $doctor_id);

if ($stmt->execute()) {
    echo "Prescription saved successfully.";
} else {
    echo "Error saving prescription: " . $conn->error;
}

$conn->close();
?>
