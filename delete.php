<?php
session_start();
include 'configure.php'; // Include database connection

if (!isset($_SESSION['student_id'])) {
    header('Location: index.php'); // Redirect to login page
    exit;
}

// Delete the student's account from the database
$student_id = $_SESSION['student_id'];
$sql = "DELETE FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$student_id]);

// Destroy session and redirect to home page
session_destroy();
header('Location: index.php');
exit;
?>
