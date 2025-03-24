<?php
session_start();
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statement
    $sql = "SELECT * FROM doctors WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Directly compare plain text password
        if ($password === $row["password"]) {  
            $_SESSION["doctor_id"] = $row["id"];
            $_SESSION["doctor_name"] = $row["name"];

            // Redirect to dashboard
            
            header("Location: http://localhost/hospital_management/doctorlogin/doctor/doctor_dashboard.html");

            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='../doctorlogin/doctor_login.html';</script>";
        }
    } else {
        echo "<script>alert('Doctor not found!'); window.location.href='../doctorlogin/doctor_login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
