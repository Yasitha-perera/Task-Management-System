<?php
include 'database.php';
session_start();

// Check if the "username" key is defined in the session
if (isset($_SESSION['username'])) {
    $query = "SELECT * FROM messages WHERE (sender = ? AND receiver = ?) OR (sender = ? AND receiver = ?) ORDER BY timestamp ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $sender, $receiver, $receiver, $sender);
    $sender = $_SESSION['username'];
    $receiver = $_POST['receiver'];
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['sender'] == $receiver) {
                echo '<div class="message receiver">' . $row['message'] . '</div>';
            } else {
                echo '<div class="message sender">' . $row['message'] . '</div>';
            }
        }
    }
} else {
    // If "username" key is not defined, close the tab using JavaScript
    echo '<script>window.close();</script>';
}
?>
<script>
    // Fetch messages every 5 seconds (optional)
    setInterval(fetchMessages, 1000);
</script>
