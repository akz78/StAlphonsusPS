<?php
session_start();
if (!isset($_SESSION['UserID'])) {
    echo "Access denied!";
    exit();
}
echo "<h2>Welcome, " . $_SESSION['Username'] . "!</h2>";
echo "<p>Role: " . $_SESSION['Role'] . "</p>";
echo "<a href='logout.php'>Logout</a>";
?>
