<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>



<div class="container">
    <h1 class="text-center mt-4 mb-5">Manage Cottages</h1>

    <div class="row ">
        <div class="col-3">
            <a href="cottage_add.php" class="btn btn-primary mb-2">Add Cottage</a>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th scope="col">Cottage No.</th>
                        <th scope="col">Catagory</th>
                        <th scope="col">Availability</th>

                        <th style="width: 15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $displayCottages = "SELECT c.c_id, c.cottage_code, cs.cottage_name, c.availability FROM cottage c
                    INNER JOIN cottages cs ON c.cs_id = cs.id";
                    $cottageRes = mysqli_query($conn, $displayCottages);
                    if (!$cottageRes) {
                        echo 'Something Went Wrong!';
                    }
                    $i = 1;
                    if (mysqli_num_rows($cottageRes) > 0) {
                        while ($cottage = mysqli_fetch_assoc($cottageRes)) { ?>

                            <tr>
                                <td>
                                    <?= $i++ ?>
                                </td>
                                <td>
                                    <?= $cottage['cottage_code'] ?>
                                </td>
                                <td>
                                    <?= $cottage['cottage_name'] ?>
                                </td>
                                <td>
                                    <?php
                                    if ($cottage['availability'] == 1) {
                                        echo "<span class='badge text-bg-danger px-3 py-1'>No</span>";
                                    } else {
                                        echo "<span class='badge text-bg-primary px-3 py-1'>Yes</span>";
                                    }
                                    ?>
                                </td>

                                <td class="d-flex">
                                    <a href="cottage_edit.php?edit=<?= $cottage['c_id'] ?>"
                                        class="btn btn-outline-success btn-sm mx-1">
                                        edit
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm" href="#"
                                        onclick="deleteUser(<?= $cottage['c_id'] ?>)">
                                        delete
                                    </a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                <h4 class="text-danger">No Record Found...</h4>
                            </td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>



</div>

<script>
    function deleteUser(cottageID) {
        if (confirm("Are you sure you want to delete this cottage?")) {
            window.location.href = "code.php?cottage_id=" + cottageID;
        }
    }
</script>

<?php include ('./include/footer.php') ?>