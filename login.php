<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'reservation_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['user_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $row['id'];

            ?>
            <script>
                alert("Login Successfully!");
                window.location.href = "index.php";
            </script>
            <?php
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 10px;
            padding: 5px;
            height: 100vh;
            background-image: url('img4');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-attachment: fixed;
        }

        .login-container {
            background-color: rgba(192, 192, 192, 0.8);
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .login-container h2 {
            margin-top: 0;
            font-size: 2em;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px;
            margin-left: auto;
            margin-top: auto;
            font-size: 1.1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container button {
            width: 105%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container p {
            margin-top: 10px;
        }

        .login-container a {
            color: #007bff;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <a href="index.php">Back</a>
        <h2>User Login</h2>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="user_login">Login</button>
        </form>
        <p>New user? <a href="register.php">Create an account</a></p>
    </div>
</body>

</html>