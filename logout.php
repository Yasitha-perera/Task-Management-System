<?php
session_start();

// Check if the user clicked the logout link
if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    // Unset all of the session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Get the URL of the previous page
$previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard.php';

// Display the confirmation message using JavaScript
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Logout Confirmation</title>
</head>
<body>
    <script>
        var confirmLogout = confirm('Are you sure you want to log out?');

        if (confirmLogout) {
            // User confirmed, proceed with logout
            window.location.href ='logout.php?confirm=true';
        } else {
            // User canceled, redirect back to previous page
            window.location.href ='$previous_page';
        }
    </script>
</body>
</html>";
?>
