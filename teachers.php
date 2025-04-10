<!--Own code Starts-->
<?php
include 'config.php'; //  database connection details

// Fetch all teachers and their details, sorted by ID
$sql = "SELECT TeacherID, FirstName, LastName, Address, PhoneNumber, AnnualSalary, BackgroundCheck 
        FROM teacher 
        ORDER BY TeacherID";

$result = $conn->query($sql); // Run the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers List</title>
    <link rel="stylesheet" href="style.css"> <!-- External stylesheet -->
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo"> <!-- School branding -->
    </header>

    <div class="container">
        <h2>Teachers List</h2>

        <table border="1"> <!-- Simple bordered table for structure -->
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Annual Salary</th>
                    <th>Background Check</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Loop through each teacher and show their info
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['TeacherID']}</td>";
                        echo "<td>{$row['FirstName']} {$row['LastName']}</td>";
                        echo "<td>{$row['Address']}</td>";
                        echo "<td>{$row['PhoneNumber']}</td>";
                        echo "<td>{$row['AnnualSalary']}</td>";
                        echo "<td>{$row['BackgroundCheck']}</td>";
                        echo "<td>
                                <a href='edit_teacher.php?id={$row['TeacherID']}'>Edit</a> | 
                                <a href='copy_teacher.php?id={$row['TeacherID']}'>Copy</a> | 
                                <a href='delete_teacher.php?id={$row['TeacherID']}' onclick='return confirm(\"Are you sure you want to delete this teacher?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    // No teachers in the database
                    echo "<tr><td colspan='7'>No teacher records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
<!--Own code Ends-->
