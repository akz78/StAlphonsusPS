<?php
// Include the database config file
include('config.php');

// Select all records from the salaries table
$query = "SELECT * FROM salaries";

// Run the query
$result = mysqli_query($conn, $query);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {

    // Start the HTML table
    echo "<table border='1'>
            <tr>
                <th>Salary ID</th>
                <th>Teacher ID</th>
                <th>TA ID</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </tr>";

    // Display each salary record
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['SalaryID'] . "</td>
                <td>" . $row['TeacherID'] . "</td>
                <td>" . $row['TAID'] . "</td>
                <td>" . $row['Amount'] . "</td>
                <td>" . $row['PaymentDate'] . "</td>
              </tr>";
    }

    // Close the table
    echo "</table>";
} else {
    // No data found
    echo "No salaries found in the database.";
}

// Close database connection
mysqli_close($conn);
?>
