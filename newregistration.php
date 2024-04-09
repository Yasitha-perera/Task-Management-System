<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: admin.php");
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon" >

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group{
            width: 370px;
            margin-bottom: 15px;
        }
        ::placeholder {
    color:transparent; /* Adjust opacity for a lighter color */
}
input[type="submit"] {
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            
        }

            /* Hover effect */
            input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
    </style>
</head>
<body>
        <?php 
        if (isset($_POST["submit"])) {
            $username=$_POST["username"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $passwordRepeat=$_POST["repeat_Password"];

            $passwordHash= password_hash($password, PASSWORD_DEFAULT);
        
$errors= array();
            if (empty($username) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
                array_push($errors,"ALL FEILD ARE REQUIRED TO BE FILLED"); 
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                array_push($errors,"Email is not valid"); 
            }
            if (strlen($password)<5) {
                array_push($errors,"Password not valid"); 
            }
            if ($password!==$passwordRepeat) {
                array_push($errors,"Passwords does not match"); 
            }
            require_once"database.php";
             $sql="SELECT * FROM users WHERE username='$username'";
             $result = mysqli_query($conn,$sql);
             $rowCount=mysqli_num_rows($result);
             if ($rowCount> 0) {
                array_push($errors,"User Name Already Exists");
             }
            if (count($errors)>0) {
                foreach ($errors as $error) {
                    echo"<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
            
                $sql="INSERT INTO users (username,email,password) VALUES(?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                $prepareStmt=mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sss", $username,$email,$passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo"<script type='text/javascript'>
                    alert('You Registered Successfully.');
                    window.location.href ='newregistration.php';
                    </script>";

                }else {
                    die("Something Went Wrong");
                }
                }
        }   
        ?>
<center><img src="logos\TMS_Logo.ico" alt="Logo" style="width: 130px; height: 130px;">
<div style="color:azure; font-family:sans-serif; font-size:larger; font-weight:bolder;" >Task Management System</div>

<br><br>
    
        <form action="newregistration.php" method="post">
            <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
            <img src="logos\UN.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
                <input type="text" class="form-control" name="username" placeholder="User Name">
                </div>
    </div>
            </div>
            <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
            <img src="logos\Em.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
                <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
    </div>
            </div>
            <div class="form-group">
            <div class="input-group">
            <div class="input-group-prepend">
            <img src="logos\PW.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
                <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
    </div>
            </div>
            <div class="form-group"> 
            <div class="input-group">
            <div class="input-group-prepend">
            <img src="logos\Re_PW.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;
            </div>   
                <input type="password" class="form-control" name="repeat_Password" placeholder="Repeat Password">
                </div>
    </div>
            </div> 
            <div class="form-group">
    <div class="input-group" style="margin-left: 100px;" >
            <div class="input-group-prepend">
            <input type="checkbox" onclick="showPassword()"> Show Password
            </div>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Register" name="submit">
        </div>
    </div> 
        </form>
        <script>
    function showPassword() {
        var passwordFields = document.querySelectorAll('input[type="password"]');
        passwordFields.forEach(function(field) {
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        });
    }
</script>
        </center>
</body>
</html>
