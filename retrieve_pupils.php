<?php
// Include the database connection file
include 'config.php';

// Check if there's a delete request
if (isset($_GET['delete'])) {
    $deleteID = intval($_GET['delete']); // Sanitize input to prevent SQL injection
    $deleteQuery = "DELETE FROM pupil WHERE PupilID = $deleteID"; // Delete query
    $conn->query($deleteQuery); // Execute the query
    // Redirect to prevent repeated deletion on page refresh
    header("Location: retrieve_pupils.php");
    exit();
}

// Fetch all pupil records
$sql = "SELECT PupilID, FirstName, LastName, DateOfBirth, Address, MedicalInfo, ClassID FROM pupil";
$result = $conn->query($sql); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupil Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            border: 1px solid #333;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a.button {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #444;
            border-radius: 4px;
            margin: 2px;
            background-color: #e7e7e7;
            color: #000;
        }

        a.button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Pupil List</h2>

    <table>
        <tr>
            <th>Pupil ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Medical Info</th>
            <th>Class ID</th>
            <th>Actions</th> <!-- Column for action buttons -->
        </tr>

        <?php
        // Check if there are any pupil records
        if ($result->num_rows > 0) {
            // Loop through each pupil record
            while ($row = $result->fetch_assoc()) {
                // Display pupil information and action buttons
                echo "<tr>
                        <td>{$row['PupilID']}</td>
                        <td>{$row['FirstName']}</td>
                        <td>{$row['LastName']}</td>
                        <td>{$row['DateOfBirth']}</td>
                        <td>{$row['Address']}</td>
                        <td>{$row['MedicalInfo']}</td>
                        <td>{$row['ClassID']}</td>
                        <td>
                            <a class='button' href='#'>View</a> <!-- Placeholder for View -->
                            <a class='button' href='#'>Edit</a> <!-- Placeholder for Edit -->
                            <a class='button' href='retrieve_pupils.php?delete={$row['PupilID']}' onclick=\"return confirm('Are you sure you want to delete this pupil?');\">Delete</a> <!-- Delete button with confirmation -->
                        </td>
                      </tr>";
            }
        } else {
            // No records found
            echo "<tr><td colspan='8'>No pupils found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
