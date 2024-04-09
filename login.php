<?php
session_start();
if (isset($_SESSION["username"])) {
    // Check if the 'usertype' key is set
    if (isset($_SESSION["usertype"])) {
        // Check user type
        if ($_SESSION["usertype"] == "user") {
            header("Location: index.php");
            exit();
        } elseif ($_SESSION["usertype"] == "admin") {
            header("Location: admin.php");
            exit();
        }
    } else {
        // Handle case when 'usertype' is not set in session
        // Redirect to login page or handle accordingly
        // Ensure no further code execution after redirection
    }
} else {
    // Handle case when username is not set in session
    // Redirect to login page or handle accordingly
    // Ensure no further code execution after redirection
}


require_once("database.php");

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]); // Sanitize user input
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn)); // Proper error handling for database queries
    }

    $user = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $username;
        if ($user["usertype"] === "user") {
            $_SESSION["usertype"] == "user";
            header("Location: index.php"); // Redirect regular users to index.php
        } elseif ($user["usertype"] === "admin") {
            $_SESSION["usertype"] == "admin";
            header("Location: admin.php"); // Redirect admins to admin.php
        }
        exit(); // Add exit to stop execution after redirection
    } else { 
        echo "<div class='alert alert-danger'>User Name or Password does not match</div>";            
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
    <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css



" crossorigin="anonymous" />

    
    <style>
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size:x-large;
        }

        .notice-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: transparent   ;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            width: 700px;
            margin: 0 auto;
            text-align: justify;
            
        }

        .notice-container:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        p {
            color:white;
            line-height: 1.6;
            font-weight:400;
            font-size: small;
        }
        .form-group{
            width: 370px;
            margin-bottom: 10px;;
            
        }
        .input-group-prepend{
            width: max-content;
            font-size:small;
            font-weight: bolder;
        }
        
        /* Hide scrollbar for webkit-based browsers */
.notice-container::-webkit-scrollbar {
    display: none;
}

    </style>
</head>
<body  style="margin-top: 3%;">
<center><img src="logos\TMS_Logo.ico" alt="Logo" style="width: 130px; height: 130px;">
<div style="color:azure; font-family:sans-serif; font-size:larger; font-weight:bolder;" >Task Management System</div>
    </center>
    <br>
    <div>
        <center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <img src="logos\UN.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <input type="text" class="form-control" name="username" placeholder="User Name">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <img src="logos\PW.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <input id="password" type="password" placeholder="Enter Password" name="password" class="form-control">
        </div>
    </div>
    <div class="form-group">
    <div class="input-group" style="margin-left: 100px;" >
            <div class="input-group-prepend">
            <input type="checkbox" onclick="showPassword()"> Show Password
            </div>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="LOGIN" name="login" class="btn btn-primary" style="width:100px;">
        </div>
    </div>
    </div>
</form>

<script>
    function showPassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

    </div>
    


    <?php 
    // Fetch the latest notice from the database
    $query_latest_notice = "SELECT * FROM notice ORDER BY nid DESC LIMIT 1";
    $result_latest_notice = mysqli_query($conn, $query_latest_notice);

    if (!$result_latest_notice) {
        die("Error: " . mysqli_error($conn)); // Proper error handling for database queries
    }

    $latest_notice = mysqli_fetch_assoc($result_latest_notice);

    // Check if there is any notice
    if ($latest_notice) {
        // Display the latest notice
        echo '<div class="notice-container" style="height: 180px; overflow-y: auto;">'; // Set height and overflow property
        echo '<h2>Latest Notice</h2>';
        echo '<p>' . $latest_notice['message'] . '</p>';
        echo '</div>';
    } else {
        // Display a message if there are no notices
        echo '<div class="notice-container">';
        echo '<p>No notices available.</p>';
        echo '</div>';
    }
?>

    </center> 

</body>
</html>
