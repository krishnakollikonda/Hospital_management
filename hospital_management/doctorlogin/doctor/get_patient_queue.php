<?php
require "../db_connect.php";

// Prepare SQL query
$sql = "SELECT p.id, p.name, p.illness FROM patients p 
        INNER JOIN appointments a ON p.id = a.patient_id 
        WHERE a.status = 'pending'";

$result = $conn->query($sql);

$patients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}

// Return JSON response
echo json_encode($patients);
$conn->close();
?>
