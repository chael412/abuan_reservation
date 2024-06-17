<?php include ('./include/header.php'); ?>

<?php include ('./include/navbar.php'); ?>

<div class="container mt-4 mb-4">
    <h1 class="text-center">Add User</h1>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card p-2">
                <form method="POST" action="code.php">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact No.(11-digits)</label>
                        <input type="text" name="contact_no" class="form-control" pattern="\d{11}" maxlength="11"
                            required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" name="user_add">Save</button>
                </form>
            </div>

        </div>
    </div>


</div>


<?php include ('./include/footer.php') ?>