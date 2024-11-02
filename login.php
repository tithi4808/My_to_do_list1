<?php 
session_start();
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM users1 WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user1_id'] = $user['id']; // Store user ID in session
        header("Location: index.php"); // Redirect to index.php on successful login
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold">Login</h2>
        <form action="" method="POST" class="mt-4">
            <input type="email" name="email" placeholder="Email" required class="block w-full p-2 mb-4 border">
            <input type="password" name="password" placeholder="Password" required class="block w-full p-2 mb-4 border">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Login</button>
            <?php if (isset($error)) { echo "<p class='text-red-500'>$error</p>"; } ?>
        </form>
    </div>
</body>
</html>
