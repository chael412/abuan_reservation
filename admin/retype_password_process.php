<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'reservation_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id']) && isset($_POST['password'])) {
        $user_id = $_SESSION['user_id'];
        $password = $conn->real_escape_string($_POST['password']);

        $query = "SELECT * FROM users WHERE id='$user_id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Redirect to the reservation page
                header('Location: make_reservation.php');
                exit();
            } else {
                echo "Passwords do not match.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Session expired or invalid request.";
    }
}
?>
