<?php 
include 'dbconn.php';
session_start();
if (isset($_SESSION['user1_id'])) {
    $user_id = $_SESSION['user1_id'];


} else {
    // Redirect to login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
} // Assuming 'user_id' is set on login



if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['title']) && !empty($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $conn->prepare("INSERT INTO todo (title, description, date_time, user_id) VALUES (?, ?, NOW(), ?)");
    $stmt->execute([$title, $description, $user_id]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <title>Home</title>
</head>
<body class="">
    <header>
        <nav>
            <div class="navbar bg-blue-950">
            <div class="navbar-start ">
            <a class="btn btn-ghost text-xl"><Span class="font-bold text-3xl text-yellow-300">Task</Span><span class="mt-2 text-orange-50">Nest</span></a>
            
            </div>
            <div class="navbar-end">
            <ul class="menu menu-horizontal px-1 text-orange-50 text-lg">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="contact.php">Contact us</a></li>
            <li><a href="logout.php">Logout</a></li>
            
            </ul>
        </div>
        </div>
        </nav>

    </header>
    <body class="h-full">
    <main class="bg-gray-100 h-screen">
        <div class="grid grid-cols-4 h-full">
            <div class="col-span-1 bg-gray-300 h-full">
                <h1>hello</h1>
                <div class="mx-6 my-10 h-4">
                    <hr>
                </div>
                <div class="mt-4 mx-8 ">
                    <h1 class="font-bold text-xl text-blue-950 text-center">Write your tasks here</h1>
                <form action="" method="POST" class='p-2   rounded-xl'>
                        <input type="text" name="title" class="w-full h-12 p-2 border border-gray-300 rounded-xl" placeholder="Please Enter Your Task Title">
                        <textarea name="description" class="w-full h-24 p-2 border border-gray-300 rounded-md" placeholder="Please Enter Your Task Description" required></textarea>
                        <div class="flex justify-center"><button type="submit" class="bg-blue-950 text-orange-50 justify-end rounded-xl px-4 h-8 w-full">Add task</button></div>
                    </form>
                </div>
            </div>
            <div class="col-span-3 bg-gray-100 pb-10 h-full flex flex-col px-4">
                
                <div class="grid grid-cols-3 gap-x-2 gap-y-8 mt-10">

                <?php
                        $todo = $conn->prepare('SELECT * FROM todo WHERE user_id = ? ORDER BY id DESC');
                        $todo->execute([$user_id]);
                        if (!$todo) {
                            die("Query failed: " . implode(", ", $conn->errorInfo()));
                        }

                        while ($row = $todo->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="bg-gray-400 w-60 h-52 border-1 border-blue-950 p-4 rounded-xl shadow-md  items-center justify-between mt-4">
                            <div class=" items-center">
                                
                            </div>
                            <div class="mt-4  bg-yellow-50 p-4 rounded-xl shadow-md  left-2 relative w-60" style="height: 200px;"> <!-- Example height for the box -->
                                    <div>
                                        <input type="checkbox" class="mr-2">
                                        <span class="font-bold text-xl text-yellow-800"><?php echo $row['title']; ?></span>
                                        </div>
                                        <div class="my-2 mx-2">
                                            <hr>
                                        </div>
                                        <p class="mt-2"><?php echo htmlspecialchars($row['description']); ?></p>
                                        
                                        <p class="text-sm absolute bottom-8 right-2 ">Created- <?php echo $row['date_time']; ?></p>
                                    <div class="absolute bottom-0 right-0 flex items-end justify-end mb-2 mr-2">

                                    <form action="update_task.php" method="GET" class="inline">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="flex items-end rounded-md px-2 ml-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                        <form action="delete_task.php" method="POST" class="inline">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="flex items-end rounded-md px-2 ml-2">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                        </div>
                    <?php
                    }

                ?>
                


                </div>
            </div>
        </div>
    </main>



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
