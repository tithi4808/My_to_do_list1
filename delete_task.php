<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM todo WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: home.php");
    exit;
}
?>
