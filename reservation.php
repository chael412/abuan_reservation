<?php
session_start();
require ('./config/dbcon.php');

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    echo "Session id is not set.";
    exit(); // Add exit to stop further execution if session ID is not set
}

if (isset($_POST['create_reservation'])) {
    $user_id = $_POST['id'];
    $cottage_id = $_POST['cottage_id'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $number_of_guests = $_POST['number_of_guests'];
    $is_overnight = isset($_POST['is_overnight']) ? 1 : 0;
    $additional_cost = $is_overnight ? 250 : 0;
    $amount_paid = $_POST['amount_paid'];
    $gcash_number = $_POST['gcash_number'];

    // Constructing the query directly
    $query = "INSERT INTO reservations (user_id, cottage_id, reservation_date, reservation_time, number_of_guest, is_overnight, additional_cost, amount_paid, gcash_no) 
              VALUES ('$user_id', '$cottage_id', '$reservation_date', '$reservation_time', '$number_of_guests', '$is_overnight', '$additional_cost', '$amount_paid', '$gcash_number')";

    $query2 = "UPDATE cottage SET availability = '1' WHERE cottage.c_id = '$cottage_id'";
    $query2_run = mysqli_query($conn, $query2);

    if (mysqli_query($conn, $query) && $query2_run) {
        ?>
        <script>
            alert('Cottage reserved successfully!');
            window.location.href = 'confirmation.php';

        </script>


        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Abuan Cottage Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img3');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .additional-cost {
            display: none;
            color: red;
            font-weight: bold;
        }

        /* .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(192, 192, 192, 0.8);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            text-align: center;
        } */

        /* h2 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            text-align: left;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 30px;
        }

        .checkbox-label input[type="checkbox"] {
            margin-right: 10px;
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

        .additional-cost {
            display: none;
            color: red;
            font-weight: bold;
        }

        .photos-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .photo {
            text-align: center;
        }

        .photo img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .photo-title {
            font-weight: bold;
            margin-top: 5px;
        } */
    </style>
    <script>
        function toggleAdditionalCost() {
            const overnightCheckbox = document.getElementById('is_overnight');
            const additionalCost = document.getElementById('additional-cost');
            if (overnightCheckbox.checked) {
                additionalCost.style.display = 'block';
            } else {
                additionalCost.style.display = 'none';
            }
        }
    </script>
</head>

<body>
    <div class="container mt-5"
        style=" background-color: rgba(192, 192, 192, 0.8);  padding: 20px; background-color: rgba(192, 192, 192, 0.8);border-radius: 10px;">
        <div class="row">
            <div class="col"><a class="btn btn-secondary float-end" href="index.php" role="button">Back</a></div>
        </div>
        <div class="row px-2 py-4">
            <div class="col" style="border-right: 2.5px solid #1e293b">
                <div>
                    <h2 class="text-center">Reserve Your Cottage</h2>

                </div>
                <?php
                if (isset($_POST['reserve_cottage'])) {
                    $cottageCode = $_POST['cottageCode'];
                    $cottageType = $_POST['cottageType'];
                    $cottageId = $_POST['cottageId'];
                    $cottagePrice = $_POST['cottagePrice'];
                    ?>
                    <div>
                        <h3 style="background: #bbf7d0; padding: 5px 10px">
                            <?= htmlspecialchars($cottageType) ?>
                        </h3>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="cottage_id" value="<?= htmlspecialchars($cottageId) ?>">
                        <input type="hidden" class="form-control" name="id" value="<?= htmlspecialchars($userId) ?>">

                        <label for="cottage_id">Cottage Choose:</label>
                        <input type="text" class="form-control" name="cottage_code" value="<?= $cottageCode ?>" disabled>

                        <label for="reservation_date">Date:</label>
                        <input type="date" class="form-control" name="reservation_date" required min="<?= date('Y-m-d') ?>"
                            max="<?= date('Y-m-d', strtotime('+7 days')) ?>">

                        <label for="reservation_time">Time In:</label>
                        <input type="time" class="form-control" name="reservation_time" required>

                        <label for="number_of_guests">Number of Guests:</label>
                        <input type="number" class="form-control" name="number_of_guests" required>

                        <div class="checkbox-label mt-2">
                            <input type="checkbox" class="form-check-input" name="is_overnight" id="is_overnight"
                                onclick="toggleAdditionalCost()">
                            <label for="is_overnight">Overnight Stay</label>
                        </div>

                        <div id="additional-cost" class="additional-cost ">
                            Additional Cost for Overnight Stay: PHP 250
                        </div>

                        <button type="submit" class="btn btn-primary mt-5" name="create_reservation">Add
                            Reservation</button>


                </div>
                <div class="col">


                    <div class="container">
                        <h2>GCash Payment</h2>

                        <p>Please send the amount to GCash number: 0917-XXXXXXX</p>

                        <h2>Payment Details</h2>


                        <?php
                        $query_user = "SELECT * FROM users WHERE id = '$userId'";
                        $user_run = mysqli_query($conn, $query_user);
                        if ($user_run) {

                            while ($user = mysqli_fetch_assoc($user_run)) {
                                ?>
                                <label for="name">Customer Name:</label>
                                <input type="text" class="form-control" name="name"
                                    value="<?= $user['firstname'] . ' ' . $user['lastname'] ?>" required disabled>

                                <label for="contact_number">Customer Contact No.</label>
                                <input type="text" class="form-control" name="contact_number" value="<?= $user['contact_no'] ?>"
                                    required disabled>
                                <?php
                            }
                        }
                        ?>


                        <label class="mt-3" for="gcash_number">GCash Number:</label>
                        <input type="text" class="form-control" name="gcash_number" value="09176677870" required readonly>

                        <label for="amount_paid">Amount Paid (PHP):</label>
                        <input type="text" class="form-control" name="amount_paid"
                            value="<?= htmlspecialchars($cottagePrice) ?>" required
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            readonly>



                    </div>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>
</body>

</html>