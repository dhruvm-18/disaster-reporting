<?php

// Database connection settings
$dsn = "mysql:host=localhost:3307;dbname=disaster_reports";
$username = "root";
$password = "";

// Create a PDO instance
try {
    $conn = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

?>
