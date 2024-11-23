<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Welcome to Your Dashboard</h2>
        <div class="p-4 border rounded shadow-sm">
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john.doe@example.com</p>
            <p><strong>Class:</strong> 10</p>
            <p><strong>Section:</strong> A</p>
            <p><strong>Roll Number:</strong> 12345</p>
            <p><strong>Department:</strong> Science</p>
            <a href="update.php" class="btn btn-warning">Update Info</a>
            <a href="delete.php" class="btn btn-danger">Delete Account</a>
        </div>
    </div>
</body>
</html>




<?php
session_start();
include 'configure.php'; // Include database connection

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: index.php'); // Redirect to login page
    exit;
}

// Fetch student data from the database
$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$student_id]);
$student = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Welcome, <?= htmlspecialchars($student['name']); ?>!</h2>
        <div class="p-4 border rounded shadow-sm">
            <p><strong>Name:</strong> <?= htmlspecialchars($student['name']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($student['email']); ?></p>
            <p><strong>Class:</strong> <?= htmlspecialchars($student['class']); ?></p>
            <p><strong>Section:</strong> <?= htmlspecialchars($student['section']); ?></p>
            <p><strong>Roll Number:</strong> <?= htmlspecialchars($student['roll_no']); ?></p>
            <p><strong>Department:</strong> <?= htmlspecialchars($student['department']); ?></p>
            <a href="update.php" class="btn btn-warning">Update Info</a>
            <a href="delete.php" class="btn btn-danger">Delete Account</a>
        </div>
    </div>
</body>
</html>
