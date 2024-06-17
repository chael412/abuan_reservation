<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>


<div class="container mt-5 mb-4">
    <h1 class="text-center">Edit User</h1>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card p-2">
                <?php
                if (isset($_GET['edit'])) {
                    $cottageID = $_GET['edit'];

                    $query = "SELECT * FROM cottage WHERE c_id = $cottageID";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $cottage = mysqli_fetch_assoc($result);
                        ?>
                        <form method="POST" action="code.php">
                            <input type="hidden" value="<?= $cottage['c_id'] ?>" name="cottage_id">
                            <div class="mb-3">
                                <label class="form-label">Cottage Code</label>
                                <input type="text" name="cottage_code" class="form-control"
                                    value="<?= $cottage['cottage_code'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-control" id="floatingInput" name="cs_id" required>
                                    <option value="" disabled>------ Select Category -------
                                    </option>
                                    <?php
                                    $displayDept = "SELECT * FROM cottages";
                                    $deptResult = mysqli_query($conn, $displayDept);

                                    if (mysqli_num_rows($deptResult) > 0) {
                                        foreach ($deptResult as $deptItem) {
                                            $selected = ($deptItem['id'] == $cottage['cs_id']) ? 'selected' : '';
                                            ?>
                                            <option value='<?= $deptItem['id'] ?>' <?= $selected ?>>
                                                <?= $deptItem['cottage_name'] ?>
                                            </option>
                                            <?php
                                        }
                                    } else {
                                        echo '<option>No Cottage found!</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Availability</label>
                                <select name="availability" class="form-control">
                                    <option value="1" <?= $cottage['availability'] == 1 ? 'selected' : '' ?>>No</option>
                                    <option value="0" <?= $cottage['availability'] == 0 ? 'selected' : '' ?>>Yes</option>
                                </select>

                            </div>

                            <a href="cottages.php" class="btn btn-outline-secondary">Back</a>
                            <button type="submit" class="btn btn-primary" name="cottage_update">Update</button>
                        </form>
                        <?php
                    }
                }
                ?>
            </div>

        </div>
    </div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>