<?php
// Include database connection
include 'config.php';

// SQL query to fetch class details along with pupils and class capacity
$sql = "SELECT c.ClassID, c.ClassName, c.Capacity, p.PupilID, p.FirstName, p.LastName 
        FROM class c
        LEFT JOIN pupil p ON c.ClassID = p.ClassID  
        ORDER BY c.ClassID, p.PupilID"; 

// Execute the query and store the result
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes and Pupils</title>
</head>
<body>
    <h2>Class List with Pupils and Capacity</h2>

    <table border="1">
        <tr>
            <th>Class ID</th>
            <th>Class Name</th>
            <th>Capacity</th> <!-- New column for class capacity -->
            <th>Pupil ID</th>
            <th>Pupil Name</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ClassID']}</td>
                        <td>{$row['ClassName']}</td>
                        <td>{$row['Capacity']}</td> <!-- Display Class Capacity -->
                        <td>"; 
                // Check if a pupil is assigned to this class
                if (!empty($row['PupilID'])) {
                    echo "{$row['PupilID']}";
                } else {
                    echo "No pupils assigned";
                }
                echo "</td>
                        <td>"; 
                if (!empty($row['PupilID'])) {
                    echo "{$row['FirstName']} {$row['LastName']}";
                } else {
                    echo "-";
                }
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No classes found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
