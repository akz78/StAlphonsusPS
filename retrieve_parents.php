<?php
// Include the database connection file to establish a connection with the database
include 'config.php';

// SQL query to fetch parent records from the 'parentguardian' table
$sql = "SELECT ParentID, FirstName, LastName, Address, PhoneNumber, Email FROM parentguardian";

// Execute the query and store the result
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Records</title>
</head>
<body>
    <h2>Parent List</h2>

    <table border="1"> <!-- Table with a border to display parent records -->
        <tr>
            <th>Parent ID</th> <!-- Column for Parent ID -->
            <th>First Name</th> <!-- Column for Parent First Name -->
            <th>Last Name</th> <!-- Column for Parent Last Name -->
            <th>Address</th> <!-- Column for Parent Address -->
            <th>Phone Number</th> <!-- Column for Parent Phone Number -->
            <th>Email</th> <!-- Column for Parent Email -->
        </tr>

        <?php
        // Check if any parent records exist
        if ($result->num_rows > 0) {
            // Loop through each record and display in a table row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ParentID']}</td> <!-- Display Parent ID -->
                        <td>{$row['FirstName']}</td> <!-- Display First Name -->
                        <td>{$row['LastName']}</td> <!-- Display Last Name -->
                        <td>{$row['Address']}</td> <!-- Display Address -->
                        <td>{$row['PhoneNumber']}</td> <!-- Display Phone Number -->
                        <td>{$row['Email']}</td> <!-- Display Email -->
                      </tr>";
            }
        } else {
            // Display a message when no parent records are found
            echo "<tr><td colspan='6'>No parents found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
