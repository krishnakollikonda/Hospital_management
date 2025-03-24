<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospital_db";

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Check if email already exists in patients or doctors
    $check_sql = "SELECT * FROM patients WHERE email = ? UNION SELECT * FROM doctors WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists! Try a different one.'); window.location.href='../register/register.html';</script>";
        exit();
    }

    // Insert into the correct table based on role
    if ($role == "patient") {
        $insert_sql = "INSERT INTO patients (name, email, password) VALUES (?, ?, ?)";
        $redirect_url = "../patientlogin/patient_login.html"; // Redirect to patient login
    } elseif ($role == "doctor") {
        $insert_sql = "INSERT INTO doctors (name, email, password) VALUES (?, ?, ?)";
        $redirect_url = "../doctorlogin/doctor_login.html"; // Redirect to doctor login
    } else {
        echo "<script>alert('Invalid role!'); window.location.href='../register/register.html';</script>";
        exit();
    }

    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful! Redirecting...'); window.location.href='$redirect_url';</script>";
    } else {
        echo "<script>alert('Error in registration! Please try again.'); window.location.href='../register/register.html';</script>";
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
