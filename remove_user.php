<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
        require_once("database.php");

        $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);

        $sql = "DELETE FROM users WHERE username = '$user_id'";

        if (mysqli_query($conn, $sql)) {
          echo  $sql_extends = "DELETE FROM extends WHERE uid = '$user_id'";
            if (mysqli_query($conn, $sql_extends)) {
                echo "<script type='text/javascript'>
                alert('User and related data removed successfully.');
                window.location.href ='admin.php';
                </script>";
            } else {
                echo "Error removing related data: " . mysqli_error($conn);
            }
        } else {
            echo "Error removing user: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "User ID is required.";
    }
} else {
    header("Location: admin.php");
    exit();
}
?>
