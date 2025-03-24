<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_SESSION['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $appointment_id = $_POST['appointment_id'];
    $prescription = $_POST['prescription'];

    $sql = "INSERT INTO prescriptions (patient_id, doctor_id, appointment_id, prescription) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $patient_id, $doctor_id, $appointment_id, $prescription);

    if ($stmt->execute()) {
        echo "Prescription added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
