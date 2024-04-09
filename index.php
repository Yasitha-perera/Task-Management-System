<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
include('./database.php');
if (isset($_POST['submit_request'])) {
    $query = "INSERT INTO extends VALUES (null, '{$_SESSION['username']}', '$_POST[subject]', '$_POST[message]', 'No Action','$_POST[selectedUser]')";
    $query_run = mysqli_query($conn, $query); 
    if ($query_run) {
        echo "<script type='text/javascript'>
            alert('Form Submitted Successfully..');
            window.location.href ='index.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error... Please try again'); 
            window.location.href ='index.php';
            </script>";
    }   
}
if (isset($_POST['file_upload'])) {
    // Escape user inputs to prevent SQL injection
    $selectedUser = mysqli_real_escape_string($conn, $_POST['selectedUser']);
    $filedis = mysqli_real_escape_string($conn, $_POST['filedis']);

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES['file']['name']);

    // Check file type
    $allowedTypes = array('pdf', 'doc', 'docx');
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedTypes)) {
        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            // Insert file details into the database
            $query = "INSERT INTO files (uid, file, filedis) 
                      VALUES ('$selectedUser', '$targetFile', '$filedis')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                echo "<script type='text/javascript'>
                    alert('File Uploaded Successfully.');
                    window.location.href ='index.php';
                    </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('Error inserting data into the database.');
                    window.location.href ='index.php';
                    </script>";
            }
        } else {
            echo "<script type='text/javascript'>
                alert('Error uploading file.');
                window.location.href ='index.php';
                </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Invalid file type. Please upload a PDF or Word document.');
            window.location.href ='index.php';
            </script>";
    }
}



