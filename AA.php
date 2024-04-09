<!DOCTYPE html>
<html lang="en">
<head>  
<meta charset="UTF-8">
  
     <style>
        body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        form {
            border: 1.5px solid white; /* Border color */
                padding: 20px; /* Padding around the container */
                width: 400px; /* Max width of the container */
                border-radius: 10px; /* Rounded corners */
                margin-top: 20px; 
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: aliceblue;
            font-size: 20px;
            font-weight:500;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border-radius: 12px;
            
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
        <form id="userForm" style="margin-top: -30px;">
            <label for="userSelect">Select User:</label>
            <select id="userSelect" name="user">
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
            <input type="submit" value="Submit">
        </form>
        <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript"> 
     
        google.charts.load('current', {'packages':['corechart']});  
        function drawChart(selectedUser) {
            $.ajax({
                type: "POST",
                url: "get_user_data.php",       
                data: { user: selectedUser },
                success: function(response) {
                    var data = google.visualization.arrayToDataTable(response);
                  
                    var options = {  
                        title: 'Percentage of Project status',
                        titleTextStyle: {
                            fontSize: 18 , 
                            
                        },  
                        pieHole: 0.4,
                        backgroundColor: 'transparent', // Set the background color with transparency
                                        
                    };  
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                },
                error: function() {
                    console.log("Error fetching data");
                }
            });
        }

        $(document).ready(function() {
            $('#userForm').submit(function(event) {
                event.preventDefault();
                var selectedUser = $('#userSelect').val();
                drawChart(selectedUser);
            });
        });
        
    </script>
        </head>
    <div style="width: 200px;" > 
    <div id="piechart" style="width: 560px; height: 400px;margin-left: 520px; margin-top: -190px;               
                             
                border-radius:10px;"></div>  
    </div>                    
</body>  
</html>
