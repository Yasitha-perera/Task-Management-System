<?php
session_start();
include('./database.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
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
        font-size: 13px;
        background-color: rgb(131,235,232);  /* Reduce font size of table content */
    }
    th, td {
        padding: 8px; /* Adjust padding for table cells */
    }
    .table thead th {
            position: sticky;
            top: 0;
            background-color: white; /* Set background color to match page background */
            z-index: 1; /* Ensure table header stays above other content */
        }
        /* Style for scrollable table container */
        .table-container {
            max-height: 500px; /* Set maximum height for the table container */
            overflow-y: auto;    scrollbar-width: thin; /* Set the width of the scrollbar */
 /* Enable vertical scrolling */
        }
        /* Style to remove scrolling from the body */
        body {
            overflow: hidden; /* Hide body overflow */
        }
    
</style>
    </head>
    <body>
        <h3 style="margin-top: -35px;">Your Tasks</h3>
        <div class="table-container">
        <table class="table table-bordered table-striped">
            <tr>

                <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Task </th>
                <th style="background-color: rgb(20, 123, 119);color: azure; "  >Decription</th>
                <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Start Date</th>
                <th  style="background-color: rgb(20, 123, 119);color: azure; " >End Date</th>
                <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Status</th>
                <th  style="background-color: rgb(20, 123, 119);color: azure; "  >Action</th>
            </tr>
            <?php 
        $query="select * from tasks where uid='{$_SESSION['username']}'";
        $query_run=mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($query_run))
        {
            ?>
            <tr>
            
            <td><?php echo $row['task']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><a href="update_status.php?id=<?php echo $row['tid'];?>">Update</a></td>

            </tr>
            <?php
        
        }
        ?>
        </table>
        </div>
    </body>
</html>
