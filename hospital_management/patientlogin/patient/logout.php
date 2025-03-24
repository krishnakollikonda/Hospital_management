<?php
session_start();
session_destroy();
header("Location: ../patientlogin/patient_login.html"); // Redirect to login page after logout
exit();
?>
