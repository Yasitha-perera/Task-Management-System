<?php
if(isset($_POST['submit'])){
    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];
    
    require_once("database.php"); 
    
    $update_query = "UPDATE users SET ";

    if (!empty($new_email)) {
        $update_query .= "email = '$new_email', ";
    }

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query .= "password = '$hashed_password', ";
    }

    $update_query = rtrim($update_query, ", ");
    $update_query .= " WHERE username = '$user_id'";

    if(mysqli_query($conn, $update_query)){
        echo "<script type='text/javascript'>
                alert('User Details Updated Successfully..');
                window.location.href ='admin.php';
                </script>";
    } else {
        echo "Error updating user details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
