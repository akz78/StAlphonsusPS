<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Bootstrap CSS for responsive layout and predefined styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- styles -->
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <!-- Logo Section -->
        <div class="d-flex align-items-center py-3">
            <!-- Logo image with responsive max-width -->
            <img src="logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <!-- Message Section -->
        <div class="text-center mb-4">
            <h4>Welcome to St Alphonsus Primary School</h4>
            <p>Please log in to continue</p>
        </div>

        <!-- Login Form Section -->
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <!-- Card container for the login form -->
            <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
                <div class="card-body">
                    <!-- Title of the login card -->
                    <h3 class="card-title text-center mb-4">Login</h3>

                    <!-- Error Message Display -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form action="authenticate.php" method="POST">
                        <!-- Username Input -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="username" 
                                name="username" 
                                required 
                                value="<?php echo isset($_GET['user']) ? htmlspecialchars($_GET['user']) : ''; ?>">
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS for interactive elements -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
