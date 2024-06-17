<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the reservation details from the POST request
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $gcash_number = $_POST['gcash_number'];
    $payment_amount = $_POST['payment_amount'];

    // Store the reservation details in session variables
    $_SESSION['name'] = $name;
    $_SESSION['mobile_number'] = $mobile_number;
    $_SESSION['gcash_number'] = $gcash_number;
    $_SESSION['payment_amount'] = $payment_amount;

    // Redirect to the password confirmation page
    header("Location: password_confirmation.php");
    exit();
} else {
    // If accessed directly, redirect to the reservation form
    header("Location: reservation_form.php");
    exit();
}
?>
