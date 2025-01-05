<?php
// Database connection details
$hostname = "localhost";
$username = "root";
$password = "";
$database = "datavault";
// Connect to the database
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}