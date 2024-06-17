<?php
session_start();
require('./config/dbcon.php');

if (isset($_GET['reservation_id'])) {
    $reservation_id = $_GET['reservation_id'];

    // Fetch reservation details
    $query = "SELECT * FROM reservations WHERE id='$reservation_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $reservation = mysqli_fetch_assoc($result);
        $cottage_id = $reservation['cottage_id']; // Assuming 'cottage_name' is the column name in your reservations table

        // Determine the price based on cottage category
        if ($cottage_id == '1-10') {
            $price = 300;
        } elseif ($cottage_id == '10-20') {
            $price = 500;
        } else {
            // Default price if category is not A or B
            $price = 0;
        }
    } else {
        echo "Reservation not found.";
        exit();
    }
} else {
    echo "Reservation ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GCash Payment</title>
     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-bottom: 10px;
        }

        .confirmation-link {
            color: #007bff;
            text-decoration: none;
        }

        .confirmation-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>GCash Payment</h2>
        <p>Reservation ID: <?= htmlspecialchars($reservation_id) ?></p>
        <p>Amount: <?= htmlspecialchars($price) ?> PHP</p>
        <p>Please send the amount to GCash number: 0917-XXXXXXX</p>

        <h2>Payment Details</h2>
        <form method="POST" action="process_payment.php">
            <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($reservation_id) ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" required>

            <label for="gcash_number">GCash Number:</label>
            <input type="text" name="gcash_number" required>

            <label for="amount_paid">Amount Paid (PHP):</label>
            <input type="number" name="amount_paid" value="<?= htmlspecialchars($price) ?>" required>
        <p>After payment, please <a href="confirmation.php?reservation_id=<?= htmlspecialchars($reservation_id) ?>">confirm your payment here</a>.</p>
        </form>
    </div>
</body>
</html>
