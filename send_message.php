<?php 
include 'dbconn.php';
session_start();

$successMessage = '';  // Initialize a variable for the success message
$messageContent = '';  // Initialize a variable for the message content

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the message into the database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    // Set the success message
    $successMessage = "Thank you for contacting us! We will get back to you soon.";
    $messageContent = nl2br(htmlspecialchars($message));  // Display the submitted message content
}
?>
