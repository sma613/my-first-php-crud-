<?php
session_start();
include 'configure.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Check if email exists in the database
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $student = $stmt->fetch();

    // Verify the password
    if ($student && password_verify($password, $student['password'])) {
        // Password is correct, start session
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];

        // Redirect to dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Invalid login
        echo "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Student Login</h2>
        <form action="index.php" method="POST" class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Log In</button>
            <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
</body>
</html>
