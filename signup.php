

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Student Sign-Up</h2>
        <form action="signup.php" method="POST" class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="class" class="form-label">Class</label>
                <input type="text" name="class" id="class" class="form-control">
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" name="section" id="section" class="form-control">
            </div>
            <div class="mb-3">
                <label for="roll_no" class="form-label">Roll Number</label>
                <input type="text" name="roll_no" id="roll_no" class="form-control">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" name="department" id="department" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <p class="text-center mt-3">Already have an account? <a href="index.php">Log In</a></p>
        </form>
    </div>
</body>
</html>


<?php
session_start();
include 'configure.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $class = htmlspecialchars($_POST['class']);
    $section = htmlspecialchars($_POST['section']);
    $roll_no = htmlspecialchars($_POST['roll_no']);
    $department = htmlspecialchars($_POST['department']);

    // Validate email (basic check)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert data
    $sql = "INSERT INTO students (name, email, password, class, section, roll_no, department) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $hashed_password, $class, $section, $roll_no, $department]);

    // Redirect to login page after successful sign-up
    header('Location: index.php');
    exit;
}
?>
