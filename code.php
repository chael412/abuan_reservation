<?php
require ('./config/dbcon.php');

if (isset($_POST['myreserve_update'])) {
    $reserveId = $_POST['reserveId'];
    $guest_no = $_POST['guest_no'];


    $query = "UPDATE reservations SET number_of_guest='$guest_no' WHERE id = '$reserveId'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        ?>
        <script>
            alert("Reservation Updated Successfully!");
            window.location.href = "myreserve.php";
        </script>
        <?php
    } else {
        echo "Error updating reservation: " . mysqli_error($conn);

    }


}

