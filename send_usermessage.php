<?php
session_start();
include 'database.php';

$message = $_POST['message'];
$sender = $_SESSION['username'];
$receiver = $_POST['receiver'];

$query = "INSERT INTO messages (sender, receiver, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $sender, $receiver, $message);
$stmt->execute();
?>
<script>
    // Fetch messages every 5 seconds (optional)
    setInterval(fetchMessages, 5000);
</script>
