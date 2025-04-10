<?php
// Include the database connection
include 'config.php';

// SQL query to retrieve all data from the DinnerMoney table
$sql = "SELECT * FROM DinnerMoney";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // If results are found, display them in a table
    echo "<table border='1'>
            <tr>
                <th>Pupil ID</th>
                <th>Balance</th>
                <th>Last Updated</th>
                <th>Payment Method</th>
            </tr>";

    // Loop through the results and display them in each table row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["PupilID"] . "</td>
                <td>" . $row["Balance"] . "</td>
                <td>" . $row["LastUpdated"] . "</td>
                <td>" . $row["PaymentMethod"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    // If no results are found, display a message
    echo "0 results found";
}

// Close the database connection
$conn->close();
?>
