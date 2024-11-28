<?php 
session_start();
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM users1 WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user1_id'] = $user['id']; // Store user ID in session
        header("Location: index.php"); // Redirect to index.php on successful login
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body >
  <header>
  

  </header>
  <main >
  <div class='grid  rounded-full lg:grid-cols-2 lg:m-10'>
           <div class='flex rounded-full  justify-center items-center'>
                <img class='pt-6 rounded-full h-full w-full ' src="https://i.postimg.cc/9ftm9wnQ/7677-jpg-wh860.jpg" alt="" />

           </div>
           <div class="hero min-h-screen bg-base-100">
  <div class="hero-content flex-col">
    <div class="text-center lg:text-left">
       <h1 class='text-4xl text-blue-950 font-bold mb-2'>Welcome to <span class="font-bold text-4xl text-yellow-500">Task </span>Nest!!!</h1>
      <h1 class=" font-bold mb-4 text-lg text-center "><span class='text-orange-500'>Login now!</span></h1>
      
    </div>
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-white">
      <form method="POST" class="card-body">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input name='email' type="email" placeholder="email" class="input input-bordered" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input type="password" name="password" placeholder="password" class="input input-bordered" required />
          
        </div>
        <div class="form-control mt-6">
          <button class='btn  bg-blue-950 text-orange-50 '>Login</button>
        </div>
        
        <p class='mt-4 text-sm text-center'>Don't have an account?Please <span> <a class='text-red-500  hover:underline' href="register.php"'>Register</a> </span> </p>
        <?php if (isset($error)) { echo "<p class='text-red-500'>$error</p>"; } ?>
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
