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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Home</title>
    
</head>
<body>
    <header>
        <nav class="navbar bg-white">
            <div class="navbar-start">
                <a class="btn btn-ghost text-xl"><span class="font-bold text-3xl text-orange-600">Task</span><span class="mt-2 text-black font-bold">Nest</span></a>
            </div>
            <div class="navbar-end">
                <ul class="menu menu-horizontal px-1 text-orange-600 font-bold text-base">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#contact">Contact us</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="admin_login.php">Admin</a></li>
                </ul>
            </div>
        </nav>
        <div>
            <img class=" w-full" src="https://i.postimg.cc/jjYRWtBq/bannert.jpg" alt="">
        </div>
    </header>

    <main >
       <section>
        <div class="container mx-auto px-6 max-w-6xl">
        <!-- About Us Heading -->
         
        <div class="grid grid-cols-2 gap-4 mt-16">
            <div>
                <img src="" alt="">
            </div>
        <div class="text-center mb-12">
            <h1 id="about" class="text-3xl font-bold text-end text-black mb-6">Welcome to <span class="text-orange-600">Task</span>Nest</h1>
            <div><hr></div>
            <p class="text-base  text-start mt-2 text-gray-700">TaskNest is a simple, yet powerful task management platform. It allows you to manage your to-do lists, create and update tasks, and delete tasks when they're completed. You can even register, log in, and manage your tasks across multiple devices.</p>
        </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-16">
           
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-start text-black mb-6">Why Choose <span class="text-orange-600">Task</span>Nest</h1>
            <div><hr></div>
            <div class="text-base  text-start mt-2 text-gray-700">In a world full of distractions, TaskNest helps you stay organized, productive, and stress-free. Here’s why TaskNest stands out:

<div class="my-2"><p><span class="font-bold">✅ Smart Task Management –</span> Easily create, prioritize, and track your tasks.</p>
<p><span class="font-bold">✅ Intuitive & User-Friendly –</span> A clean, distraction-free interface designed for efficiency.</p>
<p><span class="font-bold">✅ Reminders & Notifications –</span> Never miss a deadline with automatic alerts.</p>
<p><span class="font-bold">✅ Collaboration Made Easy –</span> Share tasks and projects with teams or family.</p>
<p><span class="font-bold">✅ Cross-Platform Access –</span> Sync your tasks seamlessly across web and mobile.</p>
<p><span class="font-bold">✅ Customization & Flexibility –</span> Set recurring tasks, choose themes, and personalize your workflow.</p>
</div>
Whether you’re a professional, student, or entrepreneur, TaskNest is your ultimate productivity companion. Stay ahead, stay organized! </div>
        </div>
        <div class="flex item-center justify-center px-4 py-12">
                <img class="rounded-xl" src="https://i.postimg.cc/LsMkXgTy/Whats-App-Image-2025-02-20-at-12-58-39-0d860e81.jpg" alt="">
            </div>
        </div>


        <!-- Features of TaskNest -->
        
        <div class="grid grid-cols-2 gap-4 mt-16">
            <div>
                <img src="" alt="">
            </div>
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-end text-black mb-6 mr-8"> <span class="text-orange-600">Task</span>Nest Features
            </h1>
            <div><hr></div>
            <div class="text-start font-semibold mt-2" >
            TaskNest is designed to make task management simple, efficient, and smart. Here’s what makes it stand out:
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">📝 Easy Task Management –</span> Create, edit, delete, and organize tasks effortlessly.
            </p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">⏰ Reminders & Notifications – </span>Set due dates and receive timely alerts.
            </p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">📊 Progress Tracking –</span> Monitor completed and pending tasks with visual indicators.
            </p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">🔄 Recurring Tasks –</span> Automate daily, weekly, or monthly tasks for consistency.
            </p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">🤝 Collaboration & Sharing –</span> Assign tasks, share projects, and work as a team.
            </p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">🌙 Dark & Light Mode –</span> Customize the interface for a comfortable experience.
            </p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">📱 Cross-Platform Sync –</span> Access tasks on any device, anytime, anywhere</p>
            <p class="text-base  text-start mt-2 text-gray-700"><span class="font-bold">💡 Smart Prioritization –</span> Set priorities and focus on what matters most.
            </p>

            </div>
        </div>
        </div>
           
        <div class="grid grid-cols-2 gap-4 mt-16">
        <div class="text-start ">
            <h2 class="text-3xl font-semibold text-black mb-4">Get Started with <span class="text-orange-600">Task</span>Nest</h2>
            <div><hr></div>
            <p class="text-base text-gray-700 mb-4">
                It's easy to get started! Simply register for an account or log in if you're already a member. Once you're in, you can start creating tasks, managing your to-do list, and stay on top of your goals.
            </p>
            <a href="register.php" class="btn bg-orange-600 text-orange-50 hover:bg-blue-700">Register Now</a>
        </div>
        <div>

        </div>
        </div> 

           
        </div>

        <!-- Getting Started Section -->
        
    
    </div>
        
   
       </section>
       <section>
       <main class="py-12">
    <div id="contact" class="container mt-10 border-2  py-6 mx-auto px-6 max-w-5xl">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-orange-600 mb-6">Send Us a Message</h1>
            <p class="text-lg text-gray-700">Have a question or want to share feedback? Use the form below to send a message directly to our admin.</p>
        </div>
        <div class="text-center mb-12"><?php if (!empty($successMessage)): ?>
            
            <p class="text-orange-500"><?php echo $successMessage; ?></p>
            
        
    <?php endif; ?></div>

        <!-- Contact Form -->
        <form action="index.php" method="POST" class="space-y-4">
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
                <button type="submit" class="btn bg-orange-600 text-white hover:bg-yellow-400">Send Message</button>
            </div>
            
        </form>

        
    </div>
</main>



       </section>
    </main>

    <!-- Modal for Search -->
  

    <!-- Modal for Adding Task -->
 

    <footer>
        <div class="footer-content text-center mt-10">
            <p>&copy; 2025 TaskNest. All rights reserved.</p>
        </div>
    </footer>

   
    
       
   
   
</body>
</html> 