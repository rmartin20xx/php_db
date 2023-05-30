<?php
// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = 'passwordone';
$database = 'school_db';

// Create a database connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}
?>
