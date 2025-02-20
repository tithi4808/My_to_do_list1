<?php 
include 'dbconn.php';
session_start();
if (isset($_SESSION['user1_id'])) {
    $user_id = $_SESSION['user1_id'];
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['title']) && !empty($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $folder = $_POST['folder'];
    $due_date = $_POST['due_date'];
    
    $stmt = $conn->prepare("INSERT INTO todo (title, description, date_time, user_id, priority, folder, due_date) VALUES (?, ?, NOW(), ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $user_id, $priority, $folder, $due_date]);

    // Redirect to reload the page or fetch tasks via AJAX
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_SESSION['user1_id'])) {
    $user_id = $_SESSION['user1_id'];
    $stmt = $conn->prepare("SELECT first_name, last_name, email, date_of_birth, image FROM users1 WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $email = $user['email'];
        $date_of_birth = $user['date_of_birth'];
        $image = $user['image']; 
    } else {
        die("User not found.");
    }
} else {
    header("Location: login.php");
    exit();
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
    <style>
        body {
            background-color: white;
        }
        .task-card {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .priority-low {
            background-color: #e2e8f0;
            color: #38a169;
        }
        .priority-medium {
            background-color: #e2e8f0;
            color: #fbbf24;
        }
        .priority-high {
            background-color: #e2e8f0;
            color: #f87171;
        }
        .priority-label {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
        }
        .modal-box {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
        }
        .modal input,
        .modal select,
        .modal textarea {
            margin-bottom: 10px;
        }
        footer {
            background-color: #1d4ed8;
            color: #fff;
            padding: 30px 0;
        }
    </style>
</head>
<body>
    

    <main class="grid grid-cols-4 gap-4 p-6">
        <!-- Left Section: User Information and Controls -->
         
        <div class="bg-gray-100 p-6  ">
        <div class="grid grid-cols-2">
            <p class="text-start font-bold">Menu</p>
            <div class="flex justify-end items-center "><img class="w-4 h-4" src="https://i.postimg.cc/GmrSsLvz/menu.png" alt=""></div>
         </div>
         <div class="my-2"><hr></div>
         
           <div>
           <h2 class="text-2xl font-bold mb-4"></h2>
            
            <div class="flex justify-center item-center"><img class="h-24 w-24 rounded-full" src="<?php echo htmlspecialchars($image); ?>" alt="User Image"></div>
            

            <p class="mt-2 text-sm font-bold text-center"><strong></strong> <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></p>
            <p class="mt-2 text-sm font-bold text-center"><strong></strong> <?php echo htmlspecialchars($email); ?></p>
           </div>

          <div class="my-2"><hr></div>
            

            
           <div> <button class="btn  bg-white text-orange-600 mt-4 w-full" id="addTaskBtn"><img class="h-6 w-6" src="https://i.postimg.cc/FHvvTQXn/add.png" alt=""> Add New Task</button></div>
            <div class="">
            
            <button class="btn   bg-white text-orange-600 mt-4 w-full" id="searchBtn"> <img class="h-6 w-6" src="https://i.postimg.cc/kXwB04wT/search-interface-symbol.png" alt="">Search here</button>
           
         </div>

            <!-- Upcoming Tasks Button -->

            <!-- Sorting Dropdown -->
            <select name="sorting" id="sortingDropdown" class="w-full mb-4 p-2 mt-4 border border-gray-300 rounded-md">
                <option value="a-z">Sort by A-Z</option>
                <option value="time">Sort by Time</option>
                <option value="priority">Sort by Priority</option>
            </select>
            <select id="priorityFilter" class="w-full p-2 border border-gray-300 rounded-md">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select> <div class="flex justify-center items-center">
        <a href="logout.php"><button class="btn bg-white text-orange-600 border-orange-600 mt-4" id="">Logout</button></div></a>
        </div>

        <!-- Right Section: Tasks -->
        <div class="col-span-3 bg-white px-6  " id="taskContainer">
            <div class="flex gap-4 pb-6">
            <button class="btn bg-white text-orange-600 border-orange-600 mt-4" id="showAllBtn">Show all Tasks</button>
            <button class="btn bg-white text-orange-600 border-orange-600 mt-4" id="upcomingBtn">Upcoming Tasks</button>
            <button class="btn bg-white text-orange-600 border-orange-600 mt-4" id="overdue">Overdue</button></div>
            <div class="grid grid-cols-3 gap-6" id="tasks">
                <!-- Tasks will be displayed here dynamically -->
            </div>
        </div>
    </main>

    <!-- Modal for Search -->
    <div id="searchModal" class="modal">
        <div class="modal-box">
            <h2 class="text-2xl font-bold mb-4">Search Tasks</h2>
            <form id="searchForm">
                <input type="text" id="searchQuery" placeholder="Search tasks..." class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                <button type="submit" class="btn btn-primary w-full">Search</button>
            </form>
            <button class="btn btn-secondary mt-4 w-full" id="closeSearchModal">Close</button>
        </div>
    </div>

    <!-- Modal for Adding Task -->
    <div id="taskModal" class="modal">
        <div class="modal-box">
            <h2 class="text-2xl font-bold text-orange-600 text-center mb-4">Add New Task</h2>
            <form id="addTaskForm" method="POST" action="">
                <input type="text" name="title" placeholder="Task Title" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                <textarea name="description" placeholder="Task Description" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required></textarea>

                <!-- Priority Dropdown -->
                <select name="priority" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>

                <!-- Folder Dropdown -->
                <select name="folder" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                    <option value="Work">Work</option>
                    <option value="Personal">Personal</option>
                    <option value="Other">Other</option>
                </select>

                <input type="date" name="due_date" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                <button type="submit" class="btn btn-secondary bg-white text-black border-2 border-orange-300 mt-4 w-full" >Add Task</button>
            </form>
            <button class="btn btn-secondary bg-white text-black border-2 border-orange-300 mt-4 w-full" id="closeTaskModal">Close</button>
        </div>
    </div>

    

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Event listeners
            document.getElementById('searchBtn').addEventListener('click', () => {
                document.getElementById('searchModal').classList.add('modal-open');
            });

            document.getElementById('closeSearchModal').addEventListener('click', () => {
                document.getElementById('searchModal').classList.remove('modal-open');
            });

            document.getElementById('addTaskBtn').addEventListener('click', () => {
                document.getElementById('taskModal').classList.add('modal-open');
            });

            document.getElementById('closeTaskModal').addEventListener('click', () => {
                document.getElementById('taskModal').classList.remove('modal-open');
            });

            document.getElementById('searchForm').addEventListener('submit', (e) => {
                e.preventDefault();
                const query = document.getElementById('searchQuery').value;
                fetchTasks('search', query);
            });

            document.getElementById('upcomingBtn').addEventListener('click', () => {
                fetchTasks('upcoming');
            });
            document.getElementById('showAllBtn').addEventListener('click', () => {
                fetchTasks('showAll');
            });
            document.getElementById('overdue').addEventListener('click', () => {
                fetchTasks('overdue');
            });
            


            document.getElementById('sortingDropdown').addEventListener('change', () => {
                const sortOption = document.getElementById('sortingDropdown').value;
                fetchTasks('sort', sortOption);
            });
            document.getElementById("priorityFilter").addEventListener("change", (e) => {
        fetchTasks("filter", e.target.value);
    });


            // Fetch tasks function
            function fetchTasks(type, param = '') {
                let url = 'fetch_tasks.php'; // Server-side PHP file to handle fetching tasks
                let data = new FormData();
                data.append('type', type);
                if (type === 'search') {
                    data.append('query', param);
                } else if (type === 'upcoming') {
                    data.append('upcoming', true);
                } else if (type === 'sort') {
                    data.append('sortOption', param);
                }else if (type === 'filter') {
          data.append('priority', param);
        }

                fetch(url, {
                    method: 'POST',
                    body: data,
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('tasks').innerHTML = data;
                });
            }

            // Initial task load
            fetchTasks('all');
        });
    </script>
    
       
    
   
</body>
</html> 