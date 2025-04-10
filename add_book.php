<?php
include 'config.php'; // Include the database connection

// Initialize the message variable to display success/error message
$message = '';

// Check if the form has been submitted by the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize the input data to prevent SQL injection
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);

    // Insert the book record into the 'LibraryBooks' table
    $sql = "INSERT INTO LibraryBooks (Title, Author, ISBN)
            VALUES ('$title', '$author', '$isbn')";

    // Execute the query and check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        // Set success message
        $message = "<p class='success'>New book record added successfully!</p>";
    } else {
        // Set error message if insertion failed
        $message = "<p class='error'>Error: " . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Library Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
    </header>

    <div class="container">
        <h2>Add New Book</h2>
        
        <!-- Display the success or error message here -->
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="add_book.php" method="POST">
            <label for="title">Book Title:</label>
            <input type="text" name="title" required>

            <label for="author">Author:</label>
            <input type="text" name="author" required>

            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" required>

            <input type="submit" value="Add Book">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
