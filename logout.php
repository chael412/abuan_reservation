<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();


?>
<script>
    alert("Logout Successfully!");
    window.location.href = 'index.php';

</script>