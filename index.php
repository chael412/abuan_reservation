<?php
require ('./config/dbcon.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cottage Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <style>
        main {
            background: url('abuan.jpg') no-repeat center center;
            background-size: cover;
            min-height: 80vh;
            padding-bottom: 100px;
            box-sizing: border-box;
        }

        footer {
            bottom: 0;
            width: 100%;
            background-color: #9ca3af;
            text-align: center;
            padding: 1rem;
            margin-top: 42px;
        }
    </style>

</head>

<body>
    <main>
        <nav class="navbar navbar-expand-lg " style="background-color: #0d9488">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" onclick="confirmLogout();" style="cursor:pointer">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="myreserve.php">View Reservation</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">User Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_login.php">Admin Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="d-flex">
                        <span class="mx-3">
                            <?php if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];
                                echo "Logged in as: " . $email;
                            } ?>
                        </span>
                    </div>
                </div>
            </div>
        </nav>


        </ul>
        <div class="d-flex">
            <span class="mx-3">
                <?php
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];

                    ?>
                </span>

                <?php

                } ?>

        </div>

        </nav>

        <header style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="container">
                <div class="row justify-content-center mt-4">
                    <div class="col-8">
                        <h1 class="text-center display-3 fw-bold" style="color: #3b82f6">Welcome to Abuan</h1>
                        <p class="text-center fs-4" style="color: #ecfeff; font-weight: 600;">Enjoy your stay!</p>
                    </div>
                    <div class="col-8 mt-5 fs-5 px-5 py-2">
                        <div class="description" style="color: #a7f3d0">
                            <p>Abuan is a serene tourist destination known for its picturesque river and lush green
                                surroundings. Whether you're looking for a relaxing getaway or an adventurous trip,
                                Abuan offers a variety of activities including boating, swimming, and etc.</p>
                        </div>
                    </div>


                </div>
            </div>


        </header>





    </main>
    <div class="container">
        <div class="row mt-4 mb-3">
            <div class="col-12">
                <h1 class="text-center">Available Cottages</h1>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="mx-3 text-center px-1" style="border-right: 1px solid #cbd5e1">
                <img src="uploads/c1.jpg" alt="Photo 1" width="180" height="145">
                <div class=" photo-title">CATEGORY A
                </div>
                <h5>(2.5x2m)- For families and friends with 6-8 members</h5>
            </div>
            <div>
                <div class="mx-3 text-center">
                    <img src="uploads/c2.jpg" alt="Photo 2" width="180" height="146">
                    <div class=" photo-title">CATEGORY B
                    </div>
                    <h5>(3x3m)- For families and friends with 10-12 member</h5>
                </div>
            </div>
        </div>
        <hr />

        <div class="row mt-5">
            <?php
            $query = "SELECT c.c_id, cs.c_type, cs.id AS cs_id, c.cottage_code, cs.cottage_name, cs.description, cs.price 
            FROM cottage c
            INNER JOIN cottages cs ON c.cs_id = cs.id
            WHERE c.availability = 0";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {

                    ?>
                    <div class="col-3 mb-2">
                        <div class="card">
                            <div class="card-body ">
                                <h3 class="card-title text-center"><?= $row['cottage_code'] ?></h3>
                                <p class="card-text"><?= $row['cottage_name'] ?></p>
                                <p class="card-text">Price: <?= $row['price'] ?></p>
                                <div>
                                    <form method="POST" action="reservation.php">
                                        <input type="hidden" value="<?= $row['c_id'] ?>" name="cottageId">
                                        <input type="hidden" value="<?= $row['cottage_code'] ?>" name="cottageCode">
                                        <input type="hidden" value=" <?= $row['cottage_name'] ?>" name="cottageType">
                                        <input type="hidden" value=" <?= $row['price'] ?>" name="cottagePrice">
                                        <?php
                                        if (isset($_SESSION['email'])) {
                                            ?>
                                            <button type="submit" class="btn btn-primary btn-sm" name="reserve_cottage">
                                                Reserve
                                            </button>
                                            <?php
                                        } else {

                                        } ?>



                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No cottages found.</p>";
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