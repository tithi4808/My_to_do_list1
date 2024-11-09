<?php
// Start the session
session_start();

// Include database connection
include 'dbconn.php';

// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['admin_logged_in'])) {
    // Redirect to login page if not logged in
    header("Location: admin_login.php");
    exit();
}

// Handle User Deletion
if (isset($_GET['delete_user_id'])) {
    $user_id = $_GET['delete_user_id'];

    // Prepare SQL query to delete the user from the database
    $stmt = $conn->prepare("DELETE FROM users1 WHERE id = ?");
    $stmt->execute([$user_id]);

    // Redirect back to the admin dashboard after successful deletion
    header("Location: admin_dashboard.php");
    exit();
}

// Handle Message Deletion
if (isset($_GET['delete_message_id'])) {
    $message_id = $_GET['delete_message_id'];

    // Prepare SQL query to delete the message from the database
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$message_id]);

    // Redirect back to the admin dashboard after successful deletion
    header("Location: admin_dashboard.php");
    exit();
}

// Fetch all users from the database
$stmt = $conn->query("SELECT * FROM users1"); // Assuming 'users1' is the table storing user information
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all messages from the database
$stmt_messages = $conn->query("SELECT * FROM messages ORDER BY date_time DESC"); // Fetch messages
$messages = $stmt_messages->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

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
                    <li><a href="admin_logout.php">Admin Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="py-10">
    <div class="container mx-auto max-w-4xl">
        <h1 class="text-4xl font-bold text-center text-blue-950 mb-8">Welcome, <?php echo $_SESSION['admin_username']; ?>!</h1>

        <!-- Users Table -->
        <h2 class="text-2xl font-semibold text-center text-blue-800 mb-6">All Registered Users</h2>
        <div class="overflow-x-auto mb-12">
            <table class="table w-full table-auto border-collapse shadow-lg">
                <thead>
                    <tr class="bg-blue-950 text-orange-50 text-xl border-b">
                        <th class="p-2 border px-4">ID</th>
                        <th class="p-2 border px-4">First Name</th>
                        <th class="p-2 border px-4">Last Name</th>
                        <th class="p-2 border px-4">Email</th>
                        <th class="p-2 border px-4">DOB</th>
                        <th class="p-2 border px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="text-center border-b">
                            <td class="p-2 border px-4"><?php echo $user['id']; ?></td>
                            <td class="p-2 border px-4"><?php echo $user['first_name']; ?></td>
                            <td class="p-2 border px-4"><?php echo $user['last_name']; ?></td>
                            <td class="p-2 border px-4"><?php echo $user['email']; ?></td>
                            <td class="p-2 border px-4"><?php echo $user['date_of_birth']; ?></td>
                            <td class="p-2 border px-4">
                                <!-- Delete Button -->
                                <a href="admin_dashboard.php?delete_user_id=<?php echo $user['id']; ?>" class="btn btn-danger bg-red-500 text-white hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Messages Table -->
        <h2 class="text-2xl font-semibold text-center text-blue-800 mb-6">User Messages</h2>
        <div class="overflow-x-auto">
            <table class="table w-full table-auto border-collapse shadow-lg">
                <thead>
                    <tr class="bg-blue-950 text-orange-50 text-xl border-b">
                        <th class="p-2 border px-4">ID</th>
                        <th class="p-2 border px-4">Name</th>
                        <th class="p-2 border px-4">Email</th>
                        <th class="p-2 border px-4">Message</th>
                        <th class="p-2 border px-4">Date</th>
                        <th class="p-2 border px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr class="text-center border-b">
                            <td class="p-2 border px-4"><?php echo $message['id']; ?></td>
                            <td class="p-2 border px-4"><?php echo $message['name']; ?></td>
                            <td class="p-2 border px-4"><?php echo $message['email']; ?></td>
                            <td class="p-2 border px-4"><?php echo nl2br(htmlspecialchars($message['message'])); ?></td>
                            <td class="p-2 border px-4"><?php echo $message['date_time']; ?></td>
                            <td class="p-2 border px-4">
                                <!-- Delete Button for Messages -->
                                <a href="admin_dashboard.php?delete_message_id=<?php echo $message['id']; ?>" class="btn btn-danger bg-red-500 text-white hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Logout Button -->
        <div class="text-center mt-6">
            <a href="admin_logout.php" class="btn bg-blue-950 text-orange-50 hover:bg-blue-700">Logout</a>
        </div>
    </div>
</main>

</body>
</html>
