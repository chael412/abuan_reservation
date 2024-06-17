<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'reservation_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Basic validation before inserting into the database
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        $message = "Password must be at least 8 characters long and contain both lowercase and uppercase letters.";
    } else {
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

        if ($conn->query($query) === TRUE) {
            $message = "Registered successfully, log in now";
        } else {
            $message = "Error: " . $query . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
            background-attachment: fixed;
        }

        .register-container {
            background-color: rgba(192, 192, 192, 0.8);
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .register-container h2 {
            margin-top: 0;
            font-size: 2em;
            /* Make the heading bigger */
        }

        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px;
            margin-left: auto;
            margin-top: auto;
            font-size: 1.1em;
            /* Make input fields larger */
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-container button {
            width: 105%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            /* Make the button text larger */
            cursor: pointer;
            margin-top: 10px;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }

        .register-container p {
            margin-top: 10px;
        }

        .register-container a {
            color: #007bff;
            text-decoration: none;
        }

        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>    
    <div class="register-container">
        <a href="index.php">Back</a>
        <h2>Register</h2>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="hidden" name="register" value="1">
<input type="namel" name="name" placeholder="Firstname" required><br>
<input type="namel" name="name" placeholder="Lastname" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>