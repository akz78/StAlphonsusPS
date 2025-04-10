<?php
// Start the session to access session variables
session_start();

// Destroy the current session, clearing all session data
session_destroy();

// Redirect the user to the login page after logging out
header("Location: login.php");

// Exit the script to ensure no further code is executed
exit();
?>
