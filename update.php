<?php
session_start();
include 'configure.php'; // Include database connection

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

// Update logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input
    $class = htmlspecialchars($_POST['class']);
    $section = htmlspecialchars($_POST['section']);
    $roll_no = htmlspecialchars($_POST['roll_no']);
    $department = htmlspecialchars($_POST['department']);

    // Update the student's information
    $sql = "UPDATE students SET class = ?, section = ?, roll_no = ?, department = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$class, $section, $roll_no, $department, $student_id]);

    // Redirect back to dashboard after update
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Your Information</h2>
        <form action="update.php" method="POST" class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="class" class="form-label">Class</label>
                <input type="text" name="class" id="class" class="form-control" value="<?= htmlspecialchars($student['class']); ?>">
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" name="section" id="section" class="form-control" value="<?= htmlspecialchars($student['section']); ?>">
            </div>
            <div class="mb-3">
                <label for="roll_no" class="form-label">Roll Number</label>
                <input type="text" name="roll_no" id="roll_no" class="form-control" value="<?= htmlspecialchars($student['roll_no']); ?>">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" name="department" id="department" class="form-control" value="<?= htmlspecialchars($student['department']); ?>">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Info</button>
        </form>
    </div>
</body>
</html>
