<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'reservation_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retype_password'])) {
    $password = $conn->real_escape_string($_POST['password']);

    $query = "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Proceed to reservation
            $_SESSION['email'] = $user['email'];
            header('Location: reservation.php');
            exit();
        } else {
            echo "Password does not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Retype Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('img1');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .retype-container {
            background-color: rgba(192, 192, 192, 0.8);
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .retype-container h2 {
            margin-top: auto;
            margin-bottom: 20px;
            font-size: 2em;

        }

        .retype-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 1.1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .retype-container button {
            width: 105%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            margin-left: 1px;
            text-align: center;
        }

        .retype-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="retype-container">
        <h2>Retype Password</h2>
        <form method="post">
            <input type="hidden" name="retype_password" value="1">
            <input type="password" name="password" placeholder="Retype Password" required><br>
            <button type="submit">Proceed</button>
        </form>
    </div>
</body>

</html>