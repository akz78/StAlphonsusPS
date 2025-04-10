<?php
// Include the database connection
include 'config.php';

$message = ""; // Variable to store success or error message

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $pupilid = $_POST['pupilid'];
    $balance = $_POST['balance'];
    $paymentmethod = $_POST['paymentmethod'];
    $lastupdated = date('Y-m-d'); // Set current date as last updated

    // SQL query to insert data into DinnerMoney table
    $sql = "INSERT INTO DinnerMoney (PupilID, Balance, LastUpdated, PaymentMethod)
            VALUES ('$pupilid', '$balance', '$lastupdated', '$paymentmethod')";

    // Check if the query was successful
    if ($conn->query($sql) === TRUE) {
        $message = "Record successfully added!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert DinnerMoney Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Insert DinnerMoney Record</h2>

        <!-- Display success or error message -->
        <?php
        if ($message != "") {
            echo "<p>$message</p>";
        }
        ?>

        <form action="dinnermoney_insert.php" method="POST">
            <input type="number" name="pupilid" placeholder="Pupil ID" required>
            <input type="number" name="balance" placeholder="Balance" step="0.01" required>
            <input type="text" name="paymentmethod" placeholder="Payment Method" required>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
