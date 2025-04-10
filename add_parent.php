<?php
include 'config.php'; // Include the database connection

// Initialize the message variable to display success/error message
$message = '';

// Check if the form has been submitted by the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize the input data to prevent SQL injection
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Insert the parent/guardian record into the 'ParentGuardian' table
    $sql = "INSERT INTO ParentGuardian (FirstName, LastName, PhoneNumber, Email, Address)
            VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$address')";

    // Execute the query and check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        // Set success message
        $message = "<p class='success'>New parent/guardian record added successfully!</p>";
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
    <title>Add Parent/Guardian</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
    </header>
    
    <div class="container">
        <h2>Add Parent/Guardian</h2>
        
        <!-- Display the success or error message here -->
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="add_parent.php" method="POST">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" required>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" required>

            <label for="phonenumber">Phone Number:</label>
            <input type="text" name="phonenumber" required>

            <label for="email">Email:</label>
            <input type="email" name="email">

            <label for="address">Address:</label>
            <input type="text" name="address">

            <input type="submit" value="Submit">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
