<?php  
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
    <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon" >
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4ba8a8; /* Fallback color */
    background-image: url('logos/Back.jpg'); /* URL of your background image */
    background-size: cover; /* Cover the entire background */
    background-position: center;
    margin-top: 120px;
        }

        h1 {
            text-align: center;
            color: white;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: rgb(20, 123, 119); 
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
    </style></head>
<body>
<center><img src="logos\TMS_Logo.png" alt="Logo" style="width: 200px; height: 200px;">
</center>
    <form action="chat.php" method="post">
        <label for="user">Select Admin:-</label>
        <select name="user" id="user">
        <option value="" disabled selected style="display:none;"></option>
            <!-- Populate this select dropdown with usernames from the users table -->
            <?php
            // Connect to the database and fetch usernames
            include('./database.php');
                        $result = $conn->query("SELECT username FROM users WHERE usertype='admin'");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
            }
            $conn->close();
            ?>
        </select>
        <input type="submit" value="Start Chat">
    </form>
</body>
</html> 