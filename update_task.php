<?php
include 'dbconn.php';

// Fetch the task details for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Retrieve task data for the provided ID
    $stmt = $conn->prepare("SELECT * FROM todo WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$task) {
        echo "Task not found!";
        exit;
    }
}

// Handle update submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Update the task with new title and description
    $stmt = $conn->prepare("UPDATE todo SET title = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$title, $description, $id])) {
        header("Location: home.php"); // Redirect to main page after update
        exit;
    } else {
        echo "Error updating task!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    
    
    <title>Update Task</title>
</head>
<body>
    <header>
    
    </header>
    <main>
    <div class="flex items-center gap-12 justify-center min-h-screen">
        <div>
            <img class="h-96 w-96" src="https://i.postimg.cc/zGLszXBd/pngtree-video-editing-isolated-cartoon-vector-illustrations-picture-image-8678272.png" alt="">
        </div>
    <div class="bg-orange-50 p-10 rounded-lg shadow-md max-w-md w-full">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Your Task</h2>
        
        <div>
            <?php if (isset($task)) { ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">
                    
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium">Title:</label>
                        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium">Description:</label>
                        <textarea name="description" id="description" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($task['description']); ?></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" name="update" class="bg-blue-950 text-white py-2 px-4 rounded-md hover:bg-blue-700">Update Task</button>
                    </div>
                </form>
            <?php } else { ?>
                <p class="text-center text-red-500">Invalid task ID provided.</p>
            <?php } ?>
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
