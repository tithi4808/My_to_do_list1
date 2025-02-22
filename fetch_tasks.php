<?php
include 'dbconn.php';
session_start();
$user_id = $_SESSION['user1_id']; // Ensure user is logged in

// Default query to fetch all tasks
$query = "SELECT * FROM todo WHERE user_id = ?";
$params = [$user_id];

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $user_id = $_SESSION['user1_id']; // Ensure user is logged in
   

// Default query to fetch all tasks
$query = "SELECT * FROM todo WHERE user_id = ?";
$params = [$user_id];

    

    if ($type == "sort" && isset($_POST['sortOption']) && $_POST['sortOption'] == "priority") {
        $query = "SELECT * FROM todo WHERE user_id = ? ORDER BY FIELD(priority, 'High', 'Medium', 'Low')";
    } elseif ($type == "search" && isset($_POST['query'])) {
        $query = "SELECT * FROM todo WHERE user_id = ? AND (title LIKE ? OR description LIKE ?)";
        $params[] = "%" . $_POST['query'] . "%";
        $params[] = "%" . $_POST['query'] . "%";
    } elseif ($type == "upcoming") {
        $query = "SELECT * FROM todo WHERE user_id = ? AND due_date >= CURDATE() ORDER BY due_date";
    } elseif ($type == "completed") {
        $query = "SELECT * FROM todo WHERE user_id = ? AND checked=1";
    } elseif ($type == "overdue") {
        $query = "SELECT * FROM todo WHERE user_id = ? AND due_date <= CURDATE() ORDER BY due_date";
    } elseif ($type == "showAll") {
        $query = "SELECT * FROM todo WHERE user_id = ?";
    } elseif ($type == "filter") {
        $priority = isset($_POST['priority']) ? $_POST['priority'] : '';

        $query = "SELECT * FROM todo WHERE user_id = ?";
        
        if ($priority) {
            $query .= " AND priority = ?";
            $params[] = $priority;
        }
    }

    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($tasks) {
        foreach ($tasks as $task) {
            $remaining_date = "N/A";
            if (!empty($task['due_date'])) {
                
                $due_date = new DateTime($task['due_date']);
                $remaining_date = $due_date->diff(new DateTime())->days +1 ;

            }
            $priorityColor = "text-blue-500"; // Default for Low priority
            if ($task['priority'] == "Medium") {
                $priorityColor = "text-green-500";
            } elseif ($task['priority'] == "High") {
                $priorityColor = "text-red-500";
            }

            echo "<div class='bg-red-50 w-full  border-2 border-orange-50 p-4 rounded-xl shadow-md'>
                   <div class='60'> <div class=''><div class='font-bold text-xl mb-1 text-black'>" . htmlspecialchars($task['title']) . "</div>
                    <p class='text-xs text end mb-2'>" . htmlspecialchars($task['date_time']) . "</p></div>
                    
                    <div class='my-2 mx-2'>
                        <hr>
                    </div>
                    <div class=' h-28'> <p class='mt-2 mb-2'>" . htmlspecialchars($task['description']) . "</p>
                     <p class='mt-2 mb-2'><span class='text-sm font-bold'>Due Time</span> : <span>". htmlspecialchars($task['due_date']) ."</span></p>
                   </div>
                    </div>
                    <div class='my-2 mx-2'>
                                            <hr>
                                        </div>

                   
                    

                    <div class='flex   justify-between '>
                    
                     <div class='  mt-4'>
                         <span class='font-bold text-sm'>
                    <span class='$priorityColor'>" . htmlspecialchars($task['priority']) . "</span>
                        </span>
                    </div>
                    
                        <div class='flex gap-2'>
                        <form action='update_task.php' method='GET' class='inline'>
                            <input type='hidden' name='id' value='" . $task['id'] . "'>
                            <button type='submit' class='flex items-end rounded-md   text-black'>
                                  <img class=' pt-4 px-2 w-12 h-10 '
                        src='https://i.postimg.cc/DZbFhgPj/edit.png'
                        alt='Admin' />
                            </button>
                        </form>
                        <form action='delete_task.php' method='POST' class='inline' onsubmit='return confirmDelete();'>
                            <input type='hidden' name='id' value='" . $task['id'] . "'>
                            <button type='submit' class='flex items-end rounded-md    text-black'>
                                <img class=' pt-4 px-2 w-12 h-10 '
                        src='https://i.postimg.cc/sxhFFgyt/delete.png'
                        alt='Admin' />
                            </button>
                        </form>
                        </div>
                    </div>
                  </div>";
        }
    } else {
        echo "<p>No tasks found.</p>";
    }
}
?>

<!-- JavaScript for Delete and Mark as Read -->
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this task?");
    }

    function markAsRead(taskId) {
        fetch('mark_as_read.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + taskId
        }).then(response => response.text())
        .then(data => {
            console.log(data);
            alert("Task marked as read!");
        }).catch(error => console.error("Error:", error));
    }
</script>