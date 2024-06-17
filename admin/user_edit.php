<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>


<div class="container mt-5 mb-4">
    <h1 class="text-center">Edit User</h1>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card p-2">
                <?php
                if (isset($_GET['edit'])) {
                    $userID = $_GET['edit'];

                    $query = "SELECT * FROM users WHERE id = $userID";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $user = mysqli_fetch_assoc($result);
                        ?>
                        <form method="POST" action="code.php">
                            <input type="hidden" value="<?= $user['id'] ?>" name="user_id">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?= $user['firstname'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?= $user['lastname'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact No.(11-digits)</label>
                                <input type="text" name="contact_no" class="form-control" pattern="\d{11}" maxlength="11"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
                                    value="<?= $user['contact_no'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="<?= $user['password'] ?>">
                            </div>

                            <button type="submit" class="btn btn-primary" name="user_update">Update</button>
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