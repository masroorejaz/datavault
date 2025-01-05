<?php
// Start the session
session_start();

// Destroy the session and unset the user session variable
unset($_SESSION['user']);

// Destroy the entire session
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit();
?>
