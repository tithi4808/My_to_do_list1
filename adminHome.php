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
                    <li><a href="adminHome.php">Home</a></li>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    
                    <li><a href="login.php">User Login</a></li>
                    <li><a href="register.php">User Registration</a></li>
                   
                </ul>
            </div>
        </nav>
        <div >
            <img class=" w-full" src="https://i.postimg.cc/jjYRWtBq/bannert.jpg" alt="">
        </div>
    </header>

    <main >
       <section>
        <div class="container mx-auto px-6 max-w-6xl">
        <!-- About Us Heading -->
         
        <div class="grid grid-cols-2 gap-4 mt-16">
            <div class="flex item-center justify-center px-4 py-12">
                <img class="rounded-xl h-72 w-full" src="https://i.postimg.cc/L8Y9sD4S/DALL-E-2025-02-22-17-15-30-A-modern-and-clean-task-management-app-welcome-screen-with-a-white-and.webp" alt="">
            </div>
        <div class="text-center pt-20 mb-12">
            <h1 id="about" class="text-3xl font-bold text-end text-black mb-6">Welcome to <span class="text-orange-600">Task</span>Nest</h1>
            <div><hr></div>
            <p class="text-base  text-start mt-2 text-gray-700">TaskNest is a simple, yet powerful task management platform. It allows you to manage your to-do lists, create and update tasks, and delete tasks when they're completed. You can even register, log in, and manage your tasks across multiple devices.</p>
        </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-16">
           
        <div class="text-center mb-12 py-12">
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
            <div class="flex item-center justify-center px-4 py-12">
                <img class="rounded-xl" src="https://i.postimg.cc/HL9fW8MH/DALL-E-2025-02-22-17-16-37-A-modern-and-clean-infographic-highlighting-the-features-of-Task-Nest-a.webp" alt="">
            </div>
        <div class="text-center py-12 mb-12">
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
        <div class="text-start py-12">
            <h2 class="text-3xl font-semibold text-black mb-4">Get Started with <span class="text-orange-600">Task</span>Nest</h2>
            <div><hr></div>
            <p class="text-base text-gray-700 mb-4">
                It's easy to get started! Simply register for an account or log in if you're already a member. Once you're in, you can start creating tasks, managing your to-do list, and stay on top of your goals.
            </p>
            <a href="register.php" class="btn bg-orange-600 text-orange-50 hover:bg-blue-700">Register Now</a>
        </div>
        <div class="flex item-center justify-center px-4 py-12">
                <img class="rounded-xl w-full h-72" src="https://i.postimg.cc/J0HvRHqR/DALL-E-2025-02-22-17-17-48-A-modern-and-clean-Get-Started-with-Task-Nest-onboarding-screen-with-a.webp" alt="">
        </div>
        </div> 

           
        </div>

        <!-- Getting Started Section -->
        
    
    </div>

    <div>
    <div class="container mx-auto mt-10 px-6 max-w-6xl ">
            <h2 class="text-3xl text-center font-bold text-black mb-4"><span class="text-orange-600">Meet</span> Our Team</h2>
            <div><hr></div>
            <div class="mt-10 grid grid-cols-3 gap-6 mx-auto max-w-4xl">
               <div>
               <div class="card bg-base-100 w-72 h-80 shadow-xl">
                    <figure>
                        <img class=" pt-4 px-4 rounded-2xl"
                        src="https://i.postimg.cc/g0LPz0Kc/IMG-20230111-WA0020.jpg"
                        alt="Admin" />
                    </figure>
                    <div class="card-body">
                        <h2 class=" text-center text-lg font-bold">Tanya Sultana</h2>
                        <p class="text-center text-sm">tanyasultana60@gmail.com</p>
                        <p class="text-center text-sm">B.Sc(Engineering) in Electronics and Comminication Engineering</p>
                        
                        
                    </div>
                </div>

               </div>
               <div>
               <div class="card bg-base-100 w-72 h-80 shadow-xl">
                    <figure>
                        <img class=" pt-4 px-4 rounded-2xl"
                        src="https://i.postimg.cc/Pq6zXdSN/Whats-App-Image-2025-02-22-at-14-16-46-709e30b5.jpg"
                        alt="Admin" />
                    </figure>
                    <div class="card-body">
                        <h2 class=" text-center text-lg font-bold">Mehrab Hossain Mahim</h2>
                        <p class="text-center text-sm">mehrabhmahim@gmail.com</p>
                        <p class="text-center text-sm">B.Sc(Engineering) in Electronics and Comminication Engineering</p>
                        
                        
                    </div>
                </div>

               </div>
               <div>
               <div class="card bg-base-100 w-72 h-80 shadow-xl">
                    <figure>
                        <img class=" pt-4 px-4 rounded-2xl"
                        src="https://i.postimg.cc/4NLJQM2V/Whats-App-Image-2025-02-22-at-13-12-12-9f18dafa.jpg"
                        alt="Admin" />
                    </figure>
                    <div class="card-body">
                        <h2 class=" text-center text-lg font-bold">Rohit Deb</h2>
                        <p class="text-center text-sm">rohitdeb242@gmail.com</p>
                        <p class="text-center text-sm">B.Sc(Engineering) in Electronics and Comminication Engineering</p>
                        
                        
                    </div>
                </div>
               </div>
            </div>
           
        </div>

    </div>
        
   
       </section>
       <section>
       <main class="py-12">
    <div id="contact" class="container mt-10 border-2  py-6 mx-auto px-6 max-w-5xl">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600 mb-6"><span class="text-black">Send Us a</span> Message</h1>
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
    <footer class="footer bg-base-200 text-base-content p-10">
  <aside>
    <svg
      width="50"
      height="50"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
      fill-rule="evenodd"
      clip-rule="evenodd"
      class="fill-current">
      <path
        d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path>
    </svg>
    <p>
      Task Nest Ltd.
      <br />
      Providing reliable tech since 2024
    </p>
  </aside>
  <nav>
    <h6 class="footer-title">Services</h6>
    <a class="link link-hover">Branding</a>
    <a class="link link-hover">Design</a>
    <a class="link link-hover">Marketing</a>
    <a class="link link-hover">Advertisement</a>
  </nav>
  <nav>
    <h6 class="footer-title">Company</h6>
    <a href="#about" class="link link-hover">About us</a>
    <a href="#contact" class="link link-hover">Contact</a>
    <a class="link link-hover">Jobs</a>
    <a class="link link-hover">Press kit</a>
  </nav>
  <nav>
    <h6 class="footer-title">Legal</h6>
    <a class="link link-hover">Terms of use</a>
    <a class="link link-hover">Privacy policy</a>
    <a class="link link-hover">Cookie policy</a>
  </nav>
</footer>
        <div class="footer-content bg-base-200 text-center ">
            <p>&copy; 2025 TaskNest. All rights reserved.</p>
        </div>
    </footer>

   
    
       
   
   
</body>
</html> 