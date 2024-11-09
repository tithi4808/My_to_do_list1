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

    <!-- Tailwind CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- DaisyUI (Tailwind plugin) -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
    <nav>
        <div class="navbar bg-blue-950">
            <div class="navbar-start">
                <a class="btn btn-ghost text-xl">
                    <span class="font-bold text-3xl text-yellow-300">Task</span><span class="mt-2 text-orange-50">Nest</span>
                </a>
            </div>
            <div class="navbar-end">
                <ul class="menu menu-horizontal px-1 text-orange-50 text-lg">
                    <li><a href="about.php">About us</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="register.php">User Registration</a></li>
                    <li><a href="admin_login.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="hero min-h-screen bg-base-100">
        <div class="hero-content flex-col">
            <h1 class="text-4xl text-blue-950 font-bold mb-2">Admin Login</h1>

            <!-- Form for Admin Login -->
            <form action="admin_login.php" method="POST" class="card shadow-xl bg-white p-8">
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" class="input input-bordered" placeholder="Username" required />
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered" placeholder="Password" required />
                </div>

                <button type="submit" class="btn bg-blue-950 text-white w-full">Login</button>

                <!-- Display error message if login fails -->
                <?php if (isset($error_message)): ?>
                    <p class="text-red-500 mt-4 text-center"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</main>

<footer></footer>

</body>
</html>
