<?php
session_start();
include '../patient/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_SESSION['patient_id'];
    $doctor_id = $_POST['doctor'];
    $appointment_date = $_POST['date'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $patient_id, $doctor_id, $appointment_date);

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
