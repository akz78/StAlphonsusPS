    <!-- Own code Starts -->

<?php
// Include the database connection config file
include 'config.php';

// SQL query to get teacher info along with their assigned class 
$sql = "SELECT t.TeacherID, t.FirstName, t.LastName, c.ClassName, c.Capacity 
        FROM teacher t
        LEFT JOIN class c ON t.TeacherID = c.TeacherID
        ORDER BY t.TeacherID"; 

// Run the query and store the result
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers and Their Classes</title>
</head>
<body>
    <h2>Teachers and Assigned Classes</h2>

    <!-- Table showing each teacher with their class and its capacity -->
    <table border="1">
        <tr>
            <th>Teacher ID</th>
            <th>Teacher Name</th>
            <th>Class Name</th>
            <th>Capacity</th>
        </tr>

        <?php
        // If there are any results from the query, loop through and display them
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    // Display teacher's ID
                    echo "<td>{$row['TeacherID']}</td>";

                    // Combine first and last name into one cell
                    echo "<td>{$row['FirstName']} {$row['LastName']}</td>";

                    // Show class name if assigned, otherwise say "No class assigned"
                    echo "<td>";
                    echo !empty($row['ClassName']) ? $row['ClassName'] : "No class assigned";
                    echo "</td>";

                    // Show class capacity if available, otherwise just a dash
                    echo "<td>";
                    echo !empty($row['Capacity']) ? $row['Capacity'] : "-";
                    echo "</td>";
                echo "</tr>";
            }
        } else {
            // If no data was returned, display a single row saying so
            echo "<tr><td colspan='4'>No teacher records found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
    <!-- Own code ends -->
