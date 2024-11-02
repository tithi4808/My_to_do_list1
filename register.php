<?php 
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    
    // Check if password contains only numbers
    if (!ctype_digit($_POST['password'])) {
        echo "Password should contain only numbers.";
        exit;
    }
    
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users1 (first_name, last_name, email, date_of_birth, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $date_of_birth, $password]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold">Register</h2>
        <form method="POST" class="mt-4">
            <input type="text" name="first_name" placeholder="First Name" required class="block w-full p-2 mb-4 border">
            <input type="text" name="last_name" placeholder="Last Name" required class="block w-full p-2 mb-4 border">
            <input type="email" name="email" placeholder="Email" required class="block w-full p-2 mb-4 border">
            <input type="date" name="date_of_birth" required class="block w-full p-2 mb-4 border">
            <input type="password" name="password" placeholder="Password" required class="block w-full p-2 mb-4 border" pattern="\d*" title="Please enter numbers only">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Register</button>
        </form>
    </div>
</body>
</html>
