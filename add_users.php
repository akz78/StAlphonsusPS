<?php
session_start();
include 'config.php'; // Ensure this contains your database connection ($conn)

// Function to hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO users (Username, PasswordHash, Role, Email, CreatedAt) VALUES (?, ?, ?, ?, NOW())");

// Add Users (user1 to user5)
for ($i = 1; $i <= 5; $i++) {
    $username = "user$i";
    $password = "pass$i";
    $hashedPassword = hashPassword($password);
    $role = "user";
    $email = "user$i@example.com";

    $stmt->bind_param("ssss", $username, $hashedPassword, $role, $email);
    $stmt->execute();
}

// Add Students (student1 to student5)
for ($i = 1; $i <= 5; $i++) {
    $username = "student$i";
    $password = "pass$i";
    $hashedPassword = hashPassword($password);
    $role = "student";
    $email = "student$i@example.com";

    $stmt->bind_param("ssss", $username, $hashedPassword, $role, $email);
    $stmt->execute();
}

// Add Teachers (teacher1 to teacher5)
for ($i = 1; $i <= 5; $i++) {
    $username = "teacher$i";
    $password = "pass$i";
    $hashedPassword = hashPassword($password);
    $role = "teacher";
    $email = "teacher$i@example.com";

    $stmt->bind_param("ssss", $username, $hashedPassword, $role, $email);
    $stmt->execute();
}

// Add Admins (admin1 to admin5)
for ($i = 1; $i <= 5; $i++) {
    $username = "admin$i";
    $password = "pass$i";
    $hashedPassword = hashPassword($password);
    $role = "admin";
    $email = "admin$i@example.com";

    $stmt->bind_param("ssss", $username, $hashedPassword, $role, $email);
    $stmt->execute();
}

// Add Parents (parent1 to parent5)
for ($i = 1; $i <= 5; $i++) {
    $username = "parent$i";
    $password = "pass$i";
    $hashedPassword = hashPassword($password);
    $role = "parent";
    $email = "parent$i@example.com";

    $stmt->bind_param("ssss", $username, $hashedPassword, $role, $email);
    $stmt->execute();
}

echo "Users added successfully!";
?>
