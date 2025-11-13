<?php
//backend/config/db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finance_tracker";

//Create connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    //Check connection
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        $conn = null; // Set to null if connection fails
    }
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    $conn = null; // Set to null if exception occurs
}
?>
