<?php
// Include the database connection file
include 'config.php';

// SQL query to get pupils and their parent information through the pupilparent table
$sql = "SELECT p.PupilID, p.FirstName AS PupilFirstName, p.LastName AS PupilLastName, 
               pg.FirstName AS ParentFirstName, pg.LastName AS ParentLastName, pg.PhoneNumber 
        FROM pupil p
        JOIN pupilparent pp ON p.PupilID = pp.PupilID
        JOIN parentguardian pg ON pp.ParentID = pg.ParentID";

$result = $conn->query($sql); // Execute the query to retrieve the data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupils and Their Parents</title>
</head>
<body>
    <h2>Pupil and Parent List</h2>

    <table border="1"> <!-- Table with a border to separate data clearly -->
        <tr>
            <th>Pupil ID</th>
            <th>Pupil Name</th>
            <th>Parent Name</th>
            <th>Phone Number</th> <!-- Column for Parent's Phone Number -->
        </tr>

        <?php
        // Check if there are any records returned from the query
        if ($result->num_rows > 0) {
            // Loop through each row in the result
            while ($row = $result->fetch_assoc()) {
                // Display the pupil and parent details in the table
                echo "<tr>
                        <td>{$row['PupilID']}</td> <!-- Pupil ID -->
                        <td>{$row['PupilFirstName']} {$row['PupilLastName']}</td> <!-- Full name of pupil -->
                        <td>{$row['ParentFirstName']} {$row['ParentLastName']}</td> <!-- Full name of parent -->
                        <td>{$row['PhoneNumber']}</td> <!-- Parent's phone number -->
                      </tr>";
            }
        } else {
            // If no records found, show a message in the table
            echo "<tr><td colspan='4'>No pupil-parent relationships found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
