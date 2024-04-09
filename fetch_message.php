<?php
// Include database connection
include('database.php');
session_start();

// Get receiver from POST request
$receiver = $_POST['receiver'];

// Check if the "username" key is defined in the session
if (isset($_SESSION['username'])) {
    $sender = $_SESSION['username'];

    // Fetch messages from the database
    $sql = "SELECT * FROM messages WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY timestamp";
    $result = $conn->query($sql);

    // Display messages
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['sender'] == $sender) {    
                echo '<div class="message sender">' . $row['message'] . '</div>';
            } else {
                echo '<div class="message receiver">' . $row['message'] . '</div>';
            }
        }
    }

    // Close database connection
    $conn->close();
} else {
    // If "username" key is not defined, close the tab using JavaScript
    echo '<script>window.close();</script>';
}
?>
    <script>
    // Fetch messages every 5 seconds (optional)
    setInterval(fetchMessages, 1000);
</script>

