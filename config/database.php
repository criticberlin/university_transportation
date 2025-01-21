<?php
// Database configuration constants
define('DB_HOST', 'localhost');     // Database host
define('DB_USER', 'root');          // Database user
define('DB_PASS', '');              // Database password
define('DB_NAME', 'smart_parking'); // Database name

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    // Log the error (in a production environment)
    error_log("Database connection failed: " . $e->getMessage());
    
    // Show user-friendly error message
    die("We're experiencing technical difficulties. Please try again later.");
}