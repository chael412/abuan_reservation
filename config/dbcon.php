<?php

define('DB_SERVER', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "reservation_system");

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}
