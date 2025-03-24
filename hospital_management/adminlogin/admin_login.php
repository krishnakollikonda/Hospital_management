
<?php
session_start();
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypting password for security

    // Check admin credentials
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin_email'] = $email;
        header("Location: admin_dashboard.php"); // Redirect to admin panel
        exit();
    } else {
        echo "<script>alert('Invalid Credentials!'); window.location.href='../frontend/admin_login.html';</script>";
    }
}
?>
