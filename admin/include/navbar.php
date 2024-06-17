<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="main_dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cottages.php">Cottages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservations.php">Manage Reservations</a>
                </li>
            </ul>
            <div>
                <a href="#" class="btn btn-sm btn-outline-danger" onclick="confirmLogout();">Logout</a>
            </div>
        </div>
    </div>
</nav>

<script>
    function confirmLogout() {
        var confirmation = confirm("Are you sure you want to logout?");
        if (confirmation) {
            window.location.href = '../logout.php';
        }
    }
</script>