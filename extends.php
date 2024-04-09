<?php 
include('./database.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <style>
.body{
            overflow: hidden;
        }

table {
        font-size: 13px;
        background-color: rgb(131,235,232); /* Reduce font size of table content */
    }
    th, td {
        padding: 8px; /* Adjust padding for table cells */
    }
    .table thead th {
            position: sticky;
            top: 0;
            background-color: rgb(20, 123, 119);
            z-index: 1; /* Ensure table header stays above other content */
        }
        /* Style for scrollable table container */
        .table-container {
            max-height: 500px; /* Set maximum height for the table container */
            overflow-y: auto; 
            scrollbar-width: thin; /* Set the width of the scrollbar */
/* Enable vertical scrolling */
        }
        /* Style to remove scrolling from the body */
        body {
            overflow: hidden; /* Hide body overflow */
        }
</style>
    </head>
<body>
    <h3 style="margin-top: -30px;" >Project Extend Requests</h3>
    <div class="table-container" >
    
    <table class="table table-bordered table-striped">
        <tr>
            <th style="background-color: rgb(20, 123, 119);color: azure; " >User</th>
            <th style="background-color: rgb(20, 123, 119);color: azure; " >Subject</th>
            <th style="background-color: rgb(20, 123, 119);color: azure; "  style="width: 40%;">Message</th>
            <th style="background-color: rgb(20, 123, 119);color: azure;" >Status</th>
            <th style="background-color: rgb(20, 123, 119);color: azure;" >Action</th>
        </tr>
        <?php 
         $sno=1;
        $query="SELECT * FROM extends WHERE req_receiver='{$_SESSION['username']}'";
        $query_run=mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($query_run))
        {
            ?>
            <tr>
                <?php
                $query1 = "SELECT username FROM users WHERE username = '{$row['uid']}'";

                $query_run1 = mysqli_query($conn, $query1);
                while($row1 = mysqli_fetch_assoc($query_run1)){
                    ?>
                    <td style="font-weight: bolder;"><?php echo ucfirst($row1['username']); ?></td>

                <?php
                }
                ?>
                <td > <?php echo $row['subject']; ?></td>
                <td ><?php echo $row['message']; ?></td>
                <td ><?php echo $row['status']; ?></td>
                <td><a href="approve_extend.php?id=<?php echo $row['lid']; ?>">Approve</a>|
                <a href="reject_extend.php?id=<?php echo $row['lid']; ?>">Reject</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    </div>
</body>

</html>
