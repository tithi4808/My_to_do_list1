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

    // Check if email already exists in the database
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users1 WHERE email = ?");
    $stmt->execute([$email]);
    $email_count = $stmt->fetchColumn();

    if ($email_count > 0) {
        // Email already exists, show error message
        echo "<p class='text-red-500'>The email address is already registered. Please use a different email.</p>";
        exit;
    }
    
    // Hash the password before saving it
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare the SQL statement to insert the user data into the database
    $stmt = $conn->prepare("INSERT INTO users1 (first_name, last_name, email, date_of_birth, password) VALUES (?, ?, ?, ?, ?)");
    
    // Execute the prepared statement
    $stmt->execute([$first_name, $last_name, $email, $date_of_birth, $password]);

    // After the insertion is successful, redirect to login page
    header("Location: login.php");
    exit; // Always call exit() after header() to ensure the script doesn't continue executing
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
<body>
   <header>
   <nav>
            <div class="navbar bg-blue-950">
            <div class="navbar-start ">
            <a class="btn btn-ghost text-xl"><Span class="font-bold text-3xl text-yellow-300">Task</Span><span class="mt-2 text-orange-50">Nest</span></a>
            
            </div>
            <div class="navbar-end">
            <ul class="menu menu-horizontal px-1 text-orange-50 text-lg">
            
            <li><a href="about.php">About us</a></li>
            <li><a href="contact.php">Contact us</a></li>
            <li><a href="login.php">Login</a></li>
            
            </ul>
        </div>
        </div>
        </nav>
   </header>
   <main>
   <div class='grid  rounded-full lg:grid-cols-2 lg:m-10'>
           <div class='flex rounded-full  justify-center items-center'>
                <img class='pt-6 rounded-full h-full w-full ' src="https://i.postimg.cc/9ftm9wnQ/7677-jpg-wh860.jpg" alt="" />
           </div>
           <div class="hero min-h-screen bg-base-100">
  <div class="hero-content flex-col">
    <div class="text-center lg:text-left">
       <h1 class='text-4xl text-blue-950 font-bold mb-2'>Want to Join <span class="font-bold text-4xl text-yellow-500">Task </span>Nest!!!</h1>
      <h1 class=" font-bold mb-4 text-lg text-center "><span class='text-orange-500'>Register here!</span></h1>
      
    </div>
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-white">
        <form action="" method="POST" class="card-body">
            <!-- Display error message -->
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $email_count > 0): ?>
                <p class="text-red-500 flex justify-center items-center">The email address is already registered. Please use a different email.</p>
            <?php endif; ?>
        
        <div class="form-control">
          <label class="label">
            <span class="label-text">Enter Your First Name</span>
          </label>
          <input type="text" name="first_name" placeholder="First Name" required class="block w-full p-2 mb-4 border">
          
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Enter Your Last Name</span>
          </label>
          <input type="text" name="last_name" placeholder="Last Name" required class="block w-full p-2 mb-4 border">
          
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Enter Your Email ID</span>
          </label>
         
          <input type="email" name="email" placeholder="Email" required class="block w-full p-2 mb-4 border">

          
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Enter Your Date Of Birth</span>
          </label>
          <input type="date" name="date_of_birth" required class="block w-full p-2 mb-4 border">
          
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Enter Password</span>
          </label>
          <input type="password" name="password" placeholder="Password" required class="block w-full p-2 mb-4 border" pattern="\d*" title="Please enter numbers only">
          
        </div>
        <div class="form-control mt-6">
        <button type="submit" class="bg-blue-950 text-orange-50 p-2 rounded">Register</button>
        </div>
        
        <p class='mt-4 text-sm text-center'>Already have an account? Please <span> <a class='text-red-500 hover:underline' href="login.php">Login</a> </span> </p>
        </form>
    </div>
  </div>
  
</div>
        </div>
   </main>
   <footer>

   </footer>
</body>
</html>
