<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
include 'dbconn.php';

echo "<h1>Welcome, " . $_SESSION['admin_username'] . "!</h1>";
echo "<h2>All Registered Users</h2>";

$stmt = $conn->query("SELECT * FROM users1"); // Assuming 'users1' is the table storing user information
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1'>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>DOB</th></tr>";
foreach ($users as $user) {
    echo "<tr><td>{$user['id']}</td><td>{$user['first_name']}</td><td>{$user['last_name']}</td><td>{$user['email']}</td><td>{$user['date_of_birth']}</td></tr>";
}
echo "</table>";
?>
<a href="admin_logout.php">Logout</a>
