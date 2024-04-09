    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }   

    include('./database.php');


    if (isset($_POST['create_task'])) {
    // Escape user inputs to prevent SQL injection
    $selectedUser = mysqli_real_escape_string($conn, $_POST['selectedUser']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $task = mysqli_real_escape_string($conn, $_POST['task']);

    // Assuming $_SESSION['username'] contains the creator's username
    $creator = mysqli_real_escape_string($conn, $_SESSION['username']);

    $query = "INSERT INTO tasks (uid, description, start_date, end_date, status, username, task, creator) 
        VALUES ('$selectedUser', '$description', '$start_date', '$end_date', 'Not Started', '$selectedUser', '$task', '$creator')";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo "<script type='text/javascript'>
            alert('Task Created Successfully..');
            window.location.href ='admin.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error... Please try again');
            window.location.href ='admin.php';
            </script>";
    }
}

    if (isset($_POST['create_notice'])) {
        // Escape user inputs to prevent SQL injection
        $message= mysqli_real_escape_string($conn, $_POST['message']);


        $query = "INSERT INTO notice (message) 
            VALUES ('$message')";

        
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            echo "<script type='text/javascript'>
                alert('Notice Posted Successfully..');
                window.location.href ='admin.php';
                </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Error... Please try again');
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
            <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript and dependencies (Popper.js, needed for Bootstrap's tooltips and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="style.css">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <title>Admin Dashboard</title>
            <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon">
            <script type="text/javascript">
                
        $(document).ready(function(){
            $("#AA").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("AA.php");
            });
        }); 
        $(document).ready(function(){
            $("#manage_user").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("registration.php");
            });
        });       
        $(document).ready(function(){
            $("#create_task").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("create_task.php");
            });
        });
        $(document).ready(function(){
            $("#manage_task").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("manage_task.php");
            });
        });
        $(document).ready(function(){
            $("#extends").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("extends.php");
            });
        });
        $(document).ready(function(){
            $("#upload").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("cc.php");
            });
        });
        $(document).ready(function(){
            $("#download").click(function(event){
                event.preventDefault();     
                $("#right_sidebar").load("CCdownload.php");
            });
        });
        
        $(document).ready(function(){
        // Add an 'active' class to the clicked table row and remove it from other rows
        $('#left_sidebar table tr').click(function(){
            $('#left_sidebar table tr').removeClass('active');
            $(this).addClass('active');
        });
    });

// Function to check if the window size changed significantly


    </script>
    
    <style>main {
            flex: 1;
        }
        footer {
            background-color: rgb(9, 87, 84);
            height: 20px ;
            text-align: center;
            width:100%;
            position: fixed;
            bottom: 0;
            color: white;
            
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
    <img src="logos\Admin.png " alt="Logo" style="width: 50px; height: 50px; margin-top: -15px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="logout.php" title="Logout">
    <img src="logos\Power.png" alt="Logout" style="width: 30px; height: 30px; margin-top: -65px;">
</a>
</span></div>
</div>

      <br>      <div class="row">
                <div id="left_sidebar">
                <table class="table">
                <tr <?php if(basename($_SERVER['PHP_SELF']) == 'admin.php') echo 'class="active"'; ?>>
                <td style="text-align:justify">
            <a href="admin.php" type="button" class="link" >&nbsp;DashBoard</a>
        </td>
    </tr>
                        <tr>
                        <td style="text-align:justify">
                                <a href="AA.php" type="button" class="link" id="AA" >&nbsp;Progress</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:justify">
                                <a href="registration.php" type="button"  class="link" id="manage_user" >&nbsp;Manage Users</a>
                            </td>
                        </tr>
                        <tr>
                        <td style="text-align:justify">
                                <a href="create_task.php" type="button" class="link" id="create_task" >&nbsp;Create Task</a>
                            </td>
                        </tr>
                        <tr>
                        <td style="text-align:justify">
                                <a href="manage_task.php" type="button"  class="link" id="manage_task" >&nbsp;Manage Task</a>
                            </td>
                        </tr>
                        <tr>
                        <td style="text-align:justify">
                                <a href="extends.php" type="button"  class="link" id="extends" >&nbsp;Extends</a>
                            </td>
                        </tr>
                        <tr>
                        <td style="text-align:justify">
                                <a href="cc.php" type="button"  class="link" id="upload" >&nbsp;Assign Files</a>
                            </td>
                        </tr>
                        <tr>
                        <td style="text-align:justify">
                                <a href="CCdownload.php" type="button"  class="link" id="download" >&nbsp;Manage Files</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div  id="right_sidebar">
                <?php 
    include('./database.php');
    $query = "SELECT status, count(*) as number FROM tasks GROUP BY status";  
    $result = mysqli_query($conn, $query);  
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
        padding: 20px;
        margin-left: -2vw;
        

    }

        .form { 
            width: 60vw;
            background-color:transparent;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 40% ;
            border: 1.5px solid white; 
            margin-top: -7vh;                

        }

        h3 {
            color: azure;
            margin-bottom: 20px;
            font-size: 1.7vw;
        }

        label {
            color: azure;
            display: block;
            height: 2vh;
            margin-bottom: 20px;

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
        button{
            width: 100%;
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;  
        }
        button:hover {
            background-color: rgb(9, 87, 84);
        }
    </style>
    </head>
    <body>

    <div class="container">
        <div class="form">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
            <script type="text/javascript"> 
    google.charts.load('current', {'packages':['corechart']});  
    google.charts.setOnLoadCallback(drawChart);  

    function drawChart() {  
        var data = google.visualization.arrayToDataTable([  
            ['status', 'Number'],   
            <?php  
            while($row = mysqli_fetch_array($result)) {  
                echo "['".$row["status"]."', ".$row["number"]."],";  
            }  
            ?>  
        ]);  

        var options = {
    title: 'Percentage of Project status',
    titleTextStyle: {
        fontSize: 18,
    },
    pieHole: 0.4,
    backgroundColor: 'transparent', // Set the background color with transparency
    chartArea: {
        width: '25vw',
            // Set the border radius here
    }
};  

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
        chart.draw(data, options);  
    }  

    // Refresh the chart every one second

</script>  
 
        </head>  
        <body>   
            <div style="width:fit-content;                
               ">  
                    <div  id="piechart" style="width: 23vw; height: 17vw;  "></div>  
            </div>
        </div>

        <div class="form"style="width: 90vw; margin-left: 25px;">
        <form action="" method="post">
            <h3>Send A Notice To All Users</h3>
            <label for="message">Message:</label>
            <textarea id="message" name="message" style="border-radius: 10px; height: 10vh; width:100%;" required></textarea>
            <center><button id type="submit" name="create_notice"  >Send Notice</button></center>
        </form>
        </div>

        <div class="form" style="width: 80vw; margin-left: 25px;" >
        <h3>Send A Message To Users</h3>
            <!-- Use the button with the specified CSS class -->
            <center><a href="select_user.php" target="_blank"><input type="submit" value="Message To All Users"></a></center>

        </div>
    </div>

    </body>
    </html>
            </div>
            <footer style="font-weight: lighter;">
    <!-- Footer content goes here -->
    <h6 >
    <center> &copy; 2024 Airport and Aviation Services (Sri Lanka) (Private) Limited, All rights reserved.</center>
    </h6>
</footer>

        </body>
        </html> 