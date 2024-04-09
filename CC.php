<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File upload and download</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* Custom CSS to adjust form size */
        .container1 {
            width: 300px; /* Reduced width */
            height: 380px; /* Reduced height */
            padding: 20px; 
            border: 1.5px solid white; /* Border color */
            border-radius: 10px; /* Rounded corners */
            margin-top: -35px;

        }
        .form-label {
            font-size: 14px; /* Reduced font size for labels */
        }
        .form-control {
            font-size: 14px; /* Reduced font size for form controls */
        }
        
        input[type="submit"] {
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
    </style>
</head>
<body>
    <div class="container1">
        <form action="CCupload.php" method="POST" enctype="multipart/form-data">
            <h3>Upload Your File</h3>
            <div class="mb-3">
                <label for="user" class="form-label">Select user</label>
                <select class="form-control" name="user" id="user">
                    <option value="-1" style="display:none;">-Select-</option>     
                    <?php
                    include('./database.php');
                    $query = "SELECT id, username FROM users WHERE usertype = 'user'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run)) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <option value="<?php echo $row['username']; ?>">
                                <?php echo $row['username']; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="task" class="form-label">Select Task</label>
                <select class="form-control" name="task" id="task">
                    <option value="-1" style="display:none;">-Select-</option>     
                    <?php
                    include('./database.php');
                    $query = "SELECT task FROM tasks";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run)) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <option value="<?php echo $row['task']; ?>">
                                <?php echo $row['task']; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Select file</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <center><input type="submit" value="Upload file"></a></center>

        </form>
    </div>
</body>
</html>
