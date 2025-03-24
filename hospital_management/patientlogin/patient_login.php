<?php
session_start();
include 'C:\xampp\htdocs\hospital_management\patientlogin\db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email exists
    $sql = "SELECT * FROM patients WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if ($patient) {
        echo "<script>alert('User found in database');</script>";
        echo "<script>alert('DB Password: " . $patient['password'] . "');</script>";
        echo "<script>alert('Entered Password: " . $password . "');</script>";
    } else {
        echo "<script>alert('User not found');</script>";
    }

    // Validate password (No hashing)
    if ($patient && $password === $patient['password']) {  
        session_regenerate_id(true);
        $_SESSION['patient_id'] = $patient['id'];

        
        header("Location: http://localhost/hospital_management/patientlogin/patient/patient_dashboard.html");


        exit();
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
