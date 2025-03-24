<?php
session_start();
if (isset($_SESSION["doctor_id"])) {
    echo json_encode(["success" => true, "name" => $_SESSION["doctor_name"]]);
} else {
    echo json_encode(["success" => false]);
}
?>
