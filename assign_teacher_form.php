<?php
include 'config.php'; // Include the database connection

// Initialize the message variable
$message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classid = mysqli_real_escape_string($conn, $_POST['classid']);
    $teacherid = mysqli_real_escape_string($conn, $_POST['teacherid']);

    // Check if the selected teacher is already assigned to another class
    $check_teacher_sql = "SELECT * FROM class WHERE TeacherID = '$teacherid'";
    $check_result = $conn->query($check_teacher_sql);

    if ($check_result->num_rows > 0) {
        $message = "<p class='error'>Error: This teacher is already assigned to another class.</p>";
    } else {
        // Update the 'class' table to assign the teacher
        $sql = "UPDATE class SET TeacherID = '$teacherid' WHERE ClassID = '$classid'";

        if ($conn->query($sql) === TRUE) {
            $message = "<p class='success'>Teacher assigned successfully!</p>";
        } else {
            $message = "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
}

// Fetch classes and teachers for the dropdowns
$class_query = "SELECT * FROM class";
$classes = $conn->query($class_query);

$teacher_query = "SELECT * FROM teacher";
$teachers = $conn->query($teacher_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Assign Teacher to Class</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
    </header>
    
    <div class="container">
        <h2>Assign Teacher to Class</h2>

        <!-- Display success/error message -->
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="assign_teacher_form.php" method="POST">
        <label for="classid">Class ID:</label>
            <select name="classid" required>
                <?php while ($row = $classes->fetch_assoc()): ?>
                    <option value="<?= $row['ClassID'] ?>"><?= $row['ClassName'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="teacherid">Teacher ID:</label>
            <select name="teacherid" required>
                <?php while ($row = $teachers->fetch_assoc()): ?>
                    <option value="<?= $row['TeacherID'] ?>"><?= $row['FirstName'] . " " . $row['LastName'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Assign Teacher">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
