<?php

$host = "localhost";
$username = "root";
$pass = "";
$database = "leave_management";
$conn = new mysqli($host, $username, $pass, $database);

if ($conn->connect_error) {
    die("Database Error: " . $conn->error);
}


