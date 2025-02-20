<?php 
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!ctype_digit($password)) {
        echo "Password should contain only numbers.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users1 WHERE email = ?");
    $stmt->execute([$email]);
    $email_count = $stmt->fetchColumn();

    if ($email_count > 0) {
        echo "<p class='text-red-500'>The email address is already registered. Please use a different email.</p>";
        exit;
    }
    
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = time() . '_' . $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_path = 'uploads/' . $image_name;

        move_uploaded_file($image_tmp_name, $image_path);
    } else {
        $image_path = '';
    }

    $stmt = $conn->prepare("INSERT INTO users1 (first_name, last_name, email, date_of_birth, password, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $date_of_birth, $password, $image_path]);

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
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl p-8 bg-white shadow-lg rounded-lg">
        <div class=""><h1 class="text-3xl font-bold text-center text-black mb-10">Register for <span class="text-orange-600">Task Nest</span></h1></div>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">First Name</label>
                    <input type="text" name="first_name" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Last Name</label>
                    <input type="text" name="last_name" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Confirm Password</label>
                    <input type="password" name="confirm_password" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium">Upload Profile Image</label>
                <input type="file" name="image" class="w-full p-2 border rounded">
            </div>
            <div class="text-center">
                <button type="submit" class="px-8 py-2   text-white bg-blue-600 rounded hover:bg-orange-500">Register</button>
            </div>
            <p class="text-sm text-center">Already have an account? <a href="login.php" class="text-red-500 hover:underline">Login</a></p>
        </form>
    </div>
</body>
</html>  