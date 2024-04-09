<?php
// Include database connection
include('database.php');
session_start();

// Get receiver and message from POST request
$receiver = $_POST['receiver'];
$message = $_POST['message'];
$sender = $_SESSION['username'];

// Insert message into the database
$sql = "INSERT INTO messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
