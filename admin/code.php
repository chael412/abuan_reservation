<?php
require ('../config/dbcon.php');

if (isset($_GET['cottage_id'])) {
    $cottageID = $_GET['cottage_id'];

    $query = "DELETE FROM cottage WHERE c_id = $cottageID";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("Cottage Deleted Successfully!");
            window.location.href = "cottages.php";
        </script>
        <?php
    } else {
        echo "Error deleting cottage: " . mysqli_error($conn);
    }
}


if (isset($_POST['cottage_update'])) {
    $cottage_id = $_POST['cottage_id'];
    $cottage_code = $_POST['cottage_code'];
    $category = $_POST['cs_id'];
    $availability = $_POST['availability'];

    $query = "UPDATE cottage SET cottage_code='$cottage_code', cs_id='$category', availability='$availability' WHERE c_id = '$cottage_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("Cottage Updated Successfully!");
            window.location.href = "cottages.php";
        </script>
        <?php
    } else {
        echo "Error updating cottages: " . mysqli_error($conn);

    }
}



if (isset($_POST['cottage_add'])) {
    $cottage_code = $_POST['cottage_code'];
    $category = $_POST['cs_id'];


    $check_query = "SELECT * FROM cottage WHERE cottage_code = '$cottage_code'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        ?>
        <script>
            alert("Cottage Code already exists! Please use a different code.");
            window.location.href = "cottage_add.php";
        </script>
        <?php
    } else {
        $query = "INSERT INTO cottage (cottage_code, cs_id) VALUES ('$cottage_code', '$category')";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            ?>
            <script>
                alert("Cottage Added Successfully!");
                window.location.href = "cottages.php";
            </script>
            <?php
        } else {
            echo "Error adding cottage: " . mysqli_error($conn);
        }
    }
}






if (isset($_POST['cancelled_reservation'])) {
    $id = $_POST['reservation_id'];

    $query = "UPDATE reservations SET stats = 'canceled'  WHERE id='$id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("Reservation was declined!");
            window.location.href = "reservations.php";
        </script>
        <?php
    } else {
        echo "Error reservations: " . mysqli_error($conn);
    }
}


if (isset($_POST['approved_reservation'])) {
    if (isset($_POST['approved_reservation'])) {
        $id = $_POST['reservation_id'];

        $query_get_reservation = "SELECT reservation_date, cottage_id FROM reservations WHERE id='$id'";
        $result_get_reservation = mysqli_query($conn, $query_get_reservation);

        if ($result_get_reservation && mysqli_num_rows($result_get_reservation) > 0) {
            $row = mysqli_fetch_assoc($result_get_reservation);
            $reservation_date = $row['reservation_date'];
            $cottage_id = $row['cottage_id'];


            $query_check_duplicate = "SELECT id FROM reservations WHERE reservation_date='$reservation_date' AND cottage_id='$cottage_id' AND stats='approved' AND id != '$id'";
            $result_check_duplicate = mysqli_query($conn, $query_check_duplicate);

            if ($result_check_duplicate && mysqli_num_rows($result_check_duplicate) > 0) {
                ?>
                <script>
                    alert("There is already an approved reservation for this cottage on this date.");
                    window.location.href = "reservations.php";
                </script>
                <?php
            } else {
                $query_update = "UPDATE reservations SET stats = 'approved' WHERE id='$id'";
                $query_run = mysqli_query($conn, $query_update);

                if ($query_run) {
                    ?>
                    <script>
                        alert("Reservation was approved!");
                        window.location.href = "reservations.php";
                    </script>
                    <?php
                } else {
                    echo "Error updating reservation: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Error fetching reservation details: " . mysqli_error($conn);
        }
    }
}



if (isset($_POST['user_add'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_no = $_POST['contact_no'];

    $query = "INSERT INTO users (firstname, lastname, contact_no, email, password) VALUES ('$firstname', '$lastname', '$contact_no', '$email', '$password')";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("User Added Successfully!");
            window.location.href = "users.php";
        </script>
        <?php
    } else {
        echo "Error adding users: " . mysqli_error($conn);
    }
}

if (isset($_POST['user_update'])) {
    $userID = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_no = $_POST['contact_no'];

    $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', contact_no='$contact_no', email='$email', password='$password' WHERE id = $userID";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("User Updated Successfully!");
            window.location.href = "users.php";
        </script>
        <?php
    } else {
        echo "Error updating user: " . mysqli_error($conn);

    }
}


if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];

    $query = "DELETE FROM users WHERE id = $userID";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("User Deleted Successfully!");
            window.location.href = "users.php";
        </script>
        <?php
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}