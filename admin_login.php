<?php
session_start();
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php"); // Redirect to the admin dashboard after successful login
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form action="admin_login.php" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Admin Login</h2>
        <?php if (isset($error_message)): ?>
            <p class="text-red-500"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium">Username:</label>
            <input type="text" name="username" id="username" required class="w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password:</label>
            <input type="password" name="password" id="password" required class="w-full p-2 border rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
    </form>
</body>
</html>
