<?php
// Connect to the database
include 'config.php';

// Query to get all teaching assistants from the database
$sql = "SELECT * FROM teachingassistant";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Teaching Assistants</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">

        <!-- Simple navigation bar -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="salary.php">Add Salary</a></li>
                <li><a href="retrieve_tas.php">View TAs</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Teaching Assistants</h2>

        <?php if ($result->num_rows > 0): ?>
            <!-- If there are TAs in the database, display them in a table -->
            <table>
                <thead>
                    <tr>
                        <th>TA ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Assigned Class ID</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through each TA and display their details -->
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['TAID']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['LastName']; ?></td>
                            <td><?php echo $row['AssignedClassID']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
                            <td><?php echo $row['PhoneNumber']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Message shown if no TAs are found -->
            <p>No teaching assistants found.</p>
        <?php endif; ?>

        <?php $conn->close(); // Close the database connection ?>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
