<?php include ('./include/header.php'); ?>
<?php include ('./include/navbar.php'); ?>


<?php
// Fetch reservations from the database
$reservations_query = "SELECT reservations.id, cottage.cottage_code, cottages.cottage_name, reservations.reservation_date, reservations.reservation_time, reservations.number_of_guest, reservations.is_overnight
    FROM reservations
    INNER JOIN cottages ON reservations.cottage_id = cottages.id
    INNER JOIN cottage ON cottage.c_id = cottages.id
    WHERE reservations.stats= 'active'
    ";
$reservations_result = $conn->query($reservations_query);

$cancelled = "SELECT reservations.id, cottage.cottage_code, cottages.cottage_name, reservations.reservation_date, reservations.reservation_time, reservations.number_of_guest, reservations.is_overnight
    FROM reservations
    INNER JOIN cottages ON reservations.cottage_id = cottages.id
    INNER JOIN cottage ON cottage.c_id = cottages.id
    WHERE reservations.stats= 'canceled'
    ";
$cancelled_res = $conn->query($cancelled);

$approved = "SELECT reservations.id, cottage.cottage_code, cottages.cottage_name, reservations.reservation_date, reservations.reservation_time, reservations.number_of_guest, reservations.is_overnight
    FROM reservations
    INNER JOIN cottages ON reservations.cottage_id = cottages.id
    INNER JOIN cottage ON cottage.c_id = cottages.id
    WHERE reservations.stats= 'approved'
    ";
$approved_res = $conn->query($approved);
?>


<div class="container mb-5">
    <h2 class="mt-5 mb-4">Manage Reservations</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cottage Code</th>
                <th>Cottage Name</th>
                <th>Reservation Date</th>
                <th>Reservation Time</th>
                <th>Number of Guests</th>
                <th>Is Overnight</th>
                <th>Action</th>
            </tr>

        </thead>
        <tbody>
            <?php
            if ($reservations_result->num_rows > 0) {
                $i = 1;
                while ($row = $reservations_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $i++ . "</td>";
                    echo "<td>" . $row['cottage_code'] . "</td>";
                    echo "<td>" . $row['cottage_name'] . "</td>";
                    echo "<td>" . $row['reservation_date'] . "</td>";
                    echo "<td>" . $row['reservation_time'] . "</td>";
                    echo "<td>" . $row['number_of_guest'] . "</td>";
                    echo "<td>" . ($row['is_overnight'] ? 'Yes' : 'No') . "</td>";
                    echo "<td>
                        <div class='d-flex'>
                            <form class='mx-2' method='post' action='code.php'>
                                <input type='hidden' name='reservation_id' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-success' name='approved_reservation'>Approved</button>
                            </form>
                            <form method='post' action='code.php'>
                                <input type='hidden' name='reservation_id' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger' name='cancelled_reservation'>Declined</button>
                            </form>
                        </div>
                        
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No reservations found</td></tr>";
            }
            ?>
        </tbody>

    </table>
</div>

<div class="container mb-2">
    <h2 class="mt-5 mb-4 text-primary">Approved</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cottage Code</th>
                <th>Reservation Date</th>
                <th>Reservation Time</th>
                <th>Number of Guests</th>
                <th>Is Overnight</th>

            </tr>

        </thead>
        <tbody>
            <?php
            if ($approved_res->num_rows > 0) {
                $b = 1;
                while ($row = $approved_res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $b++ . "</td>";
                    echo "<td>" . $row['cottage_code'] . "</td>";
                    echo "<td>" . $row['reservation_date'] . "</td>";
                    echo "<td>" . $row['reservation_time'] . "</td>";
                    echo "<td>" . $row['number_of_guest'] . "</td>";
                    echo "<td>" . ($row['is_overnight'] ? 'Yes' : 'No') . "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No reservations Approved</td></tr>";
            }
            ?>
        </tbody>

    </table>
</div>

<div class="container mb-5">
    <h2 class="mt-5 mb-4 text-danger">Cancelled </h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cottage Code</th>
                <th>Reservation Date</th>
                <th>Reservation Time</th>
                <th>Number of Guests</th>
                <th>Is Overnight</th>

            </tr>

        </thead>
        <tbody>
            <?php
            if ($cancelled_res->num_rows > 0) {
                $c = 1;
                while ($row = $cancelled_res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $c++ . "</td>";
                    echo "<td>" . $row['cottage_code'] . "</td>";
                    echo "<td>" . $row['reservation_date'] . "</td>";
                    echo "<td>" . $row['reservation_time'] . "</td>";
                    echo "<td>" . $row['number_of_guest'] . "</td>";
                    echo "<td>" . ($row['is_overnight'] ? 'Yes' : 'No') . "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No reservations Cancelled</td></tr>";
            }
            ?>
        </tbody>

    </table>
</div>


<?php include ('./include/footer.php') ?>