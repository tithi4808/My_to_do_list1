<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user1_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

include 'dbconn.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - TaskNest</title>
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
                <?php if (isset($_SESSION['user1_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Contact Form -->
<main class="py-12">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-950 mb-6">Send Us a Message</h1>
            <p class="text-lg text-gray-700">Have a question or want to share feedback? Use the form below to send a message directly to our admin.</p>
        </div>

        <!-- Contact Form -->
        <form action="contact.php" method="POST" class="space-y-4">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Name Input -->
                <div class="flex-1">
                    <label for="name" class="block text-lg">Your Name</label>
                    <input type="text" name="name" id="name" required class="input input-bordered w-full bg-gray-50 text-gray-700" />
                </div>
                <!-- Email Input -->
                <div class="flex-1">
                    <label for="email" class="block text-lg">Your Email</label>
                    <input type="email" name="email" id="email" required class="input input-bordered w-full bg-gray-50 text-gray-700" />
                </div>
            </div>

            <!-- Message Textarea -->
            <div>
                <label for="message" class="block text-lg">Your Message</label>
                <textarea name="message" id="message" rows="4" required class="textarea textarea-bordered w-full bg-gray-50 text-gray-700"></textarea>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn bg-yellow-500 text-blue-950 hover:bg-yellow-400">Send Message</button>
            </div>
        </form>

        <!-- Success Message and Submitted Message -->
        <?php if (!empty($successMessage)): ?>
            <div class="mt-6 text-center bg-green-100 text-green-800 p-4 rounded-lg">
                <p class="font-bold"><?php echo $successMessage; ?></p>
                <div class="mt-4 p-4 border rounded-lg bg-gray-50 text-gray-700">
                    <h3 class="text-lg font-semibold">Your Message:</h3>
                    <p><?php echo $messageContent; ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Footer -->
<footer>
    <footer class="footer footer-center bg-blue-950 text-orange-50 rounded p-10">
  <nav class="grid grid-flow-col gap-4">
    <a class="link link-hover">About us</a>
    <a class="link link-hover">Contact</a>
  </nav>
  <nav>
    <div class="grid grid-flow-col gap-4">
      <a>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          class="fill-current">
          <path
            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
        </svg>
      </a>
      <a>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          class="fill-current">
          <path
            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
        </svg>
      </a>
      <a>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          class="fill-current">
          <path
            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
        </svg>
      </a>
    </div>
  </nav>
  <aside>
    <p>Copyright ©2024 - All right reserved by <span class="text-yellow-300">Tanya</span></p>
  </aside>
</footer>
</footer>

</body>
</html>
