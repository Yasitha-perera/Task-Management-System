<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded files</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="style.css">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* Custom CSS to adjust table size */
        table {
            font-size: 14px;
            background-color: rgb(131,235,232); /* Reduce font size of table content */
        }
        th, td {
            padding: 8px; 
            /* Adjust padding for table cells */
        }
        .btn {
            font-size: 12px; /* Reduce font size of buttons */
            padding: 5px 10px; /* Adjust padding for buttons */
        }
        /* Style for fixed table header */
        .table thead th {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: white; /* Set background color to match page background */
        }
        /* Style for scrollable table container */
        .table-container {
            max-height: 500px; /* Set maximum height for the table container */
                overflow-y: auto;     scrollbar-width: thin; /* Set the width of the scrollbar */
/* Enable vertical scrolling */
        }
        /* Style to remove scrolling from the body */
        
    </style>
</head>
<body>
    <h3 style="margin-top: -35px;">Uploaded Files</h3 >
    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Task</th>
                    <th style="background-color: rgb(20, 123, 119);color: azure; "  >File Name</th>
                    <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Upload Date</th>
                    <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Sender</th>
                    <th style="background-color: rgb(20, 123, 119);color: azure; "  >Receiver</th>
                    <th style="background-color: rgb(20, 123, 119);color: azure; "  >Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                include('./database.php');

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch the uploaded files from the database
                $sql = "SELECT * FROM files WHERE username='{$_SESSION['username']}' OR susername='{$_SESSION['username']}'";
                $result = $conn->query($sql);

                // Display files in table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . $row['filename'];
                ?>
                <tr>
                    <td><?php echo $row['task']; ?></td>
                    <td><?php echo $row['filename']; ?></td>
                    <td><?php echo $row['upload_date']; ?></td>
                    <td style="font-weight: bolder;" ><?php echo ucfirst($row['username']); ?></td>    
                    <td><?php echo $row['susername']; ?></td>    
                    <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="4">No files uploaded yet.</td>
                </tr>
                <?php
                }
                // Close database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
