<?php
session_start(); // Start the session to store success or error messages
include 'config.php'; // Include the database connection

// Process the form when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $pupilid = $_POST['pupilid'];
    $bookid = $_POST['bookid'];
    $borrowdate = $_POST['borrowdate'];

    // Insert data into the database (table name is 'borrowedbooks')
    $sql = "INSERT INTO borrowedbooks (pupilid, bookid, borrowdate) VALUES ('$pupilid', '$bookid', '$borrowdate')";
    
    if (mysqli_query($conn, $sql)) {
        // Set success message in session
        $_SESSION['success_message'] = "Book borrowed successfully!";
    } else {
        // Set error message in session
        $_SESSION['error_message'] = "Error borrowing book.";
    }

    // Redirect to the same page to show the message
    header("Location: borrow_book.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
    </header>

    <div class="container">
        <h2>Borrow a Book</h2>

        <!-- Display success or error message if available -->
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']); // Clear the message after displaying it
        }
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']); // Clear the message after displaying it
        }
        ?>

        <!-- Borrow book form -->
        <form action="borrow_book.php" method="POST">
            <label for="pupilid">Pupil ID:</label>
            <input type="number" name="pupilid" required>

            <label for="bookid">Book ID:</label>
            <input type="number" name="bookid" required>

            <label for="borrowdate">Borrow Date:</label>
            <input type="date" name="borrowdate" required>

            <input type="submit" value="Borrow Book">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>