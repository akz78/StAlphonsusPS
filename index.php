<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>School Portal</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Brand Name (Logo) -->
            <a class="navbar-brand" href="index.php">
                <img src="logo.png" alt="School Logo" class="logo" style="height: 40px;">
            </a>
            
            <!-- Button for mobile navigation menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_pupil.php">Add Pupil</a></li>
                    <li class="nav-item"><a class="nav-link" href="retrieve_pupils.php">View Pupils</a></li>
                    <li class="nav-item"><a class="nav-link" href="retrieve_parents.php">View Parents</a></li>
                    <li class="nav-item"><a class="nav-link" href="retrieve_pupil_parents.php">View Pupil-Parent Relationships</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_book.php">Add Book</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_parent.php">Add Parents</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_ta_details.php">Add Teaching Assistant</a></li>
                    <li class="nav-item"><a class="nav-link" href="assign_parent.php">Assign Parent-Pupil</a></li>
                    <li class="nav-item"><a class="nav-link" href="assign_teacher_form.php">Assign Teacher to Class</a></li>
                    <li class="nav-item"><a class="nav-link" href="borrow_book.php">Borrow a Book</a></li>
                    <li class="nav-item"><a class="nav-link" href="retrieve_classes.php">Class List</a></li>
                    <li class="nav-item"><a class="nav-link" href="retrieve_teachers.php">Teachers</a></li>
                    <li class="nav-item"><a class="nav-link" href="dinnermoney_insert.php">Add Dinner Money</a></li>
                    <li class="nav-item"><a class="nav-link" href="update_status.php">Update Library Book Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="dinnermoney_retrieve.php">View dinner money records</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_books.php">View All Books</a></li></li>
                    <li class="nav-item"><a class="nav-link" href="Teachers.php">Teacher details</a></li>
                    <li class="nav-item"><a class="nav-link" href="salary.php">Add salary</a></li>

                </ul>
                
                <!-- Logout Button -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 80px;">
        <h1>Welcome to St. Alphonsus Primary School Portal</h1>
        <p>Manage pupils, parents, and school data efficiently.</p>
    </div>

    <footer class="text-center mt-4">
        <p>&copy; 2025 St. Alphonsus Primary School. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
