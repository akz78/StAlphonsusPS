<!--Own code Starts-->
<?php
// Bring in the database connection
include 'config.php';

//show success or errors
$message = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Grab all the submitted form data
    $teacher_id = isset($_POST['teacherid']) ? $_POST['teacherid'] : NULL;
    $ta_id = isset($_POST['taid']) ? $_POST['taid'] : NULL;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : NULL;
    $payment_date = isset($_POST['paymentdate']) ? $_POST['paymentdate'] : NULL;

    // Make sure either a Teacher ID or TA ID was entered
    if (empty($teacher_id) && empty($ta_id)) {
        $message = "<div class='error-message'>Error: You must enter either a Teacher ID or a Teaching Assistant ID.</div>";
    } elseif ($amount && $payment_date) {
        // If a Teacher ID was entered, check if it exists
        if ($teacher_id) {
            $teacher_check = "SELECT * FROM teacher WHERE TeacherID = '$teacher_id'";
            $teacher_result = $conn->query($teacher_check);

            if ($teacher_result->num_rows > 0) {
                // Insert salary info for teacher or TA
                $sql = "INSERT INTO salaries (TeacherID, TAID, Amount, PaymentDate) 
                        VALUES ('$teacher_id', '$ta_id', '$amount', '$payment_date')";

                if ($conn->query($sql) === TRUE) {
                    $message = "<div class='success-message'>Salary record added successfully!</div>";
                } else {
                    $message = "<div class='error-message'>Error: " . $conn->error . "</div>";
                }
            } else {
                // Teacher ID not found in the database
                $message = "<div class='error-message'>Error: Teacher with ID $teacher_id does not exist.</div>";
            }
        } elseif ($ta_id) {
            // Handle the case where only TA ID is submitted
            $sql = "INSERT INTO salaries (TeacherID, TAID, Amount, PaymentDate) 
                    VALUES (NULL, '$ta_id', '$amount', '$payment_date')";

            if ($conn->query($sql) === TRUE) {
                $message = "<div class='success-message'>Salary record added successfully for Teaching Assistant!</div>";
            } else {
                $message = "<div class='error-message'>Error: " . $conn->error . "</div>";
            }
        }
    } else {
        // Required fields missing
        $message = "<div class='error-message'>Error: Amount and Payment Date are required.</div>";
    }

    // Close the connection when done
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teacher Salary</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your main stylesheet -->
</head>
<body>
    <header>
        <!-- School logo positioned in the top-left corner -->
        <img src="logo.png" alt="School Logo" class="logo">
    </header>
    
    <div class="container">
        <h2>Add Teacher or TA Salary</h2>

        <!-- Display success or error messages here -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Salary submission form -->
        <form action="salary.php" method="POST">
            <!-- Either Teacher ID or TA ID can be entered, not both required -->

            <label for="teacherid">Teacher ID:</label>
            <input type="number" name="teacherid" placeholder="Teacher ID">

            <label for="taid">Teaching Assistant ID (optional):</label>
            <input type="number" name="taid" placeholder="Teaching Assistant ID">

            <!-- Required fields -->
            <label for="amount">Amount:</label>
            <input type="number" name="amount" placeholder="Amount" required>

            <label for="paymentdate">Payment Date:</label>
            <input type="date" name="paymentdate" required>

            <input type="submit" value="Submit">
        </form>
    </div>

    <footer>
        <!-- Footer message stays at the bottom -->
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>

<!--Own code Ends-->
