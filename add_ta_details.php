<?php
include 'config.php'; // Include the database connection

// Initialize the message variable to display success/error message
$message = '';

// Check if the form has been submitted by the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $assignedclassid = mysqli_real_escape_string($conn, $_POST['assignedclassid']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);

    // Validate that names contain only letters and spaces
    if (!preg_match("/^[A-Za-z\s]+$/", $firstname) || !preg_match("/^[A-Za-z\s]+$/", $lastname)) {
        $message = "<p class='error'>Error: First and Last Name must contain only letters and spaces.</p>";
    } else {
        // Insert into the Teaching Assistant table
        $sql = "INSERT INTO TeachingAssistant (FirstName, LastName, AssignedClassID, Address, PhoneNumber)
                VALUES ('$firstname', '$lastname', '$assignedclassid', '$address', '$phonenumber')";

        if ($conn->query($sql) === TRUE) {
            $message = "<p class='success'>New teaching assistant record created successfully!</p>";
        } else {
            $message = "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Teaching Assistant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add_ta.php">Add Teaching Assistant</a></li>
                <li><a href="view_tas.php">View Teaching Assistants</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Add Teaching Assistant</h2>

        <!-- Display message after form submission -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Form that submits to the same page -->
        <form method="POST">
            <!-- First Name -->
            <input type="text" name="firstname" placeholder="First Name" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
            <i class="fas fa-user"></i>

            <!-- Last Name -->
            <input type="text" name="lastname" placeholder="Last Name" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
            <i class="fas fa-user"></i>

            <!-- Assigned Class ID -->
            <input type="number" name="assignedclassid" placeholder="Assigned Class ID" required min="1">
            <i class="fas fa-school"></i>

            <!-- Address -->
            <input type="text" name="address" placeholder="Address" required>
            <i class="fas fa-home"></i>

            <!-- Phone Number -->
            <input type="tel" name="phonenumber" placeholder="Phone Number" required pattern="[0-9]{10}" title="Phone number should be 10 digits">
            <i class="fas fa-phone"></i>

            <input type="submit" value="Submit">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>