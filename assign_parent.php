<?php 
include 'config.php'; 

$message = ""; // Message to display success or error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parentid = mysqli_real_escape_string($conn, $_POST['parentid']);
    $pupilids = $_POST['pupilid']; // This is now an array for multiple pupils

    $inserted = false;

    foreach ($pupilids as $pupilid) {
        $pupilid = mysqli_real_escape_string($conn, $pupilid);

        // Check if PupilID and ParentID exist
        $check_pupil = "SELECT * FROM pupil WHERE PupilID = '$pupilid'";
        $check_parent = "SELECT * FROM parentguardian WHERE ParentID = '$parentid'";
        $pupil_result = $conn->query($check_pupil);
        $parent_result = $conn->query($check_parent);

        if ($pupil_result->num_rows > 0 && $parent_result->num_rows > 0) {
            // Avoid duplicate entries
            $check_existing = "SELECT * FROM PupilParent WHERE PupilID = '$pupilid' AND ParentID = '$parentid'";
            $existing_result = $conn->query($check_existing);

            if ($existing_result->num_rows == 0) {
                $sql = "INSERT INTO PupilParent (PupilID, ParentID) VALUES ('$pupilid', '$parentid')";
                $conn->query($sql);
                $inserted = true;
            }
        }
    }

    if ($inserted) {
        $message = "<p class='success'>Parent assigned to selected pupil(s) successfully!</p>";
    } else {
        $message = "<p class='error'>Error: No new assignments were made. Check IDs or avoid duplicates.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Assign Parent to Pupil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        select[multiple] {
            height: 150px;
            width: 100%;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.png" alt="School Logo" class="logo">
    </header>

    <div class="container">
        <h2>Assign Parent to Pupil</h2>

        <?php echo $message; ?>

        <form action="" method="POST">
            <label for="pupilid">Select Pupil(s):</label>
            <select name="pupilid[]" multiple required>
                <?php
                $pupil_query = "SELECT PupilID, FirstName, LastName FROM pupil";
                $pupil_result = $conn->query($pupil_query);
                while ($row = $pupil_result->fetch_assoc()) {
                    echo "<option value='{$row['PupilID']}'>{$row['FirstName']} {$row['LastName']} (ID: {$row['PupilID']})</option>";
                }
                ?>
            </select>

            <label for="parentid">Select Parent:</label>
            <select name="parentid" required>
                <option value="" disabled selected>-- Choose Parent --</option>
                <?php
                $parent_query = "SELECT ParentID, FirstName, LastName FROM parentguardian";
                $parent_result = $conn->query($parent_query);
                while ($row = $parent_result->fetch_assoc()) {
                    echo "<option value='{$row['ParentID']}'>{$row['FirstName']} {$row['LastName']} (ID: {$row['ParentID']})</option>";
                }
                ?>
            </select>

            <input type="submit" value="Assign Parent" style="margin-top: 15px;">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>
</body>
</html>
