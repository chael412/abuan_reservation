<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>
<?php
$query_cottages = "SELECT COUNT(c_id) AS total_cottage FROM cottage;";
$cottageRes = mysqli_query($conn, $query_cottages);
$total_cottage = $cottageRes ? mysqli_fetch_assoc($cottageRes)['total_cottage'] : 0;

$query_tourist = "SELECT COUNT(id) AS total_tourist FROM users;";
$touristRes = mysqli_query($conn, $query_tourist);
$total_tourist = $touristRes ? mysqli_fetch_assoc($touristRes)['total_tourist'] : 0;

?>



<div class="container">
    <h1 class="text-center mt-4 mb-5">Welcome, <?php echo $_SESSION["username"]; ?></h1>

    <div class="row ">
        <div class="col-3">
            <div class="card" style="height: 120px">
                <div class="card-body">
                    <h5 class="card-title">Total Cottages</h5>
                    <p class="card-text"><?= $total_cottage ?></p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="height: 120px">
                <div class="card-body">
                    <h5 class="card-title">Total Tourist</h5>
                    <p class="card-text"><?= $total_tourist ?></p>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include ('./include/footer.php') ?>