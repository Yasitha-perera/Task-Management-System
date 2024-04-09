<?php
include('./database.php');
if(isset($_POST['edit_task'])){
    $id = $_POST['id'];
    $selectedUser = mysqli_real_escape_string($conn, $_POST['selectedUser']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $task= mysqli_real_escape_string($conn, $_POST['task']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    
    $query="UPDATE tasks SET uid='$selectedUser', description='$description', task='$task', 
            start_date='$start_date', end_date='$end_date' WHERE tid=$id";
    $query_run=mysqli_query($conn,$query);
    if ($query_run) {
        echo "<script type='text/javascript'>
            alert('Task Updated Successfully..');
            window.location.href ='admin.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error.. Please Try Again');
            window.location.href ='admin.php';
            </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>             <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="style.css"> 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Edit Task</title>
    <style>
        .form-group label {
            color: white;
            font-weight: bolder;
        }
        /* Custom CSS to adjust appearance */
/* Custom CSS to make appearance smaller */
/* Custom CSS to make appearance smaller and move form up */
.form-group {
        margin-bottom: 10px; /* Reduce margin bottom for compactness */
    }
    .form-control {
        font-size: 14px; /* Reduce font size for form elements */
    }
    ::placeholder {
        font-size: 12px; /* Reduce font size of placeholders */
    }
    .form-group label {
            color: white;
            font-weight:normal;
         
        }

        input[type="submit"] {
            width: 100px;
            padding: 10px;
            
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
    form {
            border: 1.5px solid white; /* Border color */
                padding: 20px; /* Padding around the container */
                width: 400px; /* Max width of the container */
                border-radius: 10px; /* Rounded corners */
                margin: 0 auto; /* Centering horizontally */

        }
    </style>
</head>
<body>
    <div class="row" id="header">
        
    </div>
    <div class="row">
        <div class="col-md-4 m-auto" style="color:white;"><br>
            <?php
                $query="SELECT * FROM tasks WHERE tid=$_GET[id]";
                $query_run=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($query_run))
                {
            ?>
            <form action="" method="post" >  
            <h3 style="color: white; "> Edit The Task</h3><br>

                <div class="form-group">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $row['tid']; ?>" required>
                </div>
                <div class="form-group" >
                    <label>Select User:</label>
                    <select class="form-control" name="selectedUser">
                        <option value="-Select-" selected disabled>-Select-</option>
                        <?php
                        include('./database.php');
                        $query1 = "SELECT id, username FROM users WHERE usertype='user'";
                        $query_run1 = mysqli_query($conn, $query1); // Corrected variable name
                        if (mysqli_num_rows($query_run1)) {
                            while ($row1 = mysqli_fetch_assoc($query_run1)) {
                                ?>
                                <option value="<?php echo $row1['username']; ?>" <?php if ($row1['username'] == $row['uid']) echo 'selected'; ?>>
                                    <?php echo $row1['username']; ?>
                                </option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Task</label>
                    <textarea class="form-control" rows="1" cols="20" name="task"><?php echo $row['task']; ?></textarea> 
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="2" cols="50" name="description" ><?php echo $row['description']; ?></textarea> 
                </div>
                <div class="form-group">
                    <label>Start Date :</label>
                    <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>">
                </div>
                <div class="form-group">
                    <label>End Date :</label>
                    <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>">
                </div>
                <input type="submit" name="edit_task" value="Update">
            </form>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>

