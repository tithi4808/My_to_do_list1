<?php 
include 'dbconn.php';
session_start();
if (isset($_SESSION['user1_id'])) {
    $user_id = $_SESSION['user1_id'];


} else {
    // Redirect to login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
} // Assuming 'user_id' is set on login



if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['title']) && !empty($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $conn->prepare("INSERT INTO todo (title, description, date_time, user_id) VALUES (?, ?, NOW(), ?)");
    $stmt->execute([$title, $description, $user_id]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TaskNest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav>
    <div class="navbar bg-blue-950">
        <div class="navbar-start">
            <a class="btn btn-ghost text-xl">
                <span class="font-bold text-3xl text-yellow-300">Task</span><span class="mt-2 text-orange-50">Nest</span>
            </a>
        </div>

        <div class="navbar-end">
            <ul class="menu menu-horizontal px-1 text-orange-50 text-lg">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <!-- If logged in, show Logout else show Login -->
                <?php if (isset($_SESSION['user1_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content Section -->
<main class="py-12">
    <div class="container mx-auto px-6 max-w-5xl">
        <!-- About Us Heading -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-950 mb-6">Welcome to <span class="text-yellow-300">Task</span>Nest</h1>
            <div><hr></div>
            <p class="text-base text-gray-700">TaskNest is a simple, yet powerful task management platform. It allows you to manage your to-do lists, create and update tasks, and delete tasks when they're completed. You can even register, log in, and manage your tasks across multiple devices.</p>
        </div>

        <!-- Features of TaskNest -->
        <div class="mb-8">
            <div class="flex flex-col justify-center text-center ">
                <h2 class="text-3xl font-semibold text-blue-950 mb-4"><Span class="text-yellow-300">Key</Span> Features</h2>
                <div><hr></div>
                <ul class="text-base text-gray-700 space-y-4">
                    <li><strong>Task Creation</strong>: Easily create new tasks with titles, descriptions, and deadlines.</li>
                    <li><strong>Task Management</strong>: Edit, update, and delete tasks as you complete them or adjust deadlines.</li>
                    <li><strong>User Authentication</strong>: Register, log in, and manage your own tasks securely.</li>
                    <li><strong>Admin Features</strong>: Admin users can view all registered users and remove any user as needed.</li>
                </ul>
            </div>

           
        </div>

        <!-- Getting Started Section -->
        <div class="text-center mt-8">
            <h2 class="text-3xl font-semibold text-blue-950 mb-4">Get Started with <span class="text-yellow-300">Task</span>Nest</h2>
            <div><hr></div>
            <p class="text-base text-gray-700 mb-4">
                It's easy to get started! Simply register for an account or log in if you're already a member. Once you're in, you can start creating tasks, managing your to-do list, and stay on top of your goals.
            </p>
            <a href="register.php" class="btn bg-blue-950 text-orange-50 hover:bg-blue-700">Register Now</a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer>
    <footer class="footer footer-center bg-blue-950 text-orange-50 rounded p-10">
        <nav class="grid grid-flow-col gap-4">
            <a class="link link-hover">About Us</a>
            <a class="link link-hover">Contact</a>
        </nav>

        <nav>
            <div class="grid grid-flow-col gap-4">
                <!-- Social Media Icons (Optional) -->
                <a href="https://twitter.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                    </svg>
                </a>
                <a href="https://facebook.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                        <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                    </svg>
                </a>
                <a href="https://linkedin.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                    </svg>
                </a>
            </div>
        </nav>

        <!-- Footer Text -->
        <aside>
            <p>Copyright ©2024 - All rights reserved by <span class="text-yellow-300">TaskNest</span></p>
        </aside>
    </footer>
</footer>

</body>
</html>
