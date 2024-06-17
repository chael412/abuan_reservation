<?php
session_start();

// Hardcoded password for demonstration purposes
$valid_password = "password";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];

    if ($password === $valid_password) {
        // Password confirmation successful, display the receipt
        $reservation_id = uniqid('RESERVATION-');
        $name = $_SESSION['name'];
        $mobile_number = $_SESSION['mobile_number'];
        $gcash_number = $_SESSION['gcash_number'];
        $payment_amount = $_SESSION['payment_amount'];

        echo <<<EOT
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GCash Payment Receipt</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    background-color: #f4f4f4;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    margin-top: 0;
                    text-align: center;
                }
                p {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>GCash Payment Receipt</h2>
                <p><strong>Reservation Successful!</strong></p>
                <p><strong>Reservation ID:</strong> $reservation_id</p>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Mobile Number:</strong> $mobile_number</p>
                <p><strong>GCash Number:</strong> $gcash_number</p>
                <p><strong>Payment Amount:</strong> $payment_amount PHP</p>
            </div>
        </body>
        </html>
        EOT;

        // Clear session data after displaying the receipt
        session_unset();
        session_destroy();
    } else {
        // Password confirmation failed, redirect to password confirmation
        header("Location: password_confirmation.php");
        exit();
    }
} else {
    // If accessed directly, redirect to the reservation form
    header("Location: payment_gateway.php");
    exit();
}
?>
