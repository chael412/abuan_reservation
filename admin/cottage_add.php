<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>

<div class="container mt-4 mb-4">
    <h1 class="text-center">Add Cottage</h1>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card p-2">
                <form method="POST" action="code.php">
                    <div class="mb-3">
                        <label class="form-label">Cottage Code</label>
                        <input type="text" name="cottage_code" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Last Name</label>
                        <select class="form-control" id="floatingInput" name="cs_id" required>
                            <option value="" selected disabled>------ Select Category
                                -------
                            </option>
                            <?php
                            $displayDept = "SELECT *FROM cottages";
                            $deptResult = mysqli_query($conn, $displayDept);
                            if (mysqli_num_rows($deptResult) > 0) {
                                foreach ($deptResult as $deptItem) {
                                    ?>
                                    <option value='<?= $deptItem['id'] ?>'>
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
                    <a href="cottages.php" class="btn btn-outline-secondary">Back</a>
                    <button type="submit" class="btn btn-primary" name="cottage_add">Save</button>
                </form>
            </div>

        </div>
    </div>


</div>


<?php include ('./include/footer.php') ?>