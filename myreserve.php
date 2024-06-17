<?php
require ('./config/dbcon.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('abuan.jpg') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        nav {
            background-color: #0d9488;
            padding: 1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 1em;
        }

        nav a:hover {
            text-decoration: underline;
        }


        footer {
            background-color: #9ca3af;
            text-align: center;
            padding: 1em;


            width: 100%;
        }
    </style>
</head>

<body>
    <nav>
        <div>
            <a href="#">Navbar</a>
        </div>
        <div>
            <a href="#" onclick="confirmLogout();" style="cursor:pointer">Logout</a>
            <a href="index.php">Home</a>
            <a href="myreserve.php">View Reservation</a>
        </div>
        <div>
            <?php
            echo "Logged in as: " . $email;
            ?>
        </div>
    </nav>

    <div class="container-fluid px-3 pb-5">
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="text-center" style="color: white">My Reservations</h1>
            </div>
        </div>
        <div class="row ">
            <?php
            $query = "SELECT r.id AS reservation_id, c.c_id, c.cottage_code, cs.cottage_name, r.reservation_date, r.stats, r.number_of_guest
                      FROM reservations r
                      INNER JOIN cottage c ON r.cottage_id = c.c_id
                      INNER JOIN cottages cs ON c.cs_id = cs.id
                      WHERE r.user_id = (SELECT id FROM users WHERE email = '$email')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run === false) {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            } else {
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <div class="col-4 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="myreserve_edit.php?cottage_id=<?= $row['c_id'] ?>"
                                        class="btn btn-outline-success btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title text-center"><?= $row['cottage_code'] ?></h3>
                                    <p class="card-text"><span class=" fw-bold">Cottage:
                                        </span><?= $row['cottage_name'] ?>
                                    </p>
                                    <p class="card-text"> <span class="fw-bold">Reservation Date:
                                        </span><?= $row['reservation_date'] ?>
                                    </p>
                                    <p class="card-text">
                                        <span class="fw-bold">Number of guest:</span>
                                        <?= $row['number_of_guest'] ?>
                                    </p>
                                    <p class="card-text">
                                        <span class="fw-bold">Status:</span>
                                        <?= $row['stats'] ?>
                                    </p>
                                    <?php if ($row['stats'] == 'pending') { ?>
                                        <form method="POST" action="edit_reservation.php" style="display:inline-block;">
                                            <input type="hidden" name="reservation_id" value="<?= $row['reservation_id'] ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                        </form>
                                        <form method="POST" action="cancel_reservation.php" style="display:inline-block;">
                                            <input type="hidden" name="reservation_id" value="<?= $row['reservation_id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No reservations found.</p>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        function confirmLogout() {
            var confirmation = confirm("Are you sure you want to logout?");
            if (confirmation) {
                window.location.href = 'logout.php';
            }
        }
    </script>

    <footer>
        <p>&copy; 2024 Cottage Booking. All rights reserved.</p>
    </footer>
</body>

</html>