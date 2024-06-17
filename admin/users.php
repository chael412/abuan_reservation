<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>



<div class="container">
    <h1 class="text-center mt-4 mb-5">Manage Users</h1>

    <div class="row ">
        <div class="col-3">
            <a href="user_add.php" class="btn btn-primary mb-2">Add User</a>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th style="width: 15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $displayUser = "SELECT * FROM users";
                    $userRes = mysqli_query($conn, $displayUser);
                    if (!$userRes) {
                        echo 'Something Went Wrong!';
                    }
                    $i = 1;
                    if (mysqli_num_rows($userRes) > 0) {
                        while ($user = mysqli_fetch_assoc($userRes)) { ?>
                            <tr>
                                <td>
                                    <?= $i++ ?>
                                </td>
                                <td>
                                    <?= $user['firstname'] ?>
                                </td>
                                <td>
                                    <?= $user['lastname'] ?>
                                </td>
                                <td>
                                    <?= $user['contact_no'] ?>
                                </td>
                                <td>
                                    <?= $user['email'] ?>
                                </td>
                                <td>
                                    <?= $user['password'] ?>
                                </td>
                                <td class="d-flex">
                                    <a href="user_edit.php?edit=<?= $user['id'] ?>" class="btn btn-outline-success btn-sm mx-1">
                                        edit
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm" href="#" onclick="deleteUser(<?= $user['id'] ?>)">
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
    function deleteUser(userID) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = "code.php?user_id=" + userID;
        }
    }
</script>

<?php include ('./include/footer.php') ?>