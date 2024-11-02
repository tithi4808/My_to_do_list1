<?php
include 'dbconn.php';

$username = 'admin'; // Set your desired username
$password = password_hash('admin_password', PASSWORD_DEFAULT); // Replace 'admin_password' with your desired password

$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password]);

echo "Admin account created successfully.";
?>
