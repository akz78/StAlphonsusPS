<?php
include 'config.php'; // Include the database connection

// Initialize the message variable to display success/error message
$message = '';

// Check if the form has been submitted by the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $classid = mysqli_real_escape_string($conn, $_POST['classid']);
    $medicalinfo = mysqli_real_escape_string($conn, $_POST['medicalinfo']);

    // Validate that names contain only letters and spaces
    if (!preg_match("/^[A-Za-z\s]+$/", $firstname) || !preg_match("/^[A-Za-z\s]+$/", $lastname)) {
        $message = "<p class='error'>Error: First and Last Name must contain only letters and spaces.</p>";
    } else {
        // Check if the class ID exists in the 'class' table
        $check_class_sql = "SELECT * FROM class WHERE ClassID = '$classid'";
        $check_result = $conn->query($check_class_sql);

        if ($check_result->num_rows > 0) {
            // Insert into the Pupil table
            $sql = "INSERT INTO Pupil (FirstName, LastName, DateOfBirth, Address, ClassID, MedicalInfo)
                    VALUES ('$firstname', '$lastname', '$dob', '$address', '$classid', '$medicalinfo')";

            if ($conn->query($sql) === TRUE) {
                $message = "<p class='success'>New pupil record created successfully!</p>";
            } else {
                $message = "<p class='error'>Error: " . $conn->error . "</p>";
            }
        } else {
            $message = "<p class='error'>Error: The selected class does not exist. Please check the Class ID.</p>";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Pupil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add_pupil.php">Add Pupil</a></li>
                <li><a href="retrieve_pupils.php">View Pupils</a></li>
                <li><a href="retrieve_parents.php">View Parents</a></li>
                <li><a href="retrieve_pupil_parents.php">View Pupil-Parent Relationships</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Add Pupil</h2>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="add_pupil.php" method="POST">
            <input type="text" name="firstname" placeholder="First Name" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
            <i class="fas fa-user"></i>

            <input type="text" name="lastname" placeholder="Last Name" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
            <i class="fas fa-user"></i>

            <input type="date" name="dob" required>
            <i class="fas fa-calendar-alt"></i>

            <input type="text" name="address" placeholder="Address">
            <i class="fas fa-home"></i>

            <input type="number" name="classid" placeholder="Class ID" required min="0" max="7">

            <input type="text" name="medicalinfo" placeholder="Medical Information (if any)">
            <i class="fas fa-notes-medical"></i>

            <input type="submit" value="Submit">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
