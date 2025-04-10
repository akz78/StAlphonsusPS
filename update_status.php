<!--Own Code Starts -->
<?php 
include 'config.php'; // Connect to the database using settings from config.php

$message = ""; //  success or error messages

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Grab form inputs
    $bookid = $_POST['bookid'];
    $status = $_POST['status'];

    // Check if a book with this ID exists
    $checkBook = $conn->query("SELECT * FROM librarybooks WHERE BookID = '$bookid'");

    if ($checkBook->num_rows === 0) {
        // No book found with that ID
        $message = "Error: Book does not exist.";
    } else {
        // Book exists, so update its status
        $updateQuery = "UPDATE librarybooks SET Status = '$status' WHERE BookID = '$bookid'";

        if ($conn->query($updateQuery) === true) {
            $message = "Book status updated successfully!";
        } else {
            // Something went wrong during the update
            $message = "Error: " . $conn->error;
        }
    }
}

$conn->close(); // Close the DB connection once we're done
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book Status</title>
    <link rel="stylesheet" href="style.css"> <!-- External styles -->
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo"> <!-- School logo at the top -->
    </header>

    <div class="container">
        <!-- If there's a message to show (success or error), display it -->
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Update Book Status</h2>
        
        <form action="update_status.php" method="POST">
            <label for="bookid">Book ID:</label>
            <input type="number" name="bookid" id="bookid" required>

            <label for="status">Select Status:</label>
            <select name="status" id="status" required>
                <option value="Available">Available</option>
                <option value="Borrowed">Borrowed</option>
            </select>

            <input type="submit" value="Update Status">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
<!--Own code Ends-->