?>  
 <!DOCTYPE html>
    <html    lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        

        <title>User Dashboard</title>
        <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon" >

        <script type="text/javascript">
    $(document).ready(function(){
        $("#manage_task").click(function(event){
            // Prevent the default behavior of the anchor link
            event.preventDefault();     
            
            // Load content into #right_sidebar
            $("#right_sidebar").load("task.php");
        });
    });
    $(document).ready(function(){
        $("#extend_request").click(function(event){
            // Prevent the default behavior of the anchor link
            event.preventDefault();     
            
            // Load content into #right_sidebar
            $("#right_sidebar").load("extend_request.php");
        });
    });
    $(document).ready(function(){
        $("#extend_status").click(function(event){
            // Prevent the default behavior of the anchor link
            event.preventDefault();     
            
            // Load content into #right_sidebar
            $("#right_sidebar").load("extend_status.php");
        });
    });
    $(document).ready(function(){
        $("#cdf").click(function(event){
            // Prevent the default behavior of the anchor link
            event.preventDefault();     
            
            // Load content into #right_sidebar
            $("#right_sidebar").load("download.php");
        });
    });
    $(document).ready(function(){
        $("#BB").click(function(event){
            // Prevent the default behavior of the anchor link
            event.preventDefault();     
            
            // Load content into #right_sidebar
            $("#right_sidebar").load("BB.php");
        });
    });
    $(document).ready(function(){
        // Add an 'active' class to the clicked table row and remove it from other rows
        $('#left_sidebar table tr').click(function(){
            $('#left_sidebar table tr').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
<style>main {
            flex: 1;
        }
        footer {
            background-color: rgb(9, 87, 84);
            height: 20px ;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
            color: azure;
        }
          /* This prevents scrolling */
#left_sidebar table tr.active {
    background-color: rgb(9, 87, 84);
    }

        </style>
    </head>
    <body>
    <div id="header">
    <img src="logos/Header.png" alt="Logo" style="width: 100%; height: 100%;">
    <div class="corner-item"><span style="font-size: larger; color:azure; " ><?php echo ucwords(strtolower($_SESSION["username"]));?>&nbsp;&nbsp;
    <img src="logos\Admin.png " alt="Logo" style="width: 50px; height: 50px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="logout.php" title="Logout">
    <img src="logos\Power.png" alt="Logout" style="width: 30px; height: 30px; margin-top: -65px;">
</a>
</span></div>
</div>

      <br>  
        <div class="row">
            <div id="left_sidebar">
            <table class="table">
            <tr <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>
                <td style="text-align:justify">
            <a href="index.php" type="button" class="link" >&nbsp;DashBoard</a>
        </td>
    </tr>
                    <tr>
                    <td style="text-align:justify">
                            <a href="task.php" type="button" class="link" id="manage_task" >&nbsp;Update Task</a>
                        </td>
                    </tr>
                    <tr>
                    <td style="text-align:justify">
                            <a href="extend_request.php" type="button" class="link" id="extend_request" >&nbsp;Extend Request</a>
                        </td>
                    </tr>
                    <tr>
                    <td style="text-align:justify">
                            <a href="extend_status.php" type="button"  class="link" id="extend_status" >&nbsp;Extend Status</a>
                        </td>
                    </tr>
                    <tr>
                    <td style="text-align:justify">
                            <a href="download.php" type="button"  class="link" id="cdf" >&nbsp;Manage Files</a>
                        </td>
                    </tr>
                    <tr>
                    <td style="text-align:justify">
                            <a href="BB.php" type="button"  class="link" id="BB" > &nbsp;Upload Files</a>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="right_sidebar">  
            <?php 
    
                include('./database.php');
                $query = "SELECT status, count(*) as number FROM tasks where  uid='{$_SESSION['username']}' GROUP BY status";  
                $result = mysqli_query($conn, $query);  
            ?>  
             <!DOCTYPE html>  
            <html>  
            <head>        
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
                <script type="text/javascript">  
                google.charts.load('current', {'packages':['corechart']});  
                google.charts.setOnLoadCallback(drawChart);  
                function drawChart()  
                {  
                var data = google.visualization.arrayToDataTable([  
                          ['status', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["status"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Your Project status',
                      titleTextStyle: {
        fontSize: 18 // Adjust this value to change the font size
    },
    
                        
                      //is3D:true,  
                      pieHole: 0.4  ,
                      backgroundColor: 'transparent' ,
                      width: '25vw'
// Set the background color with transparency
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }      setInterval(drawChart, 1);

           </script>  
                </head>  
                    <body>   
                    <div style="width:fit-content;border: 1.5px solid white;                    
                border-radius:10px;margin-top: -37px;  ">    
                    <div id="piechart" style="width: 25vw; height: 20vw; "></div>  
                </div> 
                <div id="dashboard_content" style="margin-left: 10vw; margin-top: -20vw; ">
                <style>
    body {
        font-family: Arial, sans-serif;
        
        
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        width:fit-content   ;
        font-size: 1.8vw;
    }
    p {
        color: #555;
        line-height: 1.6;
        font-weight: bolder;
        font-size: small;
    }
    .container {
                border: 1.5px solid white; /* Border color */
                padding: 20px; /* Padding around the container */
                width: 24vw;
                margin-left: 20vw;
                border-radius: 10px; /* Rounded corners */
            }

        /* Heading styling */
         /* Center align heading */
        

        /* Style for the button */
        input[type="submit"] {
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 15vw;
            font-size: 1.2vw;

            
        }

            /* Hover effect */
            input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
</style>
<div class="container" >
        <h2 style="text-align: center;
            color: white;" >Send A Message To Admin</h2><br>
        <!-- Use the button with the specified CSS class -->
        <center><a href="select_admin.php"  target="_blank"><input type="submit" value="Message To Admin"></a></center>

    </div>
              </div> 
                  
                    </body>  
            </html>
            </div>
        </div>
        <footer style="font-weight: lighter;">
    <!-- Footer content goes here -->
    <h6 >
        &copy; 2024 Airport and Aviation Services (Sri Lanka) (Private) Limited, All rights reserved.
       
    </h6>
</footer>
    </body>
</html>
    