<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form with Smaller Size</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="style.css">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <style>
      body {
            overflow: hidden; /* Hide body overflow */
        }
    .form-group {
        margin-bottom: 3px;
        padding: 7px; 
        margin-top: -5px;/* Reduce margin bottom for compactness */
    }form {
            border: 1.5px solid white; /* Border color */
                padding: 20px; /* Padding around the container */
                width: 400px; /* Max width of the container */
                border-radius: 10px; /* Rounded corners */
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
            font-size: small;
         
        }
        input[type="submit"] {
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            height: fit-content;
        }

        input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
</style>
</head>
<body  >
<div class="row" style="margin-top: -37px;">

    <div class="form ">
        <form action="" method="post">
            <div class="form-group">
            <h3 style="color:#fff;" >Create New Task</h3>

                <label>Select User:</label>
                <select class="form-control" name="selectedUser">
                    <option value="-1" style="display:none;">-Select-</option>
                    <?php
                    include('./database.php');
                    $query = "SELECT id, username FROM users WHERE usertype = 'user'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run)) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Task</label>
                <textarea class="form-control" rows="1" cols="20" name="task" placeholder="Mention The Task"required></textarea>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="1" cols="40" name="description" placeholder="Details About The Task"required></textarea>
            </div>
            <div class="form-group">
                <label>Start Date :</label>
                <input type="date" class="form-control" name="start_date"required>
            </div>
            <div class="form-group">
                <label>End Date :</label>
                <input type="date" class="form-control" name="end_date"required>
            </div>
            <input type="submit" name="create_task" value="Create">

        </form>
    </div>
</div>

</body>
</html>
