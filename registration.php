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
    <title>User Management</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>


    .container {
       display: flex;
        justify-content: space-between;
        padding: 20px;
        margin-left: -3vw;

    }

        .form { 
            width: 60vw;
            background-color:transparent;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height:fit-content ;
            margin-left: 25px;
            border: 1.5px solid white; 
            margin-top: -7vh;                

        }

        h3 {
            color: azure;
            margin-bottom: 20px;
            font-size: 1.9vw;

        }

        label {
            color: azure;
            display: block;
            height: 2vh;

        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 1.5vh;
        }

        input[type="submit"] {
            width: 100%;
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
            
        }
        @media only screen and (max-width: 768px) {
    .form {
        width: 80vw; /* Adjust width for smaller screens */
        margin-left: auto;
        margin-right: auto;
        margin-left: 15px;

    }
}

/* Media query for even smaller screens */
@media only screen and (max-width: 480px) {
    .form {
        width: 90vw;
        margin-left: 11px;
/* Further adjust width for very small screens */
    }

}
    </style>
    </head>
    <body>

    <div class="container">
        <div class="form">
            <form action="update_user.php" method="post">
                <h3>Change User Details</h3>
                <label1 for="user_id">Select User:</label>
                <select name="user_id" id="user_id">
                    <option value="-1" style="display:none;">---------</option>
                    <?php
                    include('./database.php');
                    $query = "SELECT username FROM users WHERE usertype = 'user'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run)) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div class="form-group">
                    <label for="new_email">New Email:</label>
                    <input type="email" name="new_email" id="new_email" required>
                </div>  
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Update Details" name="submit">
                </div>
            </form>
        </div>

        <div class="form">
            <h3>Register New Users</h3>
            <form action="newregistration.php" method="post" target="_blank">
                <input type="submit" value="Register Here">
            </form>
        </div>

        <div class="form">
            <h3>Remove User</h3>
            <form action="remove_user.php" method="post">
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id">
                    <option value="-1" style="display:none;">---------</option> 
                    <?php
                    require_once("database.php");
                    $sql = "SELECT id, username FROM users WHERE usertype='user'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                    }
                    ?>
                </select>
                <div class="form-group">
                    <input type="submit" class="btn btn-danger" value="Remove" name="submit">
                </div>
            </form>
        </div>
    </div>

    </body>
    </html>

