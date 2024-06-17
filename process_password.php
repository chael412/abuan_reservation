<?php
session_start();

// Hardcoded password for demonstration purposes
$valid_password = "password";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];

    if ($password === $valid_password) {
        // Password confirmation successful, redirect to generate receipt
        header("Location: generate_receipt.php");
        exit();
    } else {
        // Password confirmation failed, redirect to password confirmation
        header("Location: password_confirmation.php");
        exit();
    }
} else {
    // If accessed directly, redirect to the reservation form
    header("Location: reservation_form.php");
    exit();
}
?>
