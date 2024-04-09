    <?php
    session_start();
    include('./database.php');

    if(isset($_POST['update'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']); // Escape the task ID to prevent SQL injection
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $query = "UPDATE tasks SET status='$status' WHERE tid='$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            echo "<script type='text/javascript'>
                alert('Status Updated Successfully..');
                window.location.href ='index.php';
                </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Error.. Please Try Again');
                window.location.href ='index.php';
                </script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update the task
</title> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> 
        <link rel="stylesheet" href="style.css"> 
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <title>Update Status</title>
        <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon" >

        <style>
            .form-group label {
                color: white;
                font-weight: bolder;
            } input[type="submit"] {
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
        .container2  {
            border: 1.5px solid white;                 
                padding: 20px; /* Padding around the container */
                width: 400px; /* Max width of the container */
                border-radius: 10px; /* Rounded corners */
                margin: auto;

            }
        </style>
    </head>
    <body style="margin-top: 120px;">
 
        <div class="container2">
            <div style="color:white;">
                <h3 style="color: white;"> Update the task</h3><br>
                <?php
                $query = "SELECT * FROM tasks WHERE tid=$_GET[id]";
                $query_run = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $row['tid']; ?>" required>
                        </div>
                        <div class="form-group">
    <label>-Select-</label>
    <select class="form-control" name="status" required>
        <option value="" disabled selected>Select an option</option>
        <option value="In-Progress">In-Progress</option>
        <option value="Complete">Complete</option>
    </select>
</div>
                        <input type="submit" name="update" value="Update">
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </body>
    </html>